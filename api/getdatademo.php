<?php 
require_once('../php/connect.php');
header("Content-Type:application/json");

$data = SelectDataAll("SELECT m.Menu_ID,m.Menu_Name,r.Rest_Name,m.Menu_Price,m.Menu_Calorie,m.Menu_Photo FROM menu as m LEFT JOIN restaurant as r ON m.Rest_ID = r.Rest_ID");


if (mysqli_num_rows($data) > 0) { 
    while ($row = mysqli_fetch_array($data)) {

        $list[] = array(
            'MenuImg' => $row['Menu_Photo'], 
            'Menu' => $row['Menu_Name'], 
            'RestaurantName' => $row['Rest_Name'],
            'Price' => $row['Menu_Price'], 
            'calorie' => $row['Menu_Calorie'],
            
            
        );       
        $pick = array_rand($list);
        
    }
    header('Content-Type: application/json');
    echo json_encode($list[$pick]);
} else {
    echo json_encode("No Record Found");
}