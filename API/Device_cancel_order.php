<?php

include 'Device_connection.php';

$user_id=$_POST['user_id'];
$order_no=$_POST['invoice_no'];
$CartData=$_POST['CartData'];
$payment_code=$_POST['payment_code'];
$reason = $_POST['reason'];

    $json1 = json_decode($CartData, true);
    $json = $json1['orders'];
    $elementCount  = count($json);
     for ($i=0;$i < $elementCount; $i++) 
      {
         $Product_Id=$json[$i]['prdct_id'];
         $ProductName=$json[$i]['prdct_name'];
         $prdct_price=$json[$i]['prdct_price'];
         $Quantity=$json[$i]['qty'];
         
         //$query="UPDATE app_orders SET status='Cancelled' WHERE BillingDet_UserId='$user_id' and InvoiceNO='$invoice_no'";
         //mysqli_query($conn,$query);
         
         
         $update="UPDATE app_order_items SET ret_status='Cancelled',payment_code='$payment_code' ,reason ='$reason' WHERE OrderNo='$order_no' AND ProductID='$Product_Id'";
         mysqli_query($conn,$update);
         
      }
      
      $Getuserphone=mysqli_query($conn,"SELECT * FROM users WHERE user_id='$user_id'");
      $Getph=mysqli_fetch_assoc($Getuserphone);
      $Phone=$Getph['phone'];
     
    
    
      $query="select count(*) as cnt from app_order_items where OrderNo='$order_no'";
      $nbr_items=mysqli_query($conn,$query);
      while($data=mysqli_fetch_assoc($nbr_items))
      {
          $count=$data['cnt'];
      
      }
      
      $query3="select count(*) as cnt from app_order_items where OrderNo='$order_no' AND ret_status='Order Placed'";
      $nbr_items3=mysqli_query($conn,$query3);
      while($data3=mysqli_fetch_assoc($nbr_items3))
      {
          $count3=$data3['cnt'];
      
      }
     
      $query2="select count(*) as cnt from app_order_items where OrderNo='$order_no' AND ret_status='Cancelled'";
      $nbr_items2=mysqli_query($conn,$query2);
      while($data2=mysqli_fetch_assoc($nbr_items2))
      {
          $count2=$data2['cnt'];
      
      }
      
        if(($count2)==$count)
        {
            $query1="UPDATE app_orders SET status='Cancelled',payment_code='$payment_code' WHERE BillingDet_UserId='$user_id' and OrderNO='$order_no'";
            mysqli_query($conn,$query1);
        }



if(mysqli_query($conn,$update))
{
        $pass['Status']="Success";
        $pass['Result']="Cancelled";
        $pass['Phone']=$Phone;
   
}
else
{
    $pass['Status']="Failed";
    $pass['Result']=[];
}
$output=$pass;


print_r(json_encode($output));

?>