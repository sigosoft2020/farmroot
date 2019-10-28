<?php

include 'Device_connection.php';


$order_no=$_POST['invoice_no'];
$reason=$_POST['reason'];
$grand_total=$_POST['grand_total'];
//$item=$_POST['item_name'];
//$Product_Id=$_POST['Product_Id'];
//$qty=$_POST['qty'];
//$rate=$_POST['rate'];
$user_id=$_POST['user_id'];
$comments=$_POST['comments'];
$pickup_date=$_POST['pickup_date'];
$pickup_time=$_POST['pickup_time'];
$refund_total=$_POST['refund_total'];
$payment_code=$_POST['payment_code'];

$CartData=$_POST['CartData'];

date_default_timezone_set('Asia/Kolkata');
$ret_date=date('Y-m-d');
$ret_time=date('h:i:s a', time());

    
    $Get="SELECT * FROM app_orders WHERE OrderNO='$order_no'";
    $result=mysqli_query($conn,$Get);
    while($Get_row=mysqli_fetch_array($result))
    {
        $payment_mode=$Get_row['payment_mode'];
        $OrderID=$Get_row['OrderID'];
        $invoice_no=$Get_row['InvoiceNO'];
    }
 
if($payment_mode!='COD')
{
    
    $json1 = json_decode($CartData, true);
    $json = $json1['orders'];
    $elementCount  = count($json);
     for ($i=0;$i < $elementCount; $i++) 
      {
         $Product_Id=$json[$i]['prdct_id'];
         $ProductName=$json[$i]['prdct_name'];
         $prdct_price=$json[$i]['prdct_price'];
         $Quantity=$json[$i]['qty'];
         
         $query="INSERT INTO returned_orders(order_no,invoice_no,reason,ret_date,ret_time,grand_total,item,Product_Id,qty,rate,user_id,mode_of_pay,comments,pickup_time,pickup_date,refund_total,payment_code,rtn_status) VALUES ('$order_no','$invoice_no','$reason','$ret_date','$ret_time','$grand_total','$ProductName','$Product_Id','$Quantity','$prdct_price','$user_id','$payment_mode','$comments','$pickup_time','$pickup_date','$refund_total','$payment_code','Returned')";
         $update="UPDATE app_order_items SET ret_status='Returned' WHERE OrderID='$OrderID' AND ProductID='$Product_Id'";
            if(mysqli_query($conn,$query) && mysqli_query($conn,$update))
            {
                  $query1="select count(*) as cnt from app_order_items where OrderNo='$order_no'";
                  $nbr_items=mysqli_query($conn,$query1);
                  while($data=mysqli_fetch_assoc($nbr_items))
                  {
                      $count=$data['cnt'];
                  
                  }
                  
                  $query2="select count(*) as cnt from app_order_items where OrderNo='$order_no' AND ret_status='Returned'";
                  $nbr_items2=mysqli_query($conn,$query2);
                  while($data2=mysqli_fetch_assoc($nbr_items2))
                  {
                      $count2=$data2['cnt'];
                  
                  }
                  
                    if(($count2)==$count)
                    {
                        $query1="UPDATE app_orders SET status='Returned' WHERE BillingDet_UserId='$user_id' and OrderNO='$order_no'";
                        mysqli_query($conn,$query1);
                    }
                    
                    
                $pass['Status']="Success";
            }
            else
            {
                $pass['Status']="Failed";
            }

      }
    
        
    
}
else
{
    $bank_id=$_POST['bank_id'];
    
    $Get_bank_det="SELECT * FROM bank_details WHERE bank_id='$bank_id' AND user_id='$user_id'";
    $res=mysqli_query($conn,$Get_bank_det);
    while($Get1=mysqli_fetch_array($res))
    {
        //$bank_name=$Get['bank_name'];
        $acount_number=$Get1['account_number'];
        $ifsc_code=$Get1['ifsc_code'];
    }
    
    $json1 = json_decode($CartData, true);
    $json = $json1['orders'];
    $elementCount  = count($json);
     for ($i=0;$i < $elementCount; $i++) 
      {
         $Product_Id=$json[$i]['prdct_id'];
         $ProductName=$json[$i]['prdct_name'];
         $prdct_price=$json[$i]['prdct_price'];
         $Quantity=$json[$i]['qty'];
    
    $query="INSERT INTO returned_orders(order_no,invoice_no,reason,ret_date,ret_time,grand_total,item,Product_Id,qty,rate,user_id,mode_of_pay,bank_id,account_no,ifsc_code,comments,pickup_time,pickup_date,refund_total,payment_code,rtn_status) VALUES ('$order_no','$invoice_no','$reason','$ret_date','$ret_time','$grand_total','$ProductName','$Product_Id','$Quantity','$prdct_price','$user_id','$payment_mode','$bank_id','$acount_number','$ifsc_code','$comments','$pickup_time','$pickup_date','$refund_total','$payment_code','Returned')";
    $update="UPDATE app_order_items SET ret_status='Returned' WHERE OrderID='$OrderID' AND ProductID='$Product_Id'";
              
        if(mysqli_query($conn,$query) && mysqli_query($conn,$update))
        {
                  $query1="select count(*) as cnt from app_order_items where OrderNo='$order_no'";
                  $nbr_items=mysqli_query($conn,$query1);
                  while($data=mysqli_fetch_assoc($nbr_items))
                  {
                      $count=$data['cnt'];
                  
                  }
                  
                  $query2="select count(*) as cnt from app_order_items where OrderNo='$order_no' AND ret_status='Returned'";
                  $nbr_items2=mysqli_query($conn,$query2);
                  while($data2=mysqli_fetch_assoc($nbr_items2))
                  {
                      $count2=$data2['cnt'];
                  
                  }
                  
                    if(($count2)==$count)
                    {
                        $query1="UPDATE app_orders SET status='Returned' WHERE BillingDet_UserId='$user_id' and OrderNO='$order_no'";
                        mysqli_query($conn,$query1);
                    }
                    
            $pass['Status']="Success";
        }
        else
        {
            $pass['Status']="Failed";
        }

      }
}


print_r(json_encode($pass));

?>