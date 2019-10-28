<?php



include 'Device_connection.php';


$current_date = date('Y-m-d');

$AgentID=$_POST['AgentID'];


$query=mysqli_query($conn,"SELECT payment_collection.*, users.* FROM payment_collection INNER JOIN users ON payment_collection.customerID=users.user_id WHERE payment_collection.StaffID='$AgentID'");


if(mysqli_num_rows($query) > 0){

while($row=mysqli_fetch_assoc($query))
{

$data[]=$row;

}

}

else{
//$message = array('result' => 'No payments');
$data=[];
$result='No payments';

}


$output['Payments']=$data;
$output['Result']=$result;

$pass=$output;



print_r(json_encode($pass));


?>