<?php 

include 'Device_connection.php';

$OrderID=$_POST['OrderID'];

$query="SELECT * FROM app_order_items WHERE OrderID='$OrderID'";
$result=mysqli_query($conn,$query);


if(mysqli_num_rows($result)>0)

{

while($row=mysqli_fetch_assoc($result))
{
   $order_items[]=$row;

}

}
else
{
   $order_items[]="No Data";
}




$output['order_items']=$order_items;





$pass=$output;


print_r(json_encode($pass));





?>