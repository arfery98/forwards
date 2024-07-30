<?php
session_start();
include('../db.php');
include('../db_connect.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: ../1page/login.php");
}

if (isset($_GET['history_forwards_status'])) {
    //print_r($_GET);

    $history_forwards_id = $_GET['history_forwards_status'];
    $sql = "UPDATE `tb_history_personal_forwards` SET history_forwards_status ='finish' WHERE `history_forwards_id` = '$history_forwards_id' ";
    $result = mysqli_query($con, $sql);

    $sql1 = "SELECT * FROM tb_history_personal_forwards ";
    $result_1 = mysqli_query($con, $sql1);

    $row = mysqli_fetch_assoc($result_1);
    if ($row['history_forwards_status'] == 'finish') {
        $stmt = "UPDATE `tb_personal_forward` SET `personal_forward_status`= 'close' WHERE personal_forward_id ";
        $result_2 = mysqli_query($con, $stmt);
    }

    if ($result) {
        header("location:../1page/check_get.php");
        exit();
    }
}
