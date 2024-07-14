<?php
// session_start();
require_once('../db.php');
//include('../db.php');
if (isset($_POST['function']) && $_POST['function'] == 'province_id') {
    $province_id = $_POST['province_id'];
    $stmt = $conn->prepare("SELECT amphures.name_th FROM amphures,provinces WHERE amphures.province_id=provinces.id AND provinces.name_th= :id");
    $stmt->bindParam(':id', $province_id);
    $stmt->execute();
    $rows = $stmt->fetchAll();
    echo '<option value="" selected disabled>เลือกอําเภอ</option>';
    foreach ($rows as $row) {
        echo '<option value="' . $row["name_th"] . '">' . $row["name_th"] . '</option>';
    }
    exit();
}
//echo $_POST['province'];

