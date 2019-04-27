<?php
    session_start();
    $_SESSION['LOG_OUT'] = 'You have successfully logged out!';
    header('Location: http://localhost/2019/pathfinder.php');
?>