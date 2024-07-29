<?php
require('../db.php');
include('../db_connect.php');
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../1page/login.php");
    exit();
}

//$user_id = $_SESSION['organization_email'];
$user_email = $_SESSION['organization_email'];
$organization_bio = $_POST['organization_bio'];

print "<pre> ";
print_r($_FILES);
print "</pre> ";


if (isset($_FILES['images'])) {
    $image_files = $_FILES['images'];
    $total_images = count($image_files['name']);
    $image_paths = [];
    $fw_img = 'some_img_ps'; // ต้องตั้งค่าชื่อของ organization ที่นี่

    // Loop through each file
    for ($i = 0; $i < $total_images; $i++) {
        // Get file extension and convert to lowercase
        $extension = strtolower(pathinfo($image_files['name'][$i], PATHINFO_EXTENSION));
        $support = array("jpg", "jpeg", "png", "gif");

        if (in_array($extension, $support)) {
            $new_file_name = strtolower($fw_img) . "_" . time() . "_" . $i . "." . $extension;
            $image_path = 'uploads/images/' . $new_file_name;

            // Move uploaded file to the destination directory
            if (move_uploaded_file($image_files['tmp_name'][$i], $image_path)) {
                $image_paths[] = $image_path;
            } else {
                $_SESSION['error'] = "เกิดข้อผิดพลาดในการอัปโหลดไฟล์:" . $image_files['name'][$i];
                //echo "Error uploading file: " . $image_files['name'][$i];
                exit;
            }
        } else {
            $_SESSION['error'] = "ไม่รองรับนามสกุลไฟล์:" . $extension;
            echo "Unsupported file type: " . $extension;
            exit;
        }
    }

    // If no errors, proceed to save paths in the database
    /* if (!empty($image_paths)) {

        // แปลง array ของ image paths เป็น JSON string
        $organization_img = json_encode($image_paths);

        $stmt5 = $conn->prepare("UPDATE `tb_organization` SET organization_bio = ? ,organization_img= ? WHERE organization_email = :organization_email;");
        $stmt5->execute([$organization_bio,$organization_img,$user_email]);
        //$result = mysqli_query($con, $sql);
        if ($stmt5) {
            $_SESSION['success'] = "แก้ไขข้อมูลเสร็จสิ้น!";
            header("Location: ../1page/org_profile.php");
            exit;
        } else {
            $_SESSION['error'] = "มีข้อผิดพลาดในการบันทึกข้อมูล";
        }
    } else {
        $_SESSION['error'] = "ไม่มีรูปภาพที่ถูกอัพโหลด";
    } */
} else {
    $_SESSION['error'] = "ไม่มีรูปภาพที่ถูกเลือก";
}


 $organization_img = json_encode($image_paths);

$stmt5 = $conn->prepare("UPDATE tb_organization SET organization_bio = ? ,organization_img = ? WHERE organization_email = ? ");
$stmt5->execute([$organization_bio, $organization_img, $user_email]);
if ($stmt5) {
    $_SESSION['success'] = "แก้ไขข้อมูลเสร็จสิ้น!";
    header("Location: ../1page/org_ps.php");
    exit;
} else {
    $_SESSION['error'] = "มีข้อผิดพลาดในการบันทึกข้อมูล";
}
