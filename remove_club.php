<?php
    $club_id = $_GET['club_id'];
    require("config.php");
    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if($mysqli->connect_errno) {
        echo "MySQL Connection Error: " . $mysqli->connect_error;
        exit();
    }
    // passwords are checked on frontend so don't have to check here
    // also assume all fields are filled
    //$user_id = $_POST['user_id'];

    $statement = $mysqli->prepare("DELETE FROM clubs WHERE id = ?");
    $statement->bind_param('i', $club_id);
    $statement->execute();