<?php
header("Content-Type:application/json");
require_once('../../php/connect.php');

postapi();
//http://localhost/webservice/api/post/postlogin.php
function postapi()
{
    global $conn;
    $data = json_decode(file_get_contents('php://input'), true);
  

    $Categories_Name = $data["Categories_Name"];
    
    $query = "INSERT INTO categories SET Categories_Name ='" . $Categories_Name . "'";


    
 

    $result = mysqli_query($conn, $query) or die($conn->error);
}
if (mysqli_affected_rows( $conn)) {
    $response = array(
        'status' => 1,
        'status_message' => 'Successfully.'
    );
    echo json_encode($response);
    http_response_code(200);  
} else {
    $response = array(
        'status' => 0,
        'status_message' => 'Failed.'
    );

    echo json_encode($response);
    http_response_code(500);  
}
  