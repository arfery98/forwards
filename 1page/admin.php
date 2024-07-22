<?php
session_start();
require('../db.php');

if (!isset($_SESSION['admin'])) {
    header("Location: ../1page/login.php");
}
?>

