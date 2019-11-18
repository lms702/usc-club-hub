<?php
//    mysqli_report(MYSQLI_REPORT_ALL);
    require("config.php");
    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if($mysqli->connect_errno) {
        echo "MySQL Connection Error: " . $mysqli->connect_error;
        exit();
    }
    // passwords are checked on frontend so don't have to check here
    // also assume all fields are filled
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm = $_POST['confirm'];

    $statement = $mysqli->prepare("SELECT * FROM users WHERE username = ?;");
    $statement->bind_param('s', $username);
    $executed = $statement->execute();
    if(!$executed){
        echo $mysqli->errno;
    }
//    var_dump($statement->get_result()->num_rows);
//    exit();
    if($statement->get_result()->num_rows > 0){
        // username exists - redirect back to register page
        header("Location: register.php?username=" . $username . "&error=already_exists");
    }
    else {
        // create user
//        var_dump($username);
//        var_dump($password);
        $statement = null;
        $statement = $mysqli->prepare("INSERT INTO users(username, password) VALUES(?, ?);");
        $statement->bind_param('ss', $username, $password);
        $executed = $statement->execute();
        if (!$executed) {
            echo $mysqli->errno;
        }
        $stmt = $mysqli->prepare("SELECT id FROM users WHERE username = ?");
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
//            exit();
//      header("Location: login.php?username=" . $username);
        setcookie('user_id', $row['id'], time() + (86400 * 30), "/");
        header("Location: home.php");
    }