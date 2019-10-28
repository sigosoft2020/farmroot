
<?php

include 'Device_connection.php';

$user_id=$_POST['user_id'];
$category=$_POST['category'];
$product=$_POST['product'];
$unit=$_POST['unit'];
$notes=$_POST['notes'];


$query="INSERT INTO bulk_orders(category,unit,notes,user_id,product) VALUES ('$category','$unit','$notes','$user_id','$product')";


if(mysqli_query($conn,$query))
{
    $pass['Status']="Success";
}
else
{
    $pass['Status']="Failed";
}

print_r(json_encode($pass));

?>