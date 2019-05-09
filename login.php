<html>
    <head>
        <link rel="stylesheet" type="text/css" href="styles.css">
    </head>
    <body>
        <div class = "center color">
            <?php
                session_start();
                if ($_SESSION['ERROR']) {
                    echo '<div class="error">'.$_SESSION['ERROR'].'</div>';
                    unset($_SESSION['ERROR']);
                }
                if ($_SESSION['LOG_OUT']) {
                    echo '<div><strong>'.$_SESSION['LOG_OUT'].'</strong></div></br>';
                    unset($_SESSION['LOG_OUT']);
                }
                if ($_SESSION['SUCCESS_MESSAGE']) {
                    echo '<div class="success"><strong>'.$_SESSION['SUCCESS_MESSAGE'].'</strong></div>';
                    unset($_SESSION['SUCCESS_MESSAGE']);
                }
            ?>
            <strong>Log In Here:</strong><br><br>
            <form action="./login_process.php" method="post">
                <strong class="align-right">E-mail:</strong> <input type = "email" name = "email"><br><br>
                <strong class="align-right">Password:</strong> <input type = "password" name = "password"><br><br>
                <button class="button" type = "submit">Log In</button>
            </form>
            <form action="./register.php" method="post">
                <button class="button" type = "text">Register Here</button>
            </form>
        </div>
    </body>
</html>