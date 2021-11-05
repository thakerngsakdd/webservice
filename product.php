<?php












require_once('php/connect.php');

//$query = "SELECT * FROM producttype ORDER BY `Type_ID` DESC"; // แก้ที่อยู่
//$result = mysqli_query($conn, $query);


//$rowproduct = mysqli_fetch_array($resultproduct);
/*
echo '<pre>';
//print_r($resultproduct);
$rowproduct = mysqli_fetch_array($resultproduct);
print_r($rowproduct);
//echo $rowproduct["Type_Name"];

while ($rowproduct = mysqli_fetch_array($resultproduct)) {
    echo "<br>";
    echo ($rowproduct["Product_ID"]);
}
echo '</pre>';
*/



?>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/index/kaichon.png">
    <title>Service</title>
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


<body>




    <div class="container-fluid py-3">
        <div class="text-right">
            <p>
                <a class="btn btn-primary" data-toggle="collapse" href="#collapseExample" role="button"
                    aria-expanded="false" aria-controls="collapseExample">
                    เพิ่มเมนูใหม่
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
                            <label for="inputPassword" class="col-sm-2 col-form-label py-2 ">ชื่อเมนู</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="menuname" name="menuname"
                                    placeholder="ชื่อเมนู" required>
                            </div>
                        </div>

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
                            <label for="inputPassword" class="col-sm-2 col-form-label py-2">แคลอรี่</label>
                            <div class="col-sm-5">
                                <input type="number" class="form-control" id="calorie" name="calorie" min="1"
                                    placeholder="แคลอรี่" max='9999999' required>
                            </div>

                        </div>


                        <div class="form-group">
                            <label for="exampleFormControlTextarea1" class="py-2">รายละเอียดเมนู</label>
                            <textarea class="form-control" id="menudetail" name="menudetail" rows="5"
                                placeholder="รายละเอียดเมนู" required></textarea>
                        </div>

                        <div class="form-group row ">

                            <label class="col-sm-1 py-2">รูปเมนู</label>
                            <div class="custom-file col-sm-5" data-callback=" PhotoChcallback">
                                <input type="file" class="custom-file-input product-file" id="file1"
                                    aria-describedby="inputGroupFileAddon01" name="file1">
                                <label class=" custom-file-label product-label" for="inputGroupFile01">เลือกไฟล์</label>
                            </div>
                        </div>
                        <figure class="figure d-none text-center m-2">
                            <img id="imgproduct" alt="product" class="figure-img img-fluid ">
                        </figure>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-toggle="collapse"
                            data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                            Close
                        </button>
                        <button type="submit" name="submitmenu1" id="submitmenu1" class="btn btn-primary">Save
                            changes</button>
                    </div>

                </form>


            </div>
        </div>


    </div>








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
                <label for="inputPassword" class="col-2 col-form-label py-2 ">ค้นหาชื่อเมนู</label>
                <div class="col-7">
                    <input type="text" class="form-control" id="txtKeyword" name="txtKeyword" placeholder="ชื่อเมนู"
                        maxlength="50" value="<?php echo $strKeyword; ?>">
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
            $selectproduct = "SELECT * FROM `menu`,`categories` WHERE `menu`.`Type_ID` = `categories`.`Type_ID` AND m.Menu_Name LIKE '%" . $keyword . "%' ";
            $resultproduct = mysqli_query($conn, $selectproduct);
            $selectproduct2 = "SELECT m.Menu_ID,m.Menu_Name,r.Rest_Name,m.Menu_Price,m.Menu_Calorie,m.Menu_Photo FROM menu as m LEFT JOIN restaurant as r ON m.Rest_ID = r.Rest_ID AND m.Menu_Name LIKE '%" . $keyword . "%' ";
            $resultproduct2 = mysqli_query($conn, $selectproduct);
            $ckrow = mysqli_fetch_array($resultproduct2);

            if (!isset($ckrow)) {

                //echo 'ไม่พบสินค้า';
        ?>
        <div class="col-7 text-center mx-auto ml-2">
            <div class="alert alert-danger alert-dismissible fade show " role="alert">
                !!!! ไม่พบเมนูที่ค้นหาในระบบ
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>


        <?php

                $selectproduct = "SELECT m.Menu_ID,m.Menu_Name,r.Rest_Name,m.Menu_Price,m.Menu_Calorie,m.Menu_Photo FROM menu as m LEFT JOIN restaurant as r ON m.Rest_ID = r.Rest_ID ORDER BY m.Menu_Name ASC";
                $resultproduct = mysqli_query($conn, $selectproduct);
            }
        } else {

            $selectproduct = "SELECT m.Menu_ID,m.Menu_Name,r.Rest_Name,m.Menu_Price,m.Menu_Calorie,m.Menu_Photo FROM menu as m LEFT JOIN restaurant as r ON m.Rest_ID = r.Rest_ID ORDER BY m.Menu_Name ASC";
            $resultproduct = mysqli_query($conn, $selectproduct);

            // SELECT m.Menu_ID,m.Menu_Name,r.Rest_Name,m.Menu_Calorie,m.Menu_Photo FROM menu as m LEFT JOIN restaurant as r ON m.Rest_ID = r.Rest_ID


        }
        // $select = "SELECT m.Menu_ID,m.Menu_Name,r.Rest_Name,m.Menu_Calorie,m.Menu_Photo FROM menu as m LEFT JOIN restaurant as r ON m.Rest_ID = r.Rest_ID";
        // $data=SelectData($select);

        //print_r($data);        

        ?>


    </div>


    </div>

    <div class="container-fluid py-2">
        <div class="card ">
            <h5 class="card-header text-center">จัดการเมนูอาหาร</h5>

            <div class="py-2">
                <table class="table table-bordered table-responsive-sm">
                    <thead>
                        <tr>
                            <th width="10%" class="text-center"></th>

                            <th width="15%" class="text-center">เมนู</th>
                            <th width="15%" class="text-center">ร้านอาหาร</th>
                            <th width="15%" class="text-center">ราคา</th>
                            <th width="15%" class="text-center">แคลอรี่</th>
                            <th width="12%" class="text-center"></th>
                            <th width="12%" class="text-center"></th>


                        </tr>
                    </thead>
                    <tbody>
                        <?php



                        // [Menu_ID] => 166 [Menu_Name] => แกงเขียวหวาน [Rest_Name] => [Menu_Calorie] => 320 [Menu_Photo] => 9260436444871.png

                        while ($rowproduct = mysqli_fetch_array($resultproduct)) {
                        ?>
                        <tr>
                            <th width="12%" class="text-center"><img class="img-responsive"
                                    src="img/menu/<?php echo $rowproduct["Menu_Photo"] ?>"
                                    alt="<?php echo $rowproduct["Menu_Photo"] ?>" width="240" height="160">
                            </th>

                            <th class="text-center"><?php echo $rowproduct["Menu_Name"] ?></th>
                            <td class="text-center"><?php echo $rowproduct["Rest_Name"] ?></td>
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
                                        เปลี่ยนรูปเมนู

                                    </a> -->

                                </div>


                            </td>
                            <td>
                                <div class="text-center">
                                    <a href="php/delete.php?admindelete_ID=<?php
                                                                                echo $rowproduct["Menu_ID"];
                                                                                ?>" style="color:#D01313" ">
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

                        <!-- <div class="form-group row">
                            <label for="inputPassword" class="col-sm-2 col-form-label py-2 ">ชื่อเมนู</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" id="Menu_Name" name="Menu_Name"
                                    placeholder="ชื่อเมนู" required>
                            </div>
                        </div>

                        <div class=" form-group row">
                            <label for="exampleFormControlSelect1" class="py-2 col-sm-2">หมวดหมู่อาหาร</label>
                            <select class="form-control col-sm-5 mx-3" id="Categories_ID" name="Categories_ID" required>
                                <option value="" selected>กรุณาเลือกหมวดหมู่</option>
                                <?php
                                $selectwarranty = "SELECT * FROM categories";
                                $resultwarranty = mysqli_query($conn, $selectwarranty);
                                while ($rowwarranty = mysqli_fetch_array($resultwarranty)) { ?>
                                <option value="<?php echo $rowwarranty["Categories_ID"]; ?>">
                                    <?php echo $rowwarranty["Categories_Name"]; ?></option>
                                <?php
                                }
                                ?>

                            </select>
                        </div> -->

                        <input type="hidden" name="Menu_ID" id="Menu_ID">


                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-2 col-form-label py-2">แคลอรี่</label>
                            <div class="col-sm-5">
                                <input type="number" class="form-control" id="Menu_Calorie" name="Menu_Calorie"
                                    placeholder="แคลอรี่" min="1" max="9999999" required>
                            </div>

                        </div>




                        <input type="hidden" name="idproduct" id="idproduct" />
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" name="submitproduct" id="submitproduct"
                                class="btn btn-primary">บันทึก</button>
                        </div>
                </form>

            </div>

        </div>
    </div>
</div>




<script>

</script>