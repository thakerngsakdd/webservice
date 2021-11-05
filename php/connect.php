<?php
session_start();
$conn = new mysqli('localhost', 'root', '', 'webservice');
$conn->set_charset("utf8");
//$conn->query('set name utf8');
//echo $conn->connect_error;
if ($conn->connect_errno) {
    die("conmection Failed" . $conn->connect_error);
} /*else {
    die("OK Database");
}*/


$datetime = date("Y-m-d H:i:s");
$date = date("Y-m-d");


if ($conn->connect_errno) {
    die("conmection Failed" . $conn->connect_error);
} /*else {
    die("OK Database");
}*/

function checkdatebase()
{
    if ($GLOBALS['conn']->connect_errno) {
        die("conmection Failed" . $GLOBALS['conn']->connect_error);
    } else {
        //die("OK Database");
    }
}

function RefreshPageback($link)
{
    header('Refresh:0; url=../' . $link . '');
};
function RefreshPage($link)
{
    header('Refresh:0; url=' . $link . '');
};


function InsertData($codesql, $linkture, $textture, $linkfalse, $textfalse)
{
    $sql = $codesql;
    $result = $GLOBALS['conn']->query($sql) or die($GLOBALS['conn']->error);


    if ($result) {
        RefreshPageback($linkture);
        //header('Refresh:0; url=../login.php');
        echo "<script> alert('$textture'); </script>";
    } else {
        RefreshPageback($linkfalse);
        echo "<script> alert('$textfalse'); </script>";
    }
}

function UpdateData($sql)
{
    $sqlupdatephoto = $sql;
    //$sqlupdatephoto = "UPDATE `product` SET `Product_Photo` = '" . $newname . "' WHERE `product`.`Product_ID` = '" . $_POST['idproductphoto'] . "'";
    $GLOBALS['conn']->query($sqlupdatephoto) or die($GLOBALS['conn']->error);
}

function UpdateDatalink($sql, $linkture)
{
    $sqlupdatephoto = $sql;
    //$sqlupdatephoto = "UPDATE `product` SET `Product_Photo` = '" . $newname . "' WHERE `product`.`Product_ID` = '" . $_POST['idproductphoto'] . "'";
    $GLOBALS['conn']->query($sqlupdatephoto) or die($GLOBALS['conn']->error);
    RefreshPageback($linkture);
}

function SelectData($sql)
{
    $select = $sql;
    $result = mysqli_query($GLOBALS['conn'], $select);
    $row = $result->fetch_assoc();
    return $row;
}
function SelectDataAll($sql)
{
    $select = $sql;
    $result = mysqli_query($GLOBALS['conn'], $select);
    
    return $result;
}