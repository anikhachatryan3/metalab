<?php
    session_start();
    if (!empty($_POST) && $_POST['first_name'] != "" && $_POST['last_name'] != "" && $_POST['username'] != "" && $_POST['email'] != "" && $_POST['password'] != "") {
        $hash = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $conn = "mysql:host=127.0.0.1;port=8889;dbname=meatlabs";
        try {
            $db = new PDO($conn, "root", "root", [
                PDO::ATTR_PERSISTENT => true
            ]);
            
            $check_email = $db->prepare("SELECT * FROM `meatlabs`.`users` WHERE email = ?");
            $check_username = $db->prepare("SELECT * FROM `meatlabs`.`users` WHERE username = ?");
            if($check_email->execute([$_POST['email']]) && $check_username->execute([$_POST['username']])) {
                $emailResult = $check_email->fetchAll();
                $userResult = $check_username->fetchAll();
                if(empty($emailResult) && empty($userResult)) {
                    $statement = $db->prepare("INSERT INTO users (first, last, username, email, password) VALUES (?,?,?,?,?)");
                    if ($statement->execute([$_POST['first_name'], $_POST['last_name'], $_POST['username'], $_POST['email'], $hash])) {
                        $_SESSION['SUCCESS_MESSAGE'] = 'Congratulations, '.$_POST['name'].'You have successfully created a new account.';
                        header('Location: login.php');
                    }
                }
                else if(empty($emailResult) && !(empty($userResult))) {
                    $_SESSION['ERROR'] = 'Username is already in use!';
                    header('Location: register.php');
                }
                else if(!(empty($emailResult)) && empty($userResult)) {
                    $_SESSION['ERROR'] = 'Email is already in use!';
                    header('Location: register.php');
                }
                else {
                    $_SESSION['ERROR'] = 'Username and email are already in use!';
                    header('Location: register.php');
                }
            }
        } catch (PDOException $e) {
            $_SESSION['ERROR'] = 'Failed to create a new account!';
            header('Location: register.php');
        }
    }
    else {
        $_SESSION['ERROR'] = 'There are empty fields.';
        header('Location: register.php');
    }
?>