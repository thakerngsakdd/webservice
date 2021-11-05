<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php
    include('include/importcss.php'); // เรียกใช่ไฟล์ include css    

    ?>



    <title>Service</title>
</head>

<?php
require_once("php/connect.php");

$sql = "SELECT * FROM categories ORDER BY `Categories_ID` DESC";
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
                <h4 class="title text-center">หมวดหมู่อาหาร</h4>
                <a href="categories.php" class="ml-4"><i class="fas fa-redo-alt"></i> รีเซ็ต</a>
            </div>
            <div class="content">
                <div class="content table-responsive table-full-width">
                    <table class="table table-striped">


                        <div class="container">

                            <thead>
                                <th width="10%"><b>รหัสหมวดหมู่</b></th>
                                <th width="70%" class="text-center"><b>ชื่อหมวดหมู่อาหาร</b></th>
                                <th width="10%"><b></b></th>
                                <th width="10%"><b></b></th>

                            </thead>
                            <tbody>

                                <?php
                                while ($row = mysqli_fetch_array($query)) { ?>
                                <tr>
                                    <div class="">
                                        <td class="text-sm-right px-5"><?php echo $row["Categories_ID"]; ?></td>
                                    </div>

                                    <td class="text-sm-left px-5"><?php echo $row["Categories_Name"]; ?></td>

                                    <td>
                                        <div class="container">
                                            <input type="button" name="edit" value="แก้ไขหมวดหมู่อาหาร"
                                                id="<?php echo $row["Categories_ID"]; ?>"
                                                class="btn btn-info  btn-sm  edit_data" />

                                        </div>


                                    </td>
                                    <td>
                                        <div class="text-center">
                                            <a href="php/deletecategories.php?admindelete_ID=<?php
                                                                                            echo $row["Categories_ID"];
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
        <div class="card my-4">

            <div class="header py-3">
                <h4 class="title text-center">เพิ่มหมวดหมู่อาหาร</h4>
            </div>
            <div class="container-fluid">
                <form action="php/addtypecategories.php" method="post">


                    <div class="form-row mx-sm-3 mb-2">
                        <label for="exampleFormControlInput1">เพิ่มหมวดหมู่อาหาร</label>
                        <input type="text" class="form-control mb-2 my-2" id="typeproduct" name="typeproduct"
                            placeholder="หมวดหมู่อาหาร" maxlength="70" required>

                    </div>
                    <button type="submit" class="btn btn-success btn-lg  float-right  mb-2  mx-3 my-1 px-5 "
                        id="addtype" name="addtype">บันทึกหมวดหมู่อาหารใหม่</button>

                </form>

            </div>

        </div>



    </div>



    <div id="dataModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Employee Details</h4>
                </div>
                <div class="modal-body" id="employee_detail">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>




    <div id="add_data_Modal" class="modal fade">
        <div class="modal-dialog">

            <div class="modal-content">
                <div class="modal-header">

                    <h4 class="modal-title mx-auto">แก้ไขหมวดหมู่อาหาร</h4>
                    <button type="button" class="close  mr-auto" data-dismiss="modal">&times;</button>

                </div>
                <div class="modal-body">
                    <form method="post" id="Categories" action="php/update.php">
                        <label>ชื่อหมวดหมู่อาหาร</label>
                        <input type="text" name="Categories_name" id="Categories_name" class="form-control"
                            maxlength="70" />
                        <br />
                        <input type="hidden" name="Categories_id" id="Categories_id" />


                </div>
                <div class="modal-footer">
                    <input type="submit" name="Categories" id="Categories" value="อัพเดท" class="btn btn-success" />
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <?php
    include('include/importjavascript.php'); // เรียกใช่ไฟล์ include javascript
    ?>
</body>






</script>

</html>