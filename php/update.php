<?php



require_once('connect.php');
// echo '<pre>';
//     print_r($_POST);
//      echo '</pre>';

if(isset($_POST['Categories'])){
    
    //UPDATE `categories` SET`Categories_Name`= '" . $_POST['Categories_name'] . "' WHERE `Categories_ID` = '" . $_POST['Categories_id'] . "'
   $sql= "UPDATE `categories` SET`Categories_Name`= '" . $_POST['Categories_name'] . "' WHERE `Categories_ID` = '" . $_POST['Categories_id'] . "'";
   $link= "categories.php";
   UpdateDatalink($sql,$link);
}




if (isset($_POST['submitproductowner'])) {   
    

    /*
     [MenuName] => asdasd
    [Categories_ID] => 78
    [Menu_ID] => 184
    [MenuCalorie] => 211
    
    */
    $sql = "UPDATE `menu` SET    `Menu_Name`='" . $_POST['Menu_Name'] . "',
                                    `Menu_Price`='" . $_POST['Menu_Price'] . "',
                                    `Menu_Calorie`='" . $_POST['Menu_Calorie'] . "',
                                    `Menu_Details`='" . $_POST['Menu_Details'] . "'
                                     WHERE `Menu_ID` = '" . $_POST['Menu_ID'] . "' ";                         

   
    $link= "productowner.php";
    UpdateDatalink($sql, $link);
}

if (isset($_POST['submitproduct'])) {   
    

    /*
     [MenuName] => asdasd
    [Categories_ID] => 78
    [Menu_ID] => 184
    [MenuCalorie] => 211
    
    */
    $sql = "UPDATE `menu` SET    `Menu_Calorie`='" . $_POST['Menu_Calorie'] . "'
                                     WHERE `Menu_ID` = '" . $_POST['Menu_ID'] . "' ";                         

   
    $link= "product.php";
    UpdateDatalink($sql, $link);
}



if (isset($_POST['submitUpdatetype'])) {
    UpdateDatalink("UPDATE `restaurant` SET `Rest_Name` = '" . $_POST['Rest_Name'] . "' WHERE `restaurant`.`Rest_ID` = '" . $_POST['idtype'] . "'", "restaurantupdate.php");
}
if (isset($_GET['allow']) and isset($_GET['userid'])) {
    //echo 'hello word';
    UpdateData("UPDATE `restaurant` SET `Rest_status` = '1' WHERE `restaurant`.`Rest_ID` = '" . $_GET['allow'] . "'");
    UpdateDatalink("UPDATE `user` SET `User_Type` = 'Restaurantowner' WHERE `user`.`User_ID` = '" . $_GET['userid'] . "'", "requestopen.php");
}