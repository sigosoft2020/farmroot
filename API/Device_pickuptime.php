<?php 

include 'Device_connection.php';
 $date=date('Y-m-d');
   $query="SELECT * FROM pickup_time"; 
   $result=mysqli_query($conn,$query);

if(mysqli_num_rows($result)>0)

{

while($row=mysqli_fetch_assoc($result))
{
   $tme[]=$row;
   $status="success";
}

}
else
{
   $tme[]="No Data";
   $status="failed";
}

$output['time']=$tme;
$output['Status']=$status;

$pass=$output;
print_r(json_encode($pass));


?>