<?php
require('../db.php');
session_start();

echo "test";

/*   test__________________________1
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_password = $_POST['user_password'];
$user_new_pass = $_POST['user_new_pass'];
$user_checkpass = $_POST['user_checkpass']




$stmt = $conn->prepare("SELECT * FROM tb_user WHERE user_password = :user_password");
$stmt->bindParam(':user_password', $user_password);
$stmt->execute();
$userData = $stmt->fetch(PDO::FETCH_ASSOC);

if ($userData) {
    if ($userData && password_verify($user_password, $userData['user_password'])) {
        $hashed_password = password_hash($user_new_pass, PASSWORD_DEFAULT);

        $up_db = "UPDATE tb_users SET user_id= ?  WHERE user_id = ?";
        $up_stmt = $conn->prepare($up_db);
        $up_stmt->bindParam($hashed_password, $_SESSION['user_id']);
        $up_stmt->execute();

        echo "เปลี่ยนรหัสผ่านสำเร็จ";
    } else {
        echo "รหัสผ่านเดิมไม่ถูกต้อง";
    }
}*/
print_r($_POST);
//if (isset($_SESSION['user_id']) && isset($_SESSION['user_name'])) {

    //include "db_conn.php";

    /* 
    if (isset($_POST['user_password']) && isset($_POST['user_new_pass']) && isset($_POST['user_checkpass'])) {

        function validate($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        $user_password = validate($_POST['user_password']);
        $user_new_pass = validate($_POST['user_new_pass']);
        $user_checkpass = validate($_POST['user_checkpass']);

        if (empty($user_password)) {
            header("Location: ../1page/chang_epass.php");
            echo "Old Password is required";
            exit();
        } else if (empty($user_new_pass)) {
            header("Location: ../1page/change_pass.php");
            echo "New Password is required";
            exit();
        } else if ($user_new_pass !== $user_checkpass) {
            header("Location: ../1page/change_pass.php");
            echo "New Password and Confirm Password does not match";
            exit();
        } else {
            // hashing the password
            $user_id = $_SESSION['user_id'];
            //$user_password = md5($user_password);
            //$user_new_pass = md5($user_new_pass);

            $stmt = $conn->prepare("SELECT * FROM tb_users WHERE user_id = :user_id");
            $stmt->bindParam(":user_id", $user_id);
            $stmt->execute();
            $userData = $stmt->fetch(PDO::FETCH_ASSOC); //mysqli_query($conn, $sql);
            //$userData = $rows['user_password'];

            if ($userData) {
                // เช็ครหัสผ่านปัจจุบันถูกต้อง
                if (password_verify($user_password, $userData['user_password'])) {
                    // รหัสรหัสผ่านใหม่
                    $hashed_password = password_hash($user_new_pass, PASSWORD_DEFAULT);

                    // รหัสผ่านใหม่ในฐานข้อมูล
                    $stmt_update = $conn->prepare("UPDATE tb_users SET password = :hashed_password WHERE user_id = :user_id");
                    //$stmt_update = $pdo->prepare($sql_update);
                    $stmt_update->bindParam(':hashed_password', $hashed_password, PDO::PARAM_STR);
                    $stmt_update->bindParam(':user_id', $user_id, PDO::PARAM_INT);
                    $stmt_update->execute();

                    header("Location: ../1page/change_pass.php");
                    echo "success=Your password has been changed successfully";
                    exit();
                } else {
                    // รหัสผ่านเดิมไม่ถูกต้อง
                    header("Location: ../1page/change_pass.php");
                    echo "error=Your current password is incorrect";
                    exit();
                }
            } /*else {
                // ไม่พบข้อมูลผู้ใช้
                header("Location: ../1page/change_pass.php");
                echo "error=User not found";
                exit();
            }
        }
    } else {
        // ถ้าไม่มีการส่งข้อมูลแบบ POST
        header("Location: ../1page/change_pass.php");
        exit();
    } */
//}
