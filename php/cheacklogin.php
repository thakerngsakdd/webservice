<?php
require_once('connect.php');

$username = $_POST['username'];
$password = $_POST['password'];

if (isset($_POST['submitlogin'])) {
    // echo '<pre>', print_r($_POST), '</pre>';

    // echo $username;
    //echo $password;

    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM user WHERE User_Username = ? ");
    $stmt->bind_param('s', $username); // s - string  i- int b - bol 
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    //echo '<pre>', print_r($row), '</pre>';
    if (!empty($row)) {
        if (password_verify($password, $row['User_Password'])) {
            //echo 'ok';

            $_SESSION['ID'] = $row['User_ID']; // ต้องมี session_start(); ก่อน ****
            $_SESSION['Username'] = $row['User_Username'];
            $_SESSION['Photo'] = $row['User_Photo'];
            $_SESSION['Firstname'] = $row['User_Firstname'];
            $_SESSION['Lastname'] = $row['User_Lastname'];
            $_SESSION['Telephonenumber'] = $row['User_Telephonenumber'];
            $_SESSION['UserType'] = $row['User_Type'];
            $_SESSION['Email'] = $row['User_Email'];
            header('location:../index.php');
        } else {
            //echo 'ล้มเหลว';
            echo "<script> alert('รหัสผ่านผิด'); </script>";

            header('Refresh:0; url=../login.php');
        }
    } else {
        echo "<script> alert('ไม่พบ Username นี้ในระบบ'); </script>";
        header('Refresh:0; url=../login.php');
        //header('location:../login.php');
    }


    /*
http://www.passwordtool.hu/php5-password-hash-generator
    $hash = '$2y$10$TujmMEDjYGMi8Fckyo/zDOg1s16DL9OcJw4t5V0QkWZ36gVAnZXSO';  // ่ รหัสจากด้าต้าเบส

    if (password_verify('peawpeaw', $hash)) {
        echo 'Password is valid!';
    } else {
        echo 'Invalid password.';
    }
*/
} else {
    echo ('ล้มเหลว');
    header('location:../index.php');
}