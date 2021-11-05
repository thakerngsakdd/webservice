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
</head>

<?php
session_start();
?>
<?php
include('include/navber.php');
// เรียกใช่ไฟล์ include navber


?>
</head>



<body>
    <?php
    //echo '<pre>', print_r($_POST), '</pre>';
    ?>

    <div class="container">
        <div class="row">
            <div class="offset-md-3 col-md-6  mt-5">
                <div class="card">
                    <div class="card-header text-center">
                        สมัครสมาชิก
                    </div>
                    <div class="card-body">

                        <form class="form" id="Formregister" method="post" action="php/CreateUser.php">


                            <label for="formGroupExampleInput">ชื่อของคุณ</label>
                            <div class="row">
                                <div class="col">
                                    <input type="text" class="form-control" placeholder="ชื่อ" maxlength="30"
                                        name="fname" id="fname">



                                </div>
                                <div class="col">
                                    <input type="text" class="form-control" placeholder="นามสกุล" id="lname"
                                        name="lname" maxlength="30">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="formGroupExampleInput">ชื่อผู้ใช้งาน</label>
                                <input type="text" class="form-control" id="user" name="user"
                                    placeholder="ชื่อผู้ใช้งาน" maxlength="30">
                            </div>
                            <div class="form-group">
                                <label for="formGroupExampleInput2">รหัสผ่าน</label>
                                <input type="password" class="form-control" id="password1" name="password1"
                                    placeholder="รหัสผ่าน" maxlength="20">
                            </div>

                            <div class="form-group">
                                <label for="formGroupExampleInput2">ยืนยันรหัสผ่าน</label>
                                <input type="password" class="form-control" id="password2" name="password2"
                                    placeholder="รหัสผ่าน" maxlength="20">
                            </div>

                            <div class="form-group">
                                <label for="formGroupExampleInput">เบอร์โทร</label>
                                <input type="tel" class="form-control" id="phone" name="phone" placeholder="เบอร์โทร"
                                    maxlength="10">
                            </div>

                            <div class=" form-group">
                                <label for="formGroupExampleInput">อีเมล</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    placeholder="email@example.com" maxlength="30">
                            </div>

                            <div class="form-group mb-2 mr-sm-2">
                                <div class="g-recaptcha" data-callback="recaptChcallback"
                                    data-sitekey="6LeWVNsUAAAAAGPk4-yyZACvfIiNwxDNoAuwfxJ_"></div>

                            </div>
                            <div class="container-fluid">
                                <div class="row">

                                    <button type="submit" class="btn btn-primary mb-2 float-left " name="submitRegister"
                                        id="submitRegister">บันทึก</button>

                                    <div class="col"></div>
                                    <a href="index.php" class="btn btn-secondary mb-2  float-right">
                                        ยกเลิก
                                    </a>

                                </div>


                        </form>





                    </div>
                    </form>



                </div>
            </div>
        </div>
    </div>


    <?php
    include('include/importjavascript.php'); // เรียกใช่ไฟล์ include javascript
    ?>


</body>

</html>