<?php
$conn = new mysqli('localhost', 'root', '', 'webservice');
$conn->set_charset("utf8");
if ($conn->connect_errno) {
    die("conmection Failed" . $conn->connect_error);
}