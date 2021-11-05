<?php
require_once('connect.php');

function Refresh($link)
{
    header('Refresh:0; url=../' . $link . '');
};
if (isset($_POST['submitproduct'])) {
    
    //echo '<pre>';
    //print_r($_POST);
    //print_r($_FILES['file']); // ชื่อ NAME ใน HTML
    //echo '</pre>';

    $temp = explode('.', $_FILES['file']['name']);
    $newname = round(microtime(true) * 5678) . '.' . end($temp);
    //print_r($newname);
    $url = '../img/menu/' . $newname;
    if (move_uploaded_file($_FILES['file']['tmp_name'], $url)) {
        $sqlmenu = "INSERT INTO `menu` ( `Categories_ID`,`Rest_ID`, `Menu_Name`, `Menu_Details`,`Menu_Price`, `Menu_Calorie`, `Menu_Photo` ) 
                            VALUES ( '" . $_POST['categoriestype'] . "','" . $_POST['restid'] . "', '" . $_POST['menuname'] . "', '" . $_POST['menudetail'] . "','" . $_POST['price'] . "',
                                                                                        '" . $_POST['calorie'] . "',  '" . $newname . "');";
        $resultmenu = $conn->query($sqlmenu) or die($conn->error);
    }

    if ($resultmenu) {
        Refresh('productowner.php');
        //header('Refresh:0; url=../login.php');
        echo "<script> alert('เพิ่มเมนูสำเร็จ'); </script>";
    } else {
        Refresh('productowner.php');
        echo "<script> alert('เพิ่มเมนูไม่สำเร็จ กรุณาติดต่อคนดูแลระบบ'); </script>";
        
    }
}