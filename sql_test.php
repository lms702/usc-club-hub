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
    $categories = ['Academic', 'Sports', 'Ethnic', 'Religious', 'Music', 'Greek Life', 'Competitive', 'Engineering'];
//    $mysqli->query("DELETE FROM categories");

    foreach ($categories as $cat){
//        echo $cat;
        $mysqli->query("INSERT INTO categories(category) VALUES('{$cat}')");
    }

    $result = $mysqli->query("SELECT category FROM categories;");
    var_dump($result->fetch_assoc());