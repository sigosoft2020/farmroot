
<?php

include 'Device_connection.php';

$user_id=$_POST['user_id'];
$bank_name=$_POST['bank_name'];
$account_holder_name=$_POST['account_holder_name'];
$account_number=$_POST['account_number'];
$ifsc_code=$_POST['ifsc_code'];

if($user_id!='' && $bank_name!='' && $account_holder_name!='' && $account_number!='' && $ifsc_code!='')
{

$query="INSERT INTO bank_details(bank_name,account_holder_name,account_number,ifsc_code,user_id) VALUES ('$bank_name','$account_holder_name','$account_number','$ifsc_code','$user_id')";

if(mysqli_query($conn,$query))
{
    $pass['Status']="Success";
}
else
{
    $pass['Status']="Failed";
}
}
else
{
    $pass['Status']="Failed";
}
print_r(json_encode($pass));

?>