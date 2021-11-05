<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php
    include('include/importcss.php'); // เรียกใช่ไฟล์ include css
    ?>
    <link rel="icon" href="img/index/logofood.png">
    <title>webservice</title>
    <?php
    require_once('php/connect.php');
    include('include/navber.php');
    //session_start();

    if (!isset($_SESSION["ID"])) {
        header('location:index.php');
    }
    $sql = "SELECT * FROM `restaurant` WHERE `User_ID`= '" . $_SESSION["ID"] . "'"; // alt  + 96
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
                <h1 class="display-4 text-center">แก้ไขข้อมูลร้าน</h1>


            </div>
        </div>
    </div>

    <div class="container">
        <div class="py-3">

            <img src="img/restaurant/<?php echo $row['Rest_Img']; ?>" alt="<?php echo $row['Rest_Img']; ?>"
                class="img-profile rounded-circle ">

            <!-- Button trigger modal -->
            <button type="button" class="btn mx-auto d-block btn-primary" data-toggle="modal"
                data-target="#exampleModal">
                เปลี่ยนรูปภาพ
            </button>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">แก้ไขรูปร้าน</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="php/updatephoto.php" method="POST" enctype="multipart/form-data">
                            <div class="modal-body">
                                <div class="custom-file " data-callback=" PhotoChcallback">
                                    <input type="file" class="custom-file-input profile-input" id="file"
                                        aria-describedby="inputGroupFileAddon01" name="file">
                                    <label class=" custom-file-label" for="inputGroupFile01">เลือกไฟล์</label>
                                </div>

                                <figure class="figure d-none  ">
                                    <img id="imgprofile" alt="profile.png"
                                        class="figure-img img-fluid rounded-circle mr-auto">
                                </figure>





                            </div>
                            <input type="hidden" name="idrestaurantphoto" value="<?php echo $row['Rest_ID'] ?>">
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                                <button type="submit" name="submitrestaurantupdate" id="submitrestaurantupdate"
                                    class="btn btn-primary" disabled>บันทึก</button>
                            </div>

                        </form>



                    </div>
                </div>
            </div>
        </div>




        <form class="form" id="Formupdatauser" method="post" action="php/update.php">

            <div class="form-group">

                <label class="textprofile">ชื่อร้าน</label>
                <input type="text" class="form-control" id="Rest_Name" name="Rest_Name" placeholder="ชื่อร้าน"
                    value="<?php echo $row['Rest_Name']; ?>" required>
                </input>
                <input type="hidden" name="idtype" value="<?php echo $row['Rest_ID']; ?>">



                <div class="container">
                    <div class="row py-4 ">

                        <button type="submit" name="submitUpdatetype"
                            class="btn btn-primary btn-lg col float-left">บันทึก</button>
                        <div class="col"></div>
                        <a href="index.php" class="btn btn-secondary btn-lg col float-right">
                            ยกเลิก
                        </a>

                    </div>

                </div>
            </div>
        </form>



























        <?php
        include('include/importjavascript.php');
        ?>

</body>

</html>