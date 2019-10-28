
<?php

include 'Device_connection.php';
date_default_timezone_set('Asia/Kolkata');
$staff=$_POST['StaffId'];
$customer=$_POST['CustomerId'];
$amount=$_POST['amount'];
$payment_note=$_POST['PaymentNote'];
$order_id=$_POST['OrderId'];
$current_date = date('Y-m-d');
$current_time1 = date('h:i:s a', time());

$query="INSERT INTO payment_collection(StaffID,customerID,Amount,PaymentDate,PaymentTime,PaymentNotes,order_id) VALUES('$staff','$customer','$amount','$current_date','$current_time1','$payment_note','$order_id')";

  $result=mysqli_query($conn,$query);

  
if(isset($result))
    {
        $pay_id=mysqli_insert_id($conn);
        
        $query1="UPDATE app_orders SET staff_status='1',payment_id='$pay_id' WHERE OrderID='$order_id'";

        $result1=mysqli_query($conn,$query1);
        
        $mob="SELECT * FROM app_orders WHERE OrderID='$order_id' AND BillingDet_UserId='$customer'";
        $mobile=mysqli_query($conn,$mob);
        while($ph=mysqli_fetch_assoc($mobile))
          {
            $mobile1=$ph['BillingDet_Phone'];
            $inv=$ph['InvoiceNO'];
          }
        
        $authKey = "40ADk8rXpe5b892c32"; //Your Authentkation key
        $mobileNumber = $mobile1;
        //Sender ID,While using route4 sender id should be 6 characters long.
        $senderId = "FARMRT";
        $mymsg = "Thank You for your purchase! We have received your payment ".$amount." for ORDER ID #".$inv;
        //Your message to send, Add URL encoding here.
        $message = urlencode("$mymsg");
        $route = "4";
        $postData = array(
            'authkey' => $authKey,
            'mobiles' => $mobileNumber,
            'message' => $message,
            'sender' => $senderId,
            'route' => $route
        );
        //API URL provided by your SMS service provider
        $url = "http://sms.moplet.com/api/sendhttp.php";
        $ch = curl_init();
        curl_setopt_array($ch, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $postData
        ));
        //Ignore SSL certificate verification
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $output = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'error:' . curl_error($ch);
        }
        curl_close($ch); 
        
        
        
         $pass['status']="Success";
    }
else
   {
         $pass['status']="Failed";
   }



print_r(json_encode($pass));

?>