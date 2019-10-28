<?php 

include 'Device_connection.php';
use Razorpay\Api\Api;
$UserID=$_POST['UserID'];
$OrderNo=$_POST['OrderNo'];

$query="SELECT payment_code FROM app_orders WHERE BillingDet_UserId='$UserID' AND OrderNO='$OrderNo'";
$result=mysqli_query($conn,$query);


if(mysqli_num_rows($result)>0)

{

while($row=mysqli_fetch_assoc($result))
{
    
    $code=$row['payment_code'];

    $api = new Api('rzp_live_bmZfIisBP4M1KL', 'v9lCaBuQDrh1nkMTsi3OeG2F');

    $payment = $api->payment->fetch('pay_BTGvrXskbv9xvC');


   $code[]=$payment;
   $status="success";

}

}
else
{
    $code=[];
    $status="failed";
}

$output['code']=$code;
$output['Status']=$status;

$pass=$output;

print_r(json_encode($pass));

?>