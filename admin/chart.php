<?php


        $stmt = $conn->prepare("SELECT * FROM status LIMIT 1");
        $stmt-> execute();
        $row = $stmt->fetch();

        $_SESSION["current_vote"] = $row["current_vote"];

        if($row["current_vote"] == 0){

        $stmt = $conn->prepare("SELECT count(vote_one) as against FROM vote WHERE vote_one = 0");
        $stmt-> execute();
        
        $row = $stmt->fetch();

        $against_count = $row["against"];
        $against = "Against";
            
        $stmt = $conn->prepare("SELECT count(vote_one) as avec FROM vote WHERE vote_one = 1");
        $stmt-> execute();
        
        $row = $stmt->fetch();

        $with_count = $row["avec"];
        $with = "With";
            
        $counts = $against_count . "," . $with_count;
        $withAgainst = " '" .$against . "' , '" . $with . "'";     
 
        }
        else if($row["current_vote"] == 1) {
            
        $stmt = $conn->prepare("SELECT count(vote_two) as against FROM vote WHERE vote_two = 0");
        $stmt-> execute();
        
        $row = $stmt->fetch();

        $against_count = $row["against"];
        $againt = "Against";
            
        $stmt = $conn->prepare("SELECT count(vote_two) as with FROM vote WHERE vote_two = 1");
        $stmt-> execute();
        
        $row = $stmt->fetch();

        $against_count = $row["with"];
        $againt = "With";             
            
            
        }