<?php
require_once('connect.php');



if (isset($_POST['submitcart'])) {


    $sqlid = "SELECT Ordersales_ID FROM `ordersales` ORDER BY `Ordersales_ID` DESC LIMIT 1";
    $resultid = $conn->query($sqlid);
    $row = $resultid->fetch_assoc();
    $adressusersend = $_POST['nameusersend'] . '<br> ' . $_POST['address'] . ' <br>เบอร์โทรติดต่อ  ' . $_POST['tel'];
    echo $adressusersend;

    if (mysqli_num_rows($resultid) == 1) {

        $OrderID = $row['Ordersales_ID'] + 1;
        $sqlinsertorder = ("INSERT INTO `ordersales`(`Ordersales_ID`, `Delivery_ID`, `User_ID`, `Ordersales_address`,
    `Ordersales_Totalprice`, `Ordersales_Day`, `Ordersales_Status`) VALUES
    ('" . $OrderID . "','" . $_POST['Delivery'] . "','" . $_SESSION["ID"] . "','" . $adressusersend . "','" .
            $_POST['Totalprice'] . "','" . date("Y-m-d") . "','รอการชำระเงิน')");
        $resultinsertorder = $conn->query($sqlinsertorder);



        if (isset($resultinsertorder)) {
            //echo '5555555555555';
        } else {
            //echo '111111111111';
        }
        //INSERT INTO `ordersalesdetail`(`ordersalesDetail_ID`, `product_ID`, `ordersalesDetail_unit`) VALUES ([value-1],[value-2],[value-3])
        //
        $totalBalance = 0;
        $sumprice = 0;
        foreach ($_SESSION["shopping_cart"] as $keys => $values) {

            //SELECT `Product_ID`, `Product_Balance` FROM `product` WHERE 1
            //UPDATE `product` SET `Product_Balance` = '100' WHERE `product`.`Product_ID` = 50;
            //echo "<br>  ID " . $values["item_id"] . "<br>";

            //echo "<br> ค่าหัก = " . $values["item_quantity"] . "<br>";

            $sqlselectproduct = ("SELECT * FROM `product` WHERE `Product_ID` = '" . $values["item_id"] . "'");

            $resultselectproduct = $conn->query($sqlselectproduct);
            $rowselectproduct = $resultselectproduct->fetch_assoc();
            //print_r($rowselectproduct);
            //echo "<br> ก่อนหัก" . $rowselectproduct['Product_Balance'] . "<br>";


            $totalBalance = $rowselectproduct['Product_Balance'] - $values["item_quantity"];
            // echo " ผลลัพ=" . $totalBalance;


            $sumprice =  $values["item_price"] * $values["item_quantity"];
            //echo " ผลลัพราคา=" . $totalBalance;
            //echo 'IDวัน' . $rowselectproduct['Warranty_ID'];

            $sqlselectWarranty = ("SELECT `Warranty_ID`, `Warranty_Name`, `Warranty_Day` FROM `warranty` WHERE `Warranty_ID`='" . $rowselectproduct['Warranty_ID'] . "'");
            $resultselectWarranty = $conn->query($sqlselectWarranty);
            $rowselectWarranty = $resultselectWarranty->fetch_assoc();
            //echo 'วัน' . $rowselectWarranty['Warranty_Day'];





            $sqlupdateproduct = ("UPDATE `product` SET `Product_Balance` = '" . $totalBalance . "' WHERE `product`.`Product_ID` = '" . $values["item_id"] . "';");
            $resultupdateproduct = $conn->query($sqlupdateproduct);

            $sqlselectproduct1 = ("SELECT `Product_ID`, `Product_Balance` FROM `product` WHERE `product`.`Product_ID` = '" . $values["item_id"] . "'");

            $resultselectproduct1 = $conn->query($sqlselectproduct1);
            $rowselectproduct1 = $resultselectproduct1->fetch_assoc();

            //echo "<br>" . $rowselectproduct1['Product_Balance'] . "<br>";



            $sqlinsertorderdetail = ("INSERT INTO `ordersalesdetail`(`ordersalesDetail_ID`, `product_ID`, `ordersalesDetail_unit`, `ordersalesdetailWarrantyday`, `ordersalesdetail_ price`) VALUES
                ('" . $OrderID . "','" . $values["item_id"] . "','" . $values["item_quantity"] . "','" . $rowselectWarranty['Warranty_Day'] . "','" . $sumprice . "')");
            $resultinsertorderdetail = $conn->query($sqlinsertorderdetail);
            if (isset($resultinsertorderdetail)) {
                //echo '1234';
            } else {
                //echo '0000';
            }
        }


        foreach ($_SESSION["shopping_cart"] as $keys => $values) {
            unset($_SESSION["shopping_cart"][$keys]);
            echo '<script>window.location="../shopproduct.php"</script>';
            echo "<script> alert('บันทึกข้อมูลสำเสร็จ'); </script>";
        }
    } else {
        $OrderID = 1;
        $adressusersend = $_POST['nameusersend'] . '<br> ' . $_POST['address'] . ' <br>เบอร์โทรติดต่อ  ' . $_POST['tel'];

        //echo $OrderID;
        $sqlinsertorder = ("INSERT INTO `ordersales`(`Ordersales_ID`, `Delivery_ID`, `User_ID`, `Ordersales_address`,
        `Ordersales_Totalprice`, `Ordersales_Day`, `Ordersales_Status`) VALUES
        ('" . $OrderID . "','" . $_POST['Delivery'] . "','" . $_SESSION["ID"] . "','" . $adressusersend . "','" .
            $_POST['Totalprice'] . "','" . date("Y-m-d") . "','รอการชำระเงิน')");
        $resultinsertorder = $conn->query($sqlinsertorder);



        if (isset($resultinsertorder)) {
            //echo '5555555555555';
        } else {
            //echo '111111111111';
        }
        //INSERT INTO `ordersalesdetail`(`ordersalesDetail_ID`, `product_ID`, `ordersalesDetail_unit`) VALUES ([value-1],[value-2],[value-3])
        //
        $totalBalance = 0;
        $sumprice = 0;
        foreach ($_SESSION["shopping_cart"] as $keys => $values) {

            //SELECT `Product_ID`, `Product_Balance` FROM `product` WHERE 1
            //UPDATE `product` SET `Product_Balance` = '100' WHERE `product`.`Product_ID` = 50;
            // echo "<br>  ID " . $values["item_id"] . "<br>";

            //echo "<br> ค่าหัก = " . $values["item_quantity"] . "<br>";

            $sqlselectproduct = ("SELECT * FROM `product` WHERE `Product_ID` = '" . $values["item_id"] . "'");

            $resultselectproduct = $conn->query($sqlselectproduct);
            $rowselectproduct = $resultselectproduct->fetch_assoc();
            //print_r($rowselectproduct);
            // echo "<br> ก่อนหัก" . $rowselectproduct['Product_Balance'] . "<br>";


            $totalBalance = $rowselectproduct['Product_Balance'] - $values["item_quantity"];
            //echo " ผลลัพ=" . $totalBalance;

            $sumprice =  $values["item_price"] * $values["item_quantity"];
            //echo " ผลลัพราคา=" . $totalBalance;
            //echo 'IDวัน' . $rowselectproduct['Warranty_ID'];

            $sqlselectWarranty = ("SELECT `Warranty_ID`, `Warranty_Name`, `Warranty_Day` FROM `warranty` WHERE `Warranty_ID`='" . $rowselectproduct['Warranty_ID'] . "'");
            $resultselectWarranty = $conn->query($sqlselectWarranty);
            $rowselectWarranty = $resultselectWarranty->fetch_assoc();
            //echo 'วัน' . $rowselectWarranty['Warranty_Day'];





            $sqlupdateproduct = ("UPDATE `product` SET `Product_Balance` = '" . $totalBalance . "' WHERE `product`.`Product_ID` = '" . $values["item_id"] . "';");
            $resultupdateproduct = $conn->query($sqlupdateproduct);

            $sqlselectproduct1 = ("SELECT `Product_ID`, `Product_Balance` FROM `product` WHERE `product`.`Product_ID` = '" . $values["item_id"] . "'");

            $resultselectproduct1 = $conn->query($sqlselectproduct1);
            $rowselectproduct1 = $resultselectproduct1->fetch_assoc();

            //echo "<br>" . $rowselectproduct1['Product_Balance'] . "<br>";



            $sqlinsertorderdetail = ("INSERT INTO `ordersalesdetail`(`ordersalesDetail_ID`, `product_ID`, `ordersalesDetail_unit`, `ordersalesdetailWarrantyday`, `ordersalesdetail_ price`) VALUES
                ('" . $OrderID . "','" . $values["item_id"] . "','" . $values["item_quantity"] . "','" . $rowselectWarranty['Warranty_Day'] . "','" . $sumprice . "')");
            $resultinsertorderdetail = $conn->query($sqlinsertorderdetail);
            if (isset($resultinsertorderdetail)) {
                //echo '1234';
            } else {
                //echo '0000';
            }
        }


        foreach ($_SESSION["shopping_cart"] as $keys => $values) {
            unset($_SESSION["shopping_cart"][$keys]);
            echo '<script>window.location="../shopproduct.php"</script>';
        }
    }
}








function Refresh($link)
{
    header('Refresh:0; url=../' . $link . '');
};



if (isset($_POST['submitkaidetail'])) {
    //echo '<pre>';
    //print_r($_POST);
    //print_r($_FILES['file']); // ชื่อ NAME ใน HTML
    //echo '</pre>';

    $kainame = $_POST['kainame'];
    $kaidetail = $_POST['kaidetail'];


    $temp = explode('.', $_FILES['file']['name']);
    $newname = round(microtime(true) * 5678) . '.' . end($temp);
    //print_r($newname);
    $url = '../img/kai/' . $newname;
    if (move_uploaded_file($_FILES['file']['tmp_name'], $url)) {
        $sql = "INSERT INTO `kai` ( kai_Name, kai_Details,  kai_Photo, datephoto_save ) 
                            VALUES ('$kainame','$kaidetail','$newname' ,'" . date("Y-m-d") . "')";
        $result = $conn->query($sql) or die($conn->error);
    }
    if ($result) {
        Refresh('managedetailkai.php');
        //header('Refresh:0; url=../login.php');
        echo "<script> alert('เพิ่มข้อมูลสำเร็จ'); </script>";
    } else {
        echo "<script> alert('สมัครสมาชิกไม่ล้มเหลว กรุณาติดต่อคนดูแลระบบ'); </script>";
        Refresh('managedetailkai.php');
    }
}



if (isset($_POST['insertwarranty'])) {
    //echo '<pre>';
    //print_r($_POST);
    //print_r($_FILES['file']); // ชื่อ NAME ใน HTML
    //echo '</pre>';

    //$temp = explode('.', $_FILES['file']['name']);
    //$newname = round(microtime(true) * 5678) . '.' . end($temp);
    //print_r($newname);
    //$url = '../img/product/' . $newname;
    //if (move_uploaded_file($_FILES['file']['tmp_name'], $url)) {
    //}


    $sql = "INSERT INTO `warranty`( `Warranty_Name`, `Warranty_Day`) VALUES ('" . $_POST['namewarranty'] . "','" . $_POST['daywarranty'] . "')";
    $result = $conn->query($sql) or die($conn->error);


    if ($result) {
        Refresh('warranty.php');
        //header('Refresh:0; url=../login.php');
        echo "<script> alert('เพิ่มสินค้าสำเร็จ'); </script>";
    } else {
        echo "<script> alert('สมัคสมาชิกไม่ล้มเหลว กรุณาติดต่อคนดูแลระบบ'); </script>";
        Refresh('warranty.php');
    }
}




if (isset($_POST['insertdelivery'])) {
    //echo '<pre>';
    //print_r($_POST);
    //print_r($_FILES['file']); // ชื่อ NAME ใน HTML
    //echo '</pre>';

    //$temp = explode('.', $_FILES['file']['name']);
    //$newname = round(microtime(true) * 5678) . '.' . end($temp);
    //print_r($newname);
    //$url = '../img/product/' . $newname;
    //if (move_uploaded_file($_FILES['file']['tmp_name'], $url)) {
    //}

    //[namedelivery] => aaaaaaaaaa
    //[moneydelivery] => 12
    //SELECT `Delivery_ID`, `Delivery_Name`, `Delivery_Price` FROM `delivery` WHERE 1

    $sql = "INSERT INTO `delivery`( `Delivery_Name`, `Delivery_Price`) VALUES ('" . $_POST['namedelivery'] . "','" . $_POST['moneydelivery'] . "')";
    $result = $conn->query($sql) or die($conn->error);


    if ($result) {
        Refresh('delivery.php');
        //header('Refresh:0; url=../login.php');
        echo "<script> alert('เพิ่มสินค้าสำเร็จ'); </script>";
    } else {
        echo "<script> alert('สมัคสมาชิกไม่ล้มเหลว กรุณาติดต่อคนดูแลระบบ'); </script>";
        Refresh('delivery.php');
    }
}