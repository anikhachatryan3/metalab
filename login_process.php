<?php
    session_start();
    if(!empty($_POST) && $_POST['email'] != "" && $_POST['password'] != "") {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $conn = "mysql:host=127.0.0.1;port=8889;dbname=meatlabs";

        try {
            $db = new PDO($conn, "root", "root", [
                PDO::ATTR_PERSISTENT => true
            ]);

            $stmt = $db->prepare("SELECT * FROM `meatlabs`.`users` WHERE email = ?");
            if($stmt->execute([$email])) {
                $result = $stmt->fetchAll();
                if(count($result) == 1 && password_verify($password, $result[0]['password'])) {
                    $_SESSION['firstname'] = $result[0]['first'];
                    $_SESSION['lastname'] = $result[0]['last'];
                    $_SESSION['id'] = $result[0]['id'];
                    $_SESSION['email'] = $result[0]['email'];
                    $_SESSION['username'] = $result[0]['username'];
                    header('Location: homepage.php');
                }
                else {
                    $_SESSION['ERROR'] = 'Invalid email or password.';
                    header('Location: login.php');
                }
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
        header('Location: login.php');
    }
?>