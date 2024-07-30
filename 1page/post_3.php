<?php
session_start();
include('../db.php');
include('../db_connect.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: ../1page/login.php");
}



$sql = "SELECT * FROM `tb_personal_forward` WHERE personal_forward_status = 'Open'  ORDER BY personal_forward_time DESC LIMIT 0,3";
$result3 = $con->query($sql);


$sql2 = "SELECT * FROM `tb_organization_forwards` WHERE organization_forward_status = 'Open'  ORDER BY organization_forward_time DESC LIMIT 0,3";
$result2 = $con->query($sql2);

$sql_3 = "SELECT * FROM `tb_org_rq` WHERE org_rq_status = 'No_forwards' ORDER BY org_rq_time DESC ";
$result_3 = $con->query($sql_3);

$sql_4 = "SELECT * FROM `tb_organization` WHERE organization_verify = 'IP' LIMIT 0,3 ";
$result_4 = $con->query($sql_4);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <title>โพสต์</title>
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
        <section class="about section-padding" id="about">

            <div class="card" style="width: 80rem;"><!-- เลือกดู -->
                <div class="text-center">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <a class="text-decoration-none" href="post_1.php">
                                    <figure class="figure">
                                        <img alt="" width="50" height="50" src="../image/soung.png">
                                    </figure>
                                    <p>โพสต์บริจาคของบุคคลทั่วไป</p>
                                </a>
                            </div>
                            <div class="col">
                                <a class="text-decoration-none" href="post_2.php">
                                    <figure class="figure">
                                        <img alt="" width="50" height="50" src="../image/org_soung.png">
                                    </figure>
                                    <p>โพสต์บริจาคขององค์กร</p>
                                </a>
                            </div>
                            <div class="col">
                                <a class="text-decoration-none" href="post_3.php">
                                    <figure class="figure">
                                        <img alt="" width="50" height="50" src="../image/org_rq.png">
                                    </figure>
                                    <p>โพสต์ขอบริจาคขององค์กร</p>
                                </a>
                            </div>
                            <div class="col">
                                <a class="text-decoration-none" href="post_4.php">
                                    <figure class="figure">
                                        <img alt="" width="50" height="50" src="../image/share.png">
                                    </figure>
                                    <p>โพสต์ประชาสัมพันธ์</p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>
        <!-- about section Ends -->

        <br>

        <div class="card" style="width: 80rem;"> <!-- โพสต์ขอองค์กร -->

            <section class="portfolio section-padding" id="portfolio">
                <div class="card-body">
                    <br>
                    <p class="fs-2">โพสต์ขอรับบริจาคขององค์กร</p>
                    <br>
                    <div class="row">
                        <?php while ($row = mysqli_fetch_assoc($result_3)) { ?>

                            <div class="col-12 col-md-12 col-lg-4">
                                <br>
                                <div class="card text-light text-center bg-white pb-2 " style="width: 25rem; height: auto;">
                                    <div class="card-body text-dark">
                                        <div id="carouselExample<?php echo $row['org_rq_id'] ?>" class="carousel slide" data-bs-ride="carousel">
                                            <div class="img-area mb-4">
                                                <div class="carousel-inner">
                                                    <?php $images = json_decode($row['org_rq_img'], true); ?>
                                                    <?php if (is_array($images) && count($images) > 0) : ?>
                                                        <?php foreach ($images as $index => $image) : ?>
                                                            <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>" style="width: 300px;">
                                                                <?php echo "<img src='../social/{$image}' class='d-block w-100' alt='images'>"; ?>
                                                            </div>
                                                        <?php endforeach; ?>
                                                    <?php else : ?>
                                                        <div class="carousel-item active">
                                                            <img src="placeholder.jpg" class="d-block w-100" alt="Placeholder Image">
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample<?php echo $row['org_rq_id'] ?>" data-bs-slide="prev">
                                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                    <span class="visually-hidden">Previous</span>
                                                </button>
                                                <button class="carousel-control-next" type="button" data-bs-target="#carouselExample<?php echo $row['org_rq_id'] ?>" data-bs-slide="next">
                                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                    <span class="visually-hidden">Next</span>
                                                </button>
                                            </div>
                                            <h3 class="card-title"><?php echo $row['org_rq_name']; ?></h3>
                                            <p class="lead"> <?php echo $row['org_rq_detail'] ?>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="card-footer bg-transparent border-light">
                                        <a href="fw_detail.php?org_rq_id=<?php echo $row['org_rq_id'] ?>" class="btn bg-primary text-white rounded-pill">รายละเอียดเพิ่มเติม</a>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>

                    </div>
                </div>
            </section>

        </div>

    </div>


    <br>
    <hr>
    <br>

    <!-- END -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>