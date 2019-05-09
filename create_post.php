<?php
    session_start();
    if($_POST['title'] != "" && $_POST['body'] != "") {
        $title = $_POST['title'];
        $body = $_POST['body'];
        $conn = "mysql:host=127.0.0.1;port=8889;dbname=meatlabs";

        try {
            $db = new PDO($conn, "root", "root", [
                PDO::ATTR_PERSISTENT => true
            ]);
            $stmt = $db->prepare("INSERT INTO posts (user_id, title, body) VALUES (?,?,?)");
            if($stmt->execute([$_SESSION['id'], $_POST['title'], $_POST['body']])) {
                $_SESSION['SUCCESS_MESSAGE'] = 'Post successfully created.';
                header('Location: homepage.php');
            }
            else {
                die("Unable to fetch data.");
            }
        }
        catch(PDOException $e) {
            die("Could not connect: " . $e->getMessage());
        }
    }
    else {
        $_SESSION['ERROR'] = 'There are empty fields.';
        header('Location: homepage.php');
    }
?>