<?php

    $dbn = "mysql:host=localhost;dbname=election";
    $user = "root";
    $pass = "";
    $options = array(
        
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
            
        );
    
    try{
        
    $conn = new PDO($dbn, $user, $pass, $options);
        } catch (PDOException $pe){
    echo 'Connection failed!' . $pe->getMessage();
        }


            $stmt = $conn->prepare("SELECT * FROM status");
            $stmt->execute();
            $row = $stmt->fetch();

            $_SESSION["current_vote"] = $row["current_vote"];
                
                