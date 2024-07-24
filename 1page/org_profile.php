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
    <title>ข้อมูลโครงการ</title>
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
            <div class="card" style="width: 80rem;">
                <div class="card-body">

                    <div class="container">
                        <p class="fs-3">ข้อมูลโครงการ</p>
                        <hr>
                        <br>
                        <center>
                            <img  src="https://img.wongnai.com/p/624x0/2018/07/31/14c189e64df54897ac2f917e26c68509.jpg" class="rounded-5" alt="">
                            <br>
                        </center>
                        <br>
                        <hr>
                        <div class="row">
                            <div class="col">
                                <label for="formGroupExampleInput" class="form-label">Email</label>
                                <input type="text" class="form-control" id="formGroupExampleInput" value="<?php echo $user_orgData['organization_email'];  ?>" disabled readonly>
                            </div>
                            <div class="col">
                                <label for="formGroupExampleInput" class="form-label">ชื่อองค์กรณ์ / โครงการ </label>
                                <input type="text" class="form-control" id="formGroupExampleInput" value="<?php echo $user_orgData['organization_name'];  ?>" disabled readonly>
                            </div>
                            <div class="col">
                                <label for="formGroupExampleInput" class="form-label">เบอร์โทรศัพท์</label>
                                <input type="text" class="form-control" id="formGroupExampleInput" value="<?php echo $user_orgData['organization_phone'];  ?>" disabled readonly>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="formGroupExampleInput" class="form-label">เอกสารตรวจสอบโครงการ</label>
                                <form class="imgForm" action=".php" method="post" enctype="multipart/form-data">
                                    <input type="file" class="btn btn-outline-secondary" name="upload" disabled readonly>
                                </form>
                            </div>
                            <div class="col">
                            </div>
                        </div>
                        <hr>
                        <p class="fs-5">ที่อยู่องค์กรณ์</p>
                        <div class="row">
                            <div class="col">
                                <label for="formGroupExampleInput" class="form-label">บ้านเลขที่</label>
                                <input type="text" class="form-control" id="formGroupExampleInput" value="<?php echo $user_orgData['organization_ad_no'];  ?>" disabled readonly>
                            </div>
                            <div class="col">
                                <label for="formGroupExampleInput" class="form-label">หมู่บ้าน</label>
                                <input type="text" class="form-control" id="formGroupExampleInput" value="<?php echo $user_orgData['organization_ad_village'];  ?>" disabled readonly>
                            </div>
                            <div class="col">
                                <label for="formGroupExampleInput" class="form-label">หมู่ที่</label>
                                <input type="text" class="form-control" id="formGroupExampleInput" value="<?php echo $user_orgData['organization_ad_groubs'];  ?>" disabled readonly>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="formGroupExampleInput" class="form-label">อาคาร</label>
                                <input type="text" class="form-control" id="formGroupExampleInput" value="<?php echo $user_orgData['organization_ad_buildings'];  ?>" disabled readonly>
                            </div>
                            <div class="col">
                                <label for="formGroupExampleInput" class="form-label">ตรอก/ซอย</label>
                                <input type="text" class="form-control" id="formGroupExampleInput" value="<?php echo $user_orgData['organization_ad_alleys'];  ?>" disabled readonly>
                            </div>
                            <div class="col">
                                <label for="formGroupExampleInput" class="form-label">ถนน</label>
                                <input type="text" class="form-control" id="formGroupExampleInput" value="<?php echo $user_orgData['organization_ad_roads'];  ?>" disabled readonly>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="formGroupExampleInput" class="form-label">จังหวัด</label>
                                <input type="text" class="form-control" id="formGroupExampleInput" value="<?php echo $user_orgData['organization_ad_provinces'];  ?>" disabled readonly>
                            </div>
                            <div class="col">
                                <label for="formGroupExampleInput" class="form-label">อำเภอ/เขต</label>
                                <input type="text" class="form-control" id="formGroupExampleInput" value="<?php echo $user_orgData['organization_ad_amphures'];  ?>" disabled readonly>
                            </div>
                            <div class="col">
                                <label for="formGroupExampleInput" class="form-label">ตำบล/แขวง</label>
                                <input type="text" class="form-control" id="formGroupExampleInput" value="<?php echo $user_orgData['organization_ad_districts'];  ?>" disabled readonly>
                            </div>
                            <div class="col">
                                <label for="formGroupExampleInput" class="form-label">รหัสไปรษณีย์</label>
                                <input type="text" class="form-control" id="formGroupExampleInput" value="<?php echo $user_orgData['organization_ad_zipcode'];  ?>" readonly>
                            </div>

                        </div>
                        <br>
                        <div class="row text-end">
                            <div class="col">
                                <a type="button" class="btn btn-primary rounded-pill" href="org_edit_profile.php">แก้ไขข้อมูล</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>