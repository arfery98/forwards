<?php
session_start();
include('../db.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: ../1page/login.php");
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
    <title>แก้ไขข้อมูลแนะนำโครงการ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css" />
    <?php if (isset($_SESSION['organization_name'])) {

        include('../org_header.php');
    } else {
        include('../header.php');
    } ?>
</head>

<body style="background:#e7f4ff">
    <div class="container">
        <br>
        <div class="card" style="width: 80rem;">
            <div class="card-body">
                <form action="../user/org_ps.php" method="POST" enctype="multipart/form-data" >
                
                    <div class="row">
                        <p class="fs-4">แนะนำโครงการ</p>
                        <div class="col">
                            <label for="formGroupExampleInput" class="form-label">แก้ไขรายละเอียดข้อมูล</label>
                            <input type="text" name="organization_bio" class="form-control" id="formGroupExampleInput">
                            <br>
                        </div>
                    </div>

                    <hr>
                    <h1 class="modal-title fs-5" id="exampleModalLabel">อัพโหลด/เพิ่ม รูปภาพเพื่อแนะนำองค์กร</h1>
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
                                <input type="file" name="images[]" id="browse_image" class="form-control" multiple accept="image/*">
                            </div>
                        </div>
                        <br>
                    </div>

                    <div class="row text-end">
                        <div class="col">
                            <a href="org_ps.php" type="button" class="btn btn-danger rounded-pill">ยกเลิก</a>
                            <button type="submit" class="btn btn-primary rounded-pill">บันทึกการแนะนำ</button>
                        </div>
                    </div>
                </form>
            </div>

            <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>
            <script>
                $("body").on("change", "#images", function(e) {
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


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>