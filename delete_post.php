<?php
    session_start();
    $conn = "mysql:host=127.0.0.1;port=8889;dbname=meatlabs";
    try {
        $db = new PDO($conn, "root", "root", [
            PDO::ATTR_PERSISTENT => true
        ]);
        $stmt = $db->prepare("DELETE FROM posts WHERE id = ?");
        
        if($stmt->execute([$_POST['id']])) {
            $_SESSION['SUCCESS_MESSAGE'] = 'Post successfully deleted.';
            header('Location: homepage.php');
        } else {
            $_SESSION['ERROR_MESSAGE'] = 'Post was not deleted.';
            header('Location: homepage.php');
        }
    }
    catch(PDOException $e) {
        die("Could not connect: " . $e->getMessage());
    }
?>