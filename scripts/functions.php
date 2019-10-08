<?php

    function proDate($date){
        
        if(strtotime($date) > strtotime('- 1 minute') ){
            
            return "Just now";
        }
        else if(strtotime($date) < strtotime('-1 minute') &&  strtotime($date) > strtotime('- 2 minutes'))
            return "1 min";
        else if(strtotime($date) < strtotime('- 2 minutes') && strtotime($date) > strtotime('- 3 minutes'))
            return "2 mins";
        else if(strtotime($date) < strtotime('- 3 minutes') &&  strtotime($date) > strtotime('- 4 minutes'))
            return "3 mins";
        else if(strtotime($date) < strtotime('- 4 minutes') &&  strtotime($date) > strtotime('- 5 minutes'))
            return "4 mins"; 
        else if(strtotime($date) < strtotime('- 5 minutes') &&  strtotime($date) > strtotime('- 6 minutes'))
            return "5 mins";  
        else if(strtotime($date) < strtotime('- 6 minutes') &&  strtotime($date) > strtotime('- 7 minutes'))
            return "6 mins";  
        else if(strtotime($date) < strtotime('- 7 minutes') &&  strtotime($date) > strtotime('- 8 minutes'))
            return "7 mins";  
        else if(strtotime($date) < strtotime('- 8 minutes') &&  strtotime($date) > strtotime('- 9 minutes'))
            return "8 mins"; 
        else if(strtotime($date) < strtotime('- 9 minutes') &&  strtotime($date) > strtotime('- 10 minutes'))
            return "9 mins";
        else if(strtotime($date) < strtotime('- 10 minutes') &&  strtotime($date) > strtotime('- 20 minutes'))
            return "10 mins";
        else if(strtotime($date) < strtotime('- 20 minutes') &&  strtotime($date) > strtotime('- 30 minutes'))
            return "20 mins";
        else if(strtotime($date) < strtotime('- 30 minutes') &&  strtotime($date) > strtotime('- 40 minutes'))
            return "30 mins";
        else if(strtotime($date) < strtotime('- 40 minutes') &&  strtotime($date) > strtotime('- 50 minutes'))
            return "40 mins";
        else if(strtotime($date) < strtotime('- 50 minutes') &&  strtotime($date) > strtotime('- 60 minutes'))
            return "50 mins";
        else if(strtotime($date) < strtotime('- 60 minutes') && strtotime($date) > strtotime('- 2 hours'))
            return "1 hour";
        else if(strtotime($date) < strtotime('- 2 hours') && strtotime($date) > strtotime('- 3 hours'))
            return "2 hours";
        else if(strtotime($date) < strtotime('- 3 hours') && strtotime($date) > strtotime('- 4 hours'))
            return "3 hours";
        else if(strtotime($date) < strtotime('- 4 hours') && strtotime($date) > strtotime('- 5 hours'))
            return "4 hours";
        else if(strtotime($date) < strtotime('- 5 hours') && strtotime($date) > strtotime('- 6 hours'))
            return "5 hours";
        else if(strtotime($date) < strtotime('- 6 hours') && strtotime($date) > strtotime('- 7 hours'))
            return "6 hours";
        else if(strtotime($date) < strtotime('- 7 hours') && strtotime($date) > strtotime('- 8 hours'))
            return "7 hours";
        else if(strtotime($date) < strtotime('- 8 hours') && strtotime($date) > strtotime('- 9 hours'))
            return "8 hours";
        else if(strtotime($date) < strtotime('- 9 hours') && strtotime($date) > strtotime('- 10 hours'))
            return "9 hours";
        else if(strtotime($date) < strtotime('- 10 hours') && strtotime($date) > strtotime('- 11 hours'))
            return "10 hours";
        else if(strtotime($date) < strtotime('- 11 hours') && strtotime($date) > strtotime('- 12 hours'))
            return "11 hours";
        else if(strtotime($date) < strtotime('- 12 hours') && strtotime($date) > strtotime('- 15 hours'))
            return "12 hours";
        else if(strtotime($date) < strtotime('- 15 hours') && strtotime($date) > strtotime('- 18 hours'))
            return "15 hours";
        else if(strtotime($date) < strtotime('- 18 hours') && strtotime($date) > strtotime('- 21 hours'))
            return "18 hours";
        else if(strtotime($date) < strtotime('- 21 hours') && strtotime($date) > strtotime('- 24 hours'))
            return "21 hours";
        else if(strtotime($date) < strtotime('- 1 day') && strtotime($date) > strtotime('- 2 days'))
            return "1 day";
        else if(strtotime($date) < strtotime('- 2 days') && strtotime($date) > strtotime('- 3 days'))
            return "2 days";
        else if(strtotime($date) < strtotime('- 3 days') && strtotime($date) > strtotime('- 4 days'))
            return "3 days";
        else if(strtotime($date) < strtotime('- 4 days') && strtotime($date) > strtotime('- 5 days'))
            return "4 days";
        else if(strtotime($date) < strtotime('- 5 days') && strtotime($date) > strtotime('- 6 days'))
            return "5 days";      
        else
            return date("d M Y | h:s a", strtotime($date));
           
        
        
    }

    function getTotal($table){
        
        global $conn;
        
        $stmt = $conn->prepare("SELECT * FROM $table ");
        $stmt-> execute();
        
        $row = $stmt->rowCount();
        
        return $row; 
    }

    function generateRandomString($length = 8) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    function countItems($item, $table, $where = false, $attr = '', $value = ''){
        
        global $conn;
        
        if($where == true){
        
        $stmt = $conn->prepare("SELECT count($item) FROM $table WHERE $attr = $value");
        $stmt->execute();
            
        }
        
        else{
        $stmt = $conn->prepare("SELECT count($item) FROM $table");
        $stmt->execute(); 
            
        }
            
        return $stmt->fetchColumn();
        
        
    }

    function checkRecord($select, $from, $value){
        
        global $conn;
        
        $stmt = $conn->prepare("SELECT $select FROM $from WHERE $select = ?");
        $stmt->execute(array($value));
        $count = $stmt->rowCount();
        
        return $count;
    }

?>