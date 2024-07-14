<?php
// session_start();
require_once('../db.php');
//include('../db.php');
if (isset($_POST['function']) && $_POST['function'] == 'amphures') {
    $province_id = $_POST['amphures_id'];
    $stmt = $conn->prepare("SELECT districts.id, districts.name_th FROM districts,amphures WHERE districts.amphure_id = amphures.id AND amphures.name_th= :id");
    $stmt->bindParam(':id', $province_id);
    $stmt->execute();
    $rows = $stmt->fetchAll();
    echo '<option value="" selected disabled>เลือกตำบล</option>';
    foreach ($rows as $row) {
        echo '<option value="' . $row["id"] . '">' . $row["name_th"] . '</option>';
    }
    exit();
}
