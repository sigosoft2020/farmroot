<?php 

include 'Device_connection.php';

$UserID=$_POST['UserID'];

//$query="SELECT * FROM app_orders WHERE BillingDet_UserId='$UserID'";
$query="SELECT DISTINCT OrderID,InvoiceNO,OrderNO,timestamp,status,GrandTotal,payment_mode FROM app_orders WHERE BillingDet_UserId='$UserID' order by OrderID desc";

$result=mysqli_query($conn,$query);


if(mysqli_num_rows($result)>0)

{

while($row=mysqli_fetch_assoc($result))
{
   $Orders[]=$row;

}

}
else
{
   $Orders[]="No Orders";
}




$output['Orders']=$Orders;





$pass=$output;


print_r(json_encode($pass));





?>