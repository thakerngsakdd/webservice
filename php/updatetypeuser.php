<?php
require_once('connect.php');
//echo $_POST['Formupdatauser'];

print_r($_POST);
$UserID = ($_GET["user"]);
//echo $UserID;
//print_r($_POST['Userlevel']);
//print_r($_POST['IDuser']);
print_r($_POST['submitUpdate']);

if (isset($_POST['submitUpdate'])) {
    //echo 'มี';
    $sqlUpdate = "UPDATE `user` SET 
            `User_Type` = '" . $_POST['Userlevel'] . "' 
                
            WHERE `user`.`User_ID` = '" . $UserID . "'";

    $result = $conn->query($sqlUpdate) or die($conn->error);

    if ($result) {
        //echo 'แก้ไข้ข้อมูลสำเร็จ';
        echo "<script> alert('แก้ไขข้อมูลสำเร็จ'); </script>";
        header('Refresh:0; url=../manageuser.php');
    } else {
        //echo 'ไม่สำเร็จ';
        echo "<script> alert('แก้ไขข้อมูลไม่สำเร็จ'); </script>";
        header('Refresh:0; url=../manageuser.php');
    }
} else {
    echo 'ไม่เข้า';
    header('location:../index.php');
}

//echo '<pre>', print_r($_POST), '</pre>';

//echo $_SESSION['ID'];