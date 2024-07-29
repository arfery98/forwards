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

$sql_3 = "SELECT * FROM `tb_org_rq` WHERE org_rq_status = 'No_forwards' ORDER BY org_rq_time DESC LIMIT 0,3";
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
    <title>หน้าแรก</title>
    <link rel="stylesheet" href="../font.css">
    <?php if (isset($_SESSION['organization_name'])) {

        include('../org_header.php');
    } else {
        include('../header.php');
    } ?>
</head>

<body style="background-color: #dfeefa;">
    <img alt="..." class="d-block w-100" src="../image/banner-index.jpg">
    <div class="container">
        <br>
        <section class="about section-padding" id="about">

            <div class="card" style="width: 80rem;">
                <div class="card-body">
                    <div class="row">

                        <div class="col-lg-4 col-md-12 col-12">
                            <div class="about-img"><img alt="" class="img-fluid" src="https://s359.kapook.com/r/600/auto/pagebuilder/16155d13-fd8a-40a1-8f58-15d2f1badd4c.jpg">
                            </div>
                        </div>

                        <div class="col-lg-8 col-md-12 col-12 ps-lg-5 mt-md-5">
                            <div class="about-text">
                                <h2>สามารถส่งต่อสิ่งของเหลือใช้ได้<br>
                                    ไม่จำกัด ส่งได้ทุกอย่างเลย</h2>
                                <p>แพลตฟอร์มนี้ไม่ใช่เป็นส่วนกลางอย่างเดียวยังสามารถส่งต่อหรือบริจาคสิ่งของที่เหลืออใช้ได้เปิดโอกาสให้คนได้เท่าเทียมกันทุกพื้นที่
                                    สามารถช่วยเหลือได้ทุกคนทุกวัยได้เลย</p>
                                <a class="btn btn-primary rounded-pill" href="forwards.php">ส่งต่อเลย</a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </section>

        <!-- about section Ends -->

        <br>
        <div class="card" style="width: 80rem;"> <!-- แนะนำองค์กร -->
            <div class="card-body">
                <section class="portfolio section-padding" id="portfolio">
                    <div class="text-center">
                        <div class="row">
                            <div class="text-center">
                                <p class="fs-1"> องค์กร </p>
                                <p class="fs-3"> องค์กรหรือหน่วยงานเข้ามาใช้งานเพื่อสร้างกลุ่มเป้าหมายให้มากขึ้น </p>
                            </div>
                        </div>
                        <hr>
                    </div>


                    <p class="fs-2">แนะนำองค์กร</p>
                    <br>
                    <div class="row">
                        <?php while ($row = mysqli_fetch_assoc($result_4)) { ?>
                            <div class="col-12 col-md-12 col-lg-4">
                                <div class="card text-light text-center bg-white pb-2 " style="width: 25rem; height: auto;">
                                    <div class="card-body text-dark">
                                        <div class="img-area mb-4">
                                            <?php $images = json_decode($row['organization_img'], true);
                                            if (is_array($images)) {
                                                foreach ($images as $image) { ?>
                                                    <div class="mx-auto" style="width: 300px;">
                                                        <?php echo "<img alt='' class='img-thumbnail' src='../user/{$image}'>"; ?>
                                                    </div>
                                                <?php } ?>
                                            <?php } ?>
                                        </div>
                                        <h3 class="card-title"><?php echo $row['organization_name']; ?></h3>
                                        <p class="lead"> <?php echo $row['organization_bio'] ?>
                                        </p>
                                    </div>
                                    <!-- <div class="card-footer bg-transparent border-light">
                                        <a href="fw_detail.php?personal_forward_id=<?php //echo $row['personal_forward_id'] 
                                                                                    ?>" class="btn bg-primary text-white rounded-pill">รายละเอียดเพิ่มเติม</a>
                                    </div> -->
                                </div>
                            </div>
                        <?php } ?>

                        <div class="text-end">
                            <br>

                        </div>
                    </div>
                </section>
            </div>
        </div>
        <!-- <div class="card" style="width: 80rem;"> <!-- เลือกดู 
            <div class="card-body">
                <section class="portfolio section-padding" id="portfolio">
                    <div class="text-center">

                        <div class="row">
                            <div class="col">
                                <a class="text-decoration-none" href="#">
                                    <figure class="figure">
                                        <img alt="" width="50" height="50" src="../image/pngegg.png">
                                    </figure>
                                    <p>วัด</p>
                                </a>
                            </div>
                            <div class="col">
                                <a class="text-decoration-none" href="#">
                                    <figure class="figure">
                                        <img alt="" width="50" height="50" src="../image/deg.png">
                                    </figure>
                                    <p>เด็ก</p>
                                </a>
                            </div>
                            <div class="col">
                                <a class="text-decoration-none" href="#">
                                    <figure class="figure">
                                        <img alt="" width="50" height="50" src="../image/leen.png">
                                    </figure>
                                    <p>การศึกษา</p>
                                </a>
                            </div>
                            <div class="col">
                                <a class="text-decoration-none" href="#">
                                    <figure class="figure">
                                        <img alt="" width="50" height="50" src="../image/yaa.png">
                                    </figure>
                                    <p>โรงพยาบาลและยา</p>
                                </a>
                            </div>
                            <div class="col">
                                <a class="text-decoration-none" href="#">
                                    <figure class="figure">
                                        <img alt="" width="50" height="50" src="../image/gaee.png">
                                    </figure>
                                    <p>ผู้สูงอายุ</p>
                                </a>
                            </div>
                            <div class="col">
                                <a class="text-decoration-none" href="#">
                                    <figure class="figure">
                                        <img alt="" width="50" height="50" src="../image/more.png">
                                    </figure>
                                    <p>อื่นๆ</p>
                                </a>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div> -->
        <br>


        <div class="card" style="width: 80rem;"> <!-- โพสต์ส่งต่อ -->
            <div class="card-body">
                <section class="portfolio section-padding" id="portfolio">
                    <div class="text-center">
                        <div class="row">
                            <div class="text-center">
                                <p class="fs-1"> ส่งต่อสิ่งของ </p>
                                <p class="fs-3"> ใครมีของที่ไม่ใช้สามารถส่งต่อได้ </p>
                            </div>
                        </div>
                        <hr>
                    </div>


                    <p class="fs-2">โพสต์บริจาคของบุคคลทั่วไป</p>
                    <br>
                    <div class="row">
                        <?php while ($row = mysqli_fetch_assoc($result3)) { ?>
                            <div class="col-12 col-md-12 col-lg-4">
                                <div class="card text-light text-center bg-white pb-2" style="width: 25rem; height: auto;">
                                    <div class="card-body text-dark ">

                                        <div id="carouselExample<?php echo $row['personal_forward_id'] ?>" class="carousel slide" data-bs-ride="carousel">
                                            <div class="img-area mb-4">
                                                <div class="carousel-inner">
                                                    <?php $images = json_decode($row['personal_forward_img'], true); ?>
                                                    <?php if (is_array($images) && count($images) > 0) : ?>
                                                        <?php foreach ($images as $index => $image) : ?>
                                                            <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>" style="width: 300px;">
                                                                <?php echo "<img src='../social/{$image}' alt='images' class='d-block w-100' >"; ?>
                                                            </div>
                                                        <?php endforeach; ?>
                                                    <?php else : ?>
                                                        <div class="carousel-item active">
                                                            <img src="placeholder.jpg" class="d-block w-100" alt="Placeholder Image">
                                                        </div>
                                                    <?php endif; ?>

                                                </div>
                                                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample<?php echo $row['personal_forward_id'] ?>" data-bs-slide="prev">
                                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                    <span class="visually-hidden">Previous</span>
                                                </button>
                                                <button class="carousel-control-next" type="button" data-bs-target="#carouselExample<?php echo $row['personal_forward_id'] ?>" data-bs-slide="next">
                                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                    <span class="visually-hidden">Next</span>
                                                </button>
                                            </div>
                                        </div>
                                        <h3 class="card-title"><?php echo $row['personal_forward_name']; ?></h3>
                                        <p class="lead"> <?php echo $row['personal_forward_detail'] ?>
                                        </p>

                                        <div class="card-footer bg-transparent border-light">
                                            <a href="fw_detail.php?personal_forward_id=<?php echo $row['personal_forward_id'] ?>" class="btn bg-primary text-white rounded-pill">รายละเอียดเพิ่มเติม</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>

                        <div class="text-end">
                            <br>
                            <a href="../1page/post_1.php" class="btn btn-outline-info rounded-pill">
                                ดูเพิ่มเติม
                            </a>
                        </div>
                    </div>
                </section>
            </div>
        </div>

        <br>

        <div class="card" style="width: 80rem;"> <!-- โพสต์ส่งองค์กร -->
            <div class="card-body">
                <section class="portfolio section-padding" id="portfolio">
                    <div class="text-center">
                        <div class="row">
                            <div class="text-center">
                                <p class="fs-1"> ส่งต่อสิ่งของ </p>
                                <p class="fs-3"> องค์กรประสงค์ที่จะให้ </p>
                            </div>
                        </div>
                        <hr>
                    </div>
                    <p class="fs-2">โพสต์บริจาคขององค์กร</p>
                    <br>
                    <div class="row">
                        <?php while ($row = mysqli_fetch_assoc($result2)) { ?>
                            <div class="col-12 col-md-12 col-lg-4">
                                <div class="card text-light text-center bg-white pb-2" style="width: 25rem; height: auto;">
                                    <div class="card-body text-dark ">
                                        <div id="carouselExample<?php echo $row['organization_forward_id'] ?>" class="carousel slide" data-bs-ride="carousel">
                                            <!-- Collapsible Image Area -->
                                            <div class="img-area mb-4">
                                                <div class="carousel-inner">


                                                    <?php $images = json_decode($row['organization_forward_img'], true); ?>
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
                                                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample<?php echo $row['organization_forward_id'] ?>" data-bs-slide="prev">
                                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                    <span class="visually-hidden">Previous</span>
                                                </button>
                                                <button class="carousel-control-next" type="button" data-bs-target="#carouselExample<?php echo $row['organization_forward_id'] ?>" data-bs-slide="next">
                                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                    <span class="visually-hidden">Next</span>
                                                </button>
                                            </div>

                                        </div>

                                        <h3 class="card-title"><?php echo htmlspecialchars($row['organization_forward_name']); ?></h3>
                                        <p class="lead"><?php echo htmlspecialchars($row['organization_forward_detail']); ?></p>
                                    </div>
                                    <div class="card-footer bg-transparent border-light">
                                        <a href="fw_detail.php?organization_forward_id=<?php echo htmlspecialchars($row['organization_forward_id']); ?>" class="btn bg-primary text-white rounded-pill">รายละเอียดเพิ่มเติม</a>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>

                        <div class="text-end">
                            <br>
                            <a href="../1page/post_2.php" type="button" class="btn btn-outline-info rounded-pill">
                                ดูเพิ่มเติม
                            </a>
                        </div>
                    </div>
                </section>
            </div>
        </div>

        <br>

        <div class="card" style="width: 80rem;"> <!-- โพสต์ขอองค์กร -->
            <div class="card-body">
                <section class="portfolio section-padding" id="portfolio">

                    <br>
                    <p class="fs-2">โพสต์ขอรับบริจาคขององค์กร</p>
                    <br>
                    <div class="row">
                        <?php while ($row = mysqli_fetch_assoc($result_3)) { ?>
                            <div class="col-12 col-md-12 col-lg-4">
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
                                                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample<?php echo $row['org_rq_id'] ?>" data-bs-slide="prev">
                                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                        <span class="visually-hidden">Previous</span>
                                                    </button>
                                                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExample<?php echo $row['org_rq_id'] ?>" data-bs-slide="next">
                                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                        <span class="visually-hidden">Next</span>
                                                    </button>
                                                </div>

                                            </div>
                                            <h3 class="card-title"><?php echo $row['org_rq_name']; ?></h3>
                                            <p class="lead"> <?php echo $row['org_rq_detail'] ?>
                                            </p>
                                        </div>
                                        <div class="card-footer bg-transparent border-light">
                                            <a href="fw_detail.php?org_rq_id=<?php echo $row['org_rq_id'] ?>" class="btn bg-primary text-white rounded-pill">รายละเอียดเพิ่มเติม</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>

                        <div class="text-end">
                            <br>
                            <a href="../1page/post_3.php" class="btn btn-outline-info rounded-pill">
                                ดูเพิ่มเติม
                            </a>
                        </div>
                    </div>
                </section>
            </div>
        </div>

        <br>
        <hr>
        <br>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>