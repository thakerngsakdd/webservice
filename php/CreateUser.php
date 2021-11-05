<?php
//echo '<pre>', print_r($_POST), '</pre>';
require_once('connect.php');


function Refresh($link)
{
    header('Refresh:0; url=../' . $link . '');
};
if (isset($_POST['submitRegister'])) {
    //https://developers.google.com/recaptcha/docs/verify
    $secretKey = "6LeWVNsUAAAAAPCObQd-jdnjWq1HG8V9L2cdQnWN";
    $responsKey = $_POST['g-recaptcha-response'];
    $remoteip = $_SERVER['REMOTE_ADDR'];
    $url = "https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$responsKey&remoteip=$remoteip";
    $response = json_decode(file_get_contents($url)); // แปลงไฟล์จาก  json ให้PHP อ่านได้


    //print_r($response);
    if ($response->success) {

        $checkSQl_Username = "SELECT * FROM `user` WHERE `User_Username` = '" . $_POST['user'] . "' ";
        $check_username = $conn->query($checkSQl_Username) or die($conn->error);
        //print_r($check_Username);
        if (!$check_username->num_rows) { // เช็คว่ามีไหม ถ้าไม่เท่ากับ 1
            $hashed_password = password_hash($_POST['password1'], PASSWORD_DEFAULT);
            //ด้าต้าเบส
            $sql_create = "INSERT INTO `user` ( `User_Username`, `User_Password`, 
            `User_Firstname`, `User_Lastname`, `User_Telephonenumber`, `User_Email`, `User_Createdate`, `User_Type`) 
                                        VALUES ('" . $_POST['user'] . "', 
                                        '" . $hashed_password . "', 
                                        '" . $_POST['fname'] . "', 
                                        '" . $_POST['lname'] . "', 
                                        '" . $_POST['phone'] . "', 
                                        '" . $_POST['email'] . "', 
                                        '" . date("Y-m-d") . "',
                                        'user');";
            /*


            $sql_create = "INSERT INTO `user` ( `User_Username`, `User_Password`, 
                        `User_Firstname`, `User_Lastname`, `User_Telephonenumber`, `User_Email`, `User_Createdate`, `User_Type`) 
                                                    VALUES ('" . $_POST['user'] . "', 

                                                    '" . $_POST['password1'] . "', 
                                                    
                                                    '" . $_POST['fname'] . "', 
                                                    '" . $_POST['lname'] . "', 
                                                    '" . $_POST['phone'] . "', 
                                                    '" . $_POST['email'] . "', 
                                                    '" . date("Y-m-d") . "',
                                                    'user');";

 */




            //ด้าต้าเบส
            $result = $conn->query($sql_create) or die($conn->error);
            //echo ('บันทึกได้');
            //print_r($response);
            if ($result) {
                Refresh('login.php');
                //header('Refresh:0; url=../login.php');
                echo "<script> alert('สมัครสมาชิกสำเร็จ'); </script>";
            } else {
                echo "<script> alert('สมัครสมาชิกล้มเหลว กรุณาติดต่อคนดูแลระบบ'); </script>";
                Refresh('register.php');
            }
        } else {
            Refresh('register.php');

            echo "<script> alert('มี Username อยู่ในระบบแล้ว'); </script>";
        }
    } else {
        Refresh('register.php');
        echo "<script> alert('Verification Failed'); </script>";
    }
    //echo 'submit';
} else {
    Refresh('register.php');
}