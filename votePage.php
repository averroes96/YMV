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
body, html {height: 100%}
.bgimg {
  background-image: url('images/main-picture.jpg');
    min-height: 100%;
    background-position: center;
    background-size: cover;
}
</style>
<style> html,body,h1,h2,h3,h4,h5,h6 { font-family: 'Exo', sans-serif; }</style>
<style>
        @font-face{
            src: url(admin/layout/fonts/Exo-Regular.ttf);
            font-family: Exo

        }          
</style>     
<script src="js/jquery-3.4.1.min.js" ></script>     
<body>
<div class="bgimg w3-container w3-animate-opacity w3-text-white">
<div class="w3-row-padding" style="min-height:60%">
  <div class="w3-quarter w3-padding-large">
    <img class="w3-padding" src="images/ymv_logo.png" alt="Logo" style="max-height:100px">
    <a href="logout.php" class="w3-hover-text-blue w3-padding w3-large w3-right" style="text-decoration : none"><i class="fas fa-sign-out-alt"></i> Sign out</a>      
  </div> 
<?php
        if($_SESSION["current_vote"] == 1){
            if($_SESSION["voteNbr"] == 0){  ?>    
  <div id="main-txt" class="w3-half w3-padding w3-center">
              <h1 class="w3-animate-top">First vote</h1>
          <form class="w3-center w3-padding w3-animate-zoom" action="first-vote.php" method="POST"  style="margin:15% 0 0 0">
        <h3 class="w3-animate-zoom w3-center">Debate question here ?</h3>
        <br>              
            <label class="container">With
              <input type="radio" name="poll" value="1">
              <span class="checkmark"></span>
            </label>

            <label class="container">Against
              <input type="radio" name="poll" value="0">
              <span class="checkmark"></span>
            </label> 
            <button id="load" type="submit" name="first-vote" class="w3-button w3-circle w3-padding w3-margin"><i class="fas fa-2x fa-arrow-circle-right w3-hover-ymv"></i></button>                
          </form>    
    </div>
<?php   } else {    ?>
    <div id="main-txt" class="w3-half w3-padding w3-center" style="margin:20% 0 0 0">            
      <p class="w3-ymv1 w3-large w3-round w3-opacity w3-center w3-padding">Your first vote was submitted ! </p>
    </div>      
            
<?php        }
            
        }
        else if($_SESSION["current_vote"] == 2){    ?>
               
<?php            if($_SESSION["voteNbr"] == 1){  ?>
  <div id="main-txt" class="w3-half w3-padding w3-center">
        <h3 class="w3-animate-top w3-center">Second vote</h3>       
        <h3 class="w3-animate-zoom w3-center">Debate question here ?</h3>
        <br>
          <form class="w3-center w3-padding w3-animate-zoom" action="second-vote.php" method="POST" style="margin:15% 0 0 0"> 
            <label class="container">With
              <input type="radio" name="poll" value="1">
              <span class="checkmark"></span>
            </label>

            <label class="container">Against
              <input type="radio" name="poll" value="0">
              <span class="checkmark"></span>
            </label> 
            <button id="load" type="submit" name="second-vote" class="w3-button w3-circle w3-padding w3-margin"><i class="fas fa-2x fa-arrow-circle-right w3-hover-ymv"></i></button>                
          </form>    
    </div>
<?php   } else {    ?>
    <div id="main-txt" class="w3-half w3-padding w3-center" style="margin:20% 0 0 0">            
      <p class="w3-ymv1 w3-large w3-round w3-opacity w3-center w3-padding">Your second vote was submitted ! </p>
    </div>      
            
<?php        }
            
        }
    else{   ?>
      
    <div id="main-txt" class="w3-half w3-padding w3-center" style="margin:20% 0 0 0">            
      <p class="w3-ymv1 w3-large w3-round w3-opacity w3-center w3-padding">Elections are paused for now ! </p>
    </div>
<?php   }   ?>    
    
<div class="w3-quarter w3-padding w3-hide-small">

    <a href="logout.php" class="w3-hover-text-blue w3-padding w3-large w3-right" style="text-decoration : none"><i class="fas fa-sign-out-alt"></i> Sign out</a>
    
</div>
   
    </div>
            <div class="w3-center w3-padding w3-hide-large w3-hide-medium ">
                    <h3 class="w3-text-white"><b>Co-Founded by</b></h3>
                    <img class="w3-animate-zoom"  src="images/flag_yellow_high.jpg" alt="Founder" style="width : 260px; height:130px">
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
        <div class="w3-twothird w3-hide-small">
            <div class="w3-right">
                    <h5 class="w3-ymv-text">Co-Founded by</h5>
                    <img class="w3-animate-zoom"  src="images/flag_yellow_high.jpg" alt="Founder" style="width : 140px; height:70px">
            </div>
        </div>
    </div>    

</footer>   
</body>
</html>
<?php
                }
    else{
    
        header("location:index.php");
        exit();
        
    }

?>
