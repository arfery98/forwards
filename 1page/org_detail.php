<?php
session_start();
include('../db.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: ../1page/login.php");
}

$stmt = $conn->prepare("SELECT * FROM tb_organization WHERE organization_name = :organization_name");
$stmt->bindParam(":organization_name", $_SESSION['organization_name']);
$stmt->execute();
$user_orgData = $stmt->fetch(PDO::FETCH_ASSOC);

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <title>รายละเอียดโครงการ</title>
    <link rel="stylesheet" href="../font.css">
    <?php if (isset($_SESSION['organization_name'])) {

        include('../org_header.php');
    } else {
        include('../header.php');
    } ?>
</head>

<body style="background-color: #dfeefa;">
    <div class="container">