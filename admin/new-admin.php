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
        
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        
        if(isset($_POST["new_admin"])){
            
            $formErrors = array();
            
            $username = filter_var($_POST["username"], FILTER_SANITIZE_STRING);
            $password = $_POST["password"];
            $fullname = filter_var($_POST["fullname"], FILTER_SANITIZE_STRING);
                    
            if(empty(trim($username)) || strlen($username) < 8 || !preg_match("/^(?=.{8,20}$)(?![_.])(?!.*[_.]{2})[a-zA-Z0-9._]+(?<![_.])$/", $username)) 
                $user_error = "Please enter a valid username ! ( username must be contain at least 8 characters and contain no spaces in between )" ;
            
            // Validate password strength
            $uppercase = preg_match('@[A-Z]@', $password);
            $lowercase = preg_match('@[a-z]@', $password);
            $number    = preg_match('@[0-9]@', $password);
            $specialChars = preg_match('@[^\d\w]@', $password);                        

            if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8 || empty(trim($password))) {
                $pass_error = "Password should contain at least 8 characters, one uppercase, lowercase, number and special character ";
                }
            
            if(empty(trim($fullname)) || !preg_match("/^[a-zA-Z]+(([' -][a-zA-Z ])?[a-zA-Z]+)*$/", $fullname))  $name_error =  "Please enter a valid fullname" ;            
            
            
            if( !isset($user_error) && !isset($pass_error) && !isset($name_error)){
                
            
            $check = checkRecord("username","admin",$username);
                
            if($check == 0){
                
            $password = sha1($password);    
            
            $stmt = $conn->prepare("INSERT INTO admin(username,password,fullname) VALUES (:zuser, :zpass, :zname)");
            $stmt->execute(array(
            
                "zuser" => $username,
                "zpass" => $password,
                "zname" => $fullname
            
            )); 
            
            if($stmt){
                
                $success = "Admin was successfully added !";
                
            }
                else {
                
                    "DATABASE ERROR !";
                    
                }
            }
                else{
                    
                    $admin_exist = "This username was taken by another admin";
                }
            }
            
        }
        
    }        

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
    <a href="dashboard.php" class="w3-bar-item w3-button w3-padding"><i class="fas fa-chart-line fa-fw"></i>  Overview</a>
    <a href="codes.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-lock fa-fw"></i>  Codes</a>
    <a href="votes.php" class="w3-bar-item w3-button w3-padding"><i class="fas fa-vote-yea fa-fw"></i>  Votes</a>       
    <a href="new-admin.php" class="w3-bar-item w3-button w3-padding w3-ymv1"><i class="fa fa-user fa-fw"></i>  New admin</a>
    <a href="../logout.php" class="w3-bar-item w3-button w3-padding"><i class="fas fa-sign-out-alt fa-fw"></i>  Logout</a>      
  </div>
</nav>


<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>
    <div class="w3-main w3-container w3-animate-right" style="margin-left:300px;margin-top:43px;">
                    
                    
                    
                    <form class="w3-card w3-white w3-padding" style="margin: 5% 10%" action="<?php echo $_SERVER["PHP_SELF"] ?>" method="post">
                        
                        <h1 class="w3-center w3-text-dark-grey">New admin</h1>
                        
                        <?php   if(isset($success)){ ?>
                        <p class="w3-ymv1 w3-center w3-margin w3-round w3-padding"><?php echo $success ?></p>
                        <?php   }   ?>                           
                        
                        <!-- Username -->
                        <p class="w3-padding">
                            <label class="w3-label w3-ymv-text">Username  <span class="w3-text-red">*</span></label>
                            <input id="username" type="text" <?php if(isset($username) && !isset($success)) echo "value='" . $username . "' " ?> name="username" class="w3-input w3-text-grey" autocomplete="off"s  required="required">    
                        
                        </p>
                        <?php   if(isset($user_error)){ ?>
                        <p class="w3-ymv w3-center w3-margin w3-round w3-padding"><?php echo $user_error ?></p>
                        <?php   }   ?>
                        <?php   if(isset($admin_exist)){ ?>
                        <p class="w3-ymv w3-center w3-margin w3-round w3-padding"><?php echo $admin_exist ?></p>
                        <?php   }   ?>                        
                                            <!-- Password -->
                        <p class="w3-margin-bottom w3-padding">
                            <label class="w3-label w3-ymv-text">Password <span class="w3-text-red">*</span></label>
                            <input id="password" type="password" name="password" class=" w3-input w3-text-grey password" autocomplete="new-password" required="required">                         
                        </p>
                        <?php   if(isset($pass_error)){ ?>
                        <p class="w3-ymv w3-center w3-margin w3-round w3-padding"><?php echo $pass_error ?></p>
                        <?php   }   ?>                        

                                                <!-- Full name -->
                        <p class="w3-padding">
                            <label class="w3-label w3-ymv-text">Fullname  <span class="w3-text-red">*</span></label>
                            <input id="username" type="text" name="fullname" class="w3-input w3-text-grey" autocomplete="off"s  required="required" <?php if(isset($fullname) && !isset($success)) echo "value='" . $fullname . "' " ?>>    
                        
                        </p>
                        <?php   if(isset($name_error)){ ?>
                        <p class="w3-ymv w3-center w3-margin w3-round w3-padding"><?php echo $name_error ?></p>
                        <?php   }   ?>                        
                            
                                                <!-- SAVE -->
                        <p class="w3-padding w3-center"><button type="submit" name="new_admin" class="w3-button w3-ymv1 w3-center"><i class="fa fa-fw fa-plus"></i> ADD</button>
                        </p>                      
                            

                    </form>       
    
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