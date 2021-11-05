<?php












require_once('php/connect.php');
//$connDB = new mysqli('localhost', 'root', '', 'webservice');
$connDB = $GLOBALS['conn'];
$connDB->set_charset("utf8");

?>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/index/logofood.png">
    <title>webservice</title>
    <?php

    include('include/importcss.php');
    include('include/navber.php');

    //print_r($_SESSION);
    //$_SESSION['ses_php_var'] = $_GET['sendVal'];
    //$_SESSION['ses_php_var'] = $_POST['sendVal'];
    //$_SESSION['Typeid'] = $_POST['Typeid'];
    //print_r($_POST);
    ?>
</head>

<?php

// $ID = 23;
$ID = $_SESSION['ID'];
$select = "SELECT * FROM `restaurant` WHERE `User_ID` = $ID";
//echo $select;
$result = mysqli_query($connDB, $select);
$row = $result->fetch_assoc();
//print_r($row);



?>

<body>




    <div class="container-fluid py-3">
        <div class="text-right">
            <p>
                <a class="btn btn-primary" data-toggle="collapse" href="#collapseExample" role="button"
                    aria-expanded="false" aria-controls="collapseExample">
                    เพิ่มสินค้าใหม่
                </a>
                <!--
            <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample"
                aria-expanded="false" aria-controls="collapseExample">
                Button with data-target
            </button>

            -->
            </p>
        </div>

        <div class="collapse" id="collapseExample">
            <div class="card card-body">
                <form action="php/insertmenu.php" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">





                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label py-2 ">
                                <h3><?php echo $row['Rest_Name'] ?></h3>
                            </label>

                        </div>

                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-2 col-form-label py-2 ">ชื่อสินค้า</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="menuname" name="menuname"
                                    placeholder="ชื่อสินค้า" required>
                            </div>
                        </div>
                        <input type="hidden" name="restid" id="restid" value="<?php echo $row['Rest_ID'] ?>">


                        <div class=" form-group row">
                            <label for="exampleFormControlSelect1" class="py-2 col-sm-2">เลือกหมวดหมู่</label>
                            <select class="form-control col-sm-5 mx-3" id="categoriestype" name="categoriestype"
                                required>
                                <option value="" selected>กรุณาเลือกหมวดหมู่</option>

                                <?php
                                $selectTypeproduct = "SELECT * FROM categories";
                                $resultTypeproduct = mysqli_query($conn, $selectTypeproduct);
                                while ($row = mysqli_fetch_array($resultTypeproduct)) { ?>
                                <option value="<?php echo $row["Categories_ID"]; ?>">
                                    <?php echo $row["Categories_Name"]; ?>
                                </option>

                                <?php
                                }
                                ?>

                            </select>
                        </div>

                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-2 col-form-label py-2">ราคาสินค้า</label>
                            <div class="col-sm-5">
                                <input type="number" class="form-control" id="price" name="price" min="1"
                                    placeholder="ราคาสินค้า" max='9999999' required>
                            </div>
                            <label for="inputPassword" class="col-sm-2 col-form-label py-2">บาท</label>

                        </div>
                        <div>
                            <div class="form-group row">
                                <label for="inputPassword" class="col-sm-2 col-form-label py-2">แคลอรี่</label>
                                <div class="col-sm-5">
                                    <input type="number" class="form-control" id="calorie" name="calorie" min="1"
                                        placeholder="แคลอรี่" max='9999999' required>
                                </div>

                            </div>


                            <div class="form-group">
                                <label for="exampleFormControlTextarea1" class="py-2">รายละเอียดสินค้า</label>
                                <textarea class="form-control" id="menudetail" name="menudetail" rows="5"
                                    placeholder="รายละเอียดสินค้า" required></textarea>
                            </div>

                            <div class="form-group row ">

                                <label class="col-sm-1 py-2">รูปสินค้า</label>
                                <div class="custom-file col-sm-5" data-callback=" PhotoChcallback">
                                    <input type="file" class="custom-file-input product-file" id="file"
                                        aria-describedby="inputGroupFileAddon01" name="file">
                                    <label class=" custom-file-label product-label"
                                        for="inputGroupFile01">เลือกไฟล์</label>
                                </div>
                            </div>
                            <figure class="figure d-none text-center m-2">
                                <img id="imgproduct" alt="product" class="figure-img img-fluid ">
                            </figure>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="reset" data-toggle="collapse"
                                data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                ปิด
                            </button>
                            <button type="submit" name="submitproduct" id="submitproduct" class="btn btn-primary"
                                disabled>เพิ่มเมนูใหม่</button>
                        </div>

                </form>


            </div>
        </div>


    </div>

    <?php
// $ID = 23;
$ID = $_SESSION['ID'];
$select = "SELECT * FROM `restaurant` WHERE `User_ID` = $ID";
//echo $select;
$result = mysqli_query($connDB, $select);
$row = $result->fetch_assoc();
//print_r($row);



?>






    <div class="container">

        <div class="py-3">


            <?php
            ini_set('display_errors', 1);
            error_reporting(~0);
            //echo $_POST;
            $strKeyword = null;


            ?>

            <form name="frmSearch" method="post" action="<?php echo $_SERVER['SCRIPT_NAME']; ?>" <div
                class="form-group row">
                <label for="inputPassword" class="col-2 col-form-label py-2 ">ค้นหาชื่อสินค้า</label>
                <div class="col-7">
                    <input type="text" class="form-control" id="txtKeyword" name="txtKeyword"
                        placeholder="ค้นหาชื่อสินค้า" maxlength="50" value="<?php echo $strKeyword; ?>">
                </div>
                <div class="col-3">
                    <input class="btn btn-light" type="submit" value="Search">
                </div>
        </div>
        </form>

        <?php
        if (isset($_POST["txtKeyword"])) {
            //echo $_POST["txtKeyword"];
            $strKeyword = $_POST["txtKeyword"];
            $keyword =  ($strKeyword);
            //echo $keyword;
            $selectproduct = "SELECT * FROM `menu`,`restaurant` WHERE `menu`.`Rest_ID` = `restaurant`.`Rest_ID`AND `restaurant`.`User_ID` = '" . $ID . "' AND `menu`.`Menu_Name` LIKE '%" . $keyword . "%' ";
            $resultproduct = mysqli_query($connDB, $selectproduct);
            $selectproduct2 = "SELECT * FROM `menu`,`restaurant` WHERE `menu`.`Rest_ID` = `restaurant`.`Rest_ID` AND `restaurant`.`User_ID` = '" . $ID . "' AND `menu`.`Menu_Name` LIKE '%" . $keyword . "%' ";
            $resultproduct2 = mysqli_query($connDB, $selectproduct);
            $ckrow = mysqli_fetch_array($resultproduct2);

            if (!isset($ckrow)) {

                //echo 'ไม่พบสินค้า';
        ?>
        <div class="col-7 text-center mx-auto ml-2">
            <div class="alert alert-danger alert-dismissible fade show " role="alert">
                !!!! ไม่พบสินค้าที่ค้นหาในระบบ
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>


        <?php

                $selectproduct = "SELECT * FROM `menu`,`restaurant` WHERE `menu`.`Rest_ID` = `restaurant`.`Rest_ID`AND `restaurant`.`User_ID` = '" . $ID . "' ORDER BY `menu`.`Menu_Name` ASC";
                $resultproduct = mysqli_query($connDB, $selectproduct);
            }
        } else {

            $selectproduct = "SELECT * FROM `menu`,`restaurant` WHERE `menu`.`Rest_ID` = `restaurant`.`Rest_ID`AND `restaurant`.`User_ID` = '" . $ID . "' ORDER BY `menu`.`Menu_Name` ASC";
            $resultproduct = mysqli_query($connDB, $selectproduct);
        }
        ?>


    </div>

    <?php
                            
    // echo '<pre>';
    // print_r($resultproduct);
    // $rowproduct = mysqli_fetch_array($resultproduct);
    // print_r($rowproduct);
    // //echo $rowproduct["Type_Name"];

    // while ($rowproduct = mysqli_fetch_array($resultproduct)) {
    //     echo "<br>";
    //     echo ($rowproduct["Product_ID"]);
    // }
    // echo '</pre>';
    ?>


    </div>


    <div class="container-fluid py-2">
        <div class="card ">
            <h5 class="card-header text-center">ร้าน<?php echo $row['Rest_Name'] ?></h5>

            <div class="py-2">
                <table class="table table-bordered table-responsive-sm">
                    <thead>
                        <tr>
                            <th width="10%" class="text-center">ชื่อสินค้า</th>
                            <th width="25%" class="text-center">ชื่อสินค้า</th>
                            <th width="15%" class="text-center">รายละเอียด</th>
                            <th width="15%" class="text-center">ราคา</th>
                            <th width="15%" class="text-center">แคลอรี่</th>
                            <th width="12%" class="text-center"></th>
                            <th width="12%" class="text-center"></th>
                            <th width="6%" class="text-center"></th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php



                            
                        // echo '<pre>';
                        // print_r($resultproduct);
                        // $rowproduct = mysqli_fetch_array($resultproduct);
                        // print_r($rowproduct);
                        // //echo $rowproduct["Type_Name"];

                        // while ($rowproduct = mysqli_fetch_array($resultproduct)) {
                        //     echo "<br>";
                        //     echo ($rowproduct["Product_ID"]);
                        // }
                        // echo '</pre>';

                            /*   
                            Array
                                (
                                    [0] => 31
                                    [Product_ID] => 31
                                    [1] => 37
                                    [Type_ID] => 37
                                    [2] => sdasd
                                    [Product_Name] => sdasd
                                    [3] => asdasd
                                    [Product_Details] => asdasd
                                    [4] => 1000000000.00
                                    [Product_Price] => 1000000000.00
                                    [5] => 23
                                    [Product_Balance] => 23
                                    [6] => 12213
                                    [Product_Photo] => 12213
                                    [7] => 2020-03-11
                                    [date_save] => 2020-03-11
                                    [8] => 2
                                    [Warranty_ID] => 2
                                    [9] => 37
                                    [10] => adsadqdas
                                    [Type_Name] => adsadqdas
                                )



                        */

                        while ($rowproduct = mysqli_fetch_array($resultproduct)) {
                        ?>
                        <tr>
                            <th width="12%" class="text-center"><img class="img-responsive"
                                    src="img/menu/<?php echo $rowproduct["Menu_Photo"] ?>"
                                    alt="<?php echo $rowproduct["Menu_Photo"] ?>" width="120" height="80">
                            </th>

                            <th class="text-center"><?php echo $rowproduct["Menu_Name"] ?></th>
                            <td class="text-center"><?php echo $rowproduct["Menu_Details"] ?></td>
                            <td class="text-center"><?php echo $rowproduct["Menu_Price"] ?></td>
                            <td class="text-center"><?php echo $rowproduct["Menu_Calorie"] ?></td>
                            <td>

                                <div class="mx-auto text-center">
                                    <input type="button" name="edit" value="รายละเอียด"
                                        id="<?php echo $rowproduct["Menu_ID"]; ?>"
                                        class="btn btn-info  btn-sm  view_dataproduct" />

                                </div>


                            </td>
                            <td>
                                <div class="mx-auto text-center">
                                    <input type="button" name="edit" value="แก้ไขข้อมูลเมนู"
                                        id="<?php echo $rowproduct["Menu_ID"]; ?>"
                                        class="btn btn-info  btn-sm  edit_dataproduct" />
                                    <div class="py-1"></div>
                                    <!-- <a href="updatephoto.php?menu_ID=<?php
                                                                            echo $rowproduct["Menu_ID"];
                                                                            ?>"
                                        class="btn btn-info  btn-sm  edit_dataphoto">
                                        เปลี่ยนรูปสินค้า

                                    </a> -->

                                </div>


                            </td>
                            <td>
                                <div class="text-center">
                                    <a href="php/delete.php?menu_ID=<?php
                                                                            echo $rowproduct["Menu_ID"];
                                                                            ?>" style="color:#000000" ">
                                                            <i class=" fas fa-trash-alt"></i></a>
                                </div>

                            </td>
                        </tr>

                        <?php
                        }
                        ?>

                    </tbody>


                </table>


            </div>
        </div>
    </div>




















    <?php
    include('include/importjavascript.php');
    ?>
</body>
<div id="dataModal" class="modal fade">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">รายละเอียดสินค้า</h4>
            </div>
            <div class="modal-body" id="detailproduct">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>




<div id="add_dataproduct_Modal" class="modal fade">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">แก้ไขสินค้า</h4>
            </div>
            <div class="modal-body">

                <form action="php/update.php" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">

                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-2 col-form-label py-2 ">ชื่อสินค้า</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" id="Menu_Name" name="Menu_Name"
                                    placeholder="ชื่อสินค้า" required>
                            </div>
                        </div>










                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-2 col-form-label py-2">ราคาสินค้า</label>
                            <div class="col-sm-5">
                                <input type="number" class="form-control" id="Menu_Price" name="Menu_Price"
                                    placeholder="ราคาสินค้า" min="1" max="9999999" required>
                            </div>
                            <label for="inputPassword" class="col-sm-2 col-form-label py-2">บาท</label>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-2 col-form-label py-2">แคลอรี่</label>
                            <div class="col-sm-5">
                                <input type="number" class="form-control" id="Menu_Calorie" name="Menu_Calorie"
                                    placeholder="แคลอรี่" min="1" max="9999999" required>
                            </div>

                        </div>




                        <div class="form-group">
                            <label for="exampleFormControlTextarea1" class="py-2">รายละเอียดสินค้า</label>
                            <textarea class="form-control" id="Menu_Details" name="Menu_Details" rows="5"
                                placeholder="รายละเอียดสินค้า" required></textarea>
                        </div>



                        <input type="hidden" name="Menu_ID" id="Menu_ID" />
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" name="submitproductowner" id="submitproductowner"
                                class="btn btn-primary">บันทึก</button>
                        </div>
                </form>


                <!--
                    <form method="post" id="update_form" action="php/update.php">
                    <label>ชื่อสินค้า</label>
                    <input type="text" name="name" id="name" class="form-control" />
                    <br />

                   <input type="hidden" name="product_ID" id="product_ID" />
                    <input type="submit" name="insert" id="insert" value="Insert" class="btn btn-success" />
                </form>
                <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
                
                    -->
            </div>

        </div>
    </div>
</div>




<script>

</script>