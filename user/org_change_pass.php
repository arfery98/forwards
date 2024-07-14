<?php
require '../db.php';
//include "../db.php" ;
session_start();


/*echo '<pre>';
print_r($_POST);
exit;*/


//if (isset($_SESSION['organization_email']) && isset($_SESSION['organization_name'])) {

//include "db_conn.php";

/* if (isset($_POST['user_password']) && isset($_POST['user_new_pass']) && isset($_POST['user_checkpass'])) {

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
        header("Location: ../1page/org_change_pass.php");
        $_SESSION['error'] = "Old Password is required";
        exit();
    } else if (empty($user_new_pass)) {
        header("Location: ../1page/org_change_pass.php");
        $_SESSION['error'] = "New Password is required";
        exit();
    } else if ($user_new_pass !== $user_checkpass) {
        header("Location: ../1page/org_change_pass.php");
        $_SESSION['error'] = "New Password and Confirm Password does not match";
        exit();
    } else {
        try {

            $user_id = $_SESSION['organization_name'];

            $stmt = $conn->prepare("SELECT * FROM tb_organization WHERE organization_name = :organization_name");
            $stmt->bindParam(":organization_name", $user_id);
            $stmt->execute();
            $userData = $stmt->fetch(PDO::FETCH_ASSOC); //mysqli_query($conn, $sql);
            //$userData = $rows['organization_password'];

            if ($userData && password_verify($user_password, $userData['organization_password'])) {
                // เช็ครหัสผ่านปัจจุบันถูกต้อง

                // รหัสรหัสผ่านใหม่
                $hashed_password = password_hash($user_new_pass, PASSWORD_DEFAULT);

                // รหัสผ่านใหม่ในฐานข้อมูล
                $stmt_update = $conn->prepare("UPDATE tb_organization SET organization_password = :organization_password WHERE organization_name = :organization_name");
                $stmt_update->bindParam(':organization_password', $hashed_password, PDO::PARAM_STR);
                $stmt_update->bindParam(':organization_name', $user_id, PDO::PARAM_STR);
                $stmt_update->execute();

                header("Location: change_pass.php");
                $_SESSION['success'] = "success=Your password has been changed successfully";
                exit();
            } else {
                // รหัสผ่านเดิมไม่ถูกต้อง
                header("Location: ../1page/org_change_pass.php");
                $_SESSION['error'] = "error=Your current password is incorrect";
                exit();
            }
        } catch (PDOException $e) {
            header("Location: ../1page/org_change_pass.php");
            $_SESSION['error'] = "มีข้อผิดพลาด";
        }
    } /*else {
                    // ไม่พบข้อมูลผู้ใช้
                    header("Location: ../1page/change_pass.php");
                    echo "error=User not found";
                    exit();
                }
} */



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
        $_SESSION['error'] = "Old Password is required";
        header("Location: ../1page/org_change_pass.php");
        exit();
    } else if (empty($user_new_pass)) {
        $_SESSION['error'] = "New Password is required";
        header("Location: ../1page/org_change_pass.php");
        exit();
    } else if ($user_new_pass !== $user_checkpass) {
        $_SESSION['error'] = "New Password and Confirm Password do not match";
        header("Location: ../1page/org_change_pass.php");
        exit();
    } else {
        try {
            $user_id = $_SESSION['organization_name'];

            $stmt = $conn->prepare("SELECT * FROM tb_organization  WHERE organization_name = :organization_name");
            $stmt->bindParam(":organization_name", $user_id);
            $stmt->execute();
            $userData = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($userData) {
                echo 'รหัสผ่านในฐานข้อมูล: ' . $userData['organization_password'] . '<br>';
                echo 'รหัสผ่านที่ผู้ใช้กรอก: ' . $user_password . '<br>';

                if (password_verify($user_password, $userData['organization_password'])) {
                    // รหัสผ่านปัจจุบันถูกต้อง

                    // เข้ารหัสรหัสผ่านใหม่
                    $hashed_password = password_hash($user_new_pass, PASSWORD_DEFAULT);

                    // อัปเดตรหัสผ่านใหม่ในฐานข้อมูล
                    $stmt_update = $conn->prepare("UPDATE tb_organization SET organization_password = :organization_password WHERE organization_name = :organization_name");
                    $stmt_update->bindParam(':organization_password', $hashed_password, PDO::PARAM_STR);
                    $stmt_update->bindParam(':organization_name', $user_id, PDO::PARAM_STR);
                    $stmt_update->execute();

                    $_SESSION['success'] = "Your password has been changed successfully";
                    header("Location: change_pass.php");
                    exit();
                } else {
                    // รหัสผ่านเดิมไม่ถูกต้อง
                    $_SESSION['error'] = "Your current password is incorrect";
                    header("Location: ../1page/org_change_pass.php");
                    exit();
                }
            } else {
                // ไม่พบผู้ใช้
                $_SESSION['error'] = "User not found";
                header("Location: ../1page/org_change_pass.php");
                exit();
            }
        } catch (PDOException $e) {
            $_SESSION['error'] = "มีข้อผิดพลาด: " . $e->getMessage();
            header("Location: ../1page/org_change_pass.php");
            exit();
        }
    }
}
