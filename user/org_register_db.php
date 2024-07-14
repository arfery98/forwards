<?php
session_start();
include('../db.php');
$min_length = 6;

if (isset($_POST['org_register'])) {
    $organization_name = $_POST['organization_name'];
    $organization_email = $_POST['organization_email'];
    $organization_password = $_POST['organization_password'];
    $confirm_password = $_POST['confirm_password'];
    $organization_phone = $_POST['organization_phone'];

    //print_r($_POST);
    //$organization_img = $_POST['organization_img'];
    //$organization_verify = $_POST['organization_verify'];

    /*$organization_ad_no = $_POST['organization_ad_no'];
    $organization_ad_village = $_POST['organization_ad_village'];
    $organization_ad_groubs = $_POST['organization_ad_groubs'];
    $organization_ad_buildings = $_POST['organization_ad_buildings'];
    $organization_ad_alleys = $_POST['organization_ad_alleys'];
    $organization_ad_roads = $_POST['organization_ad_roads'];
    $organization_ad_provinces = $_POST['organization_ad_zipcode'];
    $organization_ad_amphures = $_POST['organization_ad_districts'];
    $organization_ad_zipcode = $_POST['organization_ad_zipcode'];*/
}

 
 if (strlen($organization_password) < $min_length) {
    $_SESSION['error'] = "รหัสผ่านต้องมีความยาวมากกว่า 6 ตัวอักษร";
    header("Location: ../1page/org_register.php");
} else if ($organization_password !== $confirm_password) {
    $_SESSION['error'] = "รหัสผ่านไม่ตรงกัน";
    header("Location: ../1page/org_register.php");
} else {

    $check_user_name = $conn->prepare("SELECT COUNT(*) FROM tb_organization WHERE organization_name = ?");
    $check_user_name->execute([$organization_name]);
    $checkNameExists = $check_user_name->fetchColumn();
    $check_user_email = $conn->prepare("SELECT COUNT(*) FROM tb_organization WHERE organization_email = ?");
    $check_user_email->execute([$organization_email]);
    $checkEmailExists = $check_user_email->fetchColumn();

    if ($checkNameExists) {
        $_SESSION['error'] = "บัญชีผู้ใช้นี้ถูกใช้งานแล้ว";
        header("Location: ../1page/org_register.php?error=usernametaken");
    } else if ($checkEmailExists) {
        $_SESSION['error'] = "บัญชีผู้ใช้นี้ถูกใช้งานแล้ว";
        header("Location: ../1page/org_register.php?error=emailtaken");
    } else {
        $hash_password = password_hash($organization_password, PASSWORD_DEFAULT);

        try {
            $stmt = $conn->prepare("INSERT INTO `tb_organization`(`organization_name`, `organization_email`, `organization_password`, `organization_phone`) VALUES (?, ?, ?, ?)");
            $stmt->execute([$organization_name, $organization_email, $organization_password, $organization_phone]);
            
            $_SESSION['success'] = "ลงทะเบียนสำเร็จ";
            header("Location: ../1page/org_login.php");
            exit();
        } catch (PDOException $e) {
            $_SESSION['error'] = "มีข้อผิดพลาด"; //. $e->getMessage();
            echo "Error: " . $e->getMessage();
            header("Location: ../1page/org_register.php?");
            exit();
        }
    }
}
 