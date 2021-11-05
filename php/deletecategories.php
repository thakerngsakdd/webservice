<?php
require_once('connect.php');

if (isset($_GET['admindelete_ID'])) {
$admindelete_ID = $_GET['admindelete_ID'];
// echo $admindelete_ID;

$sqldelete = "DELETE FROM `categories` WHERE `categories`.`Categories_ID` = '" . $admindelete_ID . "'";
if ($conn->query($sqldelete) === TRUE) {
    //echo "Record deleted successfully";
    header('Refresh:0; url=../categories.php');
} else {
    //echo "Error deleting record: " . $conn->error;
    header('Refresh:0; url=../categories.php');
}
}