<?php
session_start();
include('../db.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: ../1page/login.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <title>บัญชีองค์กร</title>
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
                    <h4 class="text text-center text-primary">เข้าสู่ระบบใช้งานโครงการ</h4>
                    <form action="../user/org_login_db.php" method="POST">
                        <?php if (isset($_SESSION['error'])) { ?>
                            <div class="alert alert-danger" role="alert">
                                <?php echo $_SESSION['error'];
                                unset($_SESSION['error']);
                                ?>
                            </div>
                        <?php }; ?>
                        <div class="body">
                            <div class="mb-3">
                                <label for="email" class="form-label">อีเมล</label>
                                <input type="email" class="form-control" id="Email" name="organization_email" placeholder="Email" required>
            
                                <label for="password" class="form-label mt-3">รหัสผ่าน</label>
                                <input type="password" class="form-control" id="password" name="organization_password" placeholder="password" required>


                                <br>
                                <hr>
                                <div class="d-grid gap-2 col-6 mx-auto">
                                    <button class="btn btn-primary rounded-pill" type="submit" name="org_login">เข้าสู่ระบบ</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>