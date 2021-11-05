<?php
require_once('connect.php');


if (isset($_POST['submitphoto'])) {
    //echo '<pre>';
    //print_r($_POST);
    //print_r($_FILES['file']); // ชื่อ NAME ใน HTML
    //echo '</pre>';

    $temp = explode('.', $_FILES['file']['name']);
    $newname = round(microtime(true) * 5678) . '.' . end($temp);
    //print_r($newname);
    $url = '../img/profile/' . $newname;
    if (move_uploaded_file($_FILES['file']['tmp_name'], $url)) {
        $sql = "SELECT * FROM `user` WHERE `User_ID`= '" . $_SESSION["ID"] . "'"; // alt  + 96
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        //echo '<pre>';
        //echo $result->num_rows;
        //print_r($row);
        //echo $row['User_Photo'];
        //echo '</pre>';
        $delete = $row['User_Photo'];
        $b = "..\img\profile\ " . $delete; // เร็วกว่า        
        $deetefile = preg_replace("[ ]", "", $b); // ถ้าเจอวรรคลบออก
        //echo $deetefile;

        if ($row['User_Photo'] == 'profile.png') {
            //echo 'ไม่ลบ profile.png';
        } else {
            unlink($deetefile);
            //echo 'ลบ';        
        }

        $sqlupdatephoto = "UPDATE `user` SET `User_Photo` = '" . $newname . "' WHERE `user`.`User_ID` = '" . $_SESSION['ID'] . "'";
        $sevasql = $conn->query($sqlupdatephoto) or die($conn->error);
        $_SESSION['Photo'] = $newname;

        header('location:../profile_edit.php');
    } else {
        echo 'ไม่มีการอัพเดทข้อมูล';
    }
}

if (isset($_POST['submitphotoproduct'])) {
    echo '<pre>';
    print_r($_POST);
    print_r($_FILES['file']); // ชื่อ NAME ใน HTML
    echo '</pre>';

    $temp = explode('.', $_FILES['file']['name']);
    $newname = round(microtime(true) * 5678) . '.' . end($temp);
    //print_r($newname);
    $url = '../img/product/' . $newname; // ย้ายไฟล
    if (move_uploaded_file($_FILES['file']['tmp_name'], $url)) {
        $sql = "SELECT * FROM `menu` WHERE `Menu_ID`= '" . $_POST['idproductphoto'] . "'"; // alt  + 96
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        //echo '<pre>';
        //echo $result->num_rows;
        //print_r($row);
        //echo $row['User_Photo'];
        //echo '</pre>';
        $delete = $row['Menu_Photo'];
        $b = "..\img\menu\ " . $delete; // เร็วกว่า      //อย่าเปลี่ยนชื่อไฟล   
        $deetefile = preg_replace("[ ]", "", $b); // ถ้าเจอวรรคลบออก
        //echo $deetefile;

        if (unlink($deetefile)) {
            // echo ("deleted $deetefile");
            //unlink($deetefile);
        } else {
            echo 'ไม่เจอ';
        }


        //if ($row['User_Photo'] == 'profile.png') {
        //echo 'ไม่ลบ profile.png';
        //} else {
        //   unlink($deetefile);
        //unlink($deetefile);
        //echo 'ลบ';        
        //}

        $sqlupdatephoto = "UPDATE `menu` SET `Menu_ID` = '" . $newname . "' WHERE `menu`.`Menu_ID` = '" . $_POST['idproductphoto'] . "'";
        $sevasql = $conn->query($sqlupdatephoto) or die($conn->error);
        //$_SESSION['Photo'] = $newname;

        header('location:../product.php');
    } else {
        echo 'ไม่มีการอัพเดทข้อมูล';
    }
}

if (isset($_POST['submitrestaurantupdate'])) {
    echo '<pre>';
    print_r($_POST);
    print_r($_FILES['file']); // ชื่อ NAME ใน HTML
    echo '</pre>';

    $temp = explode('.', $_FILES['file']['name']);
    $newname = round(microtime(true) * 5678) . '.' . end($temp);
    //print_r($newname);
    $url = '../img/restaurant/' . $newname; // ย้ายไฟล
    if (move_uploaded_file($_FILES['file']['tmp_name'], $url)) {
        $sql = "SELECT * FROM `restaurant` WHERE `Rest_ID`= '" . $_POST['idrestaurantphoto'] . "'"; // alt  + 96
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $delete = $row['Rest_Img'];
        $b = "..\img\restaurant\ " . $delete; // เร็วกว่า      //อย่าเปลี่ยนชื่อไฟล   
        $deetefile = preg_replace(
            "[ ]",
            "",
            $b
        );

        if (unlink($deetefile)) {
        } else {
            echo 'ไม่เจอ';
        }

        $sqlupdatephoto = "UPDATE `restaurant` SET `Rest_Img` = '" . $newname . "' WHERE `restaurant`.`Rest_ID` = '" . $_POST['idrestaurantphoto'] . "'";
        $sevasql = $conn->query($sqlupdatephoto) or die($conn->error);


        header('location:../restaurantupdate.php');
    } else {
        echo 'ไม่มีการอัพเดทข้อมูล';
    }
}