<?php
session_start();
include("php/connectns.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css"> <!-- link เลือก css-->
    <link rel="stylesheet" href="node_modules/font-awesome5/css/fontawesome-all.css">
    <link rel="stylesheet" href="include/CSS/styles.css?v=<?php echo filemtime('include/CSS/styles.css'); ?>"
        type=" text/css">
    <link rel="icon" href="img/index/ประแจ.png">
    <title>Service</title>

</head>

<body>
    <?php


    include('include/navber.php'); // เรียกใช่ไฟล์ include

    ?>
    <br>

    <div id="carouselExampleInterval" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div id="imglist" class="carousel-item active " data-interval="1000">

                <img src="img/index/Service-01.png" class="d-block  img-fluid imglist" alt="...">

            </div>

        </div>




    </div>
    <br>
    <br>









    <br>
    <br>
    <br>












    <script src="node_modules/jquery/dist/jquery.min.js"></script> <!-- sc เลือก src -->
    <script src="node_modules/popper.js/dist/popper.min.js"></script>
    <script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>

</body>

</html>