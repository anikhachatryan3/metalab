<html>
    <head>
        <link rel="stylesheet" type="text/css" href="styles.css">
    </head>
    <body>
        <div class="center color">
            <?php 
            session_start();
                if ($_SESSION['SUCCESS_MESSAGE']) {
                    echo '<div><strong>'.$_SESSION['SUCCESS_MESSAGE'].'</strong></div></br>';
                    for ($i = 0; $i < 5; $i++) {
                        echo '<div>Sample Post</div>';
                    }
                }
            ?>
            <br>
            <form action="./logout.php" method="post">
                <button type="submit">Log Out</button>
            </form>
        </div>
    </body>
</html>