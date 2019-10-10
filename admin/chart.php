<?php


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
            
        $stmt = $conn->prepare("SELECT count(vote_two) as against FROM vote WHERE vote_two = 0");
        $stmt-> execute();
        
        $row = $stmt->fetch();

        $against_count1 = $row["against"];
        $against1 = "Against";
            
        $stmt = $conn->prepare("SELECT count(vote_two) as avec FROM vote WHERE vote_two = 1");
        $stmt-> execute();
        
        $row = $stmt->fetch();

        $with_count1 = $row["avec"];
        $with1 = "With";

        $counts1 = $against_count1 . "," . $with_count1;
        $withAgainst1 = " '" .$against1 . "' , '" . $with1 . "'";    
