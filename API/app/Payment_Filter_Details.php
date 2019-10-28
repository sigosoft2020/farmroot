<?php
include 'Device_connection.php';

$CustomerID=$_POST['CustomerID'];
$from=$_POST['From'];
$to=$_POST['to'];
$staff_id=$_POST['StaffID'];


$query=mysqli_query($conn,"SELECT (SELECT SUM(GrandTotal) FROM app_orders WHERE BillingDet_UserId='$CustomerID' AND assigned_staff_id='$staff_id') AS Total , (SELECT SUM(Amount) FROM payment_collection WHERE CustomerID='$CustomerID' AND PaymentDate >='$from' AND PaymentDate<='$to' AND StaffID='$staff_id') AS Payed");
$row=mysqli_fetch_assoc($query);

$Total_B=$row['Total'];

if(empty($Total_B))
{

$Total=0;

}
else
{

$Total=$Total_B;

}

$Payed_B=$row['Payed'];

if(empty($Payed_B))
{


$Payed=0;

}
else
{

$Payed=$Payed_B;

}

$pass['Total']=$Total;
$pass['Paid']=$Payed;


$pass['Payments']=$data;

print_r(json_encode($pass));

?>