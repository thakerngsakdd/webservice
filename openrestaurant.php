<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <?php
    include('include/importcss.php'); // เรียกใช่ไฟล์ include css
    ?>
    <link rel="stylesheet"
        href="https://earthchie.github.io/jquery.Thailand.js/jquery.Thailand.js/dist/jquery.Thailand.min.css">
    <link rel="icon" href="img/index/Service-01.png">
    <title>webservice</title>
    <?php
    require_once('php/connect.php');
    include('include/navber.php');
    //session_start();

    if (!isset($_SESSION["ID"])) {
        header('location:index.php');
    }
    $sql = "SELECT * FROM `user` WHERE `User_ID`= '" . $_SESSION["ID"] . "'"; // alt  + 96
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    //echo $result->num_rows;
    if (!$result->num_rows) {
        header('location:index.php');
    }

    //print_r($row);
    ?>
</head>

<body>
    <div class="container">
        <div class="jumbotron jumbotron-fluid ">
            <div class="container my-5">
                <h1 class="display-4 text-center">คำขอเปิดร้าน</h1>


            </div>
        </div>
    </div>
    <div class="container">
        <form action="php/insertrestaurant.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="inputname">ชื่อร้าน</label>
                <input type="text" class="form-control" id="nameproduct" name="nameproduct" placeholder="ชื่อร้าน"
                    required>

            </div>

            <div class="form-group">
                <label for="inputAddress">ที่อยู่</label>
                <input type="text" class="form-control" id="Address" name="Address"
                    placeholder="ที่อยู่ บ้านเลขที่ ถนน ซอย" required>
            </div>
            <div class="form-group">
                <label>รหัสไปรษณีย์</label>
                <input type="text" class="form-control" id="zipcode" name="zipcode" placeholder="รหัสไปรษณีย์" required>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="inputCity">แขวง / ตำบล </label>
                    <input type="text" class="form-control" id="district" name="district" placeholder="แขวง / ตำบล"
                        required>
                </div>
                <div class="form-group col-md-4">
                    <label for="inputCity">เขต / อำเภอ</label>
                    <input type="text" class="form-control" id="amphoe" name="amphoe" placeholder="เขต / อำเภอ"
                        required>
                </div>
                <div class="form-group col-md-4">
                    <label for="inputZip">จังหวัด</label>
                    <input type="text" class="form-control" id="province" name="province" placeholder="จังหวัด"
                        required>
                </div>
            </div>
            <div class="form-group">
                <label for="inputLatitude">ละติจูด</label>
                <input type="text" class="form-control" id="latitude" name="latitude" placeholder="ตำแหน่งละติจูด"
                    required>
            </div>
            <div class="form-group">
                <label for="inputLongtitude">ลองติจูด</label>
                <input type="text" class="form-control" id="longtitude" name="longtitude" placeholder="ตำแหน่งลองติจูด"
                    required>
            </div>


            <div class="form-group row ">

                <label class="col-sm-2 py-2">รูปร้านอาหาร</label>
                <div class="custom-file col-sm-6 mx-sm-3" data-callback=" PhotoChcallback">
                    <input type="file" class="custom-file-input product-file" id="file"
                        aria-describedby="inputGroupFileAddon01" name="file">
                    <label class=" custom-file-label product-label" for="inputGroupFile01">เลือกไฟล์</label>
                </div>
            </div>
            <figure class="figure d-none text-center m-2">
                <img id="imgproduct" alt="product" class="figure-img img-fluid ">
            </figure>

            <div class="modal-footer">
                <a href="maptest.php" class="btn btn-info mb-2  float-right">
                    หาตำแหน่ง ละติจูด ลองจิจูด
                </a>
                <button type="reset" class="btn btn-secondary" type="button" data-toggle="collapse"
                    data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                    รีเซ็ต
                </button>
                <button type="submit" name="submitrequestproducttype" id="submitproduct" class="btn btn-primary"
                    disabled>
                    ส่งคำขอ</button>
            </div>


        </form>

    </div>































</body>

</html>



<?php
include('include/importjavascript.php');
?>
<script type="text/javascript"
    src="https://earthchie.github.io/jquery.Thailand.js/jquery.Thailand.js/dependencies/JQL.min.js"></script>
<script type="text/javascript"
    src="https://earthchie.github.io/jquery.Thailand.js/jquery.Thailand.js/dependencies/typeahead.bundle.js"></script>
<script type="text/javascript"
    src="https://earthchie.github.io/jquery.Thailand.js/jquery.Thailand.js/dist/jquery.Thailand.min.js"></script>
<script>
$.Thailand({
    $district: $('#district'), // input ของตำบล
    $amphoe: $('#amphoe'), // input ของอำเภอ
    $province: $('#province'), // input ของจังหวัด
    $zipcode: $('#zipcode'), // input ของรหัสไปรษณีย์
})
</script>