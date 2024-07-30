<?php


require('../db.php');
require('../db_connect.php');

/* if (!isset($_SESSION['user_id'])) {
    header("Location: ../1page/login.php");
    exit();
} */

session_start();

//$user_id = $_SESSION['user_id'];


/* $image_parts = explode(";base64,", $_POST['image']);
$image_type_aux = explode("image/", $image_parts[0]);
$image_type = $image_type_aux[1];
$image_base64 = base64_decode($image_parts[1]);

file_put_contents($file, $image_base64);
$response = array(
                'status' => true,
                'msg' => 'Image uploaded on server successfully!',
				'file' => $file
            );
echo json_encode($response);


if (isset($_FILES['images'])) {
    $image_files = $_FILES['images'];
    $total_images = count($image_files['name']);
    $image_paths = [];
    $fw_img = 'who_img'; // ต้องตั้งค่าชื่อของ organization ที่นี่

    // Check if total images exceed the limit


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

    if (!empty($image_paths)) {

        // แปลง array ของ image paths เป็น JSON string
        $user_profile = json_encode($image_paths);

        $stmt = $conn->prepare("UPDATE tb_users SET user_profile = :user_profile WHERE user_id = :user_id");
        $stmt->bindParam(":user_id", $user_id, PDO::PARAM_STR);
        $stmt->bindParam(":user_profile", $user_profile, PDO::PARAM_STR);
        $stmt->execute();
        
        if ($stmt) {
            $_SESSION['success'] = "อัพรูปภาพเรียบร้อย!";
            header("location:../1page/edit_profile.php");
            exit(0);
        } else {
            $_SESSION['error'] = "มีข้อผิดพลาดในแก้ไขข้อมูล";
        }
    } else {
        $_SESSION['error'] = "ไม่มีรูปภาพที่ถูกเลือก";
    }
} */


// Base64 Image Upload Handling
/* if (isset($_POST['image'])) {
    $image_parts = explode(";base64,", $_POST['image']);
    if (count($image_parts) === 2) {
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = isset($image_type_aux[1]) ? $image_type_aux[1] : '';
        $image_base64 = base64_decode($image_parts[1]);

        $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
        if (!in_array($image_type, $allowed_types)) {
            echo json_encode([
                'status' => false,
                'msg' => 'Invalid image type!'
            ]);
            exit;
        }

        $file = 'uploads/images/' . uniqid() . '.' . $image_type;
        if (file_put_contents($file, $image_base64)) {
            echo json_encode([
                'status' => true,
                'msg' => 'Image uploaded on server successfully!',
                'file' => $file
            ]);
        } else {
            echo json_encode([
                'status' => false,
                'msg' => 'Failed to save image!'
            ]);
        }
        exit;
    } else {
        echo json_encode([
            'status' => false,
            'msg' => 'Invalid image data!'
        ]);
        exit;
    }
}

// File Upload Handling via Form
if (isset($_FILES['images'])) {
    $image_files = $_FILES['images'];
    $total_images = count($image_files['name']);
    $image_paths = [];
    $fw_img = 'who_img'; // Set organization name here

    // Loop through each file
    for ($i = 0; $i < $total_images; $i++) {
        // Get file extension and convert to lowercase
        $extension = strtolower(pathinfo($image_files['name'][$i], PATHINFO_EXTENSION));
        $allowed_extensions = ["jpg", "jpeg", "png", "gif"];

        if (in_array($extension, $allowed_extensions)) {
            $new_file_name = strtolower($fw_img) . "_" . time() . "_" . $i . "." . $extension;
            $image_path = 'uploads/images/' . $new_file_name;

            // Move uploaded file to the destination directory
            if (move_uploaded_file($image_files['tmp_name'][$i], $image_path)) {
                $image_paths[] = $image_path;
            } else {
                $_SESSION['error'] = "Error uploading file: " . htmlspecialchars($image_files['name'][$i]);
                header("Location: ../1page/edit_profile.php");
                exit;
            }
        } else {
            $_SESSION['error'] = "Unsupported file type: " . htmlspecialchars($extension);
            header("Location: ../1page/edit_profile.php");
            exit;
        }
    }

    if (!empty($image_paths)) {
        // Convert array of image paths to JSON string
        $user_profile = json_encode($image_paths);

        // Assuming $conn is your PDO connection and $user_id is defined
        $stmt = $conn->prepare("UPDATE tb_users SET user_profile = :user_profile WHERE user_id = :user_id");
        $stmt->bindParam(":user_id", $user_id, PDO::PARAM_STR);
        $stmt->bindParam(":user_profile", $user_profile, PDO::PARAM_STR);
        if ($stmt->execute()) {
            $_SESSION['success'] = "Images uploaded successfully!";
            header("Location: ../1page/edit_profile.php");
        } else {
            $_SESSION['error'] = "Error updating user profile.";
            header("Location: ../1page/edit_profile.php");
        }
        exit;
    } else {
        $_SESSION['error'] = "No images selected.";
        header("Location: ../1page/edit_profile.php");
        exit;
    }
} */


if (isset($_POST['image']) || isset($_FILES['images'])) {
    $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
    $image_paths = [];
    $fw_img = 'who_img'; // Set organization name here

    // Handle Base64 Image
    if (isset($_POST['image'])) {
        $image_parts = explode(";base64,", $_POST['image']);
        if (count($image_parts) === 2) {
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = isset($image_type_aux[1]) ? $image_type_aux[1] : '';
            $image_base64 = base64_decode($image_parts[1]);

            if (in_array($image_type, $allowed_types)) {
                $file = 'uploads/images/' . uniqid() . '.' . $image_type;
                if (file_put_contents($file, $image_base64)) {
                    $image_paths[] = $file;
                } else {
                    echo json_encode(['status' => false, 'msg' => 'Failed to save image!']);
                    exit;
                }
            } else {
                echo json_encode(['status' => false, 'msg' => 'Invalid image type!']);
                exit;
            }
        } else {
            echo json_encode(['status' => false, 'msg' => 'Invalid image data!']);
            exit;
        }
    }

    // Handle File Upload
    if (isset($_FILES['images'])) {
        $image_files = $_FILES['images'];
        $total_images = count($image_files['name']);

        for ($i = 0; $i < $total_images; $i++) {
            $extension = strtolower(pathinfo($image_files['name'][$i], PATHINFO_EXTENSION));

            if (in_array($extension, $allowed_types)) {
                $new_file_name = strtolower($fw_img) . "_" . time() . "_" . $i . "." . $extension;
                $image_path = 'uploads/images/' . $new_file_name;

                if (move_uploaded_file($image_files['tmp_name'][$i], $image_path)) {
                    $image_paths[] = $image_path;
                } else {
                    $_SESSION['error'] = "Error uploading file: " . htmlspecialchars($image_files['name'][$i]);
                    header("Location: ../1page/edit_profile.php");
                    exit;
                }
            } else {
                $_SESSION['error'] = "Unsupported file type: " . htmlspecialchars($extension);
                header("Location: ../1page/edit_profile.php");
                exit;
            }
        }
    }

    // If images were successfully uploaded
    if (!empty($image_paths)) {
        $organization_proflie = json_encode($image_paths);

        $organization_email = $_SESSION['organization_email'];

        // Assuming $conn is your PDO connection and $user_id is defined
        /* $stmt = $conn->prepare("UPDATE tb_users SET user_profile = :user_profile WHERE user_id = :user_id");
        $stmt->bindParam(":user_id", $user_id, PDO::PARAM_STR);
        $stmt->bindParam(":user_profile", $user_profile, PDO::PARAM_STR); */

        $stmt = $conn->prepare("UPDATE tb_users SET organization_proflie = :organization_proflie WHERE organization_email = :organization_email");
        $stmt->bindParam(":organization_email", $organization_email, PDO::PARAM_STR);
        $stmt->bindParam(":organization_proflie", $organization_proflie, PDO::PARAM_STR);

        if ($stmt->execute()) {
            $_SESSION['success'] = "Images uploaded successfully!";
        } else {
            $_SESSION['error'] = "Error updating user profile.";
        }
        header("Location: ../1page/edit_profile.php");
        exit;
    } else {
        $_SESSION['error'] = "No images selected.";
        header("Location: ../1page/edit_profile.php");
        exit;
    }
} else {
    echo json_encode(['status' => false, 'msg' => 'No image data received!']);
    exit;
}