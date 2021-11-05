<?php
header("Content-Type:application/json");
require_once('../../php/connect.php');

postapi();
//http://localhost/webservice/api/post/postlogin.php
function postapi()
{
    global $conn;
    $data = json_decode(file_get_contents('php://input'), true);

    $username = $data['user'];
    $password = $data['password'];
    $fname = $data['fname'];
    $lname = $data['lname'];
    $phone = $data['phone'];
    $email = $data['email'];


    $checkSQl_Username = "SELECT * FROM `user` WHERE `User_Username` = '" . $username . "' ";
    $check_username = $conn->query($checkSQl_Username) or die($conn->error);

    if (!$check_username->num_rows) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $query = "INSERT INTO `user` ( `User_Username`, `User_Password`, 
            `User_Firstname`, `User_Lastname`, `User_Telephonenumber`, `User_Email`, `User_Createdate`, `User_Type`) 
                                        VALUES ('" . $username . "', 
                                        '" . $hashed_password . "', 
                                        '" . $fname . "', 
                                        '" . $lname  . "', 
                                        '" .  $phone . "', 
                                        '" .  $email . "', 
                                        '" . date("Y-m-d") . "',
                                        'user');";
        $result = $conn->query($query) or die($conn->error);
        if ($result) {
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
    } else {
        $response = array(
            'status' => 0,
            'status_message' => 'hava user.'
        );

        echo json_encode($response);
        http_response_code(200);
    }
}
