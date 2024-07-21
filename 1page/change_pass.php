<?php
session_start();
require('../db.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: ../1page/login.php");
}


$stmt = $conn->prepare("SELECT * FROM tb_users WHERE user_id = :user_id");
$stmt->bindParam(":user_id", $_SESSION['user_id']);
$stmt->execute();
$userData = $stmt->fetch(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <title>เปลี่ยนรหัสผ่าน</title>
    <link rel="stylesheet" href="../font.css">
    <?php if (isset($_SESSION['organization_name'])) {

        include('../org_header.php');
    } else {
        include('../header.php');
    } ?>
</head>

<body style="background-color: #dfeefa;">
    <div class="container">
        <br>
        <div class="card" style="width: 80rem;">
            <div class="card-body">

                <form action="../user/edit_pass.php" method="POST">
                    <div class="container">
                        <p class="fs-3">แก้ไขรหัสผ่าน</p>
                        
                        <div class="row">
                            <div class="col">
                                <label for="formGroupExampleInput" class="form-label">ชื่อผู้ใช้งาน</label>
                                <input type="text" class="form-control" id="" disabled readonly value="<?php echo $userData['user_name'];  ?>">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col">
                                <label for="formGroupExampleInput" class="form-label">รหัสผ่านเดิม</label>
                                <input type="password" class="form-control" id="user_password" name="user_password">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col">
                                <label for="formGroupExampleInput" class="form-label">รหัสผ่านใหม่</label>
                                <input type="password" class="form-control" id="user_new_pass" name="user_new_pass">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="formGroupExampleInput" class="form-label">ยืนยันรหัสผ่านใหม่</label>
                                <input type="password" class="form-control" id="user_checkpass" name="user_checkpass">
                            </div>
                        </div>
                        <br>
                        <div class="row text-end">
                            <div class="col">
                                <a href="change_pass.php" type="button" class="btn btn-danger rounded-pill">ยกเลิก</a>
                                <button type="POST" class="btn btn-primary rounded-pill">แก้ไขรหัสผ่าน</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


    
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>