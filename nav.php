<?php
if(!isset($_COOKIE['user_id'])){
    $btn1tag = 'Login';
    $btn1link = 'login.php';
    $btn2tag = 'Register';
    $btn2link = 'register.php';
    $midbtnlink = 'please_login.php';
    ?><script>var loggedIn = false;</script><?php
}
else{
    $btn1tag = 'Profile';
    $btn1link = 'profile.php';
    $btn2tag = 'Sign out';
    $btn2link = 'signout.php';
    $midbtnlink = 'add_club.php';
    ?><script>var loggedIn = true;</script><?php
}?>
<nav class="navbar navbar-expand navbar-light bg-light" style="background-color: #4cdfff;">
    <a class="navbar-brand" href="#">
        <a href="home.php">
            <img src="resources/duckhub.png" style="height: 70px; width: auto;">
        </a>
    </a>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="add_club.php">Add Club</a>
            </li>
        </ul>
        <a href="<?php echo $btn1link ?>">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit"><?php echo $btn1tag ?></button>
        </a>
        <a href="<?php echo $btn2link ?>">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit"><?php echo $btn2tag ?></button>
        </a>
    </div>
</nav>
