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
    <title>หน้าแรก</title>
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
            <div class="container">
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
            </div>
        </section>
        </form>
        <!-- about section Ends -->

        <br>
        <div class="card" style="width: 80rem;">
            <div class="card-body">
                <section class="portfolio section-padding" id="portfolio">
                    <div class="text-center">
                        <div class="row">
                            <div class="text-center">
                                <p class="fs-1"> ส่งต่อสิ่งของ </p><br>
                                <p class="fs-3"> บุคคลที่ประสงค์ส่งต่อสิ่งของ </p>
                            </div>
                        </div>

                        <hr>
                        <br>
                        <div class="card card-body">
                            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4">

                                <div class="col-4 col-lg-2"><a class="text-decoration-none" href="#"><img alt="" width="50" height="50" src="../image/yaa.png"></a></div>
                                <div class="col-4 col-lg-2"><a class="text-decoration-none" href="#"><img alt="" width="50" height="50" src="../image/deg.png"></a></div>
                                <div class="col-4 col-lg-2"><a class="text-decoration-none" href=""><img alt="" width="50" height="50" src="../image/gaee.png"></a></div>
                                <div class="col-4 col-lg-2"><a class="text-decoration-none" href="#"><img alt="" width="50" height="50" src="../image/leen.png"></a></div>
                                <div class="col-4 col-lg-2"><a class="text-decoration-none" href="#"><img alt="" width="50" height="50" src="../image/phaa.png"></a></div>
                                <div class="col-4 col-lg-2"><a class="text-decoration-none" href=""><img alt="" width="50" height="50" src="../image/more.png"></a></div>
                            </div>



                        </div>
                    </div>
                    <br>

                    <p class="fs-2">โพสต์ส่งต่อ</p>
                    <br>
                    <div class="row">
                        <div class="col-12 col-md-12 col-lg-4">
                            <div class="card text-light text-center bg-white pb-2 " style="width: 25rem; height: 46rem;">
                                <div class="card-body text-dark">
                                    <div class="img-area mb-4"><img alt="" class="img-fluid" src="../image/ee.webp">
                                    </div>
                                    <h3 class="card-title">วัดใช่มั้ย</h3>
                                    <p class="lead"> วัดนี้เป็นวัดที่ดีและยังต้องการปัจจัยสมทบ
                                        <hr> -ปัจจัย -ประตู -ผ้าป่า
                                    </p><button class="btn bg-primary text-white rounded-pill">รายละเอียดเพิ่มเติม</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-12 col-lg-4">
                            <div class="card text-light text-center bg-white pb-2 " style="width: 25rem; height: 46rem;">
                                <div class="card-body text-dark">
                                    <div class="img-area mb-4"><img alt="" class="img-fluid" src="../image/ee.webp">
                                    </div>
                                    <h3 class="card-title">วัดเขียวเหนี่ยวทรัพย์</h3>
                                    <p class="lead">วัดนี้เป็นวัดที่ดีและยังต้องการปัจจัยสมทบมากมาย
                                        <hr> -ไม้กวาด -ประตู -ผ้าป่า
                                    </p><button class="btn bg-primary text-white rounded-pill">รายละเอียดเพิ่มเติม</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-12 col-lg-4">
                            <div class="card text-light text-center bg-white pb-2 " style="width: 25rem; height: 46rem;">
                                <div class="card-body text-dark">
                                    <div class="img-area mb-4">
                                        <img alt="" class="img-fluid" src="../image/ee.webp">
                                    </div>
                                    <h3 class="card-title">วัดอโยธยา</h3>
                                    <p class="lead">วัดนี้เป็นวัดที่ดีและยังต้องการสนับสนุนการสร้างเยอะ
                                        <hr> -ปูน -ประตู -ผ้าป่า -กระเบื้อง
                                    </p><button class="btn bg-primary text-white rounded-pill">รายละเอียดเพิ่มเติม</button>
                                </div>
                            </div>
                            <br>
                            <div class="text-end">
                                <button type="button" class="btn btn-outline-info rounded-pill" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    ดูเพิ่มเติม
                                </button>
                            </div>

                        </div>
                    </div>
                </section>
            </div>
        </div>


        <br>
        <hr>
        <br>

        <div class="container">
            <div class="card" style="width: 80rem;">
                <div class="card-body">
                    <section class="portfolio section-padding" id="portfolio">
                        <div class="text-center">
                            <div class="row">
                                <div class="text-center">
                                    <p class="fs-1"> โครงการที่เข้าร่วม </p><br>
                                    <p class="fs-3"> มีโครงการน่าสนใจหลายอย่าง </p>
                                </div>
                            </div>

                            <hr>
                            <br>
                            <div class="card card-body">
                                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4">
                                    <div class="col-4 col-lg-2"><a class="text-decoration-none" href="#"><img alt="" width="50" height="50" src="../image/pngegg.png"></a></div>
                                    <div class="col-4 col-lg-2"><a class="text-decoration-none" href="#"><img alt="" width="50" height="50" src="../image/deg.png"></a></div>
                                    <div class="col-4 col-lg-2"><a class="text-decoration-none" href="#"><img alt="" width="50" height="50" src="../image/leen.png"></a></div>
                                    <div class="col-4 col-lg-2"><a class="text-decoration-none" href="#"><img alt="" width="50" height="50" src="../image/yaa.png"></a></div>
                                    <div class="col-4 col-lg-2"><a class="text-decoration-none" href=""><img alt="" width="50" height="50" src="../image/gaee.png"></a></div>
                                    <div class="col-4 col-lg-2"><a class="text-decoration-none" href=""><img alt="" width="50" height="50" src="../image/more.png"></a></div>
                                </div>
                            </div>
                        </div>
                        <br>

                        <p class="fs-2">โครงการ</p>
                        <br>
                        <div class="row">
                            <div class="col-12 col-md-12 col-lg-4">
                                <div class="card text-light text-center bg-white pb-2 " style="width: 25rem; height: 46rem;">
                                    <div class="card-body text-dark">
                                        <div class="img-area mb-4"><img alt="" class="img-fluid" src="../image/ee.webp">
                                        </div>
                                        <h3 class="card-title">วัดใช่มั้ย</h3>
                                        <p class="lead"> วัดนี้เป็นวัดที่ดีและยังต้องการปัจจัยสมทบ
                                            <hr> -ปัจจัย -ประตู -ผ้าป่า
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
                                        <div class="img-area mb-4"><img alt="" class="img-fluid" src="../image/ee.webp">
                                        </div>
                                        <h3 class="card-title">วัดเขียวเหนี่ยวทรัพย์</h3>
                                        <p class="lead">วัดนี้เป็นวัดที่ดีและยังต้องการปัจจัยสมทบมากมาย
                                            <hr> -ไม้กวาด -ประตู -ผ้าป่า
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
                                        <div class="img-area mb-4">
                                            <img alt="" class="img-fluid" src="../image/ee.webp">
                                        </div>
                                        <h3 class="card-title">วัดอโยธยา</h3>
                                        <p class="lead">วัดนี้เป็นวัดที่ดีและยังต้องการสนับสนุนการสร้างเยอะ
                                            <hr> -ปูน -ประตู -ผ้าป่า -กระเบื้อง
                                        </p>
                                    </div>
                                    <div class="card-footer bg-transparent">
                                        <button class="btn bg-primary text-white rounded-pill">รายละเอียดเพิ่มเติม</button>
                                    </div>
                                </div>
                                <br>
                                <div class="text-end">
                                    <button type="button" class="btn btn-outline-info rounded-pill" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        ดูเพิ่มเติม
                                    </button>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>


            <br>
            <hr>
            <br>


            <div class="card" style="width: 80rem;">
                <div class="card-body">
                    <section class="portfolio section-padding" id="portfolio">
                        <div class="text-center">
                            <div class="row">
                                <div class="text-center">
                                    <p class="fs-1"> องค์กรขอรับการส่งต่อ </p><br>
                                    <p class="fs-4"> องค์กรระดับทุนช่วยเหลือผู้ยากไร้ </p>
                                </div>
                            </div>

                            <hr>
                            <br>
                            <div class="card card-body">
                                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4">

                                    <div class="col-4 col-lg-2"><a class="text-decoration-none" href="#"><img alt="" width="50" height="50" src="../image/yaa.png"></a></div>
                                    <div class="col-4 col-lg-2"><a class="text-decoration-none" href="#"><img alt="" width="50" height="50" src="../image/deg.png"></a></div>
                                    <div class="col-4 col-lg-2"><a class="text-decoration-none" href=""><img alt="" width="50" height="50" src="../image/gaee.png"></a></div>
                                    <div class="col-4 col-lg-2"><a class="text-decoration-none" href="#"><img alt="" width="50" height="50" src="../image/leen.png"></a></div>
                                    <div class="col-4 col-lg-2"><a class="text-decoration-none" href="#"><img alt="" width="50" height="50" src="../image/phaa.png"></a></div>
                                    <div class="col-4 col-lg-2"><a class="text-decoration-none" href=""><img alt="" width="50" height="50" src="../image/more.png"></a></div>
                                </div>



                            </div>
                        </div>
                        <br>

                        <p class="fs-2">โพสต์ขอรับบริจาค</p>
                        <br>
                        <div class="row">
                            <div class="col-12 col-md-12 col-lg-4">
                                <div class="card text-light text-center bg-white pb-2 " style="width: 25rem; height: 46rem;"">
                                    <div class=" card-body text-dark">
                                    <div class="img-area mb-4"><img alt="" class="img-fluid" src="../image/ee.webp">
                                    </div>
                                    <h3 class="card-title">วัดใช่มั้ย</h3>
                                    <p class="lead"> วัดนี้เป็นวัดที่ดีและยังต้องการปัจจัยสมทบ
                                        <hr> -ปัจจัย -ประตู -ผ้าป่า
                                    </p>
                                </div>
                                <div class="card-footer bg-transparent">
                                    <button class="btn bg-primary text-white rounded-pill">รายละเอียดเพิ่มเติม</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-12 col-lg-4">
                            <div class="card text-light text-center bg-white pb-2 " style="width: 25rem; height: 46rem;">
                                <div class="card-body text-dark">
                                    <div class="img-area mb-4"><img alt="" class="img-fluid" src="../image/ee.webp">
                                    </div>
                                    <h3 class="card-title">วัดเขียวเหนี่ยวทรัพย์</h3>
                                    <p class="lead">วัดนี้เป็นวัดที่ดีและยังต้องการปัจจัยสมทบมากมาย
                                        <hr> -ไม้กวาด -ประตู -ผ้าป่า
                                    </p>
                                </div>
                                <div class="card-footer bg-transparent">
                                    <button class="btn bg-primary text-white rounded-pill">รายละเอียดเพิ่มเติม</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-12 col-lg-4">
                            <div class="card text-light text-center bg-white pb-2 " style="width: 25rem; height: 46rem;">
                                <div class="card-body text-dark">
                                    <div class="img-area mb-4">
                                        <img alt="" class="img-fluid" src="../image/ee.webp">
                                    </div>
                                    <h3 class="card-title">วัดอโยธยา</h3>
                                    <p class="lead">วัดนี้เป็นวัดที่ดีและยังต้องการสนับสนุนการสร้างเยอะ
                                        <hr> -ปูน -ประตู -ผ้าป่า -กระเบื้อง
                                    </p>
                                </div>
                                <div class="card-footer bg-transparent">
                                    <button class="btn bg-primary text-white rounded-pill">รายละเอียดเพิ่มเติม</button>
                                </div>
                            </div>
                            <br>
                            <div class="text-end">
                                <button type="button" class="btn btn-outline-info rounded-pill" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    ดูเพิ่มเติม
                                </button>
                            </div>

                        </div>
                </div>
                </section>
            </div>
        </div>


        <br>
        <hr>
        <br>


        <div class="card" style="width: 80rem;">
            <div class="card-body">
                <section class="portfolio section-padding" id="portfolio">
                    <div class="text-center">
                        <div class="row">
                            <div class="text-center">
                                <p class="fs-1"> ประชาสัมพันธ์ </p><br>
                                <p class="fs-4"> แจ้งข่าวสารการบริจาคขององค์กรนั้นๆ </p>
                            </div>
                        </div>

                        <hr>
                        <br>

                    </div>
                    <br>

                    <p class="fs-2">โพสต์ข่าวสาร ข้อมูลต่างๆ</p>
                    <br>
                    <div class="row">
                        <div class="col-12 col-md-12 col-lg-4">
                            <div class="card text-light text-center bg-white pb-2 " style="width: 25rem; height: 46rem;">
                                <div class="card-body text-dark">
                                    <div class="img-area mb-4"><img alt="" class="img-fluid" src="../image/ee.webp">
                                    </div>
                                    <h3 class="card-title">วัดใช่มั้ย</h3>
                                    <p class="lead"> วัดนี้เป็นวัดที่ดีและยังต้องการปัจจัยสมทบ
                                        <hr> -ปัจจัย -ประตู -ผ้าป่า
                                    </p>
                                </div>
                                <div class="card-footer bg-transparent">
                                    <button class="btn bg-primary text-white rounded-pill">รายละเอียดเพิ่มเติม</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-12 col-lg-4">
                            <div class="card text-light text-center bg-white pb-2 " style="width: 25rem; height: 46rem;">
                                <div class="card-body text-dark">
                                    <div class="img-area mb-4"><img alt="" class="img-fluid" src="../image/ee.webp">
                                    </div>
                                    <h3 class="card-title">วัดเขียวเหนี่ยวทรัพย์</h3>
                                    <p class="lead">วัดนี้เป็นวัดที่ดีและยังต้องการปัจจัยสมทบมากมาย
                                        <hr> -ไม้กวาด -ประตู -ผ้าป่า
                                    </p>
                                </div>
                                <div class="card-footer bg-transparent">
                                    <button class="btn bg-primary text-white rounded-pill">รายละเอียดเพิ่มเติม</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-12 col-lg-4">
                            <div class="card text-light text-center bg-white pb-2 " style="width: 25rem; height: 46rem;">
                                <div class="card-body text-dark">
                                    <div class="img-area mb-4">
                                        <img alt="" class="img-fluid" src="../image/ee.webp">
                                    </div>
                                    <h3 class="card-title">วัดอโยธยา</h3>
                                    <p class="lead">วัดนี้เป็นวัดที่ดีและยังต้องการสนับสนุนการสร้างเยอะ
                                        <hr> -ปูน -ประตู -ผ้าป่า -กระเบื้อง
                                    </p>
                                </div>
                                <div class="card-footer bg-transparent">
                                    <button class="btn bg-primary text-white rounded-pill">รายละเอียดเพิ่มเติม</button>
                                </div>
                            </div>
                            <br>
                            <div class="text-end">
                                <button type="button" class="btn btn-outline-info rounded-pill" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    ดูเพิ่มเติม
                                </button>
                            </div>

                        </div>
                    </div>
                </section>
            </div>
        </div>


        <br>
        <hr>
        <br>







    </div>
    </div>

    <!-- PORTFOLIO END-->
    <br>


    <!-- END -->
    <div class="container">

        <footer class="py-3 my-4">
            <ul class="nav justify-content-center border-bottom pb-3 mb-3">
                <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">FORWARD </a></li>
                <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary"> 088-8888888</a></li>
                <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">ข่าวสาร</a></li>
                <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">สอบถาม</a></li>
                <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">เกี่ยวกับ</a></li>
            </ul>
            <p class="text-center text-body-secondary"> FORWARD 2024 NSC, TH</p>
        </footer>

    </div>





    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>