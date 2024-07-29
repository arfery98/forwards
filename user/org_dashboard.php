<?php
require('../db.php');
include('../db_connect.php');
session_start();
require_once('../address/get_amphures.php');
require_once('../address/get_districts.php');
require_once('../address/get_zipcode.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: ../1page/login.php");
    exit();
}

/*if (!isset($_SESSION['organization_name'])) {
    header("Location: ../1page/login.php");
    exit();
}*/
$organization_id = $_POST['organization_id'];
$organization_name = $_POST['organization_name'];
$organization_phone = $_POST['organization_phone'];
$organization_ad_no = $_POST['no'];
$organization_ad_village = $_POST['village'];
$organization_ad_groubs = $_POST['groubs'];
$organization_ad_buildings = $_POST['buildings'];
$organization_ad_alleys = $_POST['alleys'];
$organization_ad_roads = $_POST['roads'];
$organization_ad_provinces = $_POST['provinces'];
$organization_ad_amphures = $_POST['amphures'];
$organization_ad_district = $_POST['district'];

$stmt2 = $conn->prepare("SELECT * FROM districts WHERE id = :id");
$stmt2->bindParam(':id', $organization_ad_district);
$stmt2->execute();
$rows = $stmt2->fetch(PDO::FETCH_ASSOC);
$organization_ad_districts_name = $rows['name_th'];


$organization_ad_zipcode = $_POST['zipcode'];


print "<pre> ";
print_r($_FILES);
print "</pre> ";

if (isset($_FILES['images'])) {

    $image_files = $_FILES['images'];
    $fw_img = 'check_org'; // ต้องตั้งค่าชื่อของ organization ที่นี่
    $extension = strtolower(pathinfo($image_files['name'], PATHINFO_EXTENSION));
    $support = array("jpg", "jpeg", "png", "gif", "pdf");


    if (in_array($extension, $support)) {
        $new_file_name = strtolower($fw_img) . "_" . time() . "_" . $_FILES['images']['name'];
        $image_path = 'uploads/images/' . $new_file_name;

        // print$new_file_name ; 
        //  print $image_path ;
        if (move_uploaded_file($_FILES['images']['tmp_name'], $image_path)) {
            //$image_paths[] = $image_path;
            echo "อัพโหลดเสร็จแล้ว";
        } else {
            $_SESSION['error'] = "เกิดข้อผิดพลาดในการอัปโหลดไฟล์:";
            //echo "Error uploading file: " . $image_files['name'][$i];
            exit;
        }
    } else {
        $_SESSION['error'] = "ไม่รองรับนามสกุลไฟล์:" . $extension;
        //echo "Unsupported file type: " . $extension;
        header("location:../1page/org_edit_profile.php");
        exit;
    }
}



$stmt = $conn->prepare("UPDATE tb_organization SET organization_comfirm = ?, organization_phone = ?, organization_ad_no = ? ,organization_ad_village = ? ,organization_ad_groubs = ? ,organization_ad_buildings = ? ,organization_ad_alleys = ? ,organization_ad_roads = ? ,organization_ad_provinces = ? ,organization_ad_amphures = ? ,organization_ad_districts = ? ,organization_ad_zipcode = ? WHERE organization_id = ?");
$stmt->execute([$image_path, $organization_phone, $organization_ad_no, $organization_ad_village, $organization_ad_groubs, $organization_ad_buildings, $organization_ad_alleys, $organization_ad_roads, $organization_ad_provinces, $organization_ad_amphures, $organization_ad_districts_name, $organization_ad_zipcode, $organization_id]);
if ($stmt) {
    $_SESSION['success'] = "แก้ไขข้อมูลเสร็จสิ้น!";
    header("Location: ../1page/org_profile.php");
    exit;
} else {
    $_SESSION['error'] = "มีข้อผิดพลาดในการบันทึกข้อมูล";
}

/* 
if (isset($_FILES['images'])) {
    $image_files = $_FILES['images'];
    $total_images = count($image_files['name']);
    $image_paths = [];
    $fw_img = 'some_img'; // ต้องตั้งค่าชื่อของ organization ที่นี่

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
    if (!empty($image_paths)) {

        // แปลง array ของ image paths เป็น JSON string
        $organization_comfirm = json_encode($image_paths);
        
        $stmt = $conn->prepare("UPDATE tb_organization SET organization_comfirm = ?, organization_phone = ?, organization_ad_no = ? ,organization_ad_village = ? ,organization_ad_groubs = ? ,organization_ad_buildings = ? ,organization_ad_alleys = ? ,organization_ad_roads = ? ,organization_ad_provinces = ? ,organization_ad_amphures = ? ,organization_ad_districts = ? ,organization_ad_zipcode = ? WHERE organization_name = ?");
        $stmt->execute([$organization_comfirm, $organization_phone, $organization_ad_no, $organization_ad_village, $organization_ad_groubs, $organization_ad_buildings, $organization_ad_alleys, $organization_ad_roads, $organization_ad_provinces, $organization_ad_amphures, $organization_ad_districts_name, $organization_ad_zipcode, $organization_name]);
        //$sql = "UPDATE tb_organization SET organization_comfirm = ?, organization_phone = ?, organization_ad_no = ? ,organization_ad_village = ? ,organization_ad_groubs = ? ,organization_ad_buildings = ? ,organization_ad_alleys = ? ,organization_ad_roads = ? ,organization_ad_provinces = ? ,organization_ad_amphures = ? ,organization_ad_districts = ? ,organization_ad_zipcode = ? WHERE organization_name = ?";
        //$result = mysqli_query($con, $sql);
        if ($stmt) {
            $_SESSION['success'] = "แก้ไขข้อมูลเสร็จสิ้น!";
            header("Location: ../1page/org_profile.php");
            exit;
        } else {
            $_SESSION['error'] = "มีข้อผิดพลาดในการบันทึกข้อมูล";
        }
    } else {
        $_SESSION['error'] = "ไม่มีรูปภาพที่ถูกอัพโหลด";
    }
} else {
    $_SESSION['error'] = "ไม่มีรูปภาพที่ถูกเลือก";
}
 */
/* if ($result) {
    header("location:../1page/org_profile.php");
    exit(0);
} else {
    echo "ไม่สามารถแก้ไขข้อมูลได้";
} */
