<?php 
    session_start();
    unset($_SESSION['organization_name']);

    header('location:../1page/index.php');
    ?>