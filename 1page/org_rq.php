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
    <title>ส่งต่อ</title>
    <link rel="stylesheet" href="../font.css">
    <?php if (isset($_SESSION['organization_name'])) {

        include('../org_header.php');
    } else {
        include('../header.php');
    } ?>
</head>

<!-- FOR -->

<!-- NAME-->

<body style="background-color: #dfeefa;">
    <img alt="..." class="d-block w-100" src="../image/rq_fw.jpg">
    <br>
    <div class="container">
        <div class="carousel-inner">

            <div class="card" style="width: auto;">
                <br>

                <div class="card-body">
                    <div class="text-center">
                        <h3 class="gb-headline gb-headline-eba9dd47"> FORWARD </h3>
                        <p>
                            <span class="has-inline-color has-white-color">กรอกข้อมูลสิ่งของที่ต้องการ ด้านล่าง
                            </span>
                        </p>
                    </div>
                    <br>

                    <hr class="wp-block-separator sep-line is-style-wide">
                    <form action="../social/upload_rq.php" method="post" enctype="multipart/form-data">

                        <?php if (isset($_SESSION['success'])) { ?>

                            <div class="alert alert-success" role="alert">
                                <?php
                                echo $_SESSION['success'];
                                unset($_SESSION['success']);
                                ?>
                            </div>
                        <?php }; ?>

                        <?php if (isset($_SESSION['error'])) { ?>
                            <div class="alert alert-danger" role="alert">
                                <?php echo $_SESSION['error'];
                                unset($_SESSION['error']);
                                ?>
                            </div>
                        <?php }; ?>

                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="Email" class="form-label">
                                    สิ่งของที่ต้องการ
                                </label>
                                <input type="text" class="form-control" style="height:40px;" name="" required="">
                            </div>

                            <div class="col-md-12 mb-3">
                                <label for="Message" class="form-label">
                                    เหตุผล
                                </label>
                                <textarea class="form-control" rows="3" name=""></textarea>
                            </div>

                            <div class="text-center">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">อัพโหลดรูปภาพ</h1>
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
                                        <input type="file" name="images[]" id="personal_forward_img" class="form-control" multiple accept="image/*" required>
                                    </div>
                                </div>
                                <br>
                                <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
                                <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
                                <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>
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
                            </div>
                        </div>



                        <div class="col-md-12 mb-3">
                            <label for="Services" class="form-label">
                                หมวดหมู่ที่ขอรับการบริจาค
                            </label>
                            <select class="form-select style=" height:40px; name="personal_forward_catagories_id" required="">
                                <option selected="" value="" disabled="">โปรดเลือก</option>
                                <option value="ส่งยา และ เวชภัณฑ์">ส่งยา และ เวชภัณฑ์</option>
                                <option value="ช่วยเหลือผู้พิการ">ช่วยเหลือผู้พิการ</option>
                                <option value="การศึกษา">การศึกษา</option>
                                <option value="เครื่องนุ่งห่ม">เครื่องนุ่งห่ม</option>
                                <option value="ส่งอาหาร,ขนม,เครื่องดื่ม">ส่งอาหาร,ขนม,เครื่องดื่ม</option>
                                <option value="อื่นๆ">อื่นๆ</option>
                            </select>
                        </div>

                        <div class="row">
                            <div class="col">
                                <label for="formGroupExampleInput" class="form-label">บ้านเลขที่</label>
                                <input type="text" class="form-control" id="no" name="no" value="">
                            </div>
                            <div class="col">
                                <label for="formGroupExampleInput" class="form-label">หมู่บ้าน</label>
                                <input type="text" class="form-control" id="village" name="village" value="">
                            </div>
                            <div class="col">
                                <label for="formGroupExampleInput" class="form-label">หมู่ที่</label>
                                <input type="text" class="form-control" id="groubs" name="groubs" value="">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="formGroupExampleInput" class="form-label">อาคาร</label>
                                <input type="text" class="form-control" id="buildings" name="buildings" value="">
                            </div>
                            <div class="col">
                                <label for="formGroupExampleInput" class="form-label">ตรอก/ซอย</label value="">
                                <input type="text" class="form-control" id="alleys" name="alleys">
                            </div>
                            <div class="col">
                                <label for="formGroupExampleInput" class="form-label">ถนน</label>
                                <input type="text" class="form-control" id="roads" name="roads" value="">
                            </div>
                        </div>

                        <div class="row">

                            <?php $sql = "SELECT * FROM provinces ORDER BY name_th ASC";
                            $result = $conn->query($sql);
                            ?>

                            <div class="col">
                                <label for="formGroupExampleInput" class="form-label">จังหวัด</label>
                                <select name="provinces" class="form-select" aria-label="Default select example" id="provinces" required>
                                    <option value="" selected disabled>กรุณาเลือกจังหวัด</option>
                                    <?php foreach ($result as $row) { ?>
                                        <option value="<?= $row['name_th'] ?>"><?= $row['name_th'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col">
                                <label for="formGroupExampleInput" class="form-label">อำเภอ/เขต</label>
                                <select class="form-select" aria-label="Default select example" name="amphures" id="amphures" required>
                                </select>
                            </div>
                            <div class="col">
                                <label for="formGroupExampleInput" class="form-label">ตำบล/แขวง</label>
                                <select class="form-select" aria-label="Default select example" name="districts" id="district" required>
                                </select>
                            </div>
                            <div class="col">
                                <label for="formGroupExampleInput" class="form-label">รหัสไปรษณีย์</label>
                                <input type="text" class="form-control" id="zipcode" name="zipcode" readonly>
                                <br>
                            </div>




                            <!--<div class="text-center">
                    <label for="PhoneNumber" class="form-label">
                        สถานะการบริจาค
                    </label>
                    <input type="text" class="form-control" style="height:40px;" name="personal_forward_status" required="">

                </div>-->
                            <!--<div class="col-md-12 mb-3">
                    <label for="Email" class="form-label">
                        ชื่อผู้บริจาค
                    </label>
                    <input type="name" class="form-control" style="height:40px;" name="name" required="">
                </div>-->
                            <br>
                            <hr>
                            <div class="text-center">
                                <button type="submit" id="submitButton" class="btn btn-warning rounded-pill">ส่งต่อ</button>
                            </div>
                    </form>

                    

                </div>

            </div>


        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>