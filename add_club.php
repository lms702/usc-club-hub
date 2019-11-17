<?php
    if(!isset($_COOKIE['user_id'])){
        var_dump($_COOKIE);
//        exit();
        header("Location: register.php");
    }
//        mysqli_report(MYSQLI_REPORT_ALL);
    require("config.php");
    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if($mysqli->connect_errno) {
        echo "MySQL Connection Error: " . $mysqli->connect_error;
        exit();
    }
    $result = $mysqli->query("SELECT * FROM categories ORDER BY category;");
//    var_dump($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add a Club</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="js/jquery-3.4.1.js" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="css/addClubStyle.css">
</head>
<body>
<div id="spacer"></div>
    <div id="header">
        <h1>Add a Club!</h1>
    </div>
    <form action="upload.php" method="POST" id="form" enctype="multipart/form-data">
    <div class="container">
        <div class="row">
            <label for="name" class="col-sm-3 col-form-label text-sm-right">What is the name of your club?</label>
            <div class="col">
                <input name="name" id="name" type="text" maxlength="65" placeholder="Waterfowl fan club" class="form-control">
            </div>
        </div>
        <div class="row">
            <label for="category" class="col-sm-3 col-form-label text-sm-right">A short description <br>(max 35 characters)</label>
            <div class="col">
                <input name="short_desc" id="short_desc" type="text" maxlength="35" placeholder="A place to meet friends!" class="form-control">
            </div>
        </div>
        <div class="row">
            <label for="category" class="col-sm-3 col-form-label text-sm-right">Pick a category for your club:</label>
            <div class="col">
                <select id="category" name="category" class="form-control">
                <?php while($row = $result->fetch_assoc()): ?>
                    <option value="<?php echo $row['id']; ?>"><?php echo $row['category'] ?></option>
                <?php endwhile; ?>
                </select>
            </div>
        </div>
        <div class="row">
            <label for="long_desc" class="col-sm-3 col-form-label text-sm-right">A complete description for your club: may
                include links to your website / signup <br>(max 500 characters)</label>
            <div class="col">
<!--                <input  type="text" maxlength="65" placeholder="A full bio here" class="form-control">-->
                <textarea id="long_desc" name="long_desc" rows="6"  maxlength="500" class="form-control"
                          rows="3" placeholder="A full bio here"></textarea>
            </div>
        </div>
        <div class="row">
            <label for="image" class="col-sm-3 col-form-label text-sm-right">Upload a club logo!</label>
            <div class="col col-4">
                <input id="image" type="file" class="form-control" name="image" accept="image/*">
            </div>
        </div>
        <div class="row">
            <div class="col col-9" id="error"></div>
            <div class="col col-3">
                <button id="submit" type="submit" class="btn btn-light">Add Club!</button>
            </div>
        </div>
    </div>
    </form>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="js/add-club-script.js" type="text/javascript"></script>
</body>
</html>
<?php $mysqli->close(); ?>