<?php
    session_start();

    include "config.php";

    if(isset($_SESSION["code"])){
        
        ?>
<html>
<title>Voting Page</title>
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
    <a href="logout.php" class="w3-hover-text-blue w3-display-topmiddle w3-padding w3-large" style="text-decoration : none"><i class="fas fa-sign-out-alt"></i> Sign out</a>
  <div class="w3-display-middle w3-padding">
        <h1 class="w3-animate-zoom w3-center">Debate queastion here ?</h1>
        <br>
          <form class="w3-center w3-padding w3-animate-zoom" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST"> 
            <label class="container">With
              <input type="radio" name="poll">
              <span class="checkmark"></span>
            </label>

            <label class="container">Against
              <input type="radio" name="poll">
              <span class="checkmark"></span>
            </label>
            <button name="submit" type="submit" class="w3-button w3-circle w3-padding w3-margin"><i class="fas fa-2x fa-arrow-circle-right w3-hover-text-blue"></i></button>               
          </form> 
    </div>  
<div class="w3-display-topright w3-center w3-padding-large w3-large">

    Sponsors
    
</div>    
</div>   
</body>
</html>
<?php
                }
    else{
    
        header("location:index.php");
        exit();
        
    }

?>
