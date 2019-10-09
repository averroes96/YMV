<?php
    session_start();

    include "config.php";

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        
        if(isset($_SESSION["code"])){

            if(isset($_POST["second-vote"])){
                
                if($_SESSION["voteNbr"] == 1){
                
                    $code = filter_var($_SESSION["code"], FILTER_SANITIZE_STRING);

                    $vote = $_POST["poll"];    

                    $stmt = $conn->prepare("UPDATE vote SET vote_two = ?,vote_date = now() WHERE code = ?");
                    $stmt->execute(array($vote,$code));

                    if($stmt){
                        
                        $stmt = $conn->prepare("UPDATE code SET vote_count = 2 WHERE code = ?");
                        $stmt->execute(array($code));
                        
                        $_SESSION["voteNbr"] = 2;
                        
                        header("location: index.php");
                        exit();

                    }                    
                    
            }
            else{

                            header("location: index.php");
                            exit();        

            }                   

            }
    else{

                    header("location: index.php");
                    exit();        
        
    }            
            
        }
    else{

                    header("location: index.php");
                    exit();        
        
    }        
        
    }
    else{

                    header("location: index.php");
                    exit();        
        
    }

?>