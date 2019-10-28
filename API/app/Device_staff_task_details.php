<?php



include 'Device_connection.php';


$current_date = date('Y-m-d');

$TaskID=$_POST['LiveTaskID'];


$query=mysqli_query($conn,"SELECT tasks.*,app_orders.*,live_task.* FROM tasks INNER JOIN app_orders ON tasks.order_id=app_orders.OrderID INNER JOIN live_task ON live_task.TaskID=tasks.task_id WHERE live_task.LiveTaskID='$TaskID' ");


if(mysqli_num_rows($query) > 0){

while($row=mysqli_fetch_assoc($query))
{

$data[]=$row;

}

}

else{
 $message = array('result' => 'No Tasks');
  
$data[]=$message;

}


$output['Task']=$data;

$pass=$output;



print_r(json_encode($pass));


?>