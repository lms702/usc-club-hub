<?php // handles AJAX requests to add a club to favorites
    if(!isset($_GET['club_id']) || empty($_GET['club_id']) || !isset($_COOKIE['user_id'])){
        echo "failure";
    }
    else{
        require("config.php");
        $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if($mysqli->connect_errno) {
            echo "MySQL Connection Error: " . $mysqli->connect_error;
            exit();
        }

        $stmt = $mysqli->prepare("SELECT * FROM favorites WHERE club_id = ? AND user_id = ?;");
        $stmt->bind_param('ii', $_GET['club_id'], $_COOKIE['user_id']);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows > 0){
            echo 'already in favorites';
            exit();
        }
        else{
            $stmt = $mysqli->prepare("INSERT INTO favorites(user_id, club_id) VALUES(?,?);");
            $stmt->bind_param('ii', $_COOKIE['user_id'],$_GET['club_id']);
            $stmt->execute();
            echo "inserted";
            exit();
        }
    }