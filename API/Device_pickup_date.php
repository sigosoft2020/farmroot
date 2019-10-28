<?php 

include 'Device_connection.php';
 $date=date('Y-m-d');
   $query="SELECT * FROM delivery WHERE delivery_date>'$date'"; 
   $result=mysqli_query($conn,$query);

if(mysqli_num_rows($result)>0)

{

while($row=mysqli_fetch_assoc($result))
{
   $dates[]=$row;
   $status="success";
}

}
else
{
   $dates[]="No Data";
   $status="failed";
}

$output['date']=$dates;
$output['Status']=$status;

$pass=$output;
print_r(json_encode($pass));


?>