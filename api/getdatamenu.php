<?php 
require_once('../php/connect.php');
header("Content-Type:application/json");

// $data = SelectDataAll("SELECT m.Menu_ID,m.Categories_ID,m.Menu_Name,r.Rest_Name,m.Menu_Price,m.Menu_Calorie,m.Menu_Photo FROM menu as m LEFT JOIN restaurant as r ON m.Rest_ID = r.Rest_ID" );
$data = json_decode(file_get_contents('php://input'), true);

$CategoriesID = $data['CategoriesID'];
// $data = SelectDataAll("SELECT * FROM `menu` as  WHERE `Categories_ID` = '" . $CategoriesID . "' " );
$data = SelectDataAll("SELECT * FROM menu as me
INNER JOIN restaurant re ON me.Rest_ID = re.Rest_ID
where me.Categories_ID ='" . $CategoriesID . "' ");

if (mysqli_num_rows($data) > 0) { 
    while ($row = mysqli_fetch_array($data)) {
        $img = $row['Menu_Photo'];
        $actual_link = "http://$_SERVER[HTTP_HOST]/img/menu/$img";
        $list[] = array(
            'Categories_ID' => $row['Categories_ID'],
            'Rest_Img' => $actual_link,
            'Menu' => $row['Menu_Name'],
            'RestaurantName' => $row['Rest_Name'],
            'Menu_Details' => $row['Menu_Details'], 
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