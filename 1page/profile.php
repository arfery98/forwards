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
    <title>ข้อมูลส่วนตัว</title>
    <link rel="stylesheet" href="../font.css">
    <?php include('../header.php'); ?>
</head>

<body style="background-color: #dfeefa;">
    <div class="container">
        <br>
        <div class="card" style="width: 80rem;">
            <div class="card-body">
                <p class="fs-3">ข้อมูลส่วนตัว</p>
                <hr>
                <center>
                    <?php if (isset($_SESSION['user_id'])) { ?>

                        <img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png" alt="" height="180" class="d-inline-block align-text-middle rounded-circle">
                    <?php } else { ?>
                        <img src="file:///C:/Downloads/songtor-Photoroom.png" alt="" height="180" class="d-inline-block align-text-middle rounded-circle">
                    <?php } ?>
                </center>
                <hr>
                <div class="row">
                    <div class="col">
                        <label for="formGroupExampleInput" class="form-label">เลขบัตรประจำตัวประชาชน</label>
                        <input type="text" class="form-control" id="" value="<?php echo $userData['user_id']  ?>" disabled readonly>
                    </div>
                    <div class="col">
                        <label for="formGroupExampleInput" class="form-label">ชื่อ</label>
                        <input type="text" class="form-control" id="formGroupExampleInput" value="<?php echo $userData['user_name']  ?>" disabled readonly>
                    </div>
                    <div class="col">
                        <label for="formGroupExampleInput" class="form-label">นามสกุล</label>
                        <input type="text" class="form-control" id="formGroupExampleInput" value="<?php echo $userData['user_lastname']  ?>" disabled readonly>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="formGroupExampleInput" class="form-label"> Email</label>
                        <input type="email" class="form-control" id="formGroupExampleInput" value="<?php echo $userData['user_email']  ?>" disabled readonly>
                    </div>
                    <div class="col">
                        <label for="formGroupExampleInput" class="form-label">เบอร์โทรศัพท์</label>
                        <input type="text" class="form-control" id="formGroupExampleInput" value="<?php echo $userData['user_phone']  ?>" disabled readonly>
                    </div>
                    <div class="col">
                    </div>
                </div>
                <hr>
                <p class="fs-5">ที่อยู่</p>
                <div class="row">
                    <div class="col">
                        <label for="formGroupExampleInput" class="form-label">บ้านเลขที่</label>
                        <input type="text" class="form-control" id="formGroupExampleInput" value="<?php echo $userData['user_ad_no']  ?>" disabled readonly>
                    </div>
                    <div class="col">
                        <label for="formGroupExampleInput" class="form-label">หมู่บ้าน</label>
                        <input type="text" class="form-control" id="formGroupExampleInput" value="<?php echo $userData['user_ad_village']  ?>" disabled readonly>
                    </div>
                    <div class="col">
                        <label for="formGroupExampleInput" class="form-label">หมู่ที่</label>
                        <input type="text" class="form-control" id="formGroupExampleInput" value="<?php echo $userData['user_ad_groubs']  ?>" disabled readonly>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="formGroupExampleInput" class="form-label">อาคาร</label>
                        <input type="text" class="form-control" id="formGroupExampleInput" value="<?php echo $userData['user_ad_buildings']  ?>" disabled readonly>
                    </div>
                    <div class="col">
                        <label for="formGroupExampleInput" class="form-label">ตรอก/ซอย</label>
                        <input type="text" class="form-control" id="formGroupExampleInput" value="<?php echo $userData['user_ad_alleys']  ?>" disabled readonly>
                    </div>
                    <div class="col">
                        <label for="formGroupExampleInput" class="form-label">ถนน</label>
                        <input type="text" class="form-control" id="formGroupExampleInput" value="<?php echo $userData['user_ad_roads']  ?>" disabled readonly>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="formGroupExampleInput" class="form-label">จังหวัด</label>
                        <select class="form-select" aria-label="Default select example" id="formGroupExampleInput" disabled readonly>
                            <option selected value="<?php echo $userData['user_ad_provinces'] ?>"><?php echo $userData['user_ad_provinces'] ?></option>
                        </select>
                    </div>
                    <div class="col">
                        <label for="formGroupExampleInput" class="form-label">อำเภอ/เขต</label>
                        <select class="form-select" aria-label="Default select example" id="formGroupExampleInput" disabled readonly>
                            <option selected value="<?php echo $userData['user_ad_amphures']  ?>"><?php echo $userData['user_ad_amphures'] ?></option>
                        </select>
                    </div>
                    <div class="col">
                        <label for="formGroupExampleInput" class="form-label">ตำบล/แขวง</label>
                        <select class="form-select" aria-label="Default select example" id="formGroupExampleInput" disabled readonly>
                            <option selected value="<?php echo $userData['user_ad_districts']  ?>"><?php echo $userData['user_ad_districts'] ?></option>

                        </select>
                    </div>
                    <div class="col">
                        <label for="formGroupExampleInput" class="form-label">รหัสไปรษณีย์</label>
                        <input type="text" class="form-control" id="formGroupExampleInput" value="<?php echo $userData['user_ad_zipcode']  ?>" disabled readonly>
                    </div>



                    <div class="row text-end">

                        <div class="col">
                            <br>
                            <a href="edit_profile.php" class="btn btn-warning rounded-pill">แก้ไขข้อมูล</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>