<?php



include 'Device_connection.php';
$Mode=$_POST['Mode'];
$CustomerID=$_POST['CustomerID'];
//$AgentID=$_POST['AgentID'];
$from=$_POST['From'];
$to=$_POST['To'];
$staff_id=$_POST['StaffID'];


if($Mode=='Filter')
{

$from=$_POST['From'];
$to=$_POST['To'];

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



$last_date=mysqli_query($conn,"SELECT * FROM payment_collection WHERE CustomerID='$CustomerID' AND PaymentDate >='$from' AND PaymentDate<='$to' AND StaffID='$staff_id' ORDER BY PaymentID ASC LIMIT 1");
$last_row=mysqli_fetch_assoc($last_date);
$pass['Last_payment']=$last_row['PaymentDate'];

$sql=mysqli_query($conn,"SELECT payment_collection.*, users.* FROM payment_collection INNER JOIN users ON payment_collection.CustomerID=users.user_id WHERE  payment_collection.CustomerID='$CustomerID' AND payment_collection.StaffID='$staff_id' AND payment_collection.PaymentDate >='$from' AND payment_collection.PaymentDate<='$to'");


if(mysqli_num_rows($sql) > 0){

while($rower=mysqli_fetch_assoc($sql))
{

$data[]=$rower;

}

}

else{
 $message = array('result' => 'No Payments');
   
$data[]=$message;

}




}

if($Mode=='All')
{



$query=mysqli_query($conn,"SELECT (SELECT SUM(GrandTotal) FROM app_orders WHERE BillingDet_UserId='$CustomerID' AND assigned_staff_id='$staff_id') AS Total , (SELECT SUM(Amount) FROM payment_collection WHERE CustomerID='$CustomerID' AND StaffID='$staff_id') AS Payed");
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



$last_date=mysqli_query($conn,"SELECT * FROM payment_collection WHERE CustomerID='$CustomerID' AND StaffID='$staff_id' ORDER BY PaymentID ASC LIMIT 1");
$last_row=mysqli_fetch_assoc($last_date);
$pass['Last_payment']=$last_row['PaymentDate'];



$sql=mysqli_query($conn,"SELECT payment_collection.*, users.* FROM payment_collection INNER JOIN users ON payment_collection.CustomerID=users.user_id WHERE  payment_collection.CustomerID='$CustomerID' AND payment_collection.StaffID='$staff_id'");


if(mysqli_num_rows($sql) > 0){

while($rower=mysqli_fetch_assoc($sql))
{

$data[]=$rower;

}

}

else{
$message = array('result' => 'No Payments');
$data[]=$message;

}






}
$pass['Payments']=$data;

print_r(json_encode($pass));

?>