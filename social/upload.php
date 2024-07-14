<?php
session_start();
include('../db_connect.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: ../user/login.php");
}


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['Personal-forwards'])) {
    $user_id = $_SESSION['user_id']; // ดึงข้อมูล user_id จากเซสชัน
    //$content = !emptys($_POST['content']) ? $_POST['content'] : null;
    $personal_forward_name = $_POST['personal_forward_name'];
    $personal_forward_detail = $_POST['personal_forward_detail'];
    $personal_forward_catagories_id = $_POST['personal_forward_catagories_id'];
    $personal_forward_location = $_POST['personal_forward_location'];
    $personal_forward_status = 'Open';


    if (isset($_FILES['images'])) {
        $image_files = $_FILES['images'];
        $total_images = count($image_files['name']);
        $image_paths = [];
        $fw_img = 'some_img'; // ต้องตั้งค่าชื่อของ organization ที่นี่

        // Check if total images exceed the limit
        if ($total_images > 20) {
            echo "อัพรูปภาพสูงสุด 20 รูป";
            exit;
        }

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
                    echo "Error uploading file: " . $image_files['name'][$i];
                    exit;
                }
            } else {
                echo "Unsupported file type: " . $extension;
                exit;
            }
        }

        // If no errors, proceed to save paths in the database
        if (!empty($image_paths)) {

            // แปลง array ของ image paths เป็น JSON string
            $personal_forward_img = json_encode($image_paths);

            //echo $personal_forward_img;
            
            //  สร้างตัวแปร เพื่อเก็บภาษา sql
            $sql = "INSERT INTO tb_personal_forward(personal_forward_user,personal_forward_name,personal_forward_detail,personal_forward_img,personal_forward_catagories_id,personal_forward_location,personal_forward_status) VALUES ('$user_id','$personal_forward_name','$personal_forward_detail','$personal_forward_img','$personal_forward_catagories_id','$personal_forward_location','$personal_forward_status')";
            $result = mysqli_query($con, $sql);
            if ($result) {
                $_SESSION['success'] = "โพสต์บริจาคเรียบร้อย!";
                header("Location: ../1page/forwards.php");
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
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['organization-forwards'])) {

    //print_r($_POST);
    //$organization_email = $_SESSION['organization_email'];
    $organization_name = $_SESSION['organization_name'];
    $organization_forward_name = $_POST['personal_forward_name'];
    $organization_forward_detail = $_POST['personal_forward_detail'];
    $organization_forward_catagories_id = $_POST['personal_forward_catagories_id'];
    $organization_forward_location = $_POST['personal_forward_location'];
    $organization_forward_status = 'Open';

    if (isset($_FILES['images'])) {
        $image_files = $_FILES['images'];
        $total_images = count($image_files['name']);
        $image_paths = [];
        $organization_forward_name = 'some_organization'; // ต้องตั้งค่าชื่อของ organization ที่นี่

        // Check if total images exceed the limit
        if ($total_images > 20) {
            echo "อัพรูปภาพสูงสุด 20 รูป";
            exit;
        }

        // Loop through each file
        for ($i = 0; $i < $total_images; $i++) {
            // Get file extension and convert to lowercase
            $extension = strtolower(pathinfo($image_files['name'][$i], PATHINFO_EXTENSION));
            $support = array("jpg", "jpeg", "png", "gif");

            if (in_array($extension, $support)) {
                $new_file_name = strtolower($organization_forward_name) . "_" . time() . "_" . $i . "." . $extension;
                $image_path = 'uploads/images/' . $new_file_name;

                // Move uploaded file to the destination directory
                if (move_uploaded_file($image_files['tmp_name'][$i], $image_path)) {
                    $image_paths[] = $image_path;
                } else {
                    echo "Error uploading file: " . $image_files['name'][$i];
                    exit;
                }
            } else {
                echo "Unsupported file type: " . $extension;
                exit;
            }
        }

        // If no errors, proceed to save paths in the database
        if (!empty($image_paths)) {
            $organization_forward_img = json_encode($image_paths);

            $sql = "INSERT INTO tb_organization_forwards (organization_forward_user, organization_forward_name, organization_forward_detail, organization_forward_img, organization_forward_catagories_id, organization_forward_location, organization_forward_status) VALUES ('$organization_name','$organization_forward_name','$organization_forward_detail','$organization_forward_img','$organization_forward_catagories_id','$organization_forward_location','$organization_forward_status')";
            $result = mysqli_query($con, $sql);

            if ($result) {
                $_SESSION['success'] = "โพสต์บริจาคเรียบร้อย!";
                header("Location: ../1page/forwards.php");
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
}


/* foreach ($_POST['images'] as $image) {
        $image_paths = [];
        $image_files = $image;
        $total_images = count($image_files['name']);
        //แปลงสกุลไฟล์เป็นตัวพิมพ์เล็ก
        $extension = pathinfo($_FILES['images']['name'], PATHINFO_EXTENSION);
        $new_file_name = strtolower($organization_forward_name) . "_" . time() . "." . $extension;
        $image_path = 'uploads/images/' . $new_file_name;
        //print_r($image_path);

        if (!empty($_FILES['images']['name'][0])) {
            $image_paths = [];
            $image_files = $_FILES['images'];
            $total_images = count($image_files['name']);

            // จำกัดจำนวนไฟล์ที่อัปโหลด
            if ($total_images > 20) {
                echo "อัพรูปภาพสูงสุด 20 รูป";
                exit;
            }

            // จัดการการอัปโหลดไฟล์
            for ($i = 0; $i < $total_images; $i++) {
                $image_name = basename($image_files['name'][$i]);
                $image_path = 'uploads/images/' . $image_name;

                // ตรวจสอบและย้ายไฟล์
                if (move_uploaded_file($image_files['tmp_name'][$i], $image_path)) {
                    $image_paths[] = $image_path;
                } else {
                    echo "Error uploading file: " . $image_name;
                    exit;
                }
            }
            $_SESSION['success'] = "โพสต์บริจาคเรียบร้อย!";
            header("Location: ../1page/forwards.php");
            //echo "โพสต์บริจาคเรียบร้อย!";
        } else {
            $_SESSION['error'] = "มีข้อผิดพลาด";
        }

        $organization_forward_img = json_encode($image_paths);

        $sql = "INSERT INTO tb_organization_forwards(organization_forward_user, organization_forward_name, organization_forward_detail, organization_forward_img, organization_forward_catagories_id, organization_forward_location, organization_forward_status) VALUES ('$organization_name','$organization_forward_name','$organization_forward_detail','$organization_forward_img','$organization_forward_catagories_id','$organization_forward_location','$organization_forward_status')";

        $result = mysqli_query($con, $sql);
    }
} */