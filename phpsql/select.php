<?php
include("../php/connectns.php");
if (isset($_POST["typeproduct_id"])) {
     $output = '';

     $query = "SELECT * FROM producttype WHERE `Type_ID` = '" . $_POST["typeproduct_id"] . "'";
     $result = mysqli_query($connect, $query);
     $output .= '  
      <div class="table-responsive">  
           <table class="table table-bordered">';
     while ($row = mysqli_fetch_array($result)) {
          $output .= '  
                <tr>  
                     <td width="30%"><label>Name</label></td>  
                     <td width="70%">' . $row["Type_Name"] . '</td>  
                </tr>  
               
           ';
          /*
            <tr>  
                     <td width="30%"><label>Address</label></td>  
                     <td width="70%">' . $row["address"] . '</td>  
                </tr>  
                <tr>  
                     <td width="30%"><label>Gender</label></td>  
                     <td width="70%">' . $row["gender"] . '</td>  
                </tr>  
                <tr>  
                     <td width="30%"><label>Designation</label></td>  
                     <td width="70%">' . $row["designation"] . '</td>  
                </tr>  
                <tr>  
                     <td width="30%"><label>Age</label></td>  
                     <td width="70%">' . $row["age"] . ' Year</td>  
                </tr>  
           */
     }
     $output .= '  
           </table>  
      </div>  
      ';
     echo $output;
}



if (isset($_POST["Menu_ID"])) {
     //<img src="img\product\8989182539223.jpg" alt=""' . $row["Product_Photo"] . '""
     //class="img-fluid "></img>
     //echo 'img\product\8989182539223.jpg ';



     $output = '';

     //$query = "SELECT * FROM producttype WHERE `Type_ID` = '" . $_POST["typeproduct_id"] . "'";
     $query = "SELECT * FROM `menu`,`categories` WHERE `menu`.`Categories_ID` = `categories`.`Categories_ID` AND  `menu`.`Menu_ID` = '" . $_POST["Menu_ID"] . "'";
     $result = mysqli_query($connect, $query);
     $output .= '  
     <div class="table-responsive">  
          <table class="table table-bordered">';
     while ($row = mysqli_fetch_array($result)) {
          $x = "img/menu/ " . $row["Menu_Photo"];
          $YOYO =  preg_replace("[ ]", "", $x);
          $output .= '  
               <tr>  
                    <td width="30%"><label>รหัสสินค้า</label></td>  
                    <td width="70%">' . $row["Menu_ID"] . '</td>  
               </tr>  
               
          
          <tr>  
                    <td width="30%"><label>ชื่อสินค้า</label></td>  
                    <td width="70%">' . $row["Menu_Name"] . '</td>  
               </tr>  
               <tr>  
                    <td width="30%"><label>ประเภทสินค้า</label></td>  
                    <td width="70%">' . $row["Categories_Name"] . '</td>  
               </tr>  
               <tr>  
                    <td width="30%"><label>ราคาสินค้า</label></td>  
                    <td width="70%">' . $row["Menu_Price"] . '   บาท</td>  
               </tr>  
               <tr>  
                    <td width="30%"><label>แคลอรี่</label></td>  
                    <td width="70%">' . $row["Menu_Calorie"] . ' </td>  
               </tr>  
               
               <tr>
                    <td width="30%"><label>รายละเอียดสินค้า</label></td>  
                    <td width="70%"><textarea class="form-control" id="detail" name="detail" rows="10" disabled
                         >' . $row["Menu_Details"] . '</textarea></td> 

               </tr> 

               <tr> 
                    <td width="30%"><label>รูปสินค้า</label></td>  
                    <td width="70%"><img src="' . $YOYO . '" alt=""' . $row["Menu_Photo"] . '""
                         class="img-fluid img-product "></img>
                         
                         
                         </td> 
                         
               </tr> 
               
          
          ';
     }
     $output .= '  
          </table>  
     </div>  
     ';
     echo $output;
}




if (isset($_POST["ordersalesid"])) {
     //<img src="img\product\8989182539223.jpg" alt=""' . $row["Product_Photo"] . '""
     //class="img-fluid "></img>
     //echo 'img\product\8989182539223.jpg ';


     $sumquantity = 0;
     $total = 0;
     $totaldelivery = 0;

     $output = '';

     //$query = "SELECT * FROM producttype WHERE `Type_ID` = '" . $_POST["typeproduct_id"] . "'";
     //SELECT `ordersalesDetail_ID`, `product_ID`, `ordersalesDetail_unit`, `ordersalesdetailWarrantyday`, `ordersalesdetail_ price` FROM `ordersalesdetail` WHERE `ordersalesDetail_ID`=1
     $queryordersales = "SELECT * FROM `ordersalesdetail`,`product` WHERE `ordersalesdetail`.`product_ID`= `product`.`Product_ID` AND`ordersalesDetail_ID`='" . $_POST["ordersalesid"] . "'";
     $resultordersales = mysqli_query($connect, $queryordersales);


     $output .= ' <div class="container py-4">

     <div class="container">
         <div class="card shopping-cart">
             <div class="card-header bg-dark ">
                 <div class="row">
                     <div class="text-light col-2">
                         <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                         รายการสินค้า
                     </div>
                     <div class="col-8"></div>
                     
                 </div>

             </div>
             <div class="card-body"> ';
     while ($rowodersales = mysqli_fetch_array($resultordersales)) {
          $x = "img/product/ " . $rowodersales["Product_Photo"];
          $YOYO =  preg_replace("[ ]", "", $x);
          $output .= '
          <div class="row">
                         <div class="col-12 col-sm-12 col-md-2 text-center">
                              <img class="img-responsive" src="' . $YOYO . '"
                                   alt="prewiew" width="120" height="80">
                         </div>
                         <div class="col-12 text-sm-center col-sm-12 text-md-left col-md-6">
                         <h4 class="product-name"><strong>' . $rowodersales["Product_Name"] . '</strong></h4>
                              <h4>
                                   <small></small>
                              </h4>
          </div>
          <div class="col-12 col-sm-12 text-sm-center col-md-4 text-md-right row">

               <div class="col-6 col-sm-6 col-md-6 py-1">
                    
               <h6>  <strong>' . $rowodersales["ordersalesDetail_unit"] . ' <span class="text-muted"> ชิ้น</span></strong></h6>
               </div>
               <div class="col-3 col-sm-3 col-md-6 text-md-right" style="padding-top: 5px">
                    <h6>รวม  <strong>' . $rowodersales["ordersalesdetail_ price"] . ' <span class="text-muted">
                      บาท</span></strong></h6>
               </div>
               

          </div>
</div>



<hr>

';
          $sumquantity = $sumquantity + $rowodersales["ordersalesDetail_unit"];
          $total = $total + $rowodersales["ordersalesdetail_ price"];
     }


     //$sumquantity = $sumquantity + $values["item_quantity"];
     //$total = $total + ($values["item_quantity"] * $values["item_price"]);
     //$totaldelivery = $total + $rowselect['Delivery_Price'];

     $mama = 0;
     $selectordersales = "SELECT * FROM `ordersales`,`user`,`delivery` WHERE `user`.`User_ID`=`ordersales`.`User_ID`
     AND `ordersales`.`Delivery_ID`=`delivery`.`Delivery_ID` 
     AND`Ordersales_ID`='" . $_POST["ordersalesid"] . "'";
     $resultordersales = mysqli_query($connect, $selectordersales);
     $rowordersales = $resultordersales->fetch_assoc();
     $mama = $rowordersales['Ordersales_Totalprice'] - $total;


     //ต่อ
     $output .= ' 
     
<hr>


          <div class=" text-right ml-3  " style="margin: 10px">
          การสั่งซื้อ: <b>' . $sumquantity . ' รายการ</b>
</div>

<div class=" text-right ml-3 " style="margin: 10px">

    ค่าสินค้า <b>' . $total . ' บาท</b>
</div>
<div class=" text-right ml-3 " style="margin: 10px">

    ค่าจัดส่งสินค้า <b>' . $mama . ' บาท</b>
</div>

<div class=" text-right ml-3 " style="margin: 10px">

    รวมทั้งหมด: <b>' . $rowordersales['Ordersales_Totalprice'] . ' บาท</b>
</div>

<hr>
<hr>
<hr>
';




     ///ต่อ
     $output .= '
     <form action="php\insert.php" method="POST" enctype="multipart/form-data">
    <div class="modal-body">
          <div class="form-group">
          

          <table class="table table-bordered">
          <tr> 
          <td width="30%"><label>ที่อยู่ในการจัดส่ง</label></td>  
          <td width="70%"> ' . $rowordersales['Ordersales_address'] . '        
               </td>                
          </tr> 
          

          </div>


    ';

     $photo = "img/photopayment/ " . $rowordersales["ordersales_Photopayment"];
     $YAYA =  preg_replace("[ ]", "", $photo);
     if ($rowordersales['Ordersales_Status'] != 'รอการชำระเงิน') {
          $output .= '
          <tr> 
          <td width="30%"><label>สลิปโอนเงิน</label></td>  
          <td width="70%"><img src="' . $YAYA . '" alt=""' . $rowordersales["ordersales_Photopayment"] . '""
               class="img-fluid img-product "></img>           
               </td>                
               </tr> 
          
          ';
     } else {
     }
     $output .= '                      
     
     </table> ';
     echo $output;
}