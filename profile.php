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
$user_id = $_POST['user_id'];

$statement = $mysqli->prepare("SELECT * FROM users,  WHERE user_id = ?;");
$statement->bind_param('s', $user_id);
$executed = $statement->execute();
if(!$executed){
    echo $mysqli->errno;
}
$results = $statement->get_result();
$user = $results->fetch_assoc();

$username = $user['username'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        Log in!
    </title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="js/jquery-3.4.1.js" type="text/javascript"></script>
</head>
<body>
<div class="row" id="spacer">
    <div class="col col-2">
        <a href="index.php">
            <img src="resources/duck_icon.png" width="100%">
        </a>
    </div>
    <div class="col col-10"></div>
</div>
<div class="container" id="index-container">
    <div class="row">
        <div class="col">
            <h1>Hi <?php echo $username; ?>!</h1>
            <br>
            <h2>You have successfully logged in! There aren't very many priveleges associated with being logged in here,
                so you may want to just try making a new account because honestly that's more fun. I'll even give you a
            <a href="register.php">link</a> to do so. Happy trails!</h2>
        </div>
    </div>
    <div style="height: 15%;"></div>

</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="js/login-script.js" type="text/javascript"></script>
</body>
</html>