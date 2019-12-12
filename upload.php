<?php
//echo empty($_FILES["image"]["name"]);
//exit();
if(isset($_FILES["image"]["name"]) && !empty($_FILES["image"]["name"])) {
    $target_dir = "logos/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    // Check if image file is a actual image or fake image
    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if ($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }
    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }
    // Check file size
    if ($_FILES["image"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }
    // Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif") {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
    } else {
        // rename file
        require("config.php");
        $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if ($mysqli->connect_errno) {
            echo "MySQL Connection Error: " . $mysqli->connect_error;
            exit();
        }
        $result = $mysqli->query("SELECT * FROM images ORDER BY id DESC");
        $lastImg = $result->fetch_assoc();
        $id = intval($lastImg['id']) + 1;
        $newName = 'logos/logo' . $id . '.' . $imageFileType;
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $newName)) {
            echo "The file " . basename($_FILES["image"]["name"]) . " has been uploaded.";
            $stmt = $mysqli->prepare("INSERT INTO images(image_path) VALUES (?);");
            $stmt->bind_param('s', $newName);
            $stmt->execute();
        } else {
            echo "Sorry, there was an error uploading your file.";
            exit();
        }
    }
}
else{
    $id = 1;
}
?>

<form action="add_club_backend.php" method="POST" id="form">
    <input type="hidden" name="name" value="<?php echo $_POST['name'] ?>">
    <input type="hidden" name="short_desc" value="<?php echo $_POST['short_desc'] ?>">
    <input type="hidden" name="long_desc" value="<?php echo $_POST['long_desc'] ?>">
    <input type="hidden" name="category" value="<?php echo $_POST['category'] ?>">
    <input type="hidden" name="image_id" value="<?php echo $id ?>">
</form>
<script>document.getElementById('form').submit();</script>