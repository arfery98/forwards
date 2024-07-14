<?php
require('../db.php');
session_start();
require_once('../address/get_amphures.php');
require_once('../address/get_districts.php');
require_once('../address/get_zipcode.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_POST['user_id'];
$user_name = $_POST['user_name'];
$user_lastname = $_POST['user_lastname'];
$user_phone = $_POST['user_phone'];

$user_ad_no = $_POST['no'];
$user_ad_village = $_POST['village'];
$user_ad_groubs = $_POST['groubs'];
$user_ad_buildings = $_POST['buildings'];
$user_ad_alleys = $_POST['alleys'];
$user_ad_roads = $_POST['roads'];
$user_ad_provinces = $_POST['provinces'];
$user_ad_amphures = $_POST['amphures'];
$user_ad_districts = $_POST['districts'];

$stmt1 = $conn->prepare("SELECT * FROM districts WHERE id = :id");
$stmt1->bindParam(':id', $user_ad_districts);
$stmt1->execute();
$rows = $stmt1->fetch(PDO::FETCH_ASSOC);
$user_ad_districts_name = $rows['name_th'];


$user_ad_zipcode = $_POST['zipcode'];

$stmt = $conn->prepare("UPDATE tb_users SET user_name = ?, user_lastname = ?,  user_phone = ?, user_ad_no = ? ,user_ad_village = ? ,user_ad_groubs = ? ,user_ad_buildings = ? ,user_ad_alleys = ? ,user_ad_roads = ? ,user_ad_provinces = ? ,user_ad_amphures = ? ,user_ad_districts = ? ,user_ad_zipcode = ? WHERE user_id = ?");
$stmt->execute([$user_name, $user_lastname,  $user_phone, $user_ad_no, $user_ad_village, $user_ad_groubs, $user_ad_buildings, $user_ad_alleys, $user_ad_roads, $user_ad_provinces, $user_ad_amphures, $user_ad_districts_name, $user_ad_zipcode, $user_id]);


if ($stmt) {
    header("location:../1page/profile.php");
    exit(0);
} else {
    echo "ไม่สามารถแก้ไขข้อมูลได้";
}
//echo "Profile updated successfully!";

//$stmt = $conn->prepare("INSERT INTO tb_users( user_ad_no, user_ad_village, user_ad_groubs, user_ad_buildings, user_ad_alleys, user_ad_roads, user_ad_provinces, user_ad_amphures, user_ad_districts, user_ad_zipcode) VALUES (?,?,?,?,?,?,?,?,?)");
//$stmt->execute([$user_ad_no, $user_ad_village, $user_ad_groubs, $user_ad_buildings, $user_ad_alleys, $user_ad_roads, $user_ad_provinces, $user_ad_amphures, $user_ad_districts, $user_ad_zipcode]);


//$stmt = $conn->prepare('SELECT `user_ad_no`, `user_ad_village`, `user_ad_groubs`, `user_ad_buildings`, `user_ad_alleys`, `user_ad_roads`, `user_ad_provinces`, `user_ad_amphures`, `user_ad_districts`, `user_ad_zipcode` FROM `tb_users` WHERE user_id :user_id');
//$stmt->execute([$user_ad_no, $user_ad_village, $user_ad_groubs, $user_ad_buildings, $user_ad_alleys, $user_ad_roads, $user_ad_provinces, $user_ad_amphures, $user_ad_districts, $user_ad_zipcode]);

//echo "Updated address successfully!";
//$stmt = $conn->prepare("UPDATE tb_users SET user_ad_no = ? ,user_ad_village = ? ,user_ad_groubs = ? ,user_ad_buildings = ? ,user_ad_alleys = ? ,user_ad_roads = ? ,user_ad_provinces = ? ,user_ad_amphures = ? ,user_ad_districts = ? ,user_ad_zipcode = ? WHERE user_id = ?");
//$stmt->execute([$user_ad_no, $user_ad_village, $user_ad_groubs, $user_ad_buildings, $user_ad_alleys, $user_ad_roads, $user_ad_provinces, $user_ad_amphures, $user_ad_districts, $user_ad_zipcode]);
