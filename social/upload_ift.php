<?php

session_start();

include('../db_connect.php');
echo "<pre>";
print_r($_FILES);
echo "</pre>";

if (!isset($_SESSION['user_id'])) {
    header("Location: ../user/login.php");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['user_ift'])) {

    $user_id = $_SESSION['user_id'];
    $dc_message = $_POST['dc_message'];
    $dc_type = 'user';

    if (isset($_FILES['images'])) {
        $image_files = $_FILES['images'];
        $total_images = count($image_files['name']);
        $image_paths = [];
        $user_dc = 'some_user_ift'; // ต้องตั้งค่าชื่อของ organization ที่นี่

        // Check if total images exceed the limit
        if ($total_images > 20) {
            $_SESSION['error'] = "อัพรูปภาพสูงสุด 20 รูป";
            //echo "อัพรูปภาพสูงสุด 20 รูป";
            exit;
        }
        // Loop through each file
        for ($i = 0; $i < $total_images; $i++) {
            // Get file extension and convert to lowercase
            $extension = strtolower(pathinfo($image_files['name'][$i], PATHINFO_EXTENSION));
            $support = array("jpg", "jpeg", "png", "gif");

            if (in_array($extension, $support)) {
                $new_file_name = strtolower($user_dc) . "_" . time() . "_" . $i . "." . $extension;
                $image_path = 'uploads/images/' . $new_file_name;

                // echo $image_path;
                //$dc_img = json_encode($image_paths);
                // Move uploaded file to the destination directory
                if (move_uploaded_file($image_files['tmp_name'][$i], $image_path)) {
                    $image_paths[] = $image_path;
                } else {
                    $_SESSION['error'] = "เกิดข้อผิดพลาดในการอัปโหลดไฟล์:" . $image_files['name'][$i];
                    //echo "Error uploading file: " . $image_files['name'][$i];
                    exit;
                }
            } else {
                $_SESSION['error'] = "ไม่รองรับประเภทไฟล์นี้:" . $extension;
                //echo "Unsupported file type: " . $extension;
                exit;
            }
        }
    } else {
        $_SESSION['error'] = "ไม่มีรูปภาพที่ถูกเลือก";
    }

    $dc_img = json_encode($image_paths);
    $sql = "INSERT INTO `tb_user_declares`(`declares_user`, `declares_message`, `declares_img`, declares_type) 
                    VALUES ('$user_id', '$dc_message', '$dc_img', '$dc_type' )";
    $result = mysqli_query($con, $sql);

    if ($result) {
        $_SESSION['success'] = "โพสต์ประชาสัมพันธ์เรียบร้อย!";
        header("Location: ../1page/declares.php");
        exit;
    } else {
        $_SESSION['error'] = "มีข้อผิดพลาดในการบันทึกข้อมูล";
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['org_ift'])) {
    $user_id = $_SESSION['organization_email'];
    $dc_message = $_POST['dc_message'];
    $dc_type = 'org';

    if (isset($_FILES['images'])) {
        $image_files = $_FILES['images'];
        $total_images = count($image_files['name']);
        $image_paths = [];
        $user_dc = 'some_org_ift'; // ต้องตั้งค่าชื่อของ organization ที่นี่

        // Check if total images exceed the limit
        if ($total_images > 20) {
            $_SESSION['error'] = "อัพรูปภาพสูงสุด 20 รูป";
            //echo "อัพรูปภาพสูงสุด 20 รูป";
            exit;
        }
        // Loop through each file
        for ($i = 0; $i < $total_images; $i++) {
            // Get file extension and convert to lowercase
            $extension = strtolower(pathinfo($image_files['name'][$i], PATHINFO_EXTENSION));
            $support = array("jpg", "jpeg", "png", "gif");

            if (in_array($extension, $support)) {
                $new_file_name = strtolower($user_dc) . "_" . time() . "_" . $i . "." . $extension;
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
                $_SESSION['error'] = "ไม่รองรับประเภทไฟล์นี้:" . $extension;
                //echo "Unsupported file type: " . $extension;
                exit;
            }
        }
    } else {
        $_SESSION['error'] = "ไม่มีรูปภาพที่ถูกเลือก";
    }

    $dc_img = json_encode($image_paths);
    $sql = "INSERT INTO `tb_user_declares`(`declares_user`, `declares_message`, `declares_img`, declares_type) 
                    VALUES ('$user_id', '$dc_message', '$dc_img', '$dc_type' )";
    $result = mysqli_query($con, $sql);

    if ($result) {
        $_SESSION['success'] = "โพสต์ประชาสัมพันธ์เรียบร้อย!";
        header("Location: ../1page/declares.php");
        exit;
    } else {
        $_SESSION['error'] = "มีข้อผิดพลาดในการบันทึกข้อมูล";
    }
}
