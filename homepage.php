<?php
    session_start();
    $conn = "mysql:host=127.0.0.1;port=8889;dbname=meatlabs";
    $posts = [];
    try {
        $db = new PDO($conn, "root", "root", [
            PDO::ATTR_PERSISTENT=> true
        ]);
        $stmt = $db->prepare("SELECT * FROM posts");
        if($stmt->execute()) {
            $posts = $stmt->fetchAll();
        }
    }
    catch(PDOException $e) {
        die("Could not connect: ".$e->getMessage());
    }
?>

<html>
    <head>
        <link rel="stylesheet" type="text/css" href="styles.css">
    </head>
    <body>
        <div class="topnav">
        <li><a class="space" href="dashboard.php">Dashboard</a></li>
            <li><a class="space" href="homepage.php">Main Page</a></li>
            <li><a style="float:right" class="logout" href="logout.php">Logout</a></li>
        </div>
        <div class="center-posts color">
            <?php 
                if ($_SESSION['SUCCESS_MESSAGE']) {
                    echo '<div class="success"><strong>'.$_SESSION['SUCCESS_MESSAGE'].'</strong></div></br>';
                    unset($_SESSION['SUCCESS_MESSAGE']);
                }
                if($_SESSION['ERROR_MESSAGE']) {
                    echo '<div class="error"><strong>'.$_SESSION['ERROR_MESSAGE'].'</strong></div></br>';
                    unset($_SESSION['ERROR_MESSAGE']);
                }
            ?>
            <div class="welcome">
                <?php echo "Welcome, ".$_SESSION['firstname']." ".$_SESSION['lastname']."!"; ?>
            </div>
            <div class="form">
            <form action="./create_post.php" method="post">
                <strong class="align-right">Title:</strong> <input type = "text" name = "title"><br><br>
                <strong class="align-right">Body:</strong> <textarea name = "body"></textarea><br><br>
                <button class="button" type="submit">Create Post</button>
            </form>
            </div>
            <div>
                <?php 
                for ($i = 0; $i < count($posts); $i++) {
                    $user_id = $posts[$i]['user_id'];
                    $user;
                     try {
                        $db_user = new PDO($conn, "root", "root", [
                            PDO::ATTR_PERSISTENT=> true
                        ]);
                        $stmt_user = $db_user->prepare("SELECT * FROM users WHERE id = ?");
                        if($stmt_user->execute([$user_id])) {
                            $user = $stmt_user->fetchAll();
                            $date = $posts[$i]['date'];
                        }
                        else {
                            var_dump("error");
                        }
                    }
                    catch(PDOException $e) {
                        die("Could not connect: ".$e->getMessage());
                    }
                    ?>
                    <div class="post">
                    <div class="user">
                            <?php echo $user[0]['username']." posted:"; ?>
                        </div>
                        <div class="title">
                            <?php echo $posts[$i]['title']; ?>
                        </div>
                        <div class="body">
                            <?php echo $posts[$i]['body']; ?>
                        </div>
                        <div class="date">
                            <?php echo date("m/d/Y", strtotime($date))." at ".date("h:ia", strtotime($date)); ?>
                        </div>
                        <?php if($posts[$i]['user_id'] == $_SESSION['id']) { ?>
                            <form action="./delete_post.php" method="post">
                                <input type="hidden" name="id" value="<?php echo $posts[$i]['id']; ?>">
                                <button class="button" type="text">Delete Post</button>
                            </form>
                        <?php } ?>
                    </div>
                <?php } ?>
            </div>
            <br>
        </div>
    </body>
</html>