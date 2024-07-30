<?php
session_start();
include('../db.php');
include('../db_connect.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: ../user/login.php");
}

if (isset($_POST['submit_personal'])) {
    print_r($_POST);
    //echo "คนทั่วไปโฟสต์";
    $personal_forward_id = $_POST['personal_forward_id'];
    $history_forwards_name = $_POST['history_forwards_name'];
    $history_forwards_detail = $_POST['history_forwards_detail'];
    $history_forward_ct = $_POST['history_forward_ct'];
    $history_forwards_location = $_POST['history_forwards_location'];
    $history_forwards_user_forwards = $_POST['history_forwards_user'];
    $history_forwards_org_forwards = $_POST['history_forwards_org'];
    $history_forwards_status = "pending";

    if ($history_forwards_org_forwards != '') {

        $user_forward = $history_forwards_org_forwards;
    } else {
        $user_forward = $history_forwards_user_forwards;
    }

    $sql = "INSERT INTO tb_history_personal_forwards(history_forwards_personal_id,history_forwards_name, history_forwards_detail, history_forward_ct,history_forwards_location,history_forwards_status,history_forwards_user_forwards) 
VALUES ('$personal_forward_id','$history_forwards_name','$history_forwards_detail','$history_forward_ct','$history_forwards_location','$history_forwards_status','$user_forward')";
    $result = mysqli_query($con, $sql);
    if ($result) {
        //$_SESSION['success'] = "โพสต์บริจาคเรียบร้อย!";
        //echo "ส่งข้อมูลเสร็จสิ้น";
        header("Location: ../1page/index.php");
        exit;
    } else {
        //$_SESSION['error'] = "มีข้อผิดพลาดในการบันทึกข้อมูล";
        echo "มีปัญหาในการส่งข้อมูล";
    }
}

if (isset($_POST['submit_org'])) {
    print_r($_POST);
    //echo "องค์กรโฟสต์";
    $organization_forward_id = $_POST['organization_forward_id'];
    $history_forwards_name = $_POST['history_forwards_name'];
    $history_forwards_detail = $_POST['history_forwards_detail'];
    $history_forward_ct = $_POST['history_forward_ct'];
    $history_forwards_location = $_POST['history_forwards_location'];
    $history_forwards_user_forwards = $_POST['history_forwards_user'];
    $history_forwards_org_forwards = $_POST['history_forwards_org'];
    $history_forwards_status = "pending";

    if ($history_forwards_org_forwards != '') {
        $user_forward = $history_forwards_org_forwards;
    } else {
        $user_forward = $history_forwards_user_forwards;
    }

    $sql = "INSERT INTO tb_history_personal_forwards(history_forwards_org_id,history_forwards_name, history_forwards_detail, history_forward_ct,history_forwards_location,history_forwards_status,history_forwards_user_forwards) 
VALUES ('$organization_forward_id','$history_forwards_name','$history_forwards_detail','$history_forward_ct','$history_forwards_location','$history_forwards_status','$user_forward')";
    $result = mysqli_query($con, $sql);
    if ($result) {
        //$_SESSION['success'] = "โพสต์บริจาคเรียบร้อย!";
        //echo "ส่งข้อมูลเสร็จสิ้น";
        header("Location: ../1page/index.php");
        exit;
    } else {
        //$_SESSION['error'] = "มีข้อผิดพลาดในการบันทึกข้อมูล";
        echo "มีปัญหาในการส่งข้อมูล";
    }
}


/* 
$history_forwards_name = $_POST['history_forwards_name'];
$history_forwards_detail = $_POST['history_forwards_detail'];
$history_forward_ct = $_POST['history_forward_ct'];
$history_forwards_location = $_POST['history_forwards_location'];

$history_forwards_user_forwards = $_POST['history_forwards_user'];
$history_forwards_org_forwards = $_POST['history_forwards_org'];

$history_forwards_status = "pending";

if ($history_forwards_org_forwards != '') {

    $user_forward = $history_forwards_org_forwards;
} else {
    $user_forward = $history_forwards_user_forwards;
}

$sql = "INSERT INTO tb_history_personal_forwards(history_forwards_name, history_forwards_detail, history_forward_ct,history_forwards_location,history_forwards_status,history_forwards_user_forwards) 
VALUES ('$history_forwards_name','$history_forwards_detail','$history_forward_ct','$history_forwards_location','$history_forwards_status','$user_forward')";
 */