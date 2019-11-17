<?php
    if(isset($_GET['username'])){
        $username = $_GET['username'];
    }
    else {
        $username = "";
    }
    $error_msg = "";
    if(isset($_GET['error'])){
        $error = $_GET['error'];
        if($error == 'already_exists'){
            $error_msg = "Error: This username is taken!";
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        Register!
    </title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="js/jquery-3.4.1.js" type="text/javascript"></script>
</head>
<style>
    body, html{
        background-image: url("resources/20191117_051143.jpg");
    }
</style>
<body>
<div class="row" id="spacer">
    <div class="col col-2">
        <a href="home.html">
            <img src="resources/duck_icon.png" width="100%">
        </a>
    </div>
    <div class="col col-10"></div>
</div>
<div class="container" id="index-container">
    <div class="row">
        <div class="col">
            <br>
            <h1>Please register with your username and password!</h1>
<!--            <h3> or you'll get rekt!</h3>-->
        </div>
    </div>
    <form class="form-horizontal" action="register-backend.php" method="POST" id="register-form">
        <div class="row form-group">
            <label for="username" class="col col-2 control-label">Username</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="username"
                       name="username" placeholder="Username" value="<?php echo $username; ?>">
            </div>
        </div>
        <div class="row form-group">
            <label for="password" class="col col-2 control-label">Password</label>
            <div class="col-sm-10">
                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
            </div>
        </div>
        <div class="row form-group">
            <label for="password-confirm" class="col col-2 control-label">Password</label>
            <div class="col-sm-10">
                <input type="password" class="form-control" id="confirm" name="confirm" placeholder="Confirm Password">
            </div>
        </div>
        <div class="row form-group">
            <div class="col col-6">
                <div id="error"><?php echo $error_msg; ?></div>
                Already have an account? <a href="login.php">Sign in.</a>
            </div>
            <div class="col col-6">
                <button id="register-submit" type="submit" class="btn btn-light">Register</button>
            </div>
        </div>
    </form>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="js/register-script.js" type="text/javascript"></script>
</body>
</html>