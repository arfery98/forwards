<?php
session_start();
require('../db.php');
require('../db_connect.php');
if (!isset($_SESSION['user_id'])) {
    header("Location: ../1page/login.php");
}

if (isset($_GET['personal_forward_id'])) {
    $personal_forward_id = $_GET['personal_forward_id'];
    //$sql = "SELECT tb_users.user_name,tb_users.user_lastname,tb_users.user_phone,tb_users.user_email,tb_personal_forward.personal_forward_name,tb_personal_forward.personal_forward_detail,tb_personal_forward.personal_forward_img,tb_personal_forward.personal_forward_catagories_id,tb_personal_forward.personal_forward_time FROM tb_users,tb_personal_forward WHERE tb_users.user_id = tb_personal_forward.personal_forward_user ;";
    $sql = "SELECT tb_personal_forward.*,tb_users.user_name,tb_users.user_lastname,tb_users.user_email,tb_users.user_phone FROM tb_personal_forward LEFT JOIN tb_users ON tb_personal_forward.personal_forward_user = tb_users.user_id WHERE tb_personal_forward.personal_forward_id = '$personal_forward_id'";
    $result1 = $con->query($sql);
}
if (isset($_GET['organization_forward_id'])) {
    $organization_forward_id = $_GET['organization_forward_id'];
    $sql = "SELECT tb_organization_forwards.*,tb_organization.organization_name,tb_organization.organization_email,tb_organization.organization_phone FROM tb_organization_forwards LEFT JOIN tb_organization ON tb_organization_forwards.organization_forward_id = tb_organization.organization_email WHERE tb_organization_forwards.organization_forward_id = '$organization_forward_id'";
    $result2 = $con->query($sql);
}

if (isset($_GET['org_rq_id'])) {
    $org_rq_id = $_GET['org_rq_id'];
    $sql = "SELECT tb_org_rq.*,tb_organization.organization_name,tb_organization.organization_email,tb_organization.organization_phone FROM tb_org_rq  LEFT JOIN tb_organization ON tb_org_rq.org_rq_id = tb_organization.organization_email  WHERE tb_org_rq.org_rq_id = '$org_rq_id'";
    $result3 = $con->query($sql);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <title>ข้อมูลการบริจาค</title>
    <link rel="stylesheet" href="../font.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css" />
    <?php if (isset($_SESSION['organization_name'])) {

        include('../org_header.php');
    } else {
        include('../header.php');
    } ?>
</head>

<body < style="background-color: #dfeefa;">
    <div class="container">
        <br>
        <div class="card" style="width: auto;">
            <div class="card-body">
                <?php if (isset($_GET['personal_forward_id'])) { ?>
                    <?php while ($row = mysqli_fetch_assoc($result1)) { ?>



                        <div class="row">

                            <div id="carouselExample" class="carousel slide">
                                <?php $images = json_decode($row['personal_forward_img'], true);
                                //if (is_array($images)) { 
                                ?>


                                <div class="carousel-inner">
                                    <?php if (is_array($images) && count($images) > 0) : ?>
                                        <?php foreach ($images as $index => $image) : ?>
                                            <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>">
                                                <?php echo "<img src='../social/{$image}' class='d-block w-100' alt='images'>"; ?>

                                            </div>
                                        <?php endforeach; ?>
                                    <?php else : ?>
                                        <div class="carousel-item">
                                            <img src="placeholder.jpg" class="d-block w-100" alt="Placeholder Image">

                                        </div>
                                    <?php endif; ?>
                                </div>

                                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>

                            </div>
                            <br>

                        </div>

                        <hr>

                        <p class="fs-1"><?php echo $row["personal_forward_name"] ?></p>
                        <p class="text-break"><?php echo $row["personal_forward_detail"] ?></p>
                        <br>
                        <p> <?= htmlspecialchars($_SESSION['user_name'])  ?> &nbsp; <?= htmlspecialchars($_SESSION['user_lastname'])  ?> </p>
                        <br>

                        วันที่บริจาค : <span id=""><?php echo $row["personal_forward_time"] ?></span>

                        <br>
                        การติดต่อ : <a href="<?php echo $row["personal_forward_ib"] ?>" target="_blank"><span class="badge rounded-pill bg-info text-dark" id="">คลิ๊ก</span></a>

                        <script>
                            /* let today = new Date().toISOString().slice(0, 10);
                            document.getElementById("date").innerHTML = today; */
                        </script>
                        <br>
                        <div class="margin-top-20 margin-bottom-20">
                            <br>
                            <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIyNy4zMzgiIGhlaWdodD0iMjcuMzkxIiB2aWV3Qm94PSIwIDAgMjcuMzM4IDI3LjM5MSI+PGRlZnM+PHN0eWxlPi5he2ZpbGw6IzAwNTZmZjtmaWxsLXJ1bGU6ZXZlbm9kZDt9PC9zdHlsZT48L2RlZnM+PGcgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoMCAwKSI+PHBhdGggY2xhc3M9ImEiIGQ9Ik02MC41Niw1NS4wMmwtNC4zMTQtNC4yMTFhMS40ODksMS40ODksMCwwLDAtMi4xNTcsMGwtMi43NzMsMi43NzNBNDcuNzg2LDQ3Ljc4NiwwLDAsMSw0MC44MzgsNDMuMjA3bDIuODc2LTIuNzczYTEuNjEyLDEuNjEyLDAsMCwwLDAtMi4yNkwzOS40LDMzLjk2MmExLjQ4OCwxLjQ4OCwwLDAsMC0yLjE1NywwbC0yLjI2LDIuMjYtLjgyMi44MjJjLTQuNDE3LDQuMzE0LDE4LjksMjcuNjMxLDIzLjIxNCwyMy4zMTdsLjgyMi0uODIyLDIuMzYzLTIuMjZBMS44NSwxLjg1LDAsMCwwLDYwLjU2LDU1LjAyWiIgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoLTMzLjYwNyAtMzMuNSkiLz48L2c+PC9zdmc+" alt="pun-boon-contact-icon" class="icon">
                            <p class="text-break"><?= htmlspecialchars($_SESSION['user_phone'])  ?></p>

                            <div class="icon-with-text">
                                <div class="ant-row center-row" style="margin-left: -7.5px; margin-right: -7.5px;">
                                    <div class="ant-col gutter-row icon-wrapper ant-col-xs-2 ant-col-sm-2 ant-col-md-1 ant-col-lg-1 ant-col-xl-1" style="padding-left: 7.5px; padding-right: 7.5px;"><img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIyNy40MzMiIGhlaWdodD0iMTcuODMxIiB2aWV3Qm94PSIwIDAgMjcuNDMzIDE3LjgzMSI+PGRlZnM+PHN0eWxlPi5he2ZpbGw6IzAwNTZmZjt9PC9zdHlsZT48L2RlZnM+PGcgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoMCAwKSI+PGcgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoMCAwKSI+PHBhdGggY2xhc3M9ImEiIGQ9Ik0xMi4wNTcsOTc2LjM2MmEyLjA1NywyLjA1NywwLDAsMC0uNzYxLjE1bDExLjYzNywxMC4xNjlhMS4wNjgsMS4wNjgsMCwwLDAsMS41NDMsMGwxMS42NTktMTAuMTY5YTIuMDU3LDIuMDU3LDAsMCwwLS43NjEtLjE1Wm0tMi4wMzYsMS43NjhhMi4xMjUsMi4xMjUsMCwwLDAtLjAyMS4yODl2MTMuNzE2YTIuMDUzLDIuMDUzLDAsMCwwLDIuMDU3LDIuMDU4SDM1LjM3NWEyLjA1MywyLjA1MywwLDAsMCwyLjA1Ny0yLjA1OFY5NzguNDE5YTIuMTI4LDIuMTI4LDAsMCwwLS4wMjEtLjI4OUwyNS44MjcsOTg4LjIzNWEzLjI0LDMuMjQsMCwwLDEtNC4yNDMsMFoiIHRyYW5zZm9ybT0idHJhbnNsYXRlKC0xMCAtOTc2LjM2MikiLz48L2c+PC9nPjwvc3ZnPg==" alt="pun-boon-contact-icon" class="icon">
                                        <p class="text-break"> <?= htmlspecialchars($_SESSION['user_email'])  ?> </p>
                                    </div>
                                </div>
                            </div>

                            <div class="icon-with-text">
                                <div class="ant-row center-row" style="margin-left: -7.5px; margin-right: -7.5px;">
                                    <div class="ant-col gutter-row icon-wrapper ant-col-xs-2 ant-col-sm-2 ant-col-md-1 ant-col-lg-1 ant-col-xl-1" style="padding-left: 7.5px; padding-right: 7.5px;"><img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxNy45OCIgaGVpZ2h0PSIyNi44NSIgdmlld0JveD0iMCAwIDE3Ljk4IDI2Ljg1Ij48ZGVmcz48c3R5bGU+LmF7ZmlsbDojMDA1NmZmO2ZpbGwtcnVsZTpldmVub2RkO308L3N0eWxlPjwvZGVmcz48ZyB0cmFuc2Zvcm09InRyYW5zbGF0ZSgwIDApIj48cGF0aCBjbGFzcz0iYSIgZD0iTTguOTksMGE4Ljk5LDguOTksMCwwLDEsOC45OSw4Ljk5YzAsMy41MS00LjkxOCwxMi4wNDYtNy44LDE3LjE2NmExLjM2OCwxLjM2OCwwLDAsMS0yLjM4LDBDNC45MTgsMjEuMDM2LDAsMTIuNSwwLDguOTlBOC45OSw4Ljk5LDAsMCwxLDguOTksMFptMCw1LjU0QTMuNDUxLDMuNDUxLDAsMSwxLDUuNTQsOC45OSwzLjQ1MSwzLjQ1MSwwLDAsMSw4Ljk5LDUuNTRaIiB0cmFuc2Zvcm09InRyYW5zbGF0ZSgwIDApIi8+PC9nPjwvc3ZnPg==" alt="pun-boon-contact-icon" class="icon"></div>
                                    <p class="text-break"> บ้านเลขที่ <?php echo $row["personal_forward_ad_no"] ?> &nbsp;
                                        <?php echo $row["personal_forward_ad_village"] ?> &nbsp;
                                        <?php echo $row["personal_forward_ad_groubs"] ?> &nbsp;
                                        <?php echo $row["personal_forward_ad_buildings"] ?> &nbsp;
                                        <?php echo $row["personal_forward_ad_alleys"] ?> &nbsp;
                                        <?php echo $row["personal_forward_ad_roads"] ?> &nbsp;
                                        <?php echo $row["personal_forward_ad_provinces"] ?> &nbsp;
                                        <?php echo $row["personal_forward_ad_amphures"] ?> &nbsp;
                                        <?php echo $row["personal_forward_ad_zipcode"] ?> &nbsp; </p>
                                </div>
                            </div>
                        </div>
                        <hr>

                        <?php if (isset($_SESSION['organization_name'])) { ?>
                            <center>
                                <button type="button" class="btn btn-outline-success rounded-pill" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">ขอรับสิ่งของ</button>
                            </center>
                        <?php }  ?>

                    <?php  } ?>
                <?php } ?>

                <?php if (isset($_GET['organization_forward_id'])) { ?>
                    <?php while ($row = mysqli_fetch_assoc($result2)) { ?>
                        <br>
                        <div class="row">
                            <?php $images = json_decode($row['organization_forward_img'], true);  ?>
                            <div id="carouselExample" class="carousel slide">
                                <div class="carousel-inner">
                                    <?php if (is_array($images) && count($images) > 0) : ?>
                                        <?php foreach ($images as $index => $image) : ?>
                                            <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>">
                                                <?php echo "<img src='../social/{$image}' class='d-block w-100' alt='images'>"; ?>

                                            </div>
                                        <?php endforeach; ?>
                                    <?php else : ?>
                                        <div class="carousel-item active">
                                            <img src="placeholder.jpg" class="d-block w-100" alt="Placeholder Image">
                                            <!-- <?php //echo "<img src='../social/{$image}' class='d-block w-100' alt='images'>";
                                                    /* echo "<img src='../social/{$image}' class='d-block w-100' alt='images'>"; */ ?> -->

                                        </div>
                                    <?php endif; ?>
                                </div>
                                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                            <br>
                        </div>
                        <hr>

                        <p class="fs-1"><?php echo $row["organization_forward_name"] ?></p>
                        <p class="text-break"><?php echo $row["organization_forward_detail"] ?></p>
                        <br>
                        <p> <?= htmlspecialchars($_SESSION['organization_name'])  ?> </p>
                        <br>

                        วันที่บริจาค :<span id=""><?php echo $row["organization_forward_time"] ?></span>

                        <br>
                        การติดต่อ : <a href="<?php echo $row["organization_forward_ib"] ?>" target="_blank"><span class="badge rounded-pill bg-info text-dark" id="">คลิ๊ก</span></a>

                        <script>
                            /* let today = new Date().toISOString().slice(0, 10);
                            document.getElementById("date").innerHTML = today; */
                        </script>
                        <br>
                        <div class="margin-top-20 margin-bottom-20">
                            <br>
                            <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIyNy4zMzgiIGhlaWdodD0iMjcuMzkxIiB2aWV3Qm94PSIwIDAgMjcuMzM4IDI3LjM5MSI+PGRlZnM+PHN0eWxlPi5he2ZpbGw6IzAwNTZmZjtmaWxsLXJ1bGU6ZXZlbm9kZDt9PC9zdHlsZT48L2RlZnM+PGcgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoMCAwKSI+PHBhdGggY2xhc3M9ImEiIGQ9Ik02MC41Niw1NS4wMmwtNC4zMTQtNC4yMTFhMS40ODksMS40ODksMCwwLDAtMi4xNTcsMGwtMi43NzMsMi43NzNBNDcuNzg2LDQ3Ljc4NiwwLDAsMSw0MC44MzgsNDMuMjA3bDIuODc2LTIuNzczYTEuNjEyLDEuNjEyLDAsMCwwLDAtMi4yNkwzOS40LDMzLjk2MmExLjQ4OCwxLjQ4OCwwLDAsMC0yLjE1NywwbC0yLjI2LDIuMjYtLjgyMi44MjJjLTQuNDE3LDQuMzE0LDE4LjksMjcuNjMxLDIzLjIxNCwyMy4zMTdsLjgyMi0uODIyLDIuMzYzLTIuMjZBMS44NSwxLjg1LDAsMCwwLDYwLjU2LDU1LjAyWiIgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoLTMzLjYwNyAtMzMuNSkiLz48L2c+PC9zdmc+" alt="pun-boon-contact-icon" class="icon">
                            <p class="text-break"><?= htmlspecialchars($_SESSION['organization_phone']) ?></p>

                            <div class="icon-with-text">
                                <div class="ant-row center-row" style="margin-left: -7.5px; margin-right: -7.5px;">
                                    <div class="ant-col gutter-row icon-wrapper ant-col-xs-2 ant-col-sm-2 ant-col-md-1 ant-col-lg-1 ant-col-xl-1" style="padding-left: 7.5px; padding-right: 7.5px;"><img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIyNy40MzMiIGhlaWdodD0iMTcuODMxIiB2aWV3Qm94PSIwIDAgMjcuNDMzIDE3LjgzMSI+PGRlZnM+PHN0eWxlPi5he2ZpbGw6IzAwNTZmZjt9PC9zdHlsZT48L2RlZnM+PGcgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoMCAwKSI+PGcgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoMCAwKSI+PHBhdGggY2xhc3M9ImEiIGQ9Ik0xMi4wNTcsOTc2LjM2MmEyLjA1NywyLjA1NywwLDAsMC0uNzYxLjE1bDExLjYzNywxMC4xNjlhMS4wNjgsMS4wNjgsMCwwLDAsMS41NDMsMGwxMS42NTktMTAuMTY5YTIuMDU3LDIuMDU3LDAsMCwwLS43NjEtLjE1Wm0tMi4wMzYsMS43NjhhMi4xMjUsMi4xMjUsMCwwLDAtLjAyMS4yODl2MTMuNzE2YTIuMDUzLDIuMDUzLDAsMCwwLDIuMDU3LDIuMDU4SDM1LjM3NWEyLjA1MywyLjA1MywwLDAsMCwyLjA1Ny0yLjA1OFY5NzguNDE5YTIuMTI4LDIuMTI4LDAsMCwwLS4wMjEtLjI4OUwyNS44MjcsOTg4LjIzNWEzLjI0LDMuMjQsMCwwLDEtNC4yNDMsMFoiIHRyYW5zZm9ybT0idHJhbnNsYXRlKC0xMCAtOTc2LjM2MikiLz48L2c+PC9nPjwvc3ZnPg==" alt="pun-boon-contact-icon" class="icon">
                                        <p class="text-break"> <?= htmlspecialchars($_SESSION['organization_email']) ?> </p>
                                    </div>
                                </div>
                            </div>

                            <div class="icon-with-text">
                                <div class="ant-row center-row" style="margin-left: -7.5px; margin-right: -7.5px;">
                                    <div class="ant-col gutter-row icon-wrapper ant-col-xs-2 ant-col-sm-2 ant-col-md-1 ant-col-lg-1 ant-col-xl-1" style="padding-left: 7.5px; padding-right: 7.5px;"><img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxNy45OCIgaGVpZ2h0PSIyNi44NSIgdmlld0JveD0iMCAwIDE3Ljk4IDI2Ljg1Ij48ZGVmcz48c3R5bGU+LmF7ZmlsbDojMDA1NmZmO2ZpbGwtcnVsZTpldmVub2RkO308L3N0eWxlPjwvZGVmcz48ZyB0cmFuc2Zvcm09InRyYW5zbGF0ZSgwIDApIj48cGF0aCBjbGFzcz0iYSIgZD0iTTguOTksMGE4Ljk5LDguOTksMCwwLDEsOC45OSw4Ljk5YzAsMy41MS00LjkxOCwxMi4wNDYtNy44LDE3LjE2NmExLjM2OCwxLjM2OCwwLDAsMS0yLjM4LDBDNC45MTgsMjEuMDM2LDAsMTIuNSwwLDguOTlBOC45OSw4Ljk5LDAsMCwxLDguOTksMFptMCw1LjU0QTMuNDUxLDMuNDUxLDAsMSwxLDUuNTQsOC45OSwzLjQ1MSwzLjQ1MSwwLDAsMSw4Ljk5LDUuNTRaIiB0cmFuc2Zvcm09InRyYW5zbGF0ZSgwIDApIi8+PC9nPjwvc3ZnPg==" alt="pun-boon-contact-icon" class="icon"></div>
                                    <p class="text-break"> ที่อยู่ <?php echo $row["organization_forward_ad_no"] ?> &nbsp;
                                        <?php echo $row["organization_forward_ad_no"] ?> &nbsp;
                                        <?php echo $row["organization_forward_ad_village"] ?> &nbsp;
                                        <?php echo $row["organization_forward_ad_groubs"] ?> &nbsp;
                                        <?php echo $row["organization_forward_ad_buildings"] ?> &nbsp;
                                        <?php echo $row["organization_forward_ad_alleys"] ?> &nbsp;
                                        <?php echo $row["organization_forward_ad_roads"] ?> &nbsp;
                                        <?php echo $row["organization_forward_ad_provinces"] ?> &nbsp;
                                        <?php echo $row["organization_forward_ad_amphures"] ?> &nbsp;
                                        <?php echo $row["organization_forward_ad_districts"] ?> &nbsp;
                                        <?php echo $row["organization_forward_ad_zipcode"] ?> &nbsp;
                                    </p>
                                </div>
                            </div>
                        </div>
                        <hr>

                        <?php if (isset($_SESSION['organization_name'])) { ?>
                            <center>
                                <button type="button" class="btn btn-outline-success rounded-pill" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">ขอรับสิ่งของ</button>
                            </center>
                        <?php }  ?>

                    <?php  } ?>
                <?php } ?>

                <?php if (isset($_GET['org_rq_id'])) { ?>
                    <?php while ($row = mysqli_fetch_assoc($result3)) { ?>
                        <br>
                        <div class="row">
                            <?php $images = json_decode($row['org_rq_img'], true);  ?>
                            <div id="carouselExample" class="carousel slide">
                                <div class="carousel-inner">
                                    <?php if (is_array($images) && count($images) > 0) : ?>
                                        <?php foreach ($images as $index => $image) : ?>
                                            <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>">
                                                <?php echo "<img src='../social/{$image}' class='d-block w-100' alt='images'>"; ?>

                                            </div>
                                        <?php endforeach; ?>
                                    <?php else : ?>
                                        <div class="carousel-item active">
                                            <img src="placeholder.jpg" class="d-block w-100" alt="Placeholder Image">
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>


                            </div>
                            <br>

                        </div>
                        <hr>

                        <p class="fs-1"><?php echo $row["org_rq_name"] ?></p>
                        <p class="text-break"><?php echo $row["org_rq_detail"] ?></p>
                        <br>
                        <p>
                            <?= htmlspecialchars($_SESSION['organization_name']) ?> &nbsp; </p>
                        <br>

                        วันที่บริจาค :<span id=""><?php echo $row["org_rq_time"] ?></span>

                        <br>
                        <div class="margin-top-20 margin-bottom-20">
                            <br>
                            <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIyNy4zMzgiIGhlaWdodD0iMjcuMzkxIiB2aWV3Qm94PSIwIDAgMjcuMzM4IDI3LjM5MSI+PGRlZnM+PHN0eWxlPi5he2ZpbGw6IzAwNTZmZjtmaWxsLXJ1bGU6ZXZlbm9kZDt9PC9zdHlsZT48L2RlZnM+PGcgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoMCAwKSI+PHBhdGggY2xhc3M9ImEiIGQ9Ik02MC41Niw1NS4wMmwtNC4zMTQtNC4yMTFhMS40ODksMS40ODksMCwwLDAtMi4xNTcsMGwtMi43NzMsMi43NzNBNDcuNzg2LDQ3Ljc4NiwwLDAsMSw0MC44MzgsNDMuMjA3bDIuODc2LTIuNzczYTEuNjEyLDEuNjEyLDAsMCwwLDAtMi4yNkwzOS40LDMzLjk2MmExLjQ4OCwxLjQ4OCwwLDAsMC0yLjE1NywwbC0yLjI2LDIuMjYtLjgyMi44MjJjLTQuNDE3LDQuMzE0LDE4LjksMjcuNjMxLDIzLjIxNCwyMy4zMTdsLjgyMi0uODIyLDIuMzYzLTIuMjZBMS44NSwxLjg1LDAsMCwwLDYwLjU2LDU1LjAyWiIgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoLTMzLjYwNyAtMzMuNSkiLz48L2c+PC9zdmc+" alt="pun-boon-contact-icon" class="icon">
                            <p class="text-break"><?= htmlspecialchars($_SESSION['organization_phone']) ?></p>

                            <div class="icon-with-text">
                                <div class="ant-row center-row" style="margin-left: -7.5px; margin-right: -7.5px;">
                                    <div class="ant-col gutter-row icon-wrapper ant-col-xs-2 ant-col-sm-2 ant-col-md-1 ant-col-lg-1 ant-col-xl-1" style="padding-left: 7.5px; padding-right: 7.5px;"><img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIyNy40MzMiIGhlaWdodD0iMTcuODMxIiB2aWV3Qm94PSIwIDAgMjcuNDMzIDE3LjgzMSI+PGRlZnM+PHN0eWxlPi5he2ZpbGw6IzAwNTZmZjt9PC9zdHlsZT48L2RlZnM+PGcgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoMCAwKSI+PGcgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoMCAwKSI+PHBhdGggY2xhc3M9ImEiIGQ9Ik0xMi4wNTcsOTc2LjM2MmEyLjA1NywyLjA1NywwLDAsMC0uNzYxLjE1bDExLjYzNywxMC4xNjlhMS4wNjgsMS4wNjgsMCwwLDAsMS41NDMsMGwxMS42NTktMTAuMTY5YTIuMDU3LDIuMDU3LDAsMCwwLS43NjEtLjE1Wm0tMi4wMzYsMS43NjhhMi4xMjUsMi4xMjUsMCwwLDAtLjAyMS4yODl2MTMuNzE2YTIuMDUzLDIuMDUzLDAsMCwwLDIuMDU3LDIuMDU4SDM1LjM3NWEyLjA1MywyLjA1MywwLDAsMCwyLjA1Ny0yLjA1OFY5NzguNDE5YTIuMTI4LDIuMTI4LDAsMCwwLS4wMjEtLjI4OUwyNS44MjcsOTg4LjIzNWEzLjI0LDMuMjQsMCwwLDEtNC4yNDMsMFoiIHRyYW5zZm9ybT0idHJhbnNsYXRlKC0xMCAtOTc2LjM2MikiLz48L2c+PC9nPjwvc3ZnPg==" alt="pun-boon-contact-icon" class="icon">
                                        <p class="text-break"> <?= htmlspecialchars($_SESSION['organization_email']) ?> </p>
                                    </div>
                                </div>
                            </div>

                            <div class="icon-with-text">
                                <div class="ant-row center-row" style="margin-left: -7.5px; margin-right: -7.5px;">
                                    <div class="ant-col gutter-row icon-wrapper ant-col-xs-2 ant-col-sm-2 ant-col-md-1 ant-col-lg-1 ant-col-xl-1" style="padding-left: 7.5px; padding-right: 7.5px;"><img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxNy45OCIgaGVpZ2h0PSIyNi44NSIgdmlld0JveD0iMCAwIDE3Ljk4IDI2Ljg1Ij48ZGVmcz48c3R5bGU+LmF7ZmlsbDojMDA1NmZmO2ZpbGwtcnVsZTpldmVub2RkO308L3N0eWxlPjwvZGVmcz48ZyB0cmFuc2Zvcm09InRyYW5zbGF0ZSgwIDApIj48cGF0aCBjbGFzcz0iYSIgZD0iTTguOTksMGE4Ljk5LDguOTksMCwwLDEsOC45OSw4Ljk5YzAsMy41MS00LjkxOCwxMi4wNDYtNy44LDE3LjE2NmExLjM2OCwxLjM2OCwwLDAsMS0yLjM4LDBDNC45MTgsMjEuMDM2LDAsMTIuNSwwLDguOTlBOC45OSw4Ljk5LDAsMCwxLDguOTksMFptMCw1LjU0QTMuNDUxLDMuNDUxLDAsMSwxLDUuNTQsOC45OSwzLjQ1MSwzLjQ1MSwwLDAsMSw4Ljk5LDUuNTRaIiB0cmFuc2Zvcm09InRyYW5zbGF0ZSgwIDApIi8+PC9nPjwvc3ZnPg==" alt="pun-boon-contact-icon" class="icon"></div>
                                    <p class="text-break"> ที่อยู่ <?php echo $row["org_ad_no"] ?> &nbsp;
                                        <?php echo $row["org_ad_no"] ?> &nbsp;
                                        <?php echo $row["org_ad_village"] ?> &nbsp;
                                        <?php echo $row["org_ad_groubs"] ?> &nbsp;
                                        <?php echo $row["org_ad_buildings"] ?> &nbsp;
                                        <?php echo $row["org_ad_alleys"] ?> &nbsp;
                                        <?php echo $row["org_ad_roads"] ?> &nbsp;
                                        <?php echo $row["org_ad_provinces"] ?> &nbsp;
                                        <?php echo $row["org_ad_amphures"] ?> &nbsp;
                                        <?php echo $row["org_ad_districts"] ?> &nbsp;
                                        <?php echo $row["org_ad_zipcode"] ?> &nbsp;
                                    </p>
                                </div>
                            </div>
                        </div>
                        <hr>
                    <?php  } ?>
                <?php } ?>

            </div>
        </div>
        <br>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>