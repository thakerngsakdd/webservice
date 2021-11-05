<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php
    include('include/importcss.php'); // เรียกใช่ไฟล์ include css
    ?>
    <link rel="icon" href="img/index/kaichon.png">
    <title>Service</title>
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
                <h1 class="display-4 text-center">ข้อมูลส่วนตัว</h1>


            </div>
        </div>
    </div>

    <div class="container">
        <div class="py-3">

            <img src="img/profile/<?php echo $row['User_Photo']; ?>" alt="profile.png"
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
                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
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
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" name="submitphoto" id="submitphoto" class="btn btn-primary"
                                    disabled>Save
                                    changes</button>
                            </div>

                        </form>



                    </div>
                </div>
            </div>
        </div>




        <form class="form" id="Formupdatauser" method="post" action="php/updatauser.php">

            <label class="textprofile ">ชื่อของคุณ</label>
            <div class="row ">
                <div class="col">
                    <input type="text" class="form-control" placeholder="ชื่อ" maxlength="30"
                        value="<?php echo $row['User_Firstname']; ?> " name="fname" id="fname">

                </div>
                <div class="col">
                    <input type="text" class="form-control" placeholder="นามสกุล" id="lname"
                        value="<?php echo $row['User_Lastname']; ?>" name="lname" maxlength="30">
                </div>
            </div>


            <div class="form-group">

                <label class="textprofile">เบอร์โทร</label>
                <input type="tel" class="form-control" id="phone" name="phone" placeholder="เบอร์โทร"
                    value="<?php echo $row['User_Telephonenumber']; ?>">
                </input>

                <div class=" form-group ">
                    <label class=" textprofile">อีเมล</label>
                    <input type="email" class="form-control" id="email" name="email"
                        value="<?php echo $row['User_Email']; ?> " placeholder="email@example.com">
                </div>

                <div class="container">
                    <div class="row py-4 ">

                        <button type="submit" name="submitUpdateUser"
                            class="btn btn-primary btn-lg col float-left">บันทึก</button>
                        <div class="col"></div>
                        <a href="profile.php" class="btn btn-secondary btn-lg col float-right">
                            ยกเลิก
                        </a>

                    </div>

                </div>
        </form>



























        <?php
        include('include/importjavascript.php');
        ?>

</body>

</html>