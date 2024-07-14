<?php
require('../db.php');
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}


/*$user_id = $_SESSION['user_id'];
$user_profile = $_SESSION['user_profile'];
$user_profile = $_FILES['user_profile'][0];
$uploadDir = 'upload/';

if (!is_dir($uploadDir)) {  //ช็คที่อยู่ของไฟล์ uploadDir
    mkdir($uploadDir, 0777, true);
}
foreach ($_FILES['user_profile']['tb_user'] as $key => $tb_user) {
    $filename = basename($_FILES['user_profile'][$key]);
    $filePath = $uploadDir . $filename;
    if (move_uploaded_file($tb_user, $filePath)) {
        $user_profile[] = $filePath;
    } else {
        echo "Failed to upload image: " . $filename;
    }
}

$imagesJson = json_encode($images);

$stmt = $conn->prepare("INSERT INTO `tb_users`(`user_profile`) VALUES (?)");


//$stmt = $conn->prepare("UPDATE tb_users SET user_profile = :user_profile WHERE user_id = :user_id");
$stmt->bindParam(":user_profile", $imagesJson, PDO::PARAM_STR);
$result = $stmt->execute([$imagesJson]);


echo "success";*/


/*if(isset($_REQUEST['upprofile'])) {
        try {
            $profile_imgn = $_REQUEST['txt_name'];

            $img_file = $_FILES['txt_file'];
            $type = $_FILES['txt_file']['type'];
            $size = $_FILES['txt_file']['size'];
            $temp = $_FILES['txt_file']['tmp_name'];

            $path = "/upload" . $img_file; //เซ็ตโฟลเดอร์

            if(empty($profile_imgn)) {
                $errorMsg = "โปรดเลือกรูปภาพ" ;

            } else if ($type == "image/jpg" :: $type == "image/jpeg" :: $type == "image/png" ) {
                if (!file_exists($path)) { //เช็คไฟล์ในโฟลเดอร์ path
                    if($size < 20000000) { //เช็คขนาดไฟล์
                        move_uploaded_file($temp, '/upload'.$img_file) ;//ย้ายการอัพโหลดไฟล์
                    } else {
                        $errorMsg = "ขนาดไฟล์ของคุณใหญ่เกินไป (limit 20 mb)" ;
                    }
                } 
            } else {
                $errorMsg = "อัพไฟล์ในรูปแบบ JPG, JPEG, PNG  ";
            }

            if(!isset($errorMsg)) {
                $insert_stmt = $conn->prepare('INSERT INTO tb_users(user_profile, profile_imgn) VALUES (:user_profile, :profile_imgn)');
                $insert_stmt->bindParam(':user_profile', $user_profile) ;
                $insert_stmt->bindParam(':profile_imgn', $profile_imgn) ;

                if ($insert_stmt->execute()) {
                    $insert_stmt = "อัพโหลดไฟล์สำเร็จ" ;
                    
                }
            }

        } catch(PDOException $e){
            $e->getMessage();
        }
    }*/


if (isset($_POST['submit'])) {
    $countfiles = count($_FILES['files']);
    //อัปโหลดที่ไหน
    $query = "INSERT INTO tb_users(user_profile) VALUES(?)";
    $statement = $conn->prepare($query);
    for ($i = 0; $i < $countfiles; $i++) {

        // ชื่อไฟล์
        $filename = $_FILES['files'][$i];
        // Path
        $target_file = 'upload/' . $filename;
        // นามสกุล
        $file_extension = pathinfo(
            $target_file,
            PATHINFO_EXTENSION
        );
        $file_extension = strtolower($file_extension);
        // ไฟล์ที่รองรับ
        $valid_extension = array("png", "jpeg", "jpg");
        if (in_array($file_extension, $valid_extension)) {
            // Upload file
            if (move_uploaded_file(
                $_FILES['files'][$i],
                $target_file
            )) {
                $statement->execute(
                    array($filename, $target_file)
                );
            }
        }
    }

    echo "อัปโหลดสำเร็จ";
}
