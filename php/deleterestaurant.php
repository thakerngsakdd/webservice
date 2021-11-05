<?php
require_once('connect.php');
$Type_ID = $_GET['Type_ID'];
echo $Type_ID;

$sqldelete = "DELETE FROM `restaurant` WHERE `restaurant`.`Type_ID` = '" . $Type_ID . "'";
if ($conn->query($sqldelete) === TRUE) {
    //echo "Record deleted successfully";
    header('Refresh:0; url=../requestopen.php');
} else {
    //echo "Error deleting record: " . $conn->error;
    header('Refresh:0; url=../requestopen.php');
}