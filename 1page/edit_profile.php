<?php
session_start();
require('../db.php');
require('../db_connect.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: ../1page/login.php");
}

$stmt = $conn->prepare("SELECT * FROM tb_users WHERE user_id = :user_id");
$stmt->bindParam(":user_id", $_SESSION['user_id']);
$stmt->execute();
$userData = $stmt->fetch(PDO::FETCH_ASSOC);


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <title>แก้ไขข้อมูลส่วนตัว</title>
    <link rel="stylesheet" href="../font.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css" />
    <?php include('../header.php'); ?>
</head>

<body style="background-color: #dfeefa;">
    <div class="container">
        <br>
        <div class="card" style="width: 80rem;">
            <div class="card-body">

                <p class="fs-3">แก้ไขข้อมูลส่วนตัว</p>
                <hr>
                <center>
                    <?php //if ($userData['user_profile'] == '') { ?>
                        <!-- <img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png" alt="" height="180" class="d-inline-block align-text-middle rounded-circle"> -->
                    <?php // } else { ?>
                        <?php //$images = $userData['user_profile'];
                        //if (is_array($images)) {
                            //foreach ($images as $image) { ?>
                                <?php // echo "<img src='../user/{$image}' alt='' width='' height='250'f class='d-inline-block align-text-middle rounded-circle'>" ?>
                            <?php // } ?>
                    <?php // }   } ?>
                    
                    <form action="../user/user_dashboard.php" method="post">

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

                        <!-- <div class="text-center">
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                อัพโหลดรูปภาพ
                            </button>
                        </div>
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-xl">
                                <div class="modal-content">
                                    <div class="text-end">
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

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

                                             /* img {
                                                max-width: 100%;
                                                height: auto;
                                                display: block;
                                            }  */

                                            .cropper-view-box,
                                            .cropper-face {
                                                border-radius: 50%;
                                            }

                                            /* The css styles for `outline` do not follow `border-radius` on iOS/Safari (#979). */
                                            .cropper-view-box {
                                                outline: 0;
                                                box-shadow: 0 0 0 1px #39f;
                                            }
                                        </style>
                                        <div class="text-center">
                                            <div class="row">
                                                <div class="col-lg-6" align="center">
                                                    <label onclick="start_cropping()">เลือกรูปภาพ</label>
                                                    <div id="display_image_div">
                                                        <img name="display_image_data" id="display_image_data" src="dummy-image.png" alt="Picture">
                                                    </div>
                                                    <input type="hidden" name="cropped_image_data" id="cropped_image_data">
                                                    <br>
                                                    <input type="file" name="images" id="browse_image"="form-control" accept="image/*">

                                                </div>
                                                <div class="col-lg-6" align="center">
                                                    <label>ดูรูปภาพ</label>
                                                    <div id="cropped_image_result">
                                                        <img style="width: 350px;" src="dummy-image.png" />
                                                    </div>
                                                    <br>
                                                    <button type="button" class="btn btn-info" id="crop_button">ตัดภาพ</button>
                                                    <button type="submit" class="btn btn-warning" id="upload_button" onclick="upload()">อัพโหลด</button>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </form> -->

                </center>


                <style>
                    /* .text-center {
                        margin: 20px auto;
                        max-width: 640px;
                    }

                    img {
                        max-width: 100%;
                    }

                    .cropper-view-box,
                    .cropper-face {
                        border-radius: 50%;
                    } */

                    /*The css styles for outline do not follow border-radius on iOS/Safari (#979).  .cropper-view-box {
                        outline: 0;
                        box-shadow: 0 0 0 1px #39f;
                    }*/
                </style>
                <!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
                <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script> -->
                <script>
                    /* $("body").on("change", "#images", function(e) {
                        var files = e.target.files;
                        var done = function(url) {
                            $('#display_image_div').html('');
                            $("#display_image_div").html('<img name="display_image_data" id ="display_image_data" src="' + url + '" alt="Uploaded Picture">');

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

                        var image = document.getElementById('display_image_data');
                        var button = document.getElementById('crop_button');
                        var result = document.getElementById('cropped_image_result');
                        var croppable = false;
                        var cropper = new Cropper(image, {
                            aspectRatio: 1,
                            viewMode: 1,
                            ready: function() {
                                croppable = true;
                            },
                        });

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

                    function getRoundedCanvas(sourceCanvas) {
                        var canvas = document.createElement('canvas');
                        var context = canvas.getContext('2d');
                        var width = sourceCanvas.width;
                        var height = sourceCanvas.height;

                        canvas.width = width;
                        canvas.height = height;
                        context.imageSmoothingEnabled = true;
                        context.drawImage(sourceCanvas, 0, 0, width, height);
                        context.globalCompositeOperation = 'destination-in';
                        context.beginPath();
                        context.arc(width / 2, height / 2, Math.min(width, height) / 2, 0, 2 * Math.PI, true);
                        context.fill();
                        return canvas;
                    } */

                    /*function upload() {
                        var base64data = $('#cropped_image_result img').attr('src');
                        //alert(base64data);
                        $.ajax({
                            type: "POST",
                            dataType: "json",
                            url: "../user/crop_image_upload.php",
                            data: {
                                image: base64data
                            },
                            success: function(response) {
                                if (response.status == true) {
                                    alert(response.msg);
                                } else {
                                    alert("Image not uploaded.");
                                }
                            }
                        });
                    }*/
                </script>
               
                <form action="../user/user_dashboard.php" method="POST">
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
                    <input type="hidden" value="<?php echo $userData['user_id']  ?>" name="user_id">
                    <div class="row">

                        <div class="col">
                            <label for="formGroupExampleInput" class="form-label">เลขบัตรประจำตัวประชาชน</label>
                            <input type="text" class="form-control" value="<?php echo $userData['user_id'];  ?>" id="formGroupExampleInput" disabled>
                        </div>
                        <div class="col">
                            <label for="formGroupExampleInput" class="form-label">ชื่อ</label>
                            <input type="text" class="form-control" value="<?php echo $userData['user_name'];  ?>" name="user_name" id="formGroupExampleInput">
                        </div>
                        <div class="col">
                            <label for="formGroupExampleInput" class="form-label">นามสกุล</label>
                            <input type="text" class="form-control" value="<?php echo $userData['user_lastname'];  ?>" name="user_lastname" id="formGroupExampleInput">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="formGroupExampleInput" class="form-label"> Email</label>
                            <input type="email" class="form-control" value="<?php echo $userData['user_email'];  ?>" name="user_email" id="formGroupExampleInput">
                        </div>
                        <div class="col">
                            <label for="formGroupExampleInput" class="form-label">เบอร์โทรศัพท์</label>
                            <input type="text" class="form-control" value="<?php echo $userData['user_phone'];  ?>" name="user_phone" id="formGroupExampleInput">
                        </div>
                        <div class="col">
                        </div>
                    </div>

                    <hr>
                    <p class="fs-5">แก้ไขที่อยู่</p>


                    <div class="row">
                        <div class="col">
                            <label for="formGroupExampleInput" class="form-label">บ้านเลขที่</label>
                            <input type="text" class="form-control" id="no" name="no" value="<?php echo $userData['user_ad_no'];  ?>">
                        </div>
                        <div class="col">
                            <label for="formGroupExampleInput" class="form-label">หมู่บ้าน</label>
                            <input type="text" class="form-control" id="village" name="village" value="<?php echo $userData['user_ad_village'];  ?>">
                        </div>
                        <div class="col">
                            <label for="formGroupExampleInput" class="form-label">หมู่ที่</label>
                            <input type="text" class="form-control" id="groubs" name="groubs" value="<?php echo $userData['user_ad_groubs'];  ?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="formGroupExampleInput" class="form-label">อาคาร</label>
                            <input type="text" class="form-control" id="buildings" name="buildings" value="<?php echo $userData['user_ad_buildings'];  ?>">
                        </div>
                        <div class="col">
                            <label for="formGroupExampleInput" class="form-label">ตรอก/ซอย</label value="<?php echo $userData['user_ad_alleys'];  ?>">
                            <input type="text" class="form-control" id="alleys" name="alleys">
                        </div>
                        <div class="col">
                            <label for="formGroupExampleInput" class="form-label">ถนน</label>
                            <input type="text" class="form-control" id="roads" name="roads" value="<?php echo $userData['user_ad_roads'];  ?>">
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
                        </div>

                    </div>
                    <br>
                    <div class="row text-end">
                        <div class="col">
                            <a href="profile.php" type="button" class="btn btn-danger rounded-pill">ยกเลิก</a>
                            <button type="submit" class="btn btn-primary rounded-pill">แก้ไขข้อมูล</button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>



    <br>

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





    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>