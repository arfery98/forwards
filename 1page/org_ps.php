<?php
session_start();
include('../db.php');
include('../db_connect.php');

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
    <title>แนะนำองค์กร</title>
    <link rel="stylesheet" href="../font.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css" />
    <?php if (isset($_SESSION['organization_name'])) {

        include('../org_header.php');
    } else {
        include('../header.php');
    } ?>
</head>

<body style="background:#e7f4ff">
    <div class="container">
        <br>
        <div class="card" style="width: 80rem;">
            <div class="card-body">
                <div class="row">
                    <p class="fs-5">แนะนำโครงการ</p>
                    <div class="col">
                        <label for="formGroupExampleInput" class="form-label">รายละเอียดข้อมูล</label>
                        <input type="text" class="form-control" id="formGroupExampleInput" value="<?php echo $user_orgData['organization_bio'];  ?>" readonly>
                        <br>
                    </div>
                </div>

                <hr>
                <h1 class="modal-title fs-5" id="exampleModalLabel">รูปภาพเพื่อแนะนำองค์กร</h1>
                <div class="modal-body">
                    <?php $images = json_decode($user_orgData['organization_img'], true);
                    if (is_array($images)) {
                        foreach ($images as $image) { ?>
                            <div class="text center">
                                <?php echo "<img alt='' class='img-thumbnail' src='../user/{$image}'>"; ?>
                            </div>
                        <?php } ?>
                    <?php } ?>
                    <style>
                        .text-center {
                            margin: 20px auto;
                            max-width: 640px;
                        }

                        img {
                            max-width: 100%;
                        }
                    </style>
                    <br>

                </div>
                <div class="row text-end">
                    <div class="col">

                        <a type="button" class="btn btn-outline-secondary rounded-pill" href="org_edit_ps.php">แก้ไขข้อมูล</a>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>