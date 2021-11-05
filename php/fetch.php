<?php
//fetch.php  
include('connect.php');
if (isset($_POST["typeproduct_id"])) {
     $query = "SELECT * FROM restaurant WHERE `Type_ID` = '" . $_POST["typeproduct_id"] . "'";
     $result = mysqli_query($connect, $query);
     $row = mysqli_fetch_array($result);
     echo json_encode($row);
}