<?php
    session_start();
    if (!empty($_POST) && $_POST['first_name'] != "" && $_POST['last_name'] != "" && $_POST['username'] != "" && $_POST['email'] != "" && $_POST['password'] != "") {
        $hash = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $conn = "mysql:host=127.0.0.1;port=8889;dbname=meatlabs";
        try {
            $db = new PDO($conn, "root", "root", [
                PDO::ATTR_PERSISTENT => true
            ]);
            
            $statement = $db->prepare("INSERT INTO users (first, last, username, email, password) VALUES (?,?,?,?,?)");
            if ($statement->execute([$_POST['first_name'], $_POST['last_name'], $_POST['username'], $_POST['email'], $hash])) {
                $_SESSION['SUCCESS_MESSAGE'] = 'Congratulations, '.$_POST['name'].'You have successfully created a new account.';
                // This has to match to an actual file location on your server
                header('Location: login.php');
            }
        } catch (PDOException $e) {
            $_SESSION['ERROR'] = 'Failed to create a new account!';
            // This has to match to an actual file location on your server
            header('Location: register.php');
        }
    }
    else {
        $_SESSION['ERROR'] = 'There are empty fields.';
        header('Location: register.php');
    }
?>