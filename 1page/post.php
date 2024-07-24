<?php
session_start();
include('../db.php');
include('../db_connect.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: ../1page/login.php");
}

$sql = "SELECT * FROM `tb_personal_forward` ORDER BY personal_forward_time DESC;";
$result = $con->query($sql);

    /*try {
        if($_SERVER['REQUEST_METHOD'] == 'GET' ) {
            $post = new stdClass();

            $stmt = $conn->prepare('SELECT * FROM `tb_personal_forward` ORDER BY personal_forward_time DESC;');

            if($stmt->execute()) {
                $num = $stmt->rowCount();
                if($num > 0) {

                    $post->Result = array();
                    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                        extract($row);


                    }
                }
            }
        } 
    } catch(PDOException $e){
        echo $e->getMessage();
    }*/


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
        
            <div class="card" style="width: 80rem;">
                <div class="text-center">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <a class="text-decoration-none" href="#">
                                    <figure class="figure">
                                        <img alt="" width="100" height="100" src="../image/soung.png">
                                    </figure>
                                    <p>โพสต์บริจาคของบุคคลทั่วไป</p>
                                </a>
                            </div>
                            <div class="col">
                                <a class="text-decoration-none" href="#">
                                    <figure class="figure">
                                        <img alt="" width="100" height="100" src="../image/org_soung.png">
                                    </figure>
                                    <p>โพสต์บริจาคขององค์กร</p>
                                </a>
                            </div>
                            <div class="col">
                                <a class="text-decoration-none" href="#">
                                    <figure class="figure">
                                        <img alt="" width="100" height="100" src="../image/org_rq.png">
                                    </figure>
                                    <p>โพสต์ขอบริจาคขององค์กร</p>
                                </a>
                            </div>
                            <div class="col">
                                <a class="text-decoration-none" href="#">
                                    <figure class="figure">
                                        <img alt="" width="100" height="100" src="../image/share.png">
                                    </figure>
                                    <p>โพสต์ประชาสัมพันธ์</p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>
        </form>
        <!-- about section Ends -->

        <br>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <div class="card" style="width: 80rem;">
                <div class="card-body">
                    <section class="portfolio section-padding" id="portfolio">
                        <div class="text-center">
                            <div class="row">
                                <div class="text-center">
                                    <p class="fs-1"> ส่งต่อสิ่งของ </p><br>
                                    <p class="fs-3"> ใครมีของที่ไม่ใช้สามารถส่งต่อได้ </p>
                                </div>
                            </div>

                            <hr>
                            <br>
                        </div>
                        <br>

                        <p class="fs-2">โครงการที่รับส่งต่อสิ่งของ</p>
                        <br>
                        <div class="row">
                            <div class="col-12 col-md-12 col-lg-4">
                                <div class="card text-light text-center bg-white pb-2 " style="width: 25rem; height: 46rem;">
                                    <div class="card-body text-dark">
                                        <div class="img-area mb-4"><img alt="" class="img-fluid" src="../image/ee.webp">
                                        </div>
                                        <h3 class="card-title"><?php echo $row['personal_forward_name']; ?></h3>
                                        <p class="lead"> <?php echo $row['personal_forward_detail'] ?>
                                        </p>
                                    </div>
                                    <div class="card-footer bg-transparent">
                                        <button class="btn bg-primary text-white rounded-pill">รายละเอียดเพิ่มเติม</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-12 col-lg-4">
                                <div class="card text-light text-center bg-white pb-2" style="width: 25rem; height: 46rem;">
                                    <div class="card-body text-dark">
                                        <div class="img-area mb-4"><img alt="" class="img-fluid" src="../image/k.webp">
                                        </div>
                                        <h3 class="card-title">โรงเรียนอนุกูลนารี</h3>
                                        <p class="lead">โรงเรียนอนุกูลต้องการสิ่งของมามอบให้เด็กขาดแคลน
                                            <hr> -เสื้อผ้า
                                        </p>

                                    </div>
                                    <div class="card-footer bg-transparent">
                                        <button class="btn bg-primary text-white rounded-pill">รายละเอียดเพิ่มเติม</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-12 col-lg-4">
                                <div class="card text-light text-center bg-white pb-2" style="width: 25rem; height: 46rem;">
                                    <div class="card-body text-dark">
                                        <div class="img-area mb-4"><img alt="" class="img-fluid" src="../image/o.webp">
                                        </div>
                                        <h3 class="card-title">สัตว์ป่า</h3>
                                        <p class="lead">รักป่ารักเขา ยามนี้ทุกคนรวมตัวพร้อมสร้างสรรค์สื่อต่างๆ
                                            <hr> -อาหารสัตว์
                                        </p>

                                    </div>
                                    <div class="card-footer bg-transparent">
                                        <a class="btn bg-primary text-white rounded-pill" href="">รายละเอียดเพิ่มเติม</a>
                                    </div>
                                </div>
                            </div>


                            <div class="text-end">
                                <br>
                                <button type="button" class="btn btn-outline-info rounded-pill" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    ดูเพิ่มเติม
                                </button>
                            </div>
                        </div>
                </div>
                </section>
            </div>


            <br>
            <hr>
            <br>

            <!-- END -->

        <?php } ?>





    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>