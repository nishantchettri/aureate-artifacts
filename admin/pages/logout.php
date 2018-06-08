<?php

    session_start();

    unset($_SESSION['username']);
    unset($_SESSION['permission_level']);

    header("Location: login.php");

 ?>
