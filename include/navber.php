<?php
include("php/connectns.php");
?>
<nav class="navbar navbar-expand-lg  ">


    <!-- <a class="navbar-brand" href="index.php"><img src="img/index/sv2.png" alt="img/index/sv2.png "
            class="logo img-fluid"></a> -->
    <button class="navbar-toggler  btn-navber " type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
        aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">

        <span class="navbar-toggler-icon "><i class="fas fa-bars py-1"></i></span>


    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <?
        # ml-auto เลื่อนไปทางขวา
        // ข้อความนี้ก็ไม่ถูกแสดงผลเช่นกัน (รูปแบบที่2)
        ?>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">หน้าหลัก <span class="sr-only">(current)</span></a>
                </li>

                <!--
                <li class=" nav-item ">
                    <a class=" nav-link" href="index.php">โปรโมชั่นสินค้า </a>
                </li>
                -->

            </ul>

            <ul class="navbar-nav ml-auto">
                <?php
                if (!isset($_SESSION['ID'])) {



                ?>
                <li class="nav-item">
                    <a class="nav-link" href="login.php">ลงชื่อเข้าใช้</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="register.php">สมัครสมาชิก</a>
                </li>


                <?php
                }
                if (isset($_SESSION['ID'])) {



                    if ($_SESSION['Username'] == 'Admin') {
                        session_destroy();
                        header('location:index.php');
                    }



                ?>

                <?php
                    if ($_SESSION['UserType'] == 'user') {
                    ?>
                <!-- <li class="nav-item ">
                    <a class="nav-link" href="cart.php"><i class="fas fa-shopping-cart"></i> รายการสินค้า </a>
                </li> -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        ยินดีต้อนรับคุณ <?php echo $_SESSION['Username']; ?> <img
                            src="img/profile/<?php echo $_SESSION['Photo']; ?>" alt="<?php echo $_SESSION['Photo']; ?>"
                            class="iconphoto img-fluid rounded-circle">
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="profile.php">ข้อมูลส่วนตัว</a>
                        <!-- <a class="dropdown-item" href="prodile_editpassword.php">แก้ไขรหัสผ่าน</a> -->
                        <?php
                                $check = "SELECT * FROM `restaurant` WHERE `User_ID` = '" . $_SESSION['ID'] . "' ";
                                $check = $connect->query($check) or die($connect->error);

                                if (!$check->num_rows) {
                                ?>
                        <a class="dropdown-item" href="
openrestaurant.php">ขอเปิดร้านอาหาร</a>
                        <?php
                                }
                                if ($check->num_rows) { ?>
                        <a class="dropdown-item" href="
">กำลังตรวจสอบคำขอ</a>

                        <?php
                                }
                                ?>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="php/logout.php">ออกจากระบบ</a>
                    </div>
                </li>
                <?php
                    }
                    ?>

                <?php
                    if ($_SESSION['UserType'] == 'admin') {
                    ?>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        จัดการระบบ
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="manageuser.php">จัดการสมาชิกในระบบ</a>
                        <div class="dropdown-divider"></div>

                        <a class="dropdown-item" href="categories.php">จัดการหมวดหมู่อาหาร</a>
                        <!-- เอาประกันออก
                        <a class="dropdown-item" href="warranty.php">ประเภทการรับประกัน</a>
                        -->

                        <a class="dropdown-item" href="product.php">จัดการเมนูอาหาร</a>
                        <a class="dropdown-item" href="requestopen.php">คำขอเปิดร้านให้เว็บ</a>

                        <!-- <div class="dropdown-divider"></div> -->
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        ยินดีต้อนรับคุณ <?php echo $_SESSION['Username']; ?> <img
                            src="img/profile/<?php echo $_SESSION['Photo']; ?>" alt="<?php echo $_SESSION['Photo']; ?>"
                            class="iconphoto img-fluid rounded-circle">
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="profile.php">ข้อมูลส่วนตัว</a>
                        <!-- <a class="dropdown-item" href="prodile_editpassword.php">แก้ไขรหัสผ่าน</a> -->
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="php/logout.php">ออกจากระบบ</a>
                    </div>
                </li>
                <?php
                    }
                    ?>
                <?php
                    //
                    if ($_SESSION['UserType'] == 'Restaurantowner') {

                    ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        จัดการระบบ
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="restaurantupdate.php">แก้ไขชื่อร้าน</a>
                        <!-- เอาประกันออก
                        petition.php
                        <a class="dropdown-item" href="warranty.php">ประเภทการรับประกัน</a>                        -->

                        <a class="dropdown-item" href="productowner.php">จัดการเมนูอาหาร</a>
                        <!-- <div class="dropdown-divider"></div> -->
                        <!-- <a class="dropdown-item" href="oderproductowner.php">ตรวจสอบการสั่งซื้อสินค้า</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="petition.php">ร้องเรียน</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="totalsellowner.php">รายงานสรุปการขายสินค้า</a> -->

                    </div>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        ยินดีต้อนรับคุณ <?php echo $_SESSION['Username']; ?> <img
                            src="img/profile/<?php echo $_SESSION['Photo']; ?>" alt="<?php echo $_SESSION['Photo']; ?>"
                            class="iconphoto img-fluid rounded-circle">
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="profile.php">ข้อมูลส่วนตัว</a>
                        <!-- <a class="dropdown-item" href="prodile_editpassword.php">แก้ไขรหัสผ่าน</a> -->
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="php/logout.php">ออกจากระบบ</a>
                    </div>
                </li>

                <?php

                    }
                    ?>
                <?php
                }
                ?>





            </ul>
        </div>

    </div>






    </div>






</nav>