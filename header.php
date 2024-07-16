<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="../1page/index.php">
            <img src="../image/3.png" alt="" height="70" class="d-inline-block align-text-middle">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <?php if (isset($_SESSION['user_id'])) { ?>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                ข้อมูลผู้ใช้งาน
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="../1page/profile.php">ข้อมูลส่วนตัว</a></li>
                                <li><a class="dropdown-item" href="../1page/change_pass.php">แก้ไขรหัสผ่าน</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                โพสต์ขอรับบริจาค
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="../1page/post.php">บุคคลประสงค์ส่งต่อ</a></li>
                                <li><a class="dropdown-item" href="../1page/post.php">โครงการส่งต่อ</a></li>
                                <li><a class="dropdown-item" href="../1page/post.php">ขอรับบริจาค</a></li>
                                <li><a class="dropdown-item" href="../1page/post.php">ประชาสัมพันธ์</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                บัญชีโครงการ
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="../1page/org_login.php">เข้าสู่ระบบโครงการ</a></li>
                                <li><a class="dropdown-item" href="../1page/org_register.php">สมัครบัญชีโครงการ</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link " href="../1page/forwards.php" role="button" aria-expanded="false">
                                ส่งต่อ
                            </a>
                        </li>

                    </ul>
                <?php } else { ?>
                    <span class="navbar-text">
                        ยินดีต้อนรับเข้าสู่ "ส่งต่อ" กรุณาสมัครสมาชิกเพื่อเข้าสู่ระบบต่อไป
                    </span>

                <?php } ?>


                <div class="navbar-nav ms-auto mb-2 mb-lg-0">

                    <?php if (isset($_SESSION['user_id'])) { ?>
                        <span class="navbar-text">
                            ยินดีต้องรับคุณ <?php echo /*$_SESSION['user_name'] */ "รชตะ" . ' ' . "แซ่ฟุ้ง" /*$_SESSION['user_lastname']; */?> &nbsp;
                        </span><a href="../user/logout.php" class="btn btn-outline-secondary rounded-pill" type="submit">ออกจากระบบ</a>
                    <?php } else { ?>
                        <a href="../1page/login.php" class="btn btn-outline-primary rounded-pill" type="submit">เข้าสู่ระบบ</a>
                        &nbsp;
                        <a href="../1page/register.php" class="btn btn-outline-success rounded-pill" type="submit">สมัครสมาชิก</a>

                    <?php } ?>

                </div>
                </div>
        </div>
    </div>
</nav>