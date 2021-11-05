<?php

include("../php/connectns.php");
if (!empty($_POST)) {
    //echo  $_POST["name"];
    //echo $_POST['address'];
    print_r($_POST);
    $output = '';
    $message = '';
    $name = mysqli_real_escape_string($connect, $_POST["name"]);
    //$address = mysqli_real_escape_string($connect, $_POST["address"]);
    //$gender = mysqli_real_escape_string($connect, $_POST["gender"]);
    //$designation = mysqli_real_escape_string($connect, $_POST["designation"]);
    //$age = mysqli_real_escape_string($connect, $_POST["age"]);
    if ($_POST["typeproduct_id"] != '') {
        //echo "123";
        $query = "  
           UPDATE producttype  
           SET Type_Name ='$name'           
           WHERE Type_ID ='" . $_POST["typeproduct_id"] . "'";
        //echo "12345";


        $message = 'Data Updated';

        //header('location:../index.php');
    } else {
        //echo "12312345";
        $query = "         
           INSERT INTO `producttype` (`Type_Name`) VALUES ('" . $name . "');
           ";
        $message = 'Data Inserted';
        //header('location:../index.php');
    }

    if (mysqli_query($connect, $query)) {
        //$output .= '<label class="text-success">' . $message . '</label>';
        //$query = "SELECT * FROM producttype ORDER BY `Type_ID` DESC"; // แก้ที่อยู่
        $select_query = "SELECT * FROM producttype ORDER BY `Type_ID` DESC";
        $result = mysqli_query($connect, $select_query);
    }
    //echo $output;
}