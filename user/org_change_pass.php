<?php
require '../db.php';
//include "../db.php" ;
session_start();


/*echo '<pre>';
print_r($_POST);
exit;*/


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
            $_SESSION['error'] = "รหัสผ่านใหม่ไม่ตรงกัน";
            header("Location: ../1page/org_change_pass.php");
            exit();
        } else {

            $organization_email = $_SESSION['organization_email'];

            $stmt = $conn->prepare("SELECT * FROM tb_organization  WHERE organization_email = :organization_email");
            $stmt->bindParam(":organization_email", $organization_email);
            $stmt->execute();
            $userData = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($userData) {

                if (password_verify($user_password, $userData['organization_password'])) {
                    // รหัสผ่านปัจจุบันถูกต้อง

                    // เข้ารหัสรหัสผ่านใหม่
                    $hashed_password = password_hash($user_new_pass, PASSWORD_DEFAULT);

                    // อัปเดตรหัสผ่านใหม่ในฐานข้อมูล
                    $stmt_update = $conn->prepare("UPDATE tb_organization SET organization_password = :hashed_password WHERE organization_email = :organization_email");
                    $stmt_update->bindParam(':hashed_password', $hashed_password, PDO::PARAM_STR);
                    $stmt_update->bindParam(':organization_email', $organization_email, PDO::PARAM_STR);
                    $stmt_update->execute();

                    $_SESSION['success'] = "รหัสแก้ไขเรียบร้อย";
                    header("Location: ../1page/org_change_pass.php");
                    exit();
                } else {
                    // รหัสผ่านเดิมไม่ถูกต้อง
                    $_SESSION['error'] = "รหัสผ่านเดิมไม่ถูกต้อง";
                    header("Location: ../1page/org_change_pass.php");
                    exit();
                }
            } else {
                // ไม่พบผู้ใช้
                $_SESSION['error'] = "ไม่พบผู้ใช้";
                header("Location: ../1page/org_change_pass.php");
                exit();
            }
        }
    } catch (PDOException $e) {
        $_SESSION['error'] = "มีข้อผิดพลาด: " . $e->getMessage();
        header("Location: ../1page/org_change_pass.php");
        exit();
    }
}
