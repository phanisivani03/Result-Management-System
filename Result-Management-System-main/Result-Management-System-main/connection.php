<?php
    $host = "localhost";
    $user = "user";
    $agnyath = 'Mine@552123';
    $db_name = "r20";
      
    $con = new mysqli($host, $user, $agnyath, $db_name);
    if ($con->connect_error) {
        die("Failed to connect with MySQL: ". $con->connect_error);
    }
