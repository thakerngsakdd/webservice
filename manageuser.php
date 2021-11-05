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
require_once("php/connect.php");

$sql = "SELECT * FROM user";
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
                <h4 class="title text-center">Manage Admin</h4>
            </div>
            <div class="content">
                <div class="content table-responsive table-full-width">
                    <table class="table table-striped">


                        <div class="row">
                            <form name="frmMain" method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                                <input type="hidden" name="hdnCmd" value="">
                                <thead>
                                    <th width="15%"><b>Username</b></th>
                                    <th width="15%"><b>ชื่อ</b></th>
                                    <th width="15%"><b>นามสกุล</b></th>
                                    <th width="15%"><b>เบอร์โทร</b></th>
                                    <th width="15%"><b>สถานะ</b></th>
                                    <th width="15%"><b></b></th>

                                </thead>
                                <tbody>

                                    <?php
                                    while ($result = mysqli_fetch_array($query, MYSQLI_ASSOC)) { ?>
                                    <tr>
                                        <td><?php echo $result["User_Username"]; ?></td>
                                        <td><?php echo $result["User_Firstname"]; ?></td>
                                        <td><?php echo $result["User_Lastname"]; ?></td>
                                        <td><?php echo $result["User_Telephonenumber"]; ?></td>
                                        <td><?php echo $result["User_Type"]; ?></td>

                                        <td> &nbsp;&nbsp;

                                            <a id=" edituser" type="submit" name="edituser" href="edituser.php?UserID=<?php
                                                                                                                            echo $result["User_ID"];
                                                                                                                            ?>
                                                                                            " style="color:#000000">
                                                <i class="fas fa-edit"></i></a>&nbsp;&nbsp; &nbsp;&nbsp;
                                            <a href="php/deletuser.php?UserID=<?php
                                                                                    echo $result["User_ID"];
                                                                                    ?>" style="color:#E90000">
                                                <i class="fas fa-trash-alt"></i></a>
                                        </td>

                            </form>
                            </tr>
                            <?php
                                    }
                        ?>



                            </tbody>
                            </form>
                        </div>

                    </table>
                </div>
                <?php
                //include('Include/formAdmin.php');
                ?>
            </div>
        </div>
    </div>








    <?php
    include('include/importjavascript.php'); // เรียกใช่ไฟล์ include javascript
    ?>
</body>

</html>