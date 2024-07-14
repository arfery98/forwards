<?php

session_start();
require('../db.php');

if (isset($_POST['login'])) {
    $user_email = $_POST['email'];
    $user_password = $_POST['password'];

    // var_dump($passH);

    if (empty($user_email)) {
        $_SESSION['error'] = "กรุณากรอกอีเมล";
        header('location: ../1page/login.php');
    } else if (!filter_var($user_email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = "กรุณากรอกอีเมลให้ถูกต้อง";
        header('location: ../1page/login.php');
    } else if (empty($user_password)) {
        $_SESSION['error'] = "กรุณากรอกรหัสผ่าน";
        header('location: ../1page/login.php');
    } else {
        try {

            $stmt = $conn->prepare("SELECT * FROM tb_users WHERE user_email = :email");
            $stmt->bindParam(":email", $user_email);
            $stmt->execute();
            $userData = $stmt->fetch(PDO::FETCH_ASSOC);



            if ($userData && password_verify($user_password, $userData['user_password'])) {
                $_SESSION['user_id'] = $userData['user_id'];
                $_SESSION['user_name'] = $userData['user_name'];
                $_SESSION['user_lastname'] = $userData['user_lastname'];
                $_SESSION['user_email'] = $userData['user_email'];
                $_SESSION['user_phone'] = $userData['user_phone'];
                header("Location: ../1page/index.php");
            } else {
                $_SESSION['error'] = "อีเมลหรือรหัสผ่านไม่ถูกต้อง";
                header("Location: ../1page/login.php");
            }
        } catch (PDOException $e) {
            $_SESSION['error'] = "มีข้อผิดพลาด";
            header("Location: ../1page/login.php");
        }
    }
}
