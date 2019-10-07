<?php

    ob_start();

    session_start();

    if(isset($_SESSION["username"])){

    include "../config.php";

    include "../scripts/functions.php";

    $stmt = $conn->prepare("SELECT * FROM code");
    $stmt->execute();
    $codes = $stmt->fetchAll();    
    $countVotes = $stmt->rowCount();     

?>

<!DOCTYPE html>
<html>
<title>Codes</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../css/w3.css">
<link rel="stylesheet" href="../css/custom.css">
<link rel="stylesheet" href="layout/css/Chart.css">     
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link href="../css/all.css" rel="stylesheet">   
<style>
html,body,h1,h2,h3,h4,h5 {font-family: "Raleway", sans-serif}
</style>
<body class="w3-light-grey">

<!-- Top container -->
<div class="w3-bar w3-top w3-black w3-large" style="z-index:4">
    <button class="w3-bar-item w3-button w3-hide-large w3-hover-none w3-hover-text-light-grey" onclick="w3_open();"><i class="fa fa-bars"></i>  Menu
    </button>
  <span class="w3-bar-item w3-right"><img src="../images/ymv_logo.png" alt="Logo" style="max-height:40px; max-width:40px"></span>
</div>

<!-- Sidebar/menu -->
<nav class="w3-sidebar w3-collapse w3-white w3-animate-left" style="z-index:3;width:300px;" id="mySidebar"><br>
  <div class="w3-container w3-row">
    <div class="w3-col s8 w3-bar">
      <span>Welcome, <strong><?php  echo $_SESSION["username"]  ?></strong></span><br>
    </div>
  </div>
  <hr>
  <div class="w3-container">
    <h4 class="w3-ymv-text">Dashboard</h4>
  </div>
  <div class="w3-bar-block">
    <a href="#" class="w3-bar-item w3-button w3-padding-16 w3-hide-large w3-dark-grey w3-hover-black" onclick="w3_close()" title="close menu"></a>
    <a href="dashboard.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-users fa-fw"></i>  Overview</a>
    <a href="#" class="w3-bar-item w3-button w3-padding w3-ymv1"><i class="fa fa-eye fa-fw"></i>  Codes</a>
    <a href="votes.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-eye fa-fw"></i>  Votes</a>       
    <a href="#" class="w3-bar-item w3-button w3-padding"><i class="fa fa-users fa-fw"></i>  New admin</a>
    <a href="../logout.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-users fa-fw"></i>  Logout</a>      
  </div>
</nav>


<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>
    <div class="w3-main w3-container w3-animate-right" style="margin-left:300px;margin-top:43px;">
    
                <div class="table-responsive w3-white w3-padding w3-margin-top">
                    
                    <h2 class="w3-center w3-text-dark-grey w3-margin-bottom">Codes Manager</h2>
                    <p style="margin: 0 20%"><input class="w3-input w3-border w3-margin-bottom" id="myInput" type="text" placeholder="Search code.."></p>                    
                    <p class="w3-center"><a href="insert-codes.php" class="w3-button w3-ymv1">Generate new codes</a></p>
<?php   if(!empty($codes)){ ?>                    

                    <table class='main-table w3-center w3-hoverabl w3-table table-bordered w3-table w3-card' id="result">
                        <tr>
                        <td class="w3-ymv1 w3-center"> # </td>
                        <td class="w3-ymv1 w3-center">Code</td>
                        <td class="w3-ymv1 w3-center">Votes</td> 
                        
                        </tr>
                        <?php 
                        
                        foreach($codes as $code){   ?>
                            
                        <tr class="filtered">
                        <td class="w3-center w3-text-grey"><?php   echo $code["code_id"]   ?></td>
                        <td class="w3-center w3-text-grey"><?php   echo $code["code"]   ?></td>
                        <td class="w3-center w3-text-grey"><?php   echo $code["vote_count"]   ?></td> 
                        
                        </tr>                            

<?php                        }
                    ?> 

                    </table>
                    
                    <div class="pagination"></div>
<?php   }else{  ?>
    
      <p class="w3-blue w3-round w3-opacity w3-center w3-padding">No codes inserted yet !</p>    
    
<?php   }   ?>                    
                
                </div>
    </div>    
    
<script src="../js/jquery-3.4.1.min.js" ></script>
<script src="layout/js/admin.js" ></script>    
<script src="layout/js/Chart.bundle.js"></script>
<script src="layout/js/Chart.js"></script>    
<script>
// Get the Sidebar
var mySidebar = document.getElementById("mySidebar");

// Get the DIV with overlay effect
var overlayBg = document.getElementById("myOverlay");

// Toggle between showing and hiding the sidebar, and add overlay effect
function w3_open() {
  if (mySidebar.style.display === 'block') {
    mySidebar.style.display = 'none';
    overlayBg.style.display = "none";
  } else {
    mySidebar.style.display = 'block';
    overlayBg.style.display = "block";
  }
}

// Close the sidebar with the close button
function w3_close() {
  mySidebar.style.display = "none";
  overlayBg.style.display = "none";
}
</script> 
 

</body>
</html>
<?php   ob_end_flush(); 

    }
    else{
        
        header("location: index.php");
        exit();
        
    }

?>    