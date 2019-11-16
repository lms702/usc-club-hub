<?php
    require("config.php");
    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if($mysqli->connect_errno) {
        echo "MySQL Connection Error: " . $mysqli->connect_error;
        exit();
    }
    else{
        echo 'success!';
    }