<?php
require_once('connect.php');{
    
if (isset($_POST['submitrequestproducttype'])) {
    // echo '<pre>';
    // print_r($_POST);
    // print_r($_FILES['file']);
    // print_r($_SESSION);
    // echo '<pre>';
    
    $address;
    if ($_POST['province'] == "กรุงเทพมหานคร") {
        $address = ("ที่อยู่  " . $_POST['Address'] . "  แขวง  " . $_POST['district'] . " เขต  " . $_POST['amphoe'] . " \nจังหวัด  " . $_POST['province'] . " รหัสไปรษณีย์ " . $_POST['zipcode'] . "");
        //เขต  $_POST['amphoe']  จังหวัด  $_POST['province'] รหัสไปรษณีย์ $_POST['zipcode']"

        //echo $address;
    } else {
        $address = ("ที่อยู่  " . $_POST['Address'] . "  ตำบล  " . $_POST['district'] . " อำเภอ  " . $_POST['amphoe'] . "\nจังหวัด  " . $_POST['province'] . " รหัสไปรษณีย์ " . $_POST['zipcode'] . "");

        //echo $address;
    }
    echo $address;
    $temp = explode('.', $_FILES['file']['name']);
    $newname = round(microtime(true) * 5678) . '.' . end($temp);
    print_r($newname);
    $url = '../img/restaurant/' . $newname;
    
    $sql4 = "INSERT INTO `restaurant`( `Rest_Name`, `Rest_Address`, `User_ID`, `Rest_Img`, `Rest_status`, `Rest_Latitude` , `Rest_Longtitude`)
    VALUES ('" . $_POST['nameproduct'] . "', '" . $address .     "' ,'" . $_SESSION['ID'] . "','" . $newname . "','0' , '" . $_POST['latitude'] . "' , '" . $_POST['longtitude'] . "')";
    
    if (move_uploaded_file($_FILES['file']['tmp_name'], $url)) {
        InsertData(
            $sql4,
            "index.php",
            "ส่งคำขอสำเร็จ",
            "openrestaurant.php",
            "ส่งคำขอไม่สำเร็จ"


        );
    }
}}