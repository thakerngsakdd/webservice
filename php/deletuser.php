<?php
require_once('connect.php');
$userid = $_GET['UserID'];
echo $userid;

$sqldelete = "DELETE FROM `user` WHERE `user`.`User_ID` = '" . $userid . "'";
if ($conn->query($sqldelete) === TRUE) {
    //echo "Record deleted successfully";
    header('Refresh:0; url=../manageuser.php');
} else {
    //echo "Error deleting record: " . $conn->error;
    header('Refresh:0; url=../manageuser.php');
}
