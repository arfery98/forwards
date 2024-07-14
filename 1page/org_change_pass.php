<?php
session_start();
include('../db.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: ../1page/login.php");
}

$stmt = $conn->prepare("SELECT * FROM tb_organization WHERE organization_name = :organization_name");
$stmt->bindParam(":organization_name", $_SESSION['organization_name']);
$stmt->execute();
$user_orgData = $stmt->fetch(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <title>แก้ไขรหัสผ่านโครงการ</title>
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
        <div class="row justify-content-center">
            <div class="card" style="width: 75rem;">
                <div class="card-body">
                    <p class="fs-3">แก้ไขรหัสผ่านโครงการ</p>
                    <form action="../user/org_change_pass.php" method="POST">
                        <?php if (isset($_SESSION['success'])) { ?>

                            <div class="alert alert-success" role="alert">
                                <?php
                                echo $_SESSION['success'];
                                unset($_SESSION['success']);
                                ?>
                            </div>
                        <?php }; ?>

                        <?php if (isset($_SESSION['error'])) { ?>
                            <div class="alert alert-danger" role="alert">
                                <?php echo $_SESSION['error'];
                                unset($_SESSION['error']);
                                ?>
                            </div>
                        <?php }; ?>

                        <div class="row">
                            <div class="col">
                                <label for="org_name" class="form-label">ชื่อองค์กรณ์/โครงการ</label>
                                <input type="text" class="form-control" id="org_name" value="<?php echo $user_orgData['organization_email'];  ?>" readonly>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col">
                                <label for="org_pass" class="form-label">รหัสผ่านเดิม</label>
                                <input type="password" class="form-control" id="org_pass" name="user_password" require>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col">
                                <label for="org_editpass" class="form-label">รหัสผ่านใหม่</label>
                                <input type="password" class="form-control" id="org_editpass" name="user_new_pass" require>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col">
                                <label for="org_confirm" class="form-label">ยืนยันรหัสผ่านใหม่</label>
                                <input type="password" class="form-control" id="org_confirm" name="user_checkpass" require>
                            </div>
                        </div>
                        <br>
                        <div class="row text-end">
                            <div class="col">
                                <a href="org_profile.php" class="btn btn-danger rounded-pill">ยกเลิก</a>
                                <button type="submit" class="btn btn-warning rounded-pill">แก้ไขรหัสผ่าน</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>