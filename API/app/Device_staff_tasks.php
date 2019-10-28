<?php 

include 'Device_connection.php';


$current_date = date('Y-m-d');

$staff_id=$_POST['staff_id'];


$tasks="SELECT tasks.*, users.*,app_orders.* FROM tasks INNER JOIN users ON tasks.customer_id=users.user_id INNER JOIN app_orders ON app_orders.OrderID=tasks.order_id WHERE tasks.staff_id='$staff_id' AND tasks.flag='1' AND task_status='Pending'";

$result=mysqli_query($conn,$tasks);


if(mysqli_num_rows($result)>0)

{

while($row=mysqli_fetch_assoc($result))
{
   $task_list[]=$row;

}

}
else
{
   $task_list[]="No Task";
}




$output['task_list']=$task_list;




$temporary="SELECT live_task.*, users.*,app_orders.OrderID,tasks.order_id,tasks.task_id,app_orders.GrandTotal,app_orders.BillingDet_Name,app_orders.BillingDet_Email,app_orders.BillingDet_Phone,app_orders.BillingDet_Land,app_orders.BillingDet_City,app_orders.BillingDet_PIN FROM live_task INNER JOIN users ON live_task.customer_id=users.user_id INNER JOIN tasks ON live_task.TaskID=tasks.task_id INNER JOIN app_orders ON app_orders.OrderID=tasks.order_id WHERE live_task.staff_id='$staff_id' ORDER BY live_task.LiveTaskID DESC";
$result=mysqli_query($conn,$temporary);


if(mysqli_num_rows($result)>0)

{

while($list=mysqli_fetch_assoc($result))
{
   $temporary_task[]=$list;

}

}
else
{
   $message = array('result' => 'No Tasks');
   $temporary_task[]=$message;
}

$output['temporary_task']=$temporary_task;

$pass=$output;


print_r(json_encode($pass));

?>