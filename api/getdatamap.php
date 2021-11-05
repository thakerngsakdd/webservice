<?php
require_once('../php/connect.php');
header("Content-Type:application/json");

$data = SelectDataAll("SELECT Rest_ID, Rest_Name, Rest_Address, User_ID, Rest_status, Rest_Img, Rest_Latitude, Rest_Longtitude FROM restaurant ");


if (mysqli_num_rows($data) > 0) {
    while ($row = mysqli_fetch_array($data)) {
        $img = $row['Rest_Img'];
        $actual_link = "http://$_SERVER[HTTP_HOST]/img/restaurant/$img";
        $list[] = array(
            'Rest_ID' => $row['Rest_ID'],
            'Rest_Img' => $actual_link,
            'Rest_Name' => $row['Rest_Name'],
            'Rest_Address' => $row['Rest_Address'],
            'Rest_Latitude' => $row['Rest_Latitude'],
            'Rest_Longtitude' => $row['Rest_Longtitude'],

        );
    }
    header('Content-Type: application/json');
    echo json_encode($list);
} else {
    echo json_encode("No Record Found");
}