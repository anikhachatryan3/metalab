<?php 
    session_start();
?>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="styles.css">
    </head>
    <body>
        <div class = "center color">
            <?php
                if (isset($_SESSION['ERROR'])) {
                    echo '<div class="error">'.$_SESSION['ERROR'].'</div>';
                    unset($_SESSION['ERROR']);
                }
                if ($_SESSION['LOG_OUT']) {
                    echo '<div><strong>'.$_SESSION['LOG_OUT'].'</strong></div></br>';
                    unset($_SESSION['LOG_OUT']);
                }
            ?>
            <strong>Register Here:</strong><br><br>
            <form action="./register_process.php" method="post">
                <strong>First Name:</strong> <input type = "text" name = "first_name"><br><br>
                <strong>Last Name:</strong> <input type = "text" name = "last_name"><br><br>
                <strong>Username:</strong> <input type = "text" name = "username"><br><br>
                <strong>E-mail:</strong> <input type = "email" name = "email"><br><br>
                <strong>Password:</strong> <input type = "password" name = "password"><br><br>
                <button type = "submit">Submit</button>
            </form>
        </div>
    </body>
</html>