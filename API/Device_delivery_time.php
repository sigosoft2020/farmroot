<?php

include 'Device_connection.php';


$StoreID=$_POST['StoreID'];


$query="SELECT * from delivery_time where time_id='1' ";

$result=mysqli_query($conn,$query);


if(mysqli_num_rows($result)>0)

{

while($row=mysqli_fetch_assoc($result))
{
   $deliverytime[]=$row;

}

}
else
{
   $deliverytime[]="No data";
}




$output['deliverytime']=$deliverytime;





$pass=$output;


print_r(json_encode($pass));





?>
