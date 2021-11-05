<?php
header("Content-Type:application/json");

include('dbconnect.php');
$sql = "SELECT * FROM categories";
// echo $sql;
// echo "\n";
$result = mysqli_query($con, $sql);

print_r(mysqli_num_rows($result));


// if (mysqli_num_rows($result) > 0) {

//     $query = "SELECT * FROM categories";
    
//     $response = array();
//     $result = mysqli_query($con, $query);
   
//     $i = 1;
//     while ($row = mysqli_fetch_array($result)) {
//          $response[$i]['Categories_ID'] = $row['Categories_ID'];
//          $response[$i]['Categories_Name'] = $row['Categories_Name'];        
//          $i++;
//         //echo ($row['Categories_ID']) ;
//     }
//     header('Content-Type: application/json');
//     echo json_encode($response);
// } else {
//     response(200, "No Record Found");
// }

function response($Categories_ID,$Categories_Name) {
    $response['Categories_ID'] = $Categories_ID;
    $response['Categories_Name'] = $Categories_Name;

    //$json_response = json_encode($response);
    $json_response = json_encode($response, JSON_UNESCAPED_UNICODE); //thai languge
    echo $json_response;
}