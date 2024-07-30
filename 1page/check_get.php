<?php
session_start();
require('../db.php');
require('../db_connect.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: ../1page/login.php");
}



$user_id = $_SESSION['user_id'];


$sql = "SELECT tb_personal_forward.personal_forward_name,tb_history_personal_forwards.history_forwards_name,tb_history_personal_forwards.history_forwards_detail,tb_history_personal_forwards.history_forward_ct,tb_history_personal_forwards.history_forwards_location,tb_history_personal_forwards.history_forwards_id,tb_history_personal_forwards.history_forwards_date,tb_history_personal_forwards.history_forwards_status FROM tb_personal_forward,tb_history_personal_forwards WHERE tb_history_personal_forwards.history_forwards_personal_id=tb_personal_forward.personal_forward_id and tb_personal_forward.personal_forward_user = $user_id ";
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
            <br>
            <tbody class="text-center">
                <tr>
                    <td colspan="8">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">ชื่อโพสต์ที่ส่งต่อ</th>
                                    <th scope="col">ชื่อ</th>
                                    <th scope="col">เหตุผล</th>
                                    <th scope="col">การติดต่อ</th>
                                    <th scope="col">ที่อยู่</th>
                                    <th scope="col">เวลา</th>
                                    <th scope="col">สถานะ</th>
                                    <th scope="col">ดำเนินการ</th>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider">
                                <?php if (isset($_SESSION['user_id'])) { ?>
                                    <?php while ($row = mysqli_fetch_assoc($result_1)) { ?>
                                        <tr>
                                            <td><?php echo $row["personal_forward_name"]; ?></td>
                                            <td><?php echo $row["history_forwards_name"]; ?></td>
                                            <td><?php echo $row["history_forwards_detail"]; ?></td>
                                            <td><?php echo $row["history_forward_ct"]; ?></td>
                                            <td><?php echo $row["history_forwards_location"]; ?></td>
                                            <td><?php echo $row["history_forwards_date"]; ?></td>

                                            <td>
                                                <?php if ($row['history_forwards_status'] == 'finish') { ?>
                                                    <span class="badge rounded-pill bg-success">ส่งของให้แล้ว</span>
                                                <?php } else { ?>
                                                    <span class="badge rounded-pill bg-secondary">ขอรับสิ่งของ</span>
                                                <?php } ?>
                                            </td>

                                            <td><a href="../social/check_status.php?history_forwards_status=<?php echo $row['history_forwards_id'] ?>" class="btn btn-success<?php if ($row['history_forwards_status'] == 'finish') {
                                                                                                                                                                                    echo ' disabled';
                                                                                                                                                                                } ?>">ยืนยัน</a></td>
                                        </tr>
                                    <?php } ?>
                                <?php } ?>
                                <?php if (isset($_SESSION['organization_name'])) { ?>
                                    <?php while ($row = mysqli_fetch_assoc($result_2)) { ?>
                                        <tr>
                                            <td><?php echo $row["organization_forward_name"]; ?></td>
                                            <td><?php echo $row["history_forwards_name"]; ?></td>
                                            <td><?php echo $row["history_forwards_detail"]; ?></td>
                                            <td><?php echo $row["history_forward_ct"]; ?></td>
                                            <td><?php echo $row["history_forwards_location"]; ?></td>
                                            <td><?php echo $row["history_forwards_date"]; ?></td>

                                            <td>
                                                <?php if ($row['history_forwards_status'] == 'finish') { ?>
                                                    <span class="badge rounded-pill bg-success">ส่งของให้แล้ว</span>
                                                <?php } else { ?>
                                                    <span class="badge rounded-pill bg-secondary">ขอรับสิ่งของ</span>
                                                <?php } ?>
                                            </td>

                                            <td><a href="../social/check_status.php?history_forwards_status=<?php echo $row['history_forwards_id'] ?>" class="btn btn-success<?php if ($row['history_forwards_status'] == 'finish') {
                                                                                                                                                                                    echo ' disabled';
                                                                                                                                                                                } ?>">ยืนยัน</a></td>
                                        </tr>
                                    <?php } ?>
                                <?php } ?>
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
                
            </div>
        </div>
    </div>
    <hr>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>

</html>