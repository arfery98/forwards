<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="../1page/index.php">
            <img src="../image/3.png" alt="" height="70" class="d-inline-block align-text-middle">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <?php if (isset($_SESSION['organization_name'])) { ?>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            ข้อมูลโครงการ
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="../1page/org_profile.php">ข้อมูลโครงการ</a></li>
                            <li><a class="dropdown-item" href="../1page/org_ps.php">แนะนำโครงการ</a></li>
                            <li><a class="dropdown-item" href="../1page/org_change_pass.php">แก้ไขรหัสผ่าน</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            โพสต์การบริจาค
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="../1page/post_1.php">บุคคลประสงค์ส่งต่อ</a></li>
                            <li><a class="dropdown-item" href="../1page/post_2.php">องค์กรส่งต่อ</a></li>
                            <li><a class="dropdown-item" href="../1page/post_3.php">ขอรับบริจาค</a></li>
                            <li><a class="dropdown-item" href="../1page/post_4.php">ประชาสัมพันธ์</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                        </ul>
                    </li>

                    <?php
                    include('../db_connect.php');
                    $org_id = $_SESSION['organization_email'];
                    $sql = "SELECT * FROM `tb_organization` WHERE organization_email = '$org_id' ";
                    $result99 = $con->query($sql); ?>
                    <?php while ($row = mysqli_fetch_assoc($result99)) { ?>
                        <?php if ($row['organization_verify'] == 'IP') { ?>
                            <li class="nav-item dropdown">
                                <a class="nav-link " href="../1page/org_rq.php" role="button" aria-expanded="false">
                                    ขอรับบริจาค
                                </a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link " href="../1page/forwards.php" role="button" aria-expanded="false">
                                    ส่งต่อ
                                </a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link " href="../1page/declares.php" role="button" aria-expanded="false">
                                    ประชาสัมพันธ์
                                </a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link " href="../1page/check_get2.php" role="button" aria-expanded="false">
                                    เช็คการบริจาค
                                </a>
                            </li>
                        <?php }  ?>
                    <?php }  ?>
                </ul>
            <?php } else { ?>
                <span class="navbar-text">
                    ยินดีต้องรับเข้าสู่ส่งต่อ กรุณาสมัครสมาชิกเพื่อเข้าสู่ระบบต่อไป
                </span>

            <?php } ?>


            <?php if (isset($_SESSION['organization_name'])) { ?>

                <span class="navbar-text">
                    ยินดีต้องรับมูลนิธิ <?php echo $_SESSION['organization_name']; ?>
                </span>
                &nbsp;
                <a class="btn btn-outline-danger rounded-pill" href="../user/org_logout.php" type="submit">ออกจากระบบ</a>
            <?php } else { ?>
                <a href="../1page/org_login.php" class="btn btn-outline-primary rounded-pill" type="submit">เข้าสู่ระบบ</a>
            </div>
        <?php } ?>
    </div>
</nav>