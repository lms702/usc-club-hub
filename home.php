<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="css/home.css">
    <title>Home Page</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src = "js/jquery-3.4.1.js"> </script>
</head>
<body>
<div id="contain">
    <?php require "nav.php"; ?>
    <h1 style="font-size: 50px" class = center>Welcome To Club Hub</h1>
    <h1 id="header2" class = center2>Find The Right Club For You!</h1>
    <br>
    <div class="center">
        <a href="add_club.php">
<!--            <label for="add" class="col col-2 control-label">Have a club to add?</label>-->
            <button type="button" id="add" class="btn btn-warning">Add your club here!</button>
        </a>
    </div>
</div>
<script src="js/home.js"></script>
<script>funcReq(); </script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>