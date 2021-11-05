<?php
// Initiate curl session in a variable (resource)
$curl_handle = curl_init();

$url = "http://localhost/webservice/api/getallService.php";

// Set the curl URL option
curl_setopt($curl_handle, CURLOPT_URL, $url);

// This option will return data as a string instead of direct output
curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, true);

// Execute curl & store data in a variable
$curl_data = curl_exec($curl_handle);

curl_close($curl_handle);

// Decode JSON into PHP array
$response_data = json_decode($curl_data);
//print_r($response_data);
//echo ("<br>1<br>");

// All user data exists in 'data' object
//$user_data = $response_data->data;
//echo ("<br>");
//print_r($user_data);

// Extract only first 5 user data (or 5 array elements)
//$user_data = array_slice($user_data, 0, 1);
//echo ("<br>2<br>");
//print_r($user_data);
// Traverse array and print employee data

foreach ($response_data  as $user) {
    echo "id: " . $user->id;
    echo "<br />";
    echo "name: " . $user->name;
    echo "<br />";
}