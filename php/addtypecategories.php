<?php
//echo '<pre>', print_r($_POST), '</pre>';
//echo $_POST['typeproduct'];

require_once('connect.php');
$sqlinsert = "INSERT INTO `categories` (`Categories_Name`) VALUES ('" . $_POST['typeproduct'] . "');";
function Refresh($link)
{
    header('Refresh:0; url=../' . $link . '');
};

$result = $conn->query($sqlinsert) or die($conn->error);
if ($result) {
    Refresh('categories.php');
    //header('Refresh:0; url=../login.php');
    echo "<script> alert('บันทึกหมวดหมู่สำเร็จ'); </script>";
} else {
    echo "<script> alert('บันทึกหมวดหมู่ล้มเหลว กรุณาติดต่อคนดูแลระบบ'); </script>";
    Refresh('categories.php');
}