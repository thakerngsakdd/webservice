<?php 
require_once('../php/connect.php');
header("Content-Type:application/json");

$data = SelectDataAll("SELECT * FROM user");

try{
    //print_r($datss);
    if (mysqli_num_rows($data) > 0) { 
    while ($row = mysqli_fetch_array($data)) {

        $list[] = array(
            'Firstname' => $row['User_Firstname'], 
            'UserName' => $row['User_Username'],
            'Tel' => $row['User_Telephonenumber'], 
            'Email' => $row['User_Email']
        );       
        
    }
    header('Content-Type: application/json');
    http_response_code(200);  
    echo json_encode($list);
    } else {
        echo json_encode("No Record Found");
        http_response_code(500);    
    }
}
catch (exception $ex) {    
    http_response_code(500);    
}