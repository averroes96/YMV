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
</style>
<body>
    <div class="bgimg w3-container w3-text-white w3-animate-opacity">
        
        <div class="w3-row-padding">
        
            <div class="w3-quarter w3-margin-top">

            <img src="../images/ymv_logo.png" alt="Logo" style="max-height:100px; max-width:80px">        

            </div>    
            <div class="w3-half" style="margin : 15% 0 0 0">
            <div class="w3-card w3-white w3-padding w3-animate-top w3-round">   
                <form class="w3-padding-large w3-margin" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                    <h3 class="w3-center w3-text-orange w3-margin-bottom">Admin Login</h3>
                    <input class="w3-input w3-margin w3-light-grey w3-hover-shadow" type="text" name="username" placeholder="Username" style="max-width: -webkit-fill-available;" />                
                    <input class="w3-input w3-margin w3-light-grey w3-hover-shadow" type="password" name="password" placeholder="Password" style="max-width: -webkit-fill-available;" />
                    <input class="w3-button w3-block w3-blue" type="submit" value="Submit" />
                </form>
            </div>
            </div>
        </div>
        <div class="w3-col s6 w3-padding">
              <h3>Co-sponsored by :</h3>
                    <img class="w3-animate-zoom w3-white w3-round w3-padding w3-margin" src="../images/Anna%20Lindh%20Foundation.png" alt="Sponsor1" style="width : 200px; height:80px">
                    <img class="w3-animate-zoom w3-white w3-round w3-padding w3-margin"  src="../images/British%20Council.png" alt="Sponsor2" style="width : 200px; height:80px">
        </div>    
        <div class="w3-col s6 w3-padding">
                <div class="w3-right">
                    <h3 class="">Co-Founded by :</h3>
                    <img class="w3-animate-zoom w3-round w3-padding"  src="../images/flag_yellow_high.jpg" alt="Founder" style="width : 200px; height:80px">
                </div>
        </div>         
    </div>    
<script src="../js/jquery-3.4.1.min.js" ></script>     
</body>    
</html>
