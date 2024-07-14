<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <title>สมัครสมาชิก/Sign up</title>
    <link rel="stylesheet" href="../font.css">
    <?php include('../header.php'); ?>
</head>

<body style="background-color: #dfeefa;">
    <div class="container">

        <br>
        <div class="row justify-content-center align-items-center vh-50">
            <div class="col-xs-12 col-sm-8 col-md-4 col-lg-4">
                <div class="card p-3 rounded-4 shadow border border-secondary-subtle">
                    <img src="../image/1.png" width="150px" class="rounded-circle mx-auto my-3">
                    <h4 class="text text-center text-primary">สมัครใช้งาน</h4>
                    <hr>
                    <form action="../user/register_db.php" method="POST">

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
                                <label for="id0" class="form-label">เลขที่บัตรประจำตัวประชาชน</label>
                                <input type="id" class="form-control" id="id" name="id0">
                            </div>
                            <div>
                                <div class="row">
                                    <div class="col">
                                        <label for="id1" class="form-label">ชื่อ (ไม่มีคำนำหน้า)</label>
                                        <input type="name" class="form-control" id="id1" name="name">
                                    </div>
                                    <div class="col">
                                        <label for="id2" class="form-label">นามสกุล</label>
                                        <input type="lastname" class="form-control" id="id2" name="lastname">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <label for="id3" class="form-label">E-mail</label>
                                        <input type="email" class="form-control" id="id3" name="email">
                                    </div>
                                    <div class="col">
                                        <label for="id4" class="form-label">เบอร์โทรศัพท์</label>
                                        <input type="phone" class="form-control" id="id4" name="phone">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <label for="id3" class="form-label">รหัสผ่าน</label>
                                        <input type="password" class="form-control" id="id3" name="password">
                                    </div>
                                    <div class="col">
                                        <label for="id5" class="form-label">ยืนยันรหัสผ่าน</label>
                                        <input type="password" class="form-control" id="id5" name="confirm_password">
                                    </div>
                                </div>
                                <br>

                                <div class="d-grid gap-2 d-md-flex justify-content-center container">
                                </div>
                            </div>
                            <hr>
                            <button class="btn btn-primary rounded-pill" name="register" id="" type="submit">ยืนยัน</button>
                    </form>
                </div>
            </div>
        </div>
    </div>





    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>