<?php
// session_start();
require_once('../db.php');
//include('../db.php');
if (isset($_POST['function']) && $_POST['function'] == 'district') {
    $province_id = $_POST['district_id'];
    $stmt = $conn->prepare("SELECT * FROM districts WHERE id = :id");
    $stmt->bindParam(':id', $province_id);
    $stmt->execute();
    $rows = $stmt->fetch(PDO::FETCH_ASSOC);
    echo $rows['zip_code'];
    exit();
}
