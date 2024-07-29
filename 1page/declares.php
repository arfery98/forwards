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
    <title>ฟอร์มประชาสัมพันธ์</title>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css" />
    <link rel="stylesheet" href="../font.css">

    <?php if (isset($_SESSION['organization_name'])) {
        include('../org_header.php');
    } else {
        include('../header.php');
    } ?>
</head>

<body style="background:#e7f4ff">
    <div class="container">
        <form>
            <br>
            <div class="carousel-inner">
                <img alt="..." class="d-block w-100" src="file:///C:/Downloads/forwardwe%20(3).jpg">
            </div>
            <br>

        </form>

        <!-- FOR -->
        <br>

        <!-- NAME-->

        <section class="about section-padding" id="about">
            <div class="card" style="width: 80rem;">
                <div class="text-center">
                    <h3 class="gb-headline gb-headline-eba9dd47"> FORWARDS INFORMATION </h3>

                    <p>
                        <span class="has-inline-color has-white-color">หากมีความสนใจเรื่อง การประชาสัมพันธ์ ข่าวสาร,
                            สื่อสิ่งต่างๆ &nbsp; สามารถกรอกฟอร์มด้านล่าง
                        </span>
                    </p>
                </div>
                <hr class="wp-block-separator sep-line is-style-wide">



                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
                <script src="https://www.google.com/recaptcha/api.js" async="" defer=""></script>

                <div class="center">
                    <form id="contactForm" action="../social/upload_ift.php" method="POST" enctype="multipart/form-data">
                        <div class="container-md">
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
                        </div>
                        <div class="row">
                            <center>
                                <div class="col-md-6 mb-3">
                                    <label for="Message" class="form-label">
                                        รายละเอียดข่าวสาร
                                    </label>
                                    <textarea type="text" class="form-control" rows="3" name="dc_message"></textarea>
                                </div>
                            </center>

                            <div class="text-center">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">อัพโหลดรูปภาพข่าวสาร</h1>
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
                                        <input type="file" name="images[]" id="browse_image" class="form-control" multiple accept="image/*">
                                    </div>
                                </div>
                                <br>

                                <center>
                                    <button type="submit" <?php if (isset($_SESSION['organization_name'])) { ?> name="org_ift" ; <?php } else { ?> name="user_ift" ; <?php } ?> class="btn btn-outline-info rounded-pill">โพสต์ประชาสัมพันธ์</button>
                                </center>
                            </div>
                        </div>
                        <br>
                    </form>
                    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
                    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

                    <script>
                        $("body").on("change", "#images[]", function(e) {
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

                                var roundedCanvas;
                                var roundedImage;

                                // Show
                                roundedImage = document.createElement('img');

                                roundedImage.src = roundedCanvas.toDataURL()
                                result.innerHTML = '';
                                result.appendChild(roundedImage);
                            };
                        });
                    </script>
                </div>



                <!-- NAME-->
            </div>
        </section>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>