<?php

    ob_start();
    
    session_start();

    include "../config.php";

    include "../scripts/functions.php";

    if(isset($_SESSION["username"])){
        
    $stmt = $conn->prepare("DELETE FROM code");
    $stmt->execute();
        
    try{    

    for($i=0; $i<200 ;$i++){
        
    $stmt = $conn->prepare("INSERT INTO code(code) VALUES(:zcode)");
    $stmt->execute(array(
    
        "zcode" => generateRandomString()
    
    ));
    
    }
    }
    catch(SQLException $e){
        
        echo "<p>Database Error ! Try again !</p>";
        echo "<br>";
        echo "<a href='codes.php'>Return</a>";
        
    }    
        

                        
                        $stmt = $conn->prepare("UPDATE status SET current_vote = 1");
                        $stmt->execute();
                        
                        $_SESSION["current_status"] = 0 ;
                        
                        header("location: ../admin/codes.php");
                        exit();
    
    }
        else {

            
            header("location: ../admin/index.php");
            exit();
            
        }

?>