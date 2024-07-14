<?php
session_start();
require('../db.php');

if (!isset($_SESSION['organization_email'])) {
    header("Location: ../1page/org_login.php");
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
    <title>แก้ไขข้อมูลส่วนโครงการ</title>
    <link rel="stylesheet" href="../font.css">
    <?php include('../org_header.php'); ?>
</head>

<body style="background-color: #dfeefa;">

    <div class="container">
        <br>
        <div class="row justify-content-center">
            <div class="card" style="width: 80rem;">
                <div class="card-body">

                    <p class="fs-3">แก้ไขข้อมูลโครงการ</p>
                    <hr><br>


                    <form action="" method="POST">
                        <center>
                            <div class="text-center">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">อัพโหลดรูปภาพโครงการใหม่</h1>
                            </div>
                            <div class="modal-body">
                                <style>
                                    .text-center {
                                        margin: 20px auto;
                                        max-width: 640px;
                                    }

                                    img {
                                        max-width: 100%;
                                    }
                                </style>
                                <div class="row">
                                    <div class="text-center" align="center">
                                        <label>เลือกรูปภาพ</label>
                                        <div id="display_image_div">
                                            <img name="display_image_data" id="display_image_data" src="dummy-image.png" alt="Picture">
                                        </div>
                                        <br>
                                        <input type="file" name="browse_image" id="browse_image" class="form-control" multiple accept="image/*">
                                    </div>
                                </div>
                                <br>
                                <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
                                <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
                                <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>

                            </div>
                        </center>

                    </form>

                    <script>
                        $("body").on("change", "#browse_image", function(e) {
                            var files = e.target.files;
                            var done = function(url) {
                                $('#display_image_div').html('');
                                $("#display_image_div").html('<img name="display_image_data" id="display_image_data" src="' + url + '" alt="Uploaded Picture">');

                            };
                            if (files && files.length > 0) {
                                file = files[0];

                                if (URL) {
                                    done(URL.createObjectURL(file));
                                } else if (FileReader) {
                                    reader = new FileReader();
                                    reader.onload = function(e) {
                                        done(reader.result);
                                    };
                                    reader.readAsDataURL(file);
                                }
                            }
                            button.onclick = function() {

                                var croppedCanvas;
                                var roundedCanvas;
                                var roundedImage;

                                if (!croppable) {
                                    return;
                                }

                                // Crop
                                croppedCanvas = cropper.getCroppedCanvas();

                                // Round
                                roundedCanvas = getRoundedCanvas(croppedCanvas);

                                // Show
                                roundedImage = document.createElement('img');

                                roundedImage.src = roundedCanvas.toDataURL()
                                result.innerHTML = '';
                                result.appendChild(roundedImage);
                            };
                        });
                    </script>

                    <div class="container">
                        <form action="../user/org_dashboard.php" method="POST">
                            <hr>
                            <div class="row">
                                <div class="col">
                                    <label for="formGroupExampleInput" class="form-label">ชื่อโครงการ/องค์กรณ์</label>
                                    <input type="text" class="form-control" id="formGroupExampleInput" name="organization_name" value="<?php echo $user_orgData['organization_name'];  ?>" readonly>
                                </div>
                                <div class="col">
                                    <label for="formGroupExampleInput" class="form-label">Email</label>
                                    <input type="text" class="form-control" id="formGroupExampleInput" name="organization_email" value="<?php echo $user_orgData['organization_email'];  ?>" disabled readonly>
                                </div>
                                <div class="col">
                                    <label for="formGroupExampleInput" class="form-label">โทรศัพท์</label>
                                    <input type="text" class="form-control" id="formGroupExampleInput" name="organization_phone" value="<?php echo $user_orgData['organization_phone'];  ?>">
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col">
                                    <label for="formGroupExampleInput" class="form-label">เอกสารตรวจสอบโครงการ</label>
                                    <!-- <form class="imgForm" action="--------------.php" method="post" enctype="multipart/form-data"> -->
                                    <input type="file" class="btn btn-outline-secondary" name="upload">
                                    <!-- </form> -->
                                </div>
                            </div>
                            <hr>
                            <p class="fs-5">แก้ไขที่อยู่</p>
                            <div class="row">
                                <div class="col">
                                    <label for="formGroupExampleInput" class="form-label">บ้านเลขที่</label>
                                    <input type="text" class="form-control" id="formGroupExampleInput" name="no" value="<?php echo $user_orgData['organization_ad_no'];  ?>">
                                </div>
                                <div class="col">
                                    <label for="formGroupExampleInput" class="form-label">หมู่บ้าน</label>
                                    <input type="text" class="form-control" id="formGroupExampleInput" name="village" value="<?php echo $user_orgData['organization_ad_village'];  ?>">
                                </div>
                                <div class="col">
                                    <label for="formGroupExampleInput" class="form-label">หมู่ที่</label>
                                    <input type="text" class="form-control" id="formGroupExampleInput" name="groubs" value="<?php echo $user_orgData['organization_ad_groubs'];  ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label for="formGroupExampleInput" class="form-label">อาคาร</label>
                                    <input type="text" class="form-control" id="formGroupExampleInput" name="buildings" value="<?php echo $user_orgData['organization_ad_buildings'];  ?>">
                                </div>
                                <div class="col">
                                    <label for="formGroupExampleInput" class="form-label">ตรอก/ซอย</label>
                                    <input type="text" class="form-control" name="alleys" id="formGroupExampleInput" value="<?php echo $user_orgData['organization_ad_alleys'];  ?>">
                                </div>
                                <div class="col">
                                    <label for="formGroupExampleInput" class="form-label">ถนน</label>
                                    <input type="text" class="form-control" name="roads" id="formGroupExampleInput" value="<?php echo $user_orgData['organization_ad_roads'];  ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">

                                    <?php $sql = "SELECT * FROM provinces ORDER BY name_th ASC";
                                    $result = $conn->query($sql);
                                    ?>

                                    <label for="formGroupExampleInput" class="form-label">จังหวัด</label>
                                    <select name="provinces" class="form-select" aria-label="Default select example" id="provinces">
                                        <option selected>กรุณาเลือกจังหวัด</option>
                                        <?php foreach ($result as $row) { ?>
                                            <option value="<?= $row['name_th'] ?>"><?= $row['name_th'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="formGroupExampleInput" class="form-label">อำเภอ/เขต</label>
                                    <select class="form-select" aria-label="Default select example" name="amphures" id="amphures">
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="formGroupExampleInput" class="form-label">ตำบล/แขวง</label>
                                    <select class="form-select" aria-label="Default select example" name="district" id="district">
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="formGroupExampleInput" class="form-label">รหัสไปรษณีย์</label>
                                    <input type="text" class="form-control" id="zipcode" name="zipcode" readonly>
                                </div>

                            </div>
                            <br>
                            <div class="row text-end">
                                <div class="col">
                                    <button type="button" class="btn btn-danger rounded-pill">ยกเลิก</button>
                                    <button type="submit" class="btn btn-primary rounded-pill">แก้ไขข้อมูล</button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
                    <script type="text/javascript">
                        $('#provinces').change(function() {
                            var province_id = $(this).val();
                            $.ajax({
                                type: "POST",
                                url: "../address/get_amphures.php",
                                data: {
                                    province_id: province_id,
                                    function: 'province_id'
                                },
                                success: function(data) {
                                    console.log(data);
                                    $('#amphures').html(data)
                                    $('#district').html('');
                                    $('#zipcode').val('');
                                }
                            });
                        });
                        $('#amphures').change(function() {
                            var amphures_id = $(this).val();
                            $.ajax({
                                url: "../address/get_districts.php",
                                method: "POST",
                                data: {
                                    amphures_id: amphures_id,
                                    function: 'amphures'
                                },
                                success: function(data) {
                                    $('#district').html(data);
                                    $('#zipcode').val('');
                                }
                            });
                        });
                        $('#district').change(function() {
                            var district_id = $(this).val();
                            $.ajax({
                                url: "../address/get_zipcode.php",
                                method: "POST",
                                data: {
                                    district_id: district_id,
                                    function: 'district'
                                },
                                success: function(data) {
                                    console.log(data);
                                    $('#zipcode').val(data);
                                }
                            });
                        });
                    </script>

                </div>
            </div>
        </div>
    </div>

    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>