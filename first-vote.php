<?php
    session_start();

    include "config.php";

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        
        if(isset($_SESSION["code"])){

            if(isset($_POST["submit"])){
                
                if($_SESSION["voteNbr"] < 1){
                
                    $code = filter_var($_SESSION["code"], FILTER_SANITIZE_STRING);

                    $vote = $_POST["poll"];    

                    $stmt = $conn->prepare("INSERT INTO vote(vote_date, code, vote_one) VALUES (now(), :zcode, :zvote)");
                    $stmt->execute(array(
                        
                        "zcode" => $code,
                        "zvote" => $vote

                    ));

                    if($stmt){
                        
                        $stmt = $conn->prepare("UPDATE code SET vote_count = 1 WHERE code = ?");
                        $stmt->execute(array($code));
                        
                        $_SESSION["voteNbr"] = 1;
                        
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