<?php

    ob_start();

    session_start();

    if(isset($_SESSION["username"])){       
        

    include "../config.php";

    include "../scripts/functions.php";
        
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        
        if(isset($_POST["vote-status"])){
            
            $val = $_POST["status"];
            
            $stmt = $conn->prepare("UPDATE status SET current_vote = ?");
            $stmt->execute(array($val));
            
            if($stmt){
                
                $_SESSION["current_vote"] = $val;
                
            }
            
        }
        
    }         

    include "chart.php";

    $stmt = $conn->prepare("SELECT * FROM vote INNER JOIN code on vote.code = code.code ORDER BY vote_date DESC LIMIT 7 ");
    $stmt->execute();
    $votes = $stmt->fetchAll();    
    $countVotes = $stmt->rowCount();     

?>

<!DOCTYPE html>
<html>
<title>Dashboard</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../css/w3.css">
<link rel="stylesheet" href="../css/custom.css">
<link rel="stylesheet" href="layout/css/Chart.css">     
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link href="../css/all.css" rel="stylesheet">   
<style> html,body,h1,h2,h3,h4,h5,h6 { font-family: 'Exo', sans-serif; }</style>
<style>
        @font-face{
            src: url(layout/fonts/Exo-Regular.ttf);
            font-family: Exo

        }          
</style>
<body class="w3-light-grey">

<!-- Top container -->
<div class="w3-bar w3-top w3-black w3-large" style="z-index:4">
    <button class="w3-bar-item w3-button w3-hide-large w3-hover-none w3-hover-text-light-grey" onclick="w3_open();"><i class="fa fa-bars"></i>  Menu
    </button>
  <a href="../index.php" class="w3-bar-item w3-right"><img src="../images/ymv_logo.png" alt="Logo" style="max-height:40px; max-width:40px"></a>
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
    <a href="dashboard.php" class="w3-bar-item w3-button w3-padding w3-ymv1"><i class="fas fa-chart-line fa-fw"></i>  Overview</a>
    <a href="codes.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-lock fa-fw"></i>  Codes</a>
    <a href="votes.php" class="w3-bar-item w3-button w3-padding"><i class="fas fa-vote-yea fa-fw"></i>  Votes</a>      
    <a href="new-admin.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-user fa-fw"></i>  New admin</a>
    <a href="../logout.php" class="w3-bar-item w3-button w3-padding"><i class="fas fa-sign-out-alt fa-fw"></i>  Logout</a>
    <p class="w3-padding">Status : <span class="w3-round w3-ymv-text1">
        <?php
            if($_SESSION["current_vote"] == 0)  echo "Paused";
            else if($_SESSION["current_vote"] == 1) echo "First vote";
            else if($_SESSION["current_vote"] == 2) echo "Second vote";
        
        ?>
        
        
        </span>
      </p>  
  </div>
</nav>


<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main w3-container w3-animate-right" style="margin-left:300px;margin-top:43px;">

  <!-- Header -->
  <header class="w3-container" style="padding-top:22px">
    <h3 class="w3-center w3-ymv-text"><i class="fas fa-tachometer-alt"></i> My Dashboard</h3>
  </header>

  <div class="w3-row-padding w3-margin-bottom">
    <a class="" href="codes.php"> 
        <div class="w3-quarter w3-hover-shadow">
          <div class="w3-container w3-red w3-padding-16">
            <div class="w3-left"><i class="fa fa-lock w3-xxxlarge"></i></div>
            <div class="w3-right">
              <h3><?php echo getTotal("code")   ?></h3>
            </div>
            <div class="w3-clear"></div>
            <h4>Codes</h4>
          </div>
        </div>
      </a>
    <a class="" href="votes.php">       
    <div class="w3-quarter w3-hover-shadow">
      <div class="w3-container w3-blue w3-padding-16">
        <div class="w3-left"><i class="fas fa-vote-yea w3-xxxlarge"></i></div>
        <div class="w3-right">
          <h3><?php echo getTotal("vote")   ?></h3>
        </div>
        <div class="w3-clear"></div>
        <h4>Votes</h4>
      </div>
    </div>
      </a>
    <a class="" href="votes.php">       
    <div class="w3-quarter w3-hover-shadow">
      <div class="w3-container w3-ymv1 w3-padding-16">
        <div class="w3-left"><i class="far fa-thumbs-up w3-xxxlarge"></i></div>
        <div class="w3-right">
          <h3><?php 
        
            if($_SESSION["current_vote"] == 1){
                echo countItems("*","vote",true,"vote_one",1);
            }
            else if($_SESSION["current_vote"] == 2)
                echo countItems("*","vote",true,"vote_two",1);
            else
                echo "0";
        ?>
                                </h3>
        </div>
        <div class="w3-clear"></div>
        <h4>With</h4>
      </div>
    </div>
      </a>
    <a class="" href="votes.php">       
    <div class="w3-quarter w3-hover-shadow">
      <div class="w3-container w3-ymv w3-text-white w3-padding-16">
        <div class="w3-left"><i class="far fa-thumbs-down w3-xxxlarge"></i></div>
        <div class="w3-right">
            <h3>
                <?php 
        
            if($_SESSION["current_vote"] == 1){
                echo countItems("*","vote",true,"vote_one",0);
            }
            else if ($_SESSION["current_vote"] == 2)
                echo countItems("*","vote",true,"vote_two",0);
        else
            echo "0";
            ?>
                
            
            </h3>
        </div>
        <div class="w3-clear"></div>
        <h4>Against</h4>
      </div>
    </div>
      </a>        
  </div>

  <div class="w3-panel">
    <div class="w3-row-padding" style="margin:0 -16px">
          <div class="w3-half w3-center">
                <canvas class="w3-margin-top" id="myChart"></canvas>          
          </div>
            <div class="w3-half">
                <canvas class="w3-margin-top" id="myChart1"></canvas>
            </div>
      </div>
        <h3 class="w3-center w3-ymv-text"><i class="fas fa-fw fa-rss"></i> Feeds</h3>
<?php   if($countVotes > 0){  ?>          
        <table class="w3-table w3-striped w3-white">
<?php   foreach ($votes as $vote){    ?>            
          <tr>
            <td><i class="fas fa-bell w3-text-blue w3-large"></i></td>
            <td>ID number <?php echo $vote["code_id"] ?> voted 
            <?php  
                
                if($_SESSION["current_vote"] == 1){
                    
                    if($vote["vote_one"] == 0){
                        
                        echo " against";
                    }
                    else{
                        
                        echo " with";
                    }
                }
                else if($_SESSION["current_vote"] == 2){
                    
                    if($vote["vote_two"] == 0){
                        
                        echo " against";
                    }
                    else{
                        
                        echo " with";
                    }                    
                    
                }
                    
                
    
            ?>
            </td>
            <td><i><?php echo proDate($vote["vote_date"]) ?></i></td>
          </tr>
<?php   }   ?>            
        </table>
<?php   }
      
      else{
      ?>
      <p class="w3-ymv1 w3-round w3-opacity w3-center w3-padding" style="width:">No recent activities</p>      
      <?php  }   ?>
  </div>
  <hr>
  <div class="w3-container">
      <h3 class="w3-center w3-ymv-text"><i class="fa fa-fw fa-chart-bar"></i> General Stats</h3>
    <p class="w3-ymv-text"><b>With after the debate</b></p>
    <div class="w3-grey">
      <div class="w3-container w3-center w3-padding w3-ymv1" style="width:<?php if(countVotes("WITH") != 0) { echo (integer)((After("WITH") / countVotes("WITH"))*100) ; } else echo 0; ?>%">+<?php if(countVotes("WITH") != 0) { echo (integer)((After("WITH") / countVotes("WITH"))*100) ; } else echo 0; ?>%</div>
    </div>

    <p  class="w3-ymv-text1"><b>Against after the debate</b></p>
    <div class="w3-grey">
      <div class="w3-container w3-center w3-padding w3-ymv" style="width:<?php if(countVotes("AGAINST") != 0) { echo (integer)((After("AGAINST") / countVotes("AGAINST"))*100) ;} else echo 0; ?>%"><?php if(countVotes("AGAINST") != 0) { echo (integer)((After("AGAINST") / countVotes("AGAINST"))*100) ;} else echo 0; ?>%</div>
    </div>

    <p class="w3-text-red"><b>Changed their opinion</b></p>
    <div class="w3-grey">
      <div class="w3-container w3-center w3-padding w3-red" style="width:<?php if(getTotal("vote") != 0) { echo (integer)((After("AGAINST") + After("WITH") / getTotal("vote"))*100) ;} else echo 0; ?>%"><?php if(getTotal("vote") != 0) { echo (integer)((After("AGAINST") + After("WITH") / getTotal("vote"))*100) ;} else echo 0; ?>%</div>
    </div>
  </div>
  <hr>

  <div class="w3-container">
      <h3 class="w3-center w3-ymv-text"><i class="fas fa-vote-yea"></i> Ratio</h3>
    <table class="w3-table w3-striped w3-bordered w3-border w3-hoverable w3-white">
      <tr>
        <td>With</td>
        <td><?php if(getTotal("vote") != 0){ echo (integer)(($with_count / getTotal("vote")) * 100); } else {echo 0;} ?> %</td>
      </tr>
      <tr>
        <td>Against</td>
        <td><?php if(getTotal("vote") != 0){ echo (integer)(($against_count / getTotal("vote")) * 100); } else {echo 0;} ?> %</td>
      </tr>
    </table><br>
  </div>
  <hr>

  <div class="w3-container w3-dark-grey w3-padding-32" id="status">
    <form class="w3-center" style="margin:0 20%" method="post" action="<?php echo $_SERVER["PHP_SELF"] ?>#status">    
        <h3 class="w3-bottombar w3-border-ymv w3-padding">Vote status</h3>
            <label class="container">Paused
              <input type="radio" name="status" value="0" <?php if($_SESSION["current_vote"] == 0) echo "checked" ?> >
              <span class="checkmark"></span>
            </label>

            <label class="container">First vote
              <input type="radio" name="status" value="1" <?php if($_SESSION["current_vote"] == 1) echo "checked" ?>>
              <span class="checkmark"></span>
            </label>
            <label class="container">Second vote
              <input type="radio" name="status" value="2" <?php if($_SESSION["current_vote"] == 2) echo "checked" ?>>
              <span class="checkmark"></span>
            </label>          
        <button class="w3-button w3-ymv1 w3-margin" name="vote-status">CONFIRM</button>       
    </form>    

  </div>

  <!-- End page content -->
</div>
<script src="../js/jquery-3.4.1.min.js" ></script>
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
    <script>
    Chart.defaults.global.title.display = true;
    Chart.defaults.global.title.text = "No title";   
    </script>
    
    <script type="text/x-javascript">
    
        var ctx = document.getElementById("myChart").getContext("2d");
        var chart = new Chart(ctx, {
            
            type: "bar",
            data: {
                
                labels: [<?php echo $withAgainst ?>,''],
                datasets: [{
                    
                    label: "Votes",
                    backgroundColor: "rgb(0, 104, 132)",
                    borderColor: "rgb(0,139,139)",
                    data: [<?php echo $counts ?>,0],
                    steppedLine: true
                    
                }]
                
            },
            options: {
                
                title:{
                    text:"First vote results"
                }               
                
            }
            
           
            
            
        });
    
    </script>
    <script type="text/x-javascript">
    
        var ctx = document.getElementById("myChart1").getContext("2d");
        var chart = new Chart(ctx, {
            
            type: "bar",
            data: {
                
                labels: [<?php echo $withAgainst1 ?>,''],
                datasets: [{
                    
                    label: "Votes",
                    backgroundColor: "rgb(0, 104, 132)",
                    borderColor: "rgb(0,139,139)",
                    data: [<?php echo $counts1 ?>,0],
                    steppedLine: true
                    
                }]
                
            },
            options: {
                
                title:{
                    text:"Second vote results"
                }               
                
            }
            
           
            
            
        });
    
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