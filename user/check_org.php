<?php
session_start();
include('../db.php');
include('../db_connect.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: ../1page/login.php");
}

if (isset($_GET['organization_verify'])) {
    //print_r($_GET);

    $organization_id = $_GET['organization_verify'];
    $sql = "UPDATE `tb_organization` SET organization_verify ='IP' WHERE `organization_id` = '$organization_id' ";
    $result = mysqli_query($con, $sql);

    if ($result) {
        header("location:../1page/admin.php");
        exit();
    }
}
