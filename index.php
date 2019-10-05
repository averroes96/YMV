<?php

    ob_start();

    session_start();

    if(isset($_SESSION["code"])){
        
        header('location: votePage.php');
        exit();
    }

    include "config.php" ;

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        
        if(isset($_SESSION["code"])){

            header('location: votePage.php');
            exit();
        }
        
        if(isset($_POST["submit"])){
            
            $code = filter_var($_POST["code"], FILTER_SANITIZE_STRING);
            $code = sha1($code);
            
            $stmt = $conn->prepare("SELECT * FROM code WHERE code = ? LIMIT 1");
            $stmt->execute(array($code));
            $row = $stmt->fetch();    
            $count = $stmt->rowCount();
            
            if($count > 0){
                
                if($row["vote_count"] == 0){
                
                $_SESSION['code'] = $row['code'];
                header("location: votePage.php");
                exit();
                    
                }
                else
                {
                    
                $formInfos = array();
                    
                $formInfos[] = "You have already voted using this code before the start of the debate. Wait for the end the debate to vote again";                    
                    
                }
                
            }
                else {
                    
                $formErrors = array();
                    
                $formErrors[] = "Wrong code ! Please make sure you entered a valid code";    
                    
                }            
            
        }
        
    }

?>

<!DOCTYPE html>
<html>
<title>Welcome Page</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/w3.css">
<link rel="stylesheet" href="css/custom.css">    
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link href="css/all.css" rel="stylesheet">    
<style>
body,h1 {font-family: "Raleway", sans-serif}
body, html {height: 100%}
.bgimg {
  background-image: url('images/main-picture.jpg');
    min-height: 120%;
    background-position: center;
    background-size: cover;
}
</style>
<body>
<div class="bgimg w3-display-container w3-animate-opacity w3-text-white">

  <div class="w3-display-topleft w3-padding-large w3-xlarge">
    Logo
  </div>   
  <div class="w3-display-middle ">
        <p class="w3-xlarge w3-animate-top w3-center">Welcome to the Algerian competition of debate</p>
        <p class="w3-xlarge w3-animate-top w3-center">Please insert your code here</p>
          <form class="w3-center" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST"> 
            <input required name="code" type="text" class="code-input w3-input w3-round w3-hover-shadow w3-text-grey" placeholder="Enter your code">
            <i class="fa fa-unlock-alt w3-text-grey"></i>
            <button name="submit" type="submit" class="w3-button w3-circle w3-padding w3-margin"><i class="fas fa-2x fa-arrow-circle-right w3-hover-text-blue"></i></button> 
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
<?php if(isset($formInfos) && !empty($formInfos)){    ?>      
      <p class="w3-blue w3-round w3-opacity w3-center w3-padding">
<?php
                foreach($formInfos as $info){
                    
                    echo $info . "<br/>";
                }
                
                ?>
      
      </p>
<?php   }   ?>       
    </div>  
<div class="w3-display-topright w3-center w3-padding-large w3-large">

    Sponsors
    
</div>    
</div>   
</body>
</html>

<?php ob_end_flush();   ?>