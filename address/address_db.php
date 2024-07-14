<?php
// session_start();
require_once('../db.php');
//include('../db.php');

include_once('../address/get_amphures.php');
include_once('../address/get_districts.php');
include_once('../address/get_zipcode.php');

if (isset($_POST['update_db'])) {
    $user_ad_no = $_POST['no'];
    $user_ad_village = $_POST['village'];
    $user_ad_groubs = $_POST['groubs'];
    $user_ad_buildings = $_POST['buildings'];
    $user_ad_alleys = $_POST['alleys'];
    $user_ad_roads = $_POST['roads'];
    $user_ad_provinces = $_POST['provinces'];
    $user_ad_amphures = $_POST['amphures'];
    $user_ad_districts = $_POST['districts'];
    $user_ad_zipcode = $_POST['zipcode'];

    $stmt = $conn->prepare("INSERT INTO tb_users( user_ad_no, user_ad_village, user_ad_groubs, user_ad_buildings, user_ad_alleys, user_ad_roads, user_ad_provinces, user_ad_amphures, user_ad_districts, user_ad_zipcode) VALUES (?,?,?,?,?,?,?,?,?)");
    $stmt->execute([$user_ad_no, $user_ad_village, $user_ad_groubs, $user_ad_buildings, $user_ad_alleys, $user_ad_roads, $user_ad_provinces, $user_ad_amphures, $user_ad_districts, $user_ad_zipcode]);

    echo "Update address successfully";
} else {
    $stmt = $conn->prepare("UPDATE `tb_users` SET ,`user_ad_no`= ? ,`user_ad_village`= ? ,`user_ad_groubs`= ? ,`user_ad_buildings`= ? ,`user_ad_alleys`= ? ,`user_ad_roads`= ? ,`user_ad_provinces`= ? ,`user_ad_amphures`= ? ,`user_ad_districts`=?,`user_ad_zipcode`=?,`user_proflie`=?,`user_created_at`= ? WHERE user_id = ?");
    $stmt->execute([$user_ad_no, $user_ad_village, $user_ad_groubs, $user_ad_buildings, $user_ad_alleys, $user_ad_roads, $user_ad_provinces, $user_ad_amphures, $user_ad_districts, $user_ad_zipcode]);
}
