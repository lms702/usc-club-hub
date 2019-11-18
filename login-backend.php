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

$statement = $mysqli->prepare("SELECT * FROM users WHERE username = ?;");
$statement->bind_param('s', $username);
$executed = $statement->execute();
if(!$executed){
    echo $mysqli->errno;
}
$results = $statement->get_result();
$user = $results->fetch_assoc();
if($results->num_rows == 0) {
    // no users with that name
    header("Location: login.php?&error=no_users");
}
elseif($user['password'] != $password) {
    //incorrect password
    header("Location: login.php?&error=wrong_password&username=" . $username);
}
else{
    //login successful
    setcookie('user_id', $user['id'], time() + (86400 * 30), "/");
    header("Location: profile.php");
}