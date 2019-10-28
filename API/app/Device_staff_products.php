<?php 

include 'Device_connection.php';


$customer=$_POST['customer_id'];
$staff=$_POST['staff_id'];
$order_id=$_POST['order_id'];


$query="SELECT * FROM app_orders where BillingDet_UserId='$customer' and assigned_staff_id='$staff' and status='Order Placed' and OrderID='$order_id'";
$result=mysqli_query($conn,$query);


if(mysqli_num_rows($result)>0)

{

while($row=mysqli_fetch_assoc($result))
{
    $order_id=$row['OrderID'];
    $query1="SELECT * FROM app_order_items where OrderID='$order_id'";
    $result1=mysqli_query($conn,$query1);
    while($row1=mysqli_fetch_assoc($result1))
       {
        $package[]=$row1;
       }

}

}
else
{
   $package[]="No package";
}




$output['package']=$package;





$pass=$output;


print_r(json_encode($pass));





?>