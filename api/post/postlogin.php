<?php
header("Content-Type:application/json");
require_once('../../php/connect.php');

postapi();

function postapi()
{
    global $conn;
    $data = json_decode(file_get_contents('php://input'), true);

    $username = $data['username'];
    $password = $data['password'];

    $stmt = $conn->prepare("SELECT * FROM user WHERE User_Username = ? ");
    $stmt->bind_param('s', $username); // s - string  i- int b - bol 
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();    
    if (!empty($row)) {
        if (password_verify($password, $row['User_Password'])) {
            $response = array(
                'status' => 1,
                'status_message' => 'Successfully'
            );
            echo json_encode($response);
            http_response_code(200);  
            
        } else {
            $response = array(
                'status' => 0,
                'status_message' => 'Failed'
            );
        
            echo json_encode($response);
            http_response_code(500);  
        }
    } else {
        $response = array(
            'status' => 0,
            'status_message' => 'Failed'
        );
    
        echo json_encode($response);
        http_response_code(500);  
    }
}