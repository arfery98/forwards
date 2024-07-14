<?php

session_start();
require('../db.php');

if (isset($_POST['org_login'])) {
    $organization_email = $_POST['organization_email'];
    $organization_password = $_POST['organization_password'];
    // var_dump($passH);

    //print_r($_POST);}
        try {
            //แก้
            $stmt = $conn->prepare("SELECT * FROM tb_organization WHERE organization_email = :organization_email");
            $stmt->bindParam(":organization_email", $organization_email);
            $stmt->execute();
            $org_userData = $stmt->fetch(PDO::FETCH_ASSOC);


            if ($org_userData['organization_password'] == $organization_password) {
                //$_SESSION['user_id'] = $org_userData['user_id'];
                $_SESSION['organization_name'] = $org_userData['organization_name'];
                //$_SESSION['user_lastname'] = $org_userData['user_lastname'];
                $_SESSION['organization_email'] = $org_userData['organization_email'];
                $_SESSION['organization_phone'] = $org_userData['organization_phone'];
                header("Location: ../1page/index.php");
            } else {
                $_SESSION['error'] = "อีเมลหรือรหัสผ่านไม่ถูกต้อง";
                header("Location: ../1page/org_login.php");
            }
        } catch (PDOException $e) {
            $_SESSION['error'] = "มีข้อผิดพลาด";
            header("Location: ../1page/org_login.php");
        }
    }
