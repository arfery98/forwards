<?php
session_start();
include('../db_connect.php');
include('../db.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: ../user/login.php");
}


if ($_SERVER['REQUEST_METHOD'] ) {
    $organization_name = $_SESSION['organization_name']; // ดึงข้อมูล user_id จากเซสชัน
    //$content = !emptys($_POST['content']) ? $_POST['content'] : null;
    $org_rq_name = $_POST['org_rq_name'];
    $org_rq_detail = $_POST['org_rq_detail'];
    //$org_rq_img = $_POST['org_rq_img'];
    $org_rq_catagories_id = $_POST['org_rq_catagories_id'];
    $org_ad_no = $_POST['no'];
    $org_ad_village = $_POST['village'];
    $org_ad_groubs = $_POST['groubs'];
    $org_ad_buildings = $_POST['buildings'];
    $org_ad_alleys = $_POST['alleys'];
    $org_ad_roads = $_POST['roads'];
    $org_ad_provinces = $_POST['provinces'];
    $org_ad_amphures = $_POST['amphures'];
    $org_ad_districts = $_POST['districts'];

    $stmt1 = $conn->prepare("SELECT * FROM districts WHERE id = :id");
    $stmt1->bindParam(':id', $user_ad_districts);
    $stmt1->execute();
    $rows = $stmt1->fetch(PDO::FETCH_ASSOC);
    $user_ad_districts_name = $rows['name_th'];

    $org_ad_zipcode = $_POST['zipcode'];
    $org_rq_status = 'No_forwards';


    if (isset($_FILES['images'])) {
        $image_files = $_FILES['images'];
        $total_images = count($image_files['name']);
        $image_paths = [];
        $fw_img = 'some_img'; // ต้องตั้งค่าชื่อของ organization ที่นี่

        // Check if total images exceed the limit
        if ($total_images > 20) {
            $_SESSION['error'] = "อัพรูปภาพสูงสุด 20 รูป" ;
            //echo "อัพรูปภาพสูงสุด 20 รูป";
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
                    $_SESSION['error'] = "เกิดข้อผิดพลาดในการอัปโหลดไฟล์:" . $image_files['name'][$i] ;
                    //echo "Error เกิดข้อผิดพลาดในการอัปโหลดไฟล์ file: " . $image_files['name'][$i];
                    exit;
                }
            } else {
                $_SESSION['error'] = "ไม่รองรับประเภทไฟล์นี้:" . $extension ;
                //echo "Unsupported file type: " . $extension;
                exit;
            }
        }

        // If no errors, proceed to save paths in the database
        if (!empty($image_paths)) {

            // แปลง array ของ image paths เป็น JSON string
            $org_rq_img = json_encode($image_paths);

            //echo $personal_forward_img;

            //  สร้างตัวแปร เพื่อเก็บภาษา sql
            $sql = "INSERT INTO tb_org_rq(org_rq_user, org_rq_name, org_rq_detail, org_rq_img, org_rq_catagories_id, org_ad_no, org_ad_village, org_ad_groubs, org_ad_buildings, org_ad_alleys, org_ad_roads, org_ad_provinces, org_ad_amphures, org_ad_districts, org_ad_zipcode, org_rq_status) 
            VALUES ('$organization_name','$org_rq_name','$org_rq_detail','$org_rq_img','$org_rq_catagories_id','$org_ad_no','$org_ad_village','$org_ad_groubs','$org_ad_buildings','$org_ad_alleys','$org_ad_roads','$org_ad_provinces','$org_ad_amphures','$org_ad_districts','$org_ad_zipcode','$org_rq_status')";
            $result = mysqli_query($con, $sql);
            if ($result) {
                $_SESSION['success'] = "โพสต์ขอรับการบริจาคเรียบร้อย!";
                header("Location: ../1page/org_rq.php");
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