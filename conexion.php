<?php


    $user='root';
    $password='';
    $database='pokemon';
    $servername='localhost';

    // Create connection
    $conn = new mysqli($servername, $user, $password, $database);
    // Check connection
    if ($conn->connect_error) {
         die("Connection failed: " . $conn->connect_error);
    }else{
        echo "";
    }

    
?>