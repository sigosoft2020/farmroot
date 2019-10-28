
<?php

include 'Device_connection.php';

$BillingDet_Phone=$_POST['BillingDet_Phone'];
$BillingDet_Name=$_POST['BillingDet_Name'];
$BillingDet_Land=$_POST['BillingDet_Land'];
$BillingDet_City=$_POST['BillingDet_City'];
$BillingDet_Address=$_POST['BillingDet_Address'];
$BillingDet_Email=$_POST['BillingDet_Email'];


$BillingDet_UserId=$_POST['BillingDet_UserId'];

$UserType="User";


$GrandTotal=$_POST['GrandTotal'];;

$CartData=$_POST['CartData'];

$delevery_date=$_POST['delevery_time'];
$delevery_date_veg=$_POST['delevery_time_veg'];

$longitude=$_POST['longitude'];
$latitude=$_POST['latitude'];
$voucher_code=$_POST['voucher_code'];
$voucher_amount=$_POST['voucher_amount'];
$payment_mode=$_POST['payment_mode'];
$del_slot_veg=$_POST['del_slot_veg'];
$del_slot_others=$_POST['del_slot_others'];

$payment_code=$_POST['payment_code'];

//$OrderNO='APP'.time();
//$InvoiceNO='A'.time();
$sel=mysqli_query($conn,"SELECT * FROM last_invoice WHERE last_id='1'");
$sel_row=mysqli_fetch_assoc($sel);
$last_invoice=$sel_row['last_invoice'];
    
$OrderNO='FMRT'.$last_invoice;
$InvoiceNO='FRT'.$last_invoice;


date_default_timezone_set('Asia/Kolkata');
$t_date=date('Y-m-d');
$t_time=date('h:i:s a', time());



// use Razorpay\Api\Api;

// $api = new Api('rzp_test_26ccbdbfe0e84b', '69b2e24411e384f91213f22a');

// $payment = $api->payment->fetch($payment_code);





$query="INSERT INTO app_orders(OrderNO, InvoiceNO, GrandTotal, BillingDet_UserId, UserType, BillingDet_Name,BillingDet_Phone, BillingDet_Land, BillingDet_City,BillingDet_Address,status,delivery_date,type_of_sale,delivery_date_veg,longitude,latitude,voucher_code,voucher_amount,BillingDet_Email,payment_mode,del_slot_others,del_slot_veg,billing_date,billing_time,payment_code) VALUES ('$OrderNO', '$InvoiceNO', '$GrandTotal', '$BillingDet_UserId', '$UserType', '$BillingDet_Name', '$BillingDet_Phone', '$BillingDet_Land', '$BillingDet_City', '$BillingDet_Address', 'Order Placed','$delevery_date','App Order','$delevery_date_veg','$longitude','$latitude','$voucher_code','$voucher_amount','$BillingDet_Email','$payment_mode','$del_slot_others','$del_slot_veg','$t_date','$t_time','$payment_code')";

if(mysqli_query($conn,$query))
{

 $OrderID=mysqli_insert_id($conn);
 mysqli_query($conn,"update last_invoice SET last_invoice=last_invoice+1 WHERE last_id='1'");

 $qry="UPDATE users SET voucher_code='$voucher_code' where user_id='$BillingDet_UserId'";
 mysqli_query($conn,$qry);
 
 
    $Getuserphone=mysqli_query($conn,"SELECT * FROM users WHERE user_id='$BillingDet_UserId'");
    $Getph=mysqli_fetch_assoc($Getuserphone);
    $Phone=$Getph['phone'];
    

// $save_address=mysqli_query($conn,"INSERT INTO address_table(BillingDet_Land, BillingDet_City,BillingDet_Address, UserID) VALUES ('$BillingDet_Land', '$BillingDet_City', '$BillingDet_Address', '$BillingDet_UserId')");

 $json1 = json_decode($CartData, true);
$json = $json1['order'];
$elementCount  = count($json);





for ($i=0;$i < $elementCount; $i++) 
 {
 

    $ProductName=$json[$i]['ProductName'];
    $Product_Id=$json[$i]['Product_Id'];


    $Quantity=$json[$i]['Quantity'];
    $Product_MRP=$json[$i]['Product_MRP'];
    $offer_price=$json[$i]['offer_price'];
    $Total=$json[$i]['Total'];

    $GetImage=mysqli_query($conn,"SELECT * FROM products WHERE ProductID='$Product_Id'");
    $GetImage_row=mysqli_fetch_assoc($GetImage);
 

    $ProductImage=$GetImage_row['Product_Image'];
    $sgst=$GetImage_row['sgst'];
    $cgst=$GetImage_row['cgst'];
    $gst=$GetImage_row['gst'];
    $cat_id=$GetImage_row['CategoryID'];
    $ProductStock=$GetImage_row['ProductStock']-$Quantity;
   
  

 $sql=mysqli_query($conn,"INSERT INTO app_order_items(OrderID, ProductID, ProductName, 	ProductImage, 	Quantity, ProductPrice, Total, OrderNo, InvoiceNO,sgst,cgst,gst,offer_price,category,ret_status) VALUES ('$OrderID', '$Product_Id', '$ProductName', '$ProductImage', '$Quantity', '$Product_MRP', '$Total', '$OrderNO', '$InvoiceNO','$sgst','$cgst','$gst','$offer_price','$cat_id','Order Placed')");

 
    if($ProductStock<=0)
    {
        $stock=mysqli_query($conn,"UPDATE products SET ProductStock='0',stock_status='out',percentage='0' WHERE ProductID='$Product_Id'");
    }
    else
    {
        $stock=mysqli_query($conn,"UPDATE products SET ProductStock=ProductStock-'$Quantity', stock_status='in' WHERE ProductID='$Product_Id'");
    }


 }

$pass['Status']="Success";
$pass['id']=$OrderNO;
$pass['mobile']=$Phone;


}
else
{

$pass['Status']="Failed";

}



print_r(json_encode($pass));



?>