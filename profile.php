<?php
//    mysqli_report(MYSQLI_REPORT_ALL);
if(!isset($_COOKIE['user_id'])){
    header("Location: login.php");
}

require("config.php");
$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if($mysqli->connect_errno) {
    echo "MySQL Connection Error: " . $mysqli->connect_error;
    exit();
}
// passwords are checked on frontend so don't have to check here
// also assume all fields are filled
//$user_id = $_POST['user_id'];
$user_id = $_COOKIE['user_id'];

$statement = $mysqli->prepare("SELECT * FROM users WHERE id = ?;");
$statement->bind_param('i', $user_id);
$statement->execute();
$results = $statement->get_result();
$user = $results->fetch_assoc();
$username = $user['username'];

$stmt = $mysqli->prepare("select clubs.id, clubs.name, clubs.short_desc, clubs.long_desc, categories.category, images.image_path
from clubs
join images
on clubs.image_id = images.id
join categories 
on clubs.category_id = categories.id
WHERE clubs.user_id = ?;");
$stmt->bind_param('i', $_COOKIE['user_id']);
$stmt->execute();
$clubs_owned = $stmt->get_result();

$stmt = $mysqli->prepare("select clubs.id, clubs.name, clubs.short_desc, clubs.long_desc, categories.category, images.image_path
from clubs
join images
on clubs.image_id = images.id
join categories
on clubs.category_id = categories.id
join favorites
on favorites.club_id = clubs.id
where favorites.user_id = ?;");
$stmt->bind_param('i', $_COOKIE['user_id']);
$stmt->execute();
$favorites = $stmt->get_result();
//var_dump($clubs_owned);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        Your profile.
    </title>
    <link rel="stylesheet" type="text/css" href="css/profile.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="js/jquery-3.4.1.js" type="text/javascript"></script>
</head>
<body>
<?php require "nav.php";?>

<div class="container" id="index-container">
    <div class="row">
        <div class="col" style="text-align: center">
            <h1>Hi <?php echo $username; ?>!</h1>
        </div>
    </div>

    <?php
        $clubs = [$clubs_owned, $favorites];
        $logo = ['logo-own', 'logo-fav'];
        $group = ['Here are the clubs that you own...', 'Here are your favorite clubs...'];
        for ($i = 0; $i < 2; $i++):
            if($clubs[$i]->num_rows > 0): ?>
            <div class="row">
                <div class="col">
                    <h2 class="<?php echo $logo[$i]; ?>"><?php echo $group[$i]; ?></h2>
                </div>
            </div>
            <?php while($row = $clubs[$i]->fetch_assoc()): ?>
            <div class="row">
                <div class="col col-12 col-lg-3">
                    <img class="logo <?php echo $logo[$i] . ' ' . $row['id']?>" src="<?php echo $row['image_path']?>" alt=''>
                </div>
                <div class="col col-12 col-lg-9">
                    <h2>
                        <?php echo $row['name'] ?>
                    </h2>
                    <p>
                        <?php echo $row['short_desc'] ?>
                    </p>
                    <p> <?php echo $row['long_desc'] ?></p>
                </div>
            </div>
            <div class="row divider"></div>
            <?php endwhile; endif; ?>
        <?php endfor; ?>

    <div style="height: 15%;"></div>

</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="js/login-script.js" type="text/javascript"></script>
<script>
    $('.logo').on('click', function() {
        event.preventDefault();
        let row = $(this).parent().parent();
        let classes= $(this).attr('class').split(' ');
        let type = '.' + classes[1];
        let club_id = classes[2];
        row.next().fadeOut(800, () => { row.next().remove(); });
        row.fadeOut(800, ()=>{
            row.remove();
            if($(type).length === 1){
                $(type).fadeOut(800);
            }
        });
        console.log(club_id);
        $.ajax({
            url: 'remove_fav.php',
            data : {
                user_id : '<?php echo $user_id; ?>',
                club_id : club_id
            }
        });
        if(type === '.logo-own'){
            // $('.' + club_id).trigger('click');
            $.ajax({
                url: 'remove_club.php',
                data : {
                    club_id : club_id
                }
            });
        }
    })
</script>
</body>
</html>