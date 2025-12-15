<?php 
    $servername = "localhost";
    $username = "12";
    $password = "qwertyuiop";
    $db = "store";
    
    $conn = new mysqli($servername, $username, $password, $db); 
    
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    } 
?>