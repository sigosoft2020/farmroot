<?php



include 'Device_connection.php';


$current_date = date('Y-m-d');

$staffID=$_POST['staffID'];


$query=mysqli_query($conn,"SELECT EDate,Amount,expense_category_name,Description FROM expense_table WHERE staff_id='$staffID'");


if(mysqli_num_rows($query) > 0){

while($row=mysqli_fetch_assoc($query))
{

$data[]=$row;

}

}

else{
 $message = array('result' => 'No payments');
  
$data[]=$message;

}


$output['Payments']=$data;

$pass=$output;



print_r(json_encode($pass));


?>