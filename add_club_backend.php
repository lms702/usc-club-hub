<?php
    var_dump($_POST);

    $club_name = $_POST['name'];
    $short_desc = $_POST['short_desc'];
    $long_desc = $_POST['long_desc'];
    $category = $_POST['category'];
    $image_id = 1;
    if(isset($_POST['image_id']) && !empty($_POST['image_id'])){
        $image_id = $_POST['image_id'];
    }

    require("config.php");
    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if($mysqli->connect_errno) {
        echo "MySQL Connection Error: " . $mysqli->connect_error;
        exit();
    }
    $stmt = $mysqli->prepare("SELECT * FROM clubs WHERE name = ?");
    $stmt->bind_param('s', $club_name);
    $stmt->execute();
    $result = $stmt->get_result();
    if($result->num_rows > 0){
        // name is taken
        header("Location: add_club.php?&error=name_taken");
    }
//background-color: #000529;
//background-image: url("https://www.transparenttextures.com/patterns/cubes.png");
/* This is mostly intended for prototyping; please download the pattern and re-host for production environments. Thank you! */

    $stmt = $mysqli->prepare("INSERT INTO clubs(user_id, name, short_desc, long_desc, category_id, image_id)".
    "VALUES(?, ?, ?, ?, ?, ?)");
    $stmt->bind_param('isssii', $_COOKIE['user_id'], $club_name, $short_desc,
        $long_desc, $category, $image_id);
    $stmt->execute();
    header("Location: profile.php");
//    $result = $stmt->get_result();


