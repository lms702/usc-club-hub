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
    if($error == "no_users"){
        $error_msg = "No user of this name exists!";
    }
    else if($error == 'wrong_password'){
        $error_msg = "Incorrect password!";
    }
}
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
    <link rel="stylesheet" type="text/css" href="css/about.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="js/jquery-3.4.1.js" type="text/javascript"></script>
</head>
<style>
    body, html{
        background-image: url("resources/eth.jpeg");
    }
</style>
<body>
<?php require "nav.php";?>
<div class="row" id="spacer">
</div>
<div class="container" id="index-container">
    <br>
    <div class="row">
        <div class="col">
            <h1>About the USC Club Hub!</h1>
        </div>
    </div>
    <div style="height: 10%;"></div>
    <div class="row">
        <div class="col col-12 col-md-3">
            <img src="resources/stress.jpg">
        </div>
        <div class="col col-12 col-md-9">
            <h3>Why do we need it?</h3>
            <p>Sometimes USC can feel really lonely. For freshmen and seniors alike, it can be difficult to make friends
                when perhaps everyone around you is busy studying for their crazy intense classes or just don't seem to
                 share you interests. If you're the one stressed out about all of your insane classes, you probably need
                an outlet to destress and socialize. With over 1000 active clubs and organizations at USC,
            </p>
        </div>
    </div>
    <div class="row">
        <div class="col col-12 col-md-9">
            <h3>How the Club Hub Works</h3>
            <p>
                The USC Club Hub allows students at USC to explore the wide range of clubs and organizations available
                at USC. With a sliding deck of clubs for every category, students can easily look through all of potential
                activities, communities, and opportunities.
            </p>
        </div>
        <div class="col col-12 col-md-3">
            <img src="resources/tommy.jpg">
        </div>
    </div>
    <div class="row">
        <div class="col col-12 col-md-3">
            <img src="resources/hands.png">
        </div>
        <div class="col col-12 col-md-9">
            <h3>Want to add a club to our collection?</h3>
            <p>
                The USC Club Hub is a user-driven application, meaning that if you have a club you'd like to share with
                other students here, we encourage you to add yours to the 'Hub! We have a very intuitive form for you to
                add all of your club's information and a logo (if you want) - it's free advertisement!
            </p>
        </div>
    </div>
    <div class="row">
        <div class="col col-12 col-md-9">
            <h3>Any Questions?</h3>
            <p>
                <span>If you have any questions or concerns, feel free to contact us through the means below:</span>
                <ul>
                    <li>Email: scottmai@usc.edu</li>
                    <li>Text: (702) 867-5309</li>
                    <li>Facebook: <a style="color: white" href="#">facebook.com/usc-club-hub</a></li>
                    <li>Twitter: <a style="color: white" href="#">twitter.com/usc-club-hub</a></li>
                </ul>
            </p>
        </div>
        <div class="col col-12 col-md-3">
            <img src="resources/question.png">
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="js/login-script.js" type="text/javascript"></script>
</body>
</html>