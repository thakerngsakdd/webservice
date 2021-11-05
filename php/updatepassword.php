<?php

function Refresh($link)
{
    header('Refresh:0; url=../' . $link . '');
};
require_once('connect.php');
//print_r($_POST);
//$username = $_POST['username'];
$password = $_POST['password'];

if (isset($_POST['submitUpdatepassword'])) {
    // echo '<pre>', print_r($_POST), '</pre>';

    // echo $username;
    //echo $password;

    //$username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM user WHERE User_ID = ? ");
    $stmt->bind_param('s', $_SESSION['ID']); // s - string  i- int b - bol 
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    //echo '<pre>', print_r($row), '</pre>';
    if (!empty($row)) {
        if (password_verify($password, $row['User_Password'])) {
            //echo "<script> alert('ผ่าน'); </script>";

            $hashed_password = password_hash($_POST['password1'], PASSWORD_DEFAULT);
            $sqlUpdate = "UPDATE `user` SET `User_Password` = '" . $hashed_password . "'  WHERE `User_ID` = '" . $_SESSION['ID'] . "' ";

            $result = $conn->query($sqlUpdate) or die($conn->error);
            //echo ('บันทึกได้');
            //print_r($response);
            if ($result) {
                echo "<script> alert('แก้ไขรหัสผ่านสำเร็จ'); </script>";
                Refresh('prodile_editpassword.php');
                //header('Refresh:0; url=../login.php');

            } else {
                Refresh('prodile_editpassword.php');
                echo "<script> alert('แก้ไขรหัสไม่ผ่านสำเร็จ' กรุณาติดต่อคนดูแลระบบ'); </script>";
            }
            //echo 'ok';
            // session_start();

            //header('location:../index.php');
        } else {
            //echo 'ล้มเหลว';
            echo "<script> alert('รหัสผ่านผิด'); </script>";

            Refresh('prodile_editpassword.php');
        }
    } else {
        echo "<script> alert('ไม่พบ Username นี้ในระบบ'); </script>";
        //header('Refresh:0; url=../login.php');
        //header('location:../login.php');
    }
} else {
    //echo ('ล้มเหลว');
    header('location:../index.php');
}