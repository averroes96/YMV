<?php

    ob_start();

    session_start();


    if(isset($_SESSION["code"])){
        
        header('location: votePage.php');
        exit();
    }

    include "config.php" ;

    include "scripts/functions.php";



    if($_SERVER["REQUEST_METHOD"] == "POST"){
        
        if(isset($_SESSION["code"])){

            header('location: votePage.php');
            exit();
        }
        
        if(isset($_POST["submit"])){
            
            $code = filter_var($_POST["code"], FILTER_SANITIZE_STRING);
            
            $stmt = $conn->prepare("SELECT * FROM code WHERE code = ? LIMIT 1");
            $stmt->execute(array($code));
            $row = $stmt->fetch();    
            $count = $stmt->rowCount();
            
            if($count > 0){
                
                if($_SESSION["current_vote"] == 0){
                
                $formInfos = array();
                    
                $formInfos[] = "Elections are paused for now.";                    
                                        
                    
                }                
                
                else if($_SESSION["current_vote"] == 1){
                
                if($row["vote_count"] == 0){
                
                $_SESSION['code'] = $_POST["code"];
                $_SESSION["voteNbr"] = $row["vote_count"];
                    
                header("location: votePage.php");
                exit();
                    
                }
                else
                {
                    
                $formInfos = array();
                    
                $formInfos[] = "You have already submitted your vote using this code before the start of the debate. Wait for its end to vote again";                    
                    
                }
                }
                else if($_SESSION["current_vote"] == 2)
                {
                if($row["vote_count"] == 1){
                
                $_SESSION['code'] = $_POST["code"];
                $_SESSION["voteNbr"] = $row["vote_count"];
                header("location: votePage.php");
                exit();
                    
                }
                else
                {
                    
                $formInfos = array();
                    
                $formInfos[] = "Sorry you can't access this page for now !";                    
                    
                }                    
                    
                    
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
body, html {height: 100%}
.bgimg {
  background-image: url('images/main-picture.jpg');
    min-height: 100%;
    background-position: center;
    background-size: cover;
}
body{
        
    background-color: #006884;    
    }
</style>
<style> html,body,h1,h2,h3,h4,h5,h6 { font-family: 'Exo', sans-serif; }</style>
<style>
        @font-face{
            src: url(admin/layout/fonts/Exo-Regular.ttf);
            font-family: Exo

        }          
</style>    
<body>
<div class="bgimg w3-animate-opacity w3-text-white">
<div class="w3-row-padding">
  <div class="w3-quarter w3-animate-left w3-padding-large">
    <img class="w3-padding" src="images/ymv_logo.png" alt="Logo" style="max-height:100px">
  </div>   
  <div class="w3-half w3-padding" style="margin: 15% 0 0 0">
        <p class="w3-xlarge w3-animate-top w3-center">Welcome to the Algerian competition of debate</p>
        <p class="w3-xlarge w3-animate-top w3-center">Please insert your code here</p>
          <form class="w3-center w3-animate-top" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST"> 
            <input autocomplete="off" required name="code" type="text" class="w3-animate-input code-input w3-input w3-round w3-hover-shadow w3-text-grey" placeholder="Enter your code">
            <i class="fa fa-unlock-alt w3-ymv-text"></i>
            <button name="submit" type="submit" class="w3-button w3-circle w3-padding w3-margin"><i class="fas fa-2x fa-arrow-circle-right w3-hover-ymv"></i></button> 
          </form>
<?php if(isset($formErrors) && !empty($formErrors)){    ?>      
      <p class="w3-ymv w3-round w3-opacity w3-center w3-padding">
<?php
                foreach($formErrors as $error){
                    
                    echo $error . "<br/>";
                }
                
                ?>
      
      </p>
<?php   }   ?>
<?php if(isset($formInfos) && !empty($formInfos)){    ?>      
      <p class="w3-ymv1 w3-round w3-opacity w3-center w3-padding">
<?php
                foreach($formInfos as $info){
                    
                    echo $info . "<br/>";
                }
                
                ?>
      
      </p>
<?php   }   ?>

    </div>
    <div class="w3-quarter w3-padding w-center w3-hide-large w3-hide-medium w3-animate-zoom" style="margin:20% 0">
    
        <h3 class="w3-text-white w3-center"><b>Co-Founded by</b></h3>
        <p class="w3-center"><img  src="images/flag_yellow_high.jpg" alt="Founder" style="width : 200px; height:120px">  </p>      
    
    </div>
    </div>     

 
</div>
<!-- Footer -->
<footer class="w3-container w3-padding-16 w3-light-grey w3-xlarge">
    <div class="w3-row-padding">    
        <div class="w3-third w3-center">
              <h5 class="w3-ymv-text">Co-sponsored by</h5>
                    <img class="w3-animate-zoom w3-round w3-padding" src="images/Anna%20Lindh%20Foundation.png" alt="Sponsor1" style="width : 180px; height:70px">
                    <img class="w3-animate-zoom w3-round w3-padding"  src="images/British%20Council.png" alt="Sponsor2" style="width : 180px; height:70px">
        </div>    
        <div class="w3-twothird w3-hide-small ">
            <div class="w3-right">
                    <h5 class="w3-ymv-text">Co-Founded by</h5>
                    <img class="w3-animate-zoom"  src="images/flag_yellow_high.jpg" alt="Founder" style="width : 140px; height:70px">
            </div>
        </div>
    </div>    

</footer>      
<script src="js/jquery-3.4.1.min.js" ></script>     
</body>    
</html>

<?php ob_end_flush(); ?>