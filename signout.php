<?php
    $x = 5;
    echo 'what is this;';

    setcookie("user_id", null, -1, '/');
    header("Location: home.php");