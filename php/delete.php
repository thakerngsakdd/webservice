<?php
require_once('connect.php');

if (isset($_GET['menu_ID'])) {
    //ลบสินค้า
    $menu_ID = $_GET['menu_ID'];
    //echo $product_ID;



    $sqldelete = "DELETE FROM `menu` WHERE `menu`.`Menu_ID` = '" . $menu_ID . "'";
    if ($conn->query($sqldelete) === TRUE) {
        //echo "Record deleted successfully";
        header('Refresh:0; url=../productowner.php');
    } else {
        //echo "Error deleting record: " . $conn->error;
        header('Refresh:0; url=../productowner.php');
    }
}
if (isset($_GET['admindelete_ID'])) {
    //ลบสินค้า
    $admindelete_ID = $_GET['admindelete_ID'];
    //echo $product_ID;



    $sqldelete = "DELETE FROM `menu` WHERE `menu`.`Menu_ID` = '" . $admindelete_ID . "'";
    if ($conn->query($sqldelete) === TRUE) {
        //echo "Record deleted successfully";
        header('Refresh:0; url=../product.php');
    } else {
        //echo "Error deleting record: " . $conn->error;
        header('Refresh:0; url=../product.php');
    }
}