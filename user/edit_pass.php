<?php
require('../db.php');
session_start();

if (isset($_SESSION['user_id']) && isset($_SESSION['user_name'])) {

    if (isset($_POST['user_password']) && isset($_POST['user_new_pass']) && isset($_POST['user_checkpass'])) {

        function validate($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        try {
            $user_password = validate($_POST['user_password']);
            $user_new_pass = validate($_POST['user_new_pass']);
            $user_checkpass = validate($_POST['user_checkpass']);

            if ($user_new_pass !== $user_checkpass) {
                header("Location: ../1page/change_pass.php");
                echo "รหัสผ่านใหม่ไม่ตรงกัน";
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
                        $stmt_update = $conn->prepare("UPDATE tb_users SET user_password = :hashed_password WHERE user_id = :user_id");
                        $stmt_update->bindParam(':hashed_password', $hashed_password, PDO::PARAM_STR);
                        $stmt_update->bindParam(':user_id', $user_id, PDO::PARAM_INT);
                        $stmt_update->execute();

                        $_SESSION['success'] = "รหัสแก้ไขเรียบร้อย";
                        header("Location: ../1page/change_pass.php");
                        exit();
                    } else {
                        // รหัสผ่านเดิมไม่ถูกต้อง
                        $_SESSION['error'] = "รหัสผ่านเดิมไม่ถูกต้อง";
                        header("Location: ../1page/change_pass.php");
                        exit();
                    }
                } else {
                    // ไม่พบข้อมูลผู้ใช้
                    $_SESSION['error'] = "ไม่พบผู้ใช้";
                    header("Location: ../1page/change_pass.php");
                    echo "error=User not found";
                    exit();
                }
            }
        } catch (PDOException $e) {
            $_SESSION['error'] = "มีข้อผิดพลาด: " . $e->getMessage();
            header("Location: ../1page/org_change_pass.php");
            exit();
        }
    }
}
