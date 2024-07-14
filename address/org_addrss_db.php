<?php
// session_start();
require_once('../db.php');
//include('../db.php');

include_once('../address/get_amphures.php');
include_once('../address/get_districts.php');
include_once('../address/get_zipcode.php');

if (isset($_POST['update_db'])) {
    $organization_ad_no = $_POST['no'];
    $organization_ad_village = $_POST['village'];
    $organization_ad_groubs = $_POST['groubs'];
    $organization_ad_buildings = $_POST['buildings'];
    $organization_ad_alleys = $_POST['alleys'];
    $organization_ad_roads = $_POST['roads'];
    $organization_ad_provinces = $_POST['provinces'];
    $organization_ad_amphures = $_POST['amphures'];
    $organization_ad_districts = $_POST['districts'];
    $organization_ad_zipcode = $_POST['zipcode'];

    $stmt = $conn->prepare("INSERT INTO tb_organization( organization_ad_no, organization_ad_village, organization_ad_groubs, organization_ad_buildings, organization_ad_alleys, organization_ad_roads, organization_ad_provinces, organization_ad_amphures, organization_ad_districts, organization_ad_zipcode) VALUES (?,?,?,?,?,?,?,?,?)");
    $stmt->execute([$organization_ad_no, $organization_ad_village, $organization_ad_groubs, $organization_ad_buildings, $organization_ad_alleys, $organization_ad_roads, $organization_ad_provinces, $organization_ad_amphures, $organization_ad_districts, $organization_ad_zipcode]);

    echo "Update address successfully";
} else {
    $stmt = $conn->prepare("UPDATE `tb_organization` SET ,`organization_ad_no`= ? ,`organization_ad_village`= ? ,`organization_ad_groubs`= ? ,`organization_ad_buildings`= ? ,`organization_ad_alleys`= ? ,`organization_ad_roads`= ? ,`organization_ad_provinces`= ? ,`organization_ad_amphures`= ? ,`organization_ad_districts`=?,`organization_ad_zipcode`=?, WHERE organization_email = ?");
    $stmt->execute([$organization_ad_no, $organization_ad_village, $organization_ad_groubs, $organization_ad_buildings, $user_ad_alleys, $user_ad_roads, $user_ad_provinces, $user_ad_amphures, $user_ad_districts, $user_ad_zipcode]);
}
