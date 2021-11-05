<?php
require_once("php/connect.php");
$UserID = ($_GET["UserID"]);
//$UserType = ($_GET["Userlevel"]);
//echo $UserID;
//echo $UserType;
//print_r($_POST);
$sql = "SELECT * FROM `user` WHERE `User_ID`= '" . $UserID . "'"; // alt  + 96
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    include('include/importcss.php'); // เรียกใช่ไฟล์ include css
    ?>
    <title>Profile</title>
    <?php
    //session_start();    
    include('include/navber.php');

    if (!isset($_SESSION["ID"])) {
        header('location:index.php');
    }
    $sql = "SELECT * FROM `user` WHERE `User_ID`= '" . $UserID . "'"; // alt  + 96
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    // echo ('<pre>');
    //print_r($row);
    // echo ('</pre>');


    //echo $result->num_rows;  

    //print_r($row);
    ?>
</head>

<body>
    <div class="container">
        <div class="jumbotron jumbotron-fluid ">
            <div class="container my-5">
                <h1 class="display-4 text-center">ประวัติส่วนตัว</h1>


            </div>
        </div>
    </div>
    <div class="container">
        <div class="py-3">

            <img src="img/profile/<?php echo $row['User_Photo']; ?>" alt="profile.png"
                class="img-profile rounded-circle ">

            <!-- Button trigger modal -->



        </div>




        <form class="form" id="Formupdatausertype" method="post"
            action="php/updatetypeuser.php?user=<?php echo $UserID; ?> ">

            <label class="textprofile ">ชื่อของคุณ</label>
            <div class="row ">
                <div class="col">
                    <input type="text" class="form-control" placeholder="ชื่อ" maxlength="30"
                        value="<?php echo $row['User_Firstname']; ?> " name="fname" id="fname" disabled>

                </div>
                <div class="col">
                    <input type="text" class="form-control" placeholder="นามสกุล" id="lname"
                        value="<?php echo $row['User_Lastname']; ?>" name="lname" maxlength="30" disabled>
                </div>
            </div>


            <div class="form-group">

                <label class="textprofile">เบอร์โทร</label>
                <input type="tel" class="form-control" id="phone" name="phone" placeholder="เบอร์โทร"
                    value="<?php echo $row['User_Telephonenumber']; ?> " " disabled>
                            </input>
            </div>

            <div class=" form-group ">
                                <label class=" textprofile">อีเมล </label>
                <input type="email" class="form-control" id="email" name="email"
                    value="<?php echo $row['User_Email']; ?> " placeholder="email@example.com" disabled>
            </div>
            <div class=" form-group ">
                <label class=" textprofile">สถานะแอดมิน&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                <div class="dropdown">
                    <select name="Userlevel" id="Userlevel" class="form-control border-input" required>
                        <option value="" disabled selected>กรุณาเลือก</option>

                        <option value="admin" <?php if ($row['User_Type'] == 'admin') {
                                                    echo "selected='selected'";
                                                } ?>>admin</option>
                        <option value="user" <?php if ($row['User_Type'] == 'user') {
                                                    echo "selected='selected'";
                                                } ?>>user</option>

                    </select>
                </div>
            </div>
            <div class="container">
                <div class="row py-4 ">

                    <button type="submit" name="submitUpdate"
                        class=" btn btn-primary btn-lg col float-left">บันทึก</button>
                    <div class="col"></div>
                    <a href="manageuser.php" class="btn btn-secondary btn-lg col float-right">
                        ยกเลิก
                    </a>

                </div>

            </div>
        </form>



























        <?php
        include('include/importjavascript.php'); // เรียกใช่ไฟล์ include javascript
        ?>



</body>

</html>