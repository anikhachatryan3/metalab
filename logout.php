<?php
    session_destroy();
    session_start();
    $_SESSION['SUCCESS_MESSAGE'] = 'You have successfully logged out!';
    header('Location: login.php');
?>