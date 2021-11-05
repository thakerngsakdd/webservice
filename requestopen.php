<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php
    //echo "111111111111111111111111";
    include('include/importcss.php'); // เรียกใช่ไฟล์ include css    

    ?>


    <link rel="icon" href="img/index/logofood.png">
    <title>Food-Delivery</title>
</head>

<?php
require_once("php/connect.php");

$sql = "SELECT * FROM `restaurant`,`user` WHERE `Rest_status`='0' AND user.User_ID = restaurant.User_ID ORDER BY `Rest_ID` DESC";
$query = mysqli_query($conn, $sql);
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
    <div class="container-fluid py-5">

        <div class="card ">
            <div class="header py-3">
                <h4 class="title text-center">ร้านอาหาร</h4>
                <a href="requestopen.php" class="ml-4"><i class="fas fa-redo-alt"></i> รีเซ็ต</a>
            </div>
            <div class="content">
                <div class="content table-responsive table-full-width">
                    <table class="table table-striped">


                        <div class="container">

                            <thead>
                                <th width="10%" class="text-center"><b>รูปร้านอาหาร</b></th>
                                <th width="10%" class="text-center"><b>รหัสร้าน</b></th>
                                <th width="20%" class="text-center"><b>ชื่อร้านอาหาร</b></th>
                                <th width="40%" class="text-center"><b></b>ที่อยู่</th>
                                <th width="10%"><b></b></th>
                                <th width="10%"><b></b></th>

                            </thead>
                            <tbody>

                                <?php
                                while ($row = mysqli_fetch_array($query)) {
                                    //producttype_Img

                                ?>
                                <tr>
                                    <th width="12%" class="text-center"><img class="img-responsive"
                                            src="img/restaurant/<?php echo $row["Rest_Img"] ?>"
                                            alt="<?php echo $row["Rest_Img"] ?>" width="120" height="80">
                                    </th>

                                    <td class="text-center"><?php echo $row["Rest_ID"]; ?></td>
                                    <td class="text-center"><?php echo $row["Rest_Name"]; ?></td>
                                    <td class="text-center"><?php echo $row["Rest_Address"]; ?></td>
                                    <td class="text-center"><?php echo $row["User_Username"]; ?></td>
                                    <td>
                                        <div class="mx-auto text-center">
                                            <a type="button"
                                                href="php/update.php?allow=<?php
                                                                                            echo $row["Rest_ID"];
                                                                                            ?>&&userid=<?php echo $row["User_ID"] ?>"
                                                class="btn btn-warning  btn-sm  ">อนุมัติ</a>
                                        </div>

                                    </td>



                                    <td>
                                        <div class="text-center">
                                            <a href="php/deleterestaurant.php?Type_ID=<?php
                                                                                            echo $row["Rest_ID"];
                                                                                            ?>" style="color:#000000" ">
                                            <i class=" fas fa-trash-alt"></i></a>
                                        </div>


                                    </td>

                                </tr>
                                <?php

                                }
                                ?>



                            </tbody>
                            </form>
                        </div>

                    </table>
                </div>

            </div>
        </div>




    </div>



    <?php
    include('include/importjavascript.php'); // เรียกใช่ไฟล์ include javascript
    ?>
</body>






</script>

</html>