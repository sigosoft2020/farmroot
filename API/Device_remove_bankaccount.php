
<?php

include 'Device_connection.php';

$user_id=$_POST['user_id'];
$bank_id=$_POST['bank_id'];

if($user_id!='' && $bank_id!='')
{

$query="DELETE FROM bank_details WHERE bank_id='$bank_id' AND user_id='$user_id'";

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