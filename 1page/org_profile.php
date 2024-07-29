<?php
session_start();
include('../db.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: ../1page/login.php");
}

$stmt = $conn->prepare("SELECT * FROM tb_organization WHERE organization_email = :organization_email");
$stmt->bindParam(":organization_email", $_SESSION['organization_email']);
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css" />
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
                            <?php if (isset($_SESSION['organization_proflie'])) { ?>

                                <?php $images = json_decode($user_orgData['organization_proflie'], true);
                                if (is_array($images)) {
                                    foreach ($images as $image) { ?>
                                        <?php echo "<img src='../user/{$image}' alt='' height='180' class='d-inline-block align-text-middle rounded-circle'>" ?>
                                    <?php } ?>
                                <?php  } ?>
                            <?php } else { ?>
                                <img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png" alt="" height="180" class="d-inline-block align-text-middle rounded-circle">
                            <?php  } ?>
                        </center>
                        <br>
                        <hr>
                        <div class="row">
                            <div class="col">
                                <label for="formGroupExampleInput" class="form-label">Email</label>
                                <input type="text" class="form-control" id="formGroupExampleInput" value="<?php echo $user_orgData['organization_email'];  ?>" readonly>
                            </div>
                            <div class="col">
                                <label for="formGroupExampleInput" class="form-label">ชื่อองค์กรณ์ / โครงการ </label>
                                <input type="text" class="form-control" id="formGroupExampleInput" value="<?php echo $user_orgData['organization_name'];  ?>" readonly>
                            </div>
                            <div class="col">
                                <label for="formGroupExampleInput" class="form-label">เบอร์โทรศัพท์</label>
                                <input type="text" class="form-control" id="formGroupExampleInput" value="<?php echo $user_orgData['organization_phone'];  ?>" readonly>
                            </div>
                        </div>

                        <br>

                        <div class="row">
                            <div class="col">
                                <label for="formGroupExampleInput" class="form-label">เอกสารตรวจสอบองค์กร : </label>
                                <?php if ($user_orgData['organization_verify'] == 'IP') { ?>
                                    <span class="badge bg-success">ดำเนินการเสร็จสิ้น</span>
                                <?php } else { ?>
                                    <span class="badge bg-warning text-dark">ยังไม่ดำเนินการ</span>
                                <?php } ?>
                            </div>
                            <div class="col">
                            </div>
                        </div>
                        <hr>
                        <p class="fs-5">ที่อยู่องค์กรณ์</p>
                        <div class="row">
                            <div class="col">
                                <label for="formGroupExampleInput" class="form-label">บ้านเลขที่</label>
                                <input type="text" class="form-control" id="formGroupExampleInput" value="<?php echo $user_orgData['organization_ad_no'];  ?>" readonly>
                            </div>
                            <div class="col">
                                <label for="formGroupExampleInput" class="form-label">หมู่บ้าน</label>
                                <input type="text" class="form-control" id="formGroupExampleInput" value="<?php echo $user_orgData['organization_ad_village'];  ?>" readonly>
                            </div>
                            <div class="col">
                                <label for="formGroupExampleInput" class="form-label">หมู่ที่</label>
                                <input type="text" class="form-control" id="formGroupExampleInput" value="<?php echo $user_orgData['organization_ad_groubs'];  ?>" readonly>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="formGroupExampleInput" class="form-label">อาคาร</label>
                                <input type="text" class="form-control" id="formGroupExampleInput" value="<?php echo $user_orgData['organization_ad_buildings'];  ?>" readonly>
                            </div>
                            <div class="col">
                                <label for="formGroupExampleInput" class="form-label">ตรอก/ซอย</label>
                                <input type="text" class="form-control" id="formGroupExampleInput" value="<?php echo $user_orgData['organization_ad_alleys'];  ?>" readonly>
                            </div>
                            <div class="col">
                                <label for="formGroupExampleInput" class="form-label">ถนน</label>
                                <input type="text" class="form-control" id="formGroupExampleInput" value="<?php echo $user_orgData['organization_ad_roads'];  ?>" readonly>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="formGroupExampleInput" class="form-label">จังหวัด</label>
                                <input type="text" class="form-control" id="formGroupExampleInput" value="<?php echo $user_orgData['organization_ad_provinces'];  ?>" readonly>
                            </div>
                            <div class="col">
                                <label for="formGroupExampleInput" class="form-label">อำเภอ/เขต</label>
                                <input type="text" class="form-control" id="formGroupExampleInput" value="<?php echo $user_orgData['organization_ad_amphures'];  ?>" readonly>
                            </div>
                            <div class="col">
                                <label for="formGroupExampleInput" class="form-label">ตำบล/แขวง</label>
                                <input type="text" class="form-control" id="formGroupExampleInput" value="<?php echo $user_orgData['organization_ad_districts'];  ?>" readonly>
                            </div>
                            <div class="col">
                                <label for="formGroupExampleInput" class="form-label">รหัสไปรษณีย์</label>
                                <input type="text" class="form-control" id="formGroupExampleInput" value="<?php echo $user_orgData['organization_ad_zipcode'];  ?>" readonly>
                            </div>

                        </div>
                        <br>
                        <div class="row text-end">
                            <div class="col">
                                <a type="button" class="btn btn-outline-secondary rounded-pill" href="org_edit_profile.php">แก้ไขข้อมูล</a>
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