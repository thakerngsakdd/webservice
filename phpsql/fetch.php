<?php
//fetch.php  
include("../php/connectns.php");

if (isset($_POST["Categories_ID"])) {
     $query = "SELECT * FROM `categories` WHERE Categories_ID = '" . $_POST["Categories_ID"] . "'";
     $result = mysqli_query($connect, $query);
     $row = mysqli_fetch_array($result);
     echo json_encode($row);
}



if (isset($_POST["Menu_ID"])) {
     $query = "SELECT m.Menu_ID,m.Menu_Name,r.Rest_Name,m.Menu_Calorie,m.Menu_Photo,m.Categories_ID,m.Menu_Price,m.Menu_Details FROM menu as m LEFT JOIN restaurant as r ON m.Rest_ID = r.Rest_ID WHERE Menu_ID = '" . $_POST["Menu_ID"] . "'";
     $result = mysqli_query($connect, $query);
     $row = mysqli_fetch_array($result);
     echo json_encode($row);
}





if (isset($_POST["typeproduct_id"])) {
     $query = "SELECT * FROM producttype WHERE `Type_ID` = '" . $_POST["typeproduct_id"] . "'";
     $result = mysqli_query($connect, $query);
     $row = mysqli_fetch_array($result);
     echo json_encode($row);
}



if (isset($_POST["product_ID"])) {
     $query = "SELECT * FROM `product` WHERE `product`.`Product_ID` = '" . $_POST["product_ID"] . "'";
     //$query = "SELECT * FROM `product`,`producttype` WHERE `product`.`Product_ID` = '" . $_POST["product_ID"] . "'";
     $result = mysqli_query($connect, $query);
     $row = mysqli_fetch_array($result);
     echo json_encode($row);
     //echo json_encode($_POST["product_ID"]);
     //$x = '<label for="inputPassword" class="col-sm-2 col-form-label py-2">ชิ้น</label>';
     //echo $x;
}

if (isset($_POST["kai_ID"])) {
     $query = "SELECT * FROM `kai` WHERE `kai`.`kai_ID` = '" . $_POST["kai_ID"] . "'";
     //$query = "SELECT * FROM `product`,`producttype` WHERE `product`.`Product_ID` = '" . $_POST["product_ID"] . "'";
     $result = mysqli_query($connect, $query);
     $row = mysqli_fetch_array($result);
     echo json_encode($row);
     //echo json_encode($_POST["product_ID"]);
     //$x = '<label for="inputPassword" class="col-sm-2 col-form-label py-2">ชิ้น</label>';
     //echo $x;
}


if (isset($_POST["Warranty"])) {
     //SELECT `Warranty_ID`, `Warranty_Name`, `Warranty_Day` FROM `warranty` WHERE 1

     $query = "SELECT * FROM `warranty` WHERE Warranty_ID = '" . $_POST["Warranty"] . "'";
     $result = mysqli_query($connect, $query);
     $row = mysqli_fetch_array($result);
     echo json_encode($row);
     //echo json_encode($_POST["product_ID"]);
     //$x = '<label for="inputPassword" class="col-sm-2 col-form-label py-2">ชิ้น</label>';
     //echo $x;
}



if (isset($_POST["Delivery"])) {
     //SELECT `Delivery_ID`, `Delivery_Name`, `Delivery_Day` FROM `Delivery` WHERE 1

     $query = "SELECT * FROM `delivery` WHERE Delivery_ID = '" . $_POST["Delivery"] . "'";
     $result = mysqli_query($connect, $query);
     $row = mysqli_fetch_array($result);
     echo json_encode($row);
     //echo json_encode($_POST["product_ID"]);
     //$x = '<label for="inputPassword" class="col-sm-2 col-form-label py-2">ชิ้น</label>';
     //echo $x;
}

if (isset($_POST["ordersalesid"])) {
     //SELECT `Delivery_ID`, `Delivery_Name`, `Delivery_Day` FROM `Delivery` WHERE 1

     $query = "SELECT * FROM `ordersales` WHERE Ordersales_ID = '" . $_POST["ordersalesid"] . "'";
     $result = mysqli_query($connect, $query);
     $row = mysqli_fetch_array($result);
     echo json_encode($row);
     //echo json_encode($_POST["product_ID"]);
     //$x = '<label for="inputPassword" class="col-sm-2 col-form-label py-2">ชิ้น</label>';
     //echo $x;
}