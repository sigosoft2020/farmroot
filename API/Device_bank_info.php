<?php 

include 'Device_connection.php';

$uesr_id=$_POST['user_id'];

$query="SELECT * FROM bank_details WHERE user_id='$uesr_id' ORDER BY bank_id DESC";
$result=mysqli_query($conn,$query);


if(mysqli_num_rows($result)>0)

{

while($row=mysqli_fetch_assoc($result))
{
   $bank[]=$row;
   $status="success";
}

}
else
{
    $bank[]="No Data";
    $status="failed";
}


$output['Data']=$bank;
$output['Status']=$status;

$pass=$output;


print_r(json_encode($pass));

?>