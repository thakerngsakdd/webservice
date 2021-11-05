<?php
header("Content-Type:application/json");
require_once('../../php/connect.php');

postapi();
//http://localhost/webservice/api/post/postlogin.php
function postapi()
{
    global $conn;
    $data = json_decode(file_get_contents('php://input'), true);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $h = $data["height"];
        $w = $data["weight"];
        $age = $data["age"];
        $gender = $data["gender"];
        
        $text = "BMR (Basal Metabolic Rate) ของคุณคือ %d กิโลแคลอรี่ <br>";
        if( is_numeric($h) && is_numeric($w) && is_numeric($age)){
          if($gender == "male"){
            $BMR = 66 + (13.7 * $w) + (5 * $h) - (6.8 * $age);
          }else if($gender == "female"){
            $BMR = 665 + (9.6 * $w) + (1.8 * $h) - (4.7 * $age);
          }
          $result = $BMR;
          header('Content-Type: application/json');
         

          $response = array(
            'status' => 1,
            'status_message' => 'Successfully.',
            'BMR' => $result
          );

        echo json_encode($response);
        http_response_code(200);
          
        }else{
          $response = array(
            'status' => 0,
            'status_message' => 'Failed.',
            'BMR' => "คุณใส่ค่าผิด กรุณาใส่ใหม่อีกรอบครับ"
          );

        echo json_encode($response);
        http_response_code(200);
        }
      }
    

}