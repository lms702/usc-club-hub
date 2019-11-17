<?php // handles AJAX requests to add a club to favorites
    if(!isset($_GET['book_id']) || empty($_GET['book_id']) || !isset($_COOKIE['user_id'])){
        echo "failure";
    }
    else{
        require("config.php");
        $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if($mysqli->connect_errno) {
            echo "MySQL Connection Error: " . $mysqli->connect_error;
            exit();
        }
//        $stmt = $mysqli->prepare("INSERT INTO ")
    }