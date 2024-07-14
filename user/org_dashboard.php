<?php
require('../db.php');
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


$stmt = $conn->prepare("UPDATE tb_organization SET  organization_phone = ?, organization_ad_no = ? ,organization_ad_village = ? ,organization_ad_groubs = ? ,organization_ad_buildings = ? ,organization_ad_alleys = ? ,organization_ad_roads = ? ,organization_ad_provinces = ? ,organization_ad_amphures = ? ,organization_ad_districts = ? ,organization_ad_zipcode = ? WHERE organization_name = ?");
$stmt->execute([ $organization_phone, $organization_ad_no, $organization_ad_village, $organization_ad_groubs, $organization_ad_buildings, $organization_ad_alleys, $organization_ad_roads, $organization_ad_provinces, $organization_ad_amphures, $organization_ad_districts_name, $organization_ad_zipcode, $organization_name]);


if ($stmt) {
    header("location:../1page/org_profile.php");
    exit(0);
} else {
    echo "ไม่สามารถแก้ไขข้อมูลได้";
}