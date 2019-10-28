<?php



include 'Device_connection.php';


$current_date = date('Y-m-d');

$staff_id=$_POST['staff_id'];


$query=mysqli_query($conn,"SELECT DISTINCT tasks.customer_id, users.name FROM tasks INNER JOIN users ON tasks.customer_id=users.user_id WHERE tasks.staff_id='$staff_id'");


if(mysqli_num_rows($query) > 0){

while($row=mysqli_fetch_assoc($query))
{

$data[]=$row;

}

}

else{

$data[]="No Customers";

}


$output['Customers']=$data;

$pass=$output;



print_r(json_encode($pass));


?>