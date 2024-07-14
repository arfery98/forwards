<?php
session_start();
require_once('../db.php');
$min_length = 6;

if (isset($_POST['register'])) {
    $user_id = $_POST['id0'];
    $user_name = $_POST['name'];
    $user_lastname = $_POST['lastname'];
    $user_email = $_POST['email'];
    $user_password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $user_phone = $_POST['phone'];
}
if (empty($user_id)) {
    $_SESSION['error'] = "กรุณากรอกข้อมูลให้ครบถ้วน";
    header("Location: register.php");
} else if (!filter_var($user_email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['error'] = "กรุณากรอกอีเมลที่ถูกต้อง";
    header("Location: register.php");
} else if (strlen($user_password) < $min_length) {
    $_SESSION['error'] = "รหัสผ่านต้องมีความยาวมากกว่า 6 ตัวอักษร";
    header("Location: register.php");
} else if ($user_password !== $confirm_password) {
    $_SESSION['error'] = "รหัสผ่านไม่ตรงกัน";
    header("Location: register.php");
} else {

    $check_user_id = $conn->prepare("SELECT COUNT(*) FROM tb_users WHERE user_id = ?");
    $check_user_id->execute([$user_id]);
    $checkNameExists = $check_user_id->fetchColumn();
    $check_user_email = $conn->prepare("SELECT COUNT(*) FROM tb_users WHERE user_email = ?");
    $check_user_email->execute([$user_email]);
    $checkEmailExists = $check_user_email->fetchColumn();

    if ($checkNameExists) {
        $_SESSION['error'] = "บัญชีผู้ใช้นี้ถูกใช้งานแล้ว";
        header("Location: ../1page/register.php?error=usernametaken");
    } else if ($checkEmailExists) {
        $_SESSION['error'] = "บัญชีผู้ใช้นี้ถูกใช้งานแล้ว";
        header("Location: ../1page/register.php?error=emailtaken");
    } else {
        $hash_password = password_hash($user_password, PASSWORD_DEFAULT);

        try {
            $stmt = $conn->prepare("INSERT INTO tb_users (user_id, user_name, user_lastname, user_email, user_password ,user_phone) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->execute([$user_id, $user_name, $user_lastname, $user_email, $hash_password, $user_phone]);

            $_SESSION['success'] = "ลงทะเบียนสำเร็จ";
            header("Location: ../1page/login.php");
            //exit();
        } catch (PDOException $e) {
            $_SESSION['error'] = "มีข้อผิดพลาด"; //. $e->getMessage();
            //echo "Error: " . $e->getMessage();
            header("Location: ../1page/register.php?");
            //exit();
        }
    }
}
