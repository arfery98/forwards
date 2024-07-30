<?php
include"../db_connect.phpp";
if(isset($_POST['crop_image'])) {

    $data = $_POST['crop_image'];

    $image_array_1 = explode(";", $data);

    $image_array_2 = explode(",", $image_array_1[1]);

    $base64_decode = base64_decode($image_array_2[1]);

    $path_img = 'upload/'.time().'.png';

    $imagename = ''.time().'.png';

    file_put_contents($path_img, $base64_decode);

    $sql2 = "INSERT INTO upload(imagename) VALUES ('$imagename')"; 

    $con->query($sql2);
}

?>