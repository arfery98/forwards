<?php
session_start();
require('../db.php');
require('../db_connect.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: ../1page/login.php");
}

$sql = "SELECT * FROM `tb_organization` ;";
$result_1 = mysqli_query($con, $sql);

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
        <table class="table table-striped table-bordered">
            <br><br>

            <tbody class="text-center">
                <tr>
                    <td colspan="6">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">ชื่อองค์กร</th>
                                    <th scope="col">เบอร์โทร</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">ที่อยู่องค์กร</th>
                                    <th scope="col">ใบตรวจสอบ</th>
                                    <th scope="col">สถานะ</th>
                                    <th scope="col">ดำเนินการ</th>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider">
                                <?php while ($row = mysqli_fetch_assoc($result_1)) { ?>
                                    <tr>
                                        <td><?php echo $row["organization_name"]; ?></td>
                                        <td><?php echo $row["organization_phone"]; ?></td>
                                        <td><?php echo $row["organization_email"]; ?></td>
                                        <td><?php echo $row["organization_ad_no"]; ?>&nbsp;
                                            <?php echo $row["organization_ad_village"]; ?>&nbsp;
                                            <?php echo $row["organization_ad_groubs"]; ?>&nbsp;
                                            <?php echo $row["organization_ad_buildings"]; ?>&nbsp;
                                            <?php echo $row["organization_ad_alleys"]; ?>&nbsp;
                                            <?php echo $row["organization_ad_roads"]; ?>&nbsp;
                                            <?php echo $row["organization_ad_provinces"]; ?>&nbsp;
                                            <?php echo $row["organization_ad_amphures"]; ?>&nbsp;
                                            <?php echo $row["organization_ad_districts"]; ?>&nbsp;
                                            <?php echo $row["organization_ad_zipcode"]; ?>&nbsp;</td>
                                        <td>

                                            <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exampleModal<?php echo $row["organization_id"]; ?>">
                                                ดูรูปภาพ
                                            </button>



                                        </td>

                                        <td>
                                            <?php if ($row['organization_verify'] == 'IP') { ?>
                                                <span class="badge rounded-pill bg-success">ได้รับการอนุมัติ</span>
                                            <?php } else { ?>
                                                <span class="badge rounded-pill bg-secondary">รอการยืนยัน</span>
                                            <?php } ?>
                                        </td>

                                        <td><a href="../user/check_org.php?organization_verify=<?php echo $row['organization_id'] ?>" class="btn btn-success <?php if ($row['organization_verify'] == 'IP') {
                                                                                                                                                                    echo "disabled";
                                                                                                                                                                } ?>">ยืนยัน</a></td>

                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal<?php echo $row["organization_id"]; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

                                            <div class="modal-dialog modal-xl">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">รูปภาพตรวจสอบ</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>

                                                    <div class="modal-body">
                                                        <img alt='' class='img-thumbnail' src='../user/<?php echo $row["organization_comfirm"] ?>'>

                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </tr>
                                <?php } ?>
                            </tbody>
                </tr>

            </tbody>
        </table>
        </td>
        </tr>
        </tbody>
        </table>
        <br>
        <hr>
    </div>

    <div class=" text-center py-md-5 px-4 px-md-3 text-body-secondary">
        <div class="row">
            <div class="col-lg-3 mb-3">
                <a class="d-inline-flex align-items-center mb-2 text-body-emphasis text-decoration-none" href="index.php" aria-label="...">
                    <span class="fs-5">FORWARDS</span>
                </a>
            </div>
            <div class="col-6 col-lg-2 offset-lg-1 mb-3">
                <h5>รายละเอียด</h5>
                <ul class="list-unstyled">
                    <h8>นายรชตะ แซ่ฟุ้ง</h8><br>
                    <h8>นายพันธดนย์ พาตา</h8>
                </ul>
                <h5>ครูที่ปรึกษา</h5>
                <ul class="list-unstyled">
                    <h8>นายพิพัฒน์ศักดิ์ ไชยวงษ์</h8>
                </ul>
                <h5>โรงเรียนอนุกูลนารี จ.กาฬสินธุ์</h5>

            </div>

            <div class="col-6 col-lg-2 offset-lg-1 mb-3">
                <h5>Contact</h5>
                <ul class="list-unstyled">
                    <h8>FB:Rachata Saefung</h8><br>
                    <h8>FB:cho kun</h8><br>
                    <h8>email:std45798@anukoolnaree.ac.th</h8><br>
                    <h8>email:std45792@anukoolnaree.ac.th</h8><br>
                    <h8>Tel:0633659643</h8><br>
                    <h8>Tel:0926480980</h8>
                </ul>
            </div>

            <div class="col-6 col-lg-2 offset-lg-1 mb-3">
                <h5>Menu</h5>
                <ul class="list-unstyled">
                    <li class="mb-2"><a href="" target="_blank" rel="noopener"></a>ข้อมูลผู้ใช้งาน</li>
                    <li class="mb-2"><a href="" target="_blank" rel="noopener"></a>โพสต์การบริจาค</li>
                    <li class="mb-2"><a href="" target="_blank" rel="noopener"></a>บัญชีองค์กรณ์</li>
                    <li class="mb-2"><a href="" target="_blank" rel="noopener"></a>ส่งต่อ</li>
                </ul>
            </div>
        </div>
    </div>
    <hr>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>

</html>