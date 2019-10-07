<?php

    ob_start();

    session_start();

    if(isset($_SESSION["username"])){
        
        header('location: dashboard.php');
        exit();
        
    }

    require "../config.php" ;

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        
        if(isset($_SESSION["username"])){

            header('location: dashboard.php');
            exit();
        }
        
        if(isset($_POST["submit"])){
            
            $formErrors = array();
            
            $username = filter_var($_POST["username"], FILTER_SANITIZE_STRING);
            $password = $_POST["password"];
            
            if(empty(trim($username)))  $formErrors[] = "Please enter a valid username !";
            
            if(empty(trim($password)))  $formErrors[] = "Please enter your password !";
            
            if(empty($formErrors)){
                
            $password = sha1($password);    
            
            $stmt = $conn->prepare("SELECT * FROM admin WHERE username = ? AND password = ? LIMIT 1");
            $stmt->execute(array($username, $password));
            $row = $stmt->fetch();    
            $count = $stmt->rowCount();    
            
            if($count > 0){
                
                $_SESSION['username'] = $row["username"];
                header("location: dashboard.php");
                exit();
            }
                else {
                    
                $formErrors = array();
                    
                $formErrors[] = "Wrong code ! Please make sure you entered a valid code";   
                    
                }
            }
            
        }
        
    }

?>

<!DOCTYPE html>
<html>
<title>Admin login</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../css/w3.css">
<link rel="stylesheet" href="../css/custom.css">    
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link href="../css/all.css" rel="stylesheet">    
<style>
body,h1 {font-family: "Raleway", sans-serif}
body, html {height: 100%}
.bgimg {
  background-image: url('../images/main-picture.jpg');
    min-height: 100%;
    background-position: center;
    background-size: cover;
}
body{   background-color: #006884;    }    
</style>
<body>
    <div class="bgimg w3-container w3-text-white w3-animate-opacity">
        
        <div class="w3-row-padding">
        
            <div class="w3-quarter w3-margin-top">

            <img src="../images/ymv_logo.png" alt="Logo" style="max-height:100px; max-width:80px">        

            </div>    
            <div class="w3-half" style="margin : 15% 0 0 0">
            <div class="w3-card w3-white w3-margin-bottom w3-padding w3-animate-top w3-round">               
                <form class="w3-padding-large" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                    <h2 class="w3-center w3-ymv-text"><i class="fas fa-tachometer-alt"></i> Admin panel</h2>                     
                    <p><input required class="w3-input w3-input2 w3-margin w3-text-grey w3-light-grey w3-hover-shadow" type="text" name="username" placeholder="Username" style="max-width: -webkit-fill-available;" /></p>
                    <i class="fa fa-user w3-input-icon"></i>
                    <p><input required class="w3-input w3-input2 w3-text-grey w3-margin w3-light-grey w3-hover-shadow" type="password" name="password" placeholder="Password" style="max-width: -webkit-fill-available;" /></p>
                    <i class="fa fa-lock w3-input-icon"></i>
                    <p class="w3-center"><button name="submit" class="w3-button w3-block w3-ymv1" type="submit" ><i class="fas fa-fw fa-sign-in-alt"></i> Login</button></p>
                </form>
                <?php if(isset($formErrors) && !empty($formErrors)){    ?>      
                      <p class="w3-red w3-round w3-opacity w3-center w3-padding">
                <?php
                                foreach($formErrors as $error){

                                    echo $error . "<br/>";
                                }

                                ?>

                      </p>
                <?php   }   ?>                
            </div>
            </div>
        </div>         
    </div>
<!-- Footer -->
<footer class="w3-container w3-padding-16 w3-light-grey w3-xlarge">
    <div class="w3-row-padding">    
        <div class="w3-twothird">
              <h3 class="w3-ymv-text">Co-sponsored by</h3>
                    <img class="w3-animate-zoom w3-round w3-padding" src="../images/Anna%20Lindh%20Foundation.png" alt="Sponsor1" style="width : 220px; height:100px">
                    <img class="w3-animate-zoom w3-round w3-padding"  src="../images/British%20Council.png" alt="Sponsor2" style="width : 220px; height:100px">
        </div>    
        <div class="w3-third w3-center">
                    <h3 class="w3-ymv-text">Co-Founded by</h3>
                    <img class="w3-animate-zoom w3-round w3-padding"  src="../images/flag_yellow_high.jpg" alt="Founder" style="width : 170px; height:100px">
        </div>
    </div>    

</footer>      
<script src="../js/jquery-3.4.1.min.js" ></script>     
</body>    
</html>
