<?php 
include 'Device_connection.php';


$current_date = date('Y-m-d');
$staffId=$_POST['staffId'];

$completed="SELECT live_task.TaskID,live_task.EndDate,live_task.LiveTaskID,users.*,app_orders.BillingDet_City,tasks.order_id FROM live_task INNER JOIN users ON live_task.customer_id=users.user_id INNER JOIN tasks ON live_task.TaskID=tasks.task_id INNER JOIN app_orders ON app_orders.OrderID=tasks.order_id WHERE live_task.staff_id='$staffId' AND live_task.Status='Completed'";
$result=mysqli_query($conn,$completed);


if(mysqli_num_rows($result)>0)

{

while($list=mysqli_fetch_assoc($result))
{
   $completed_task[]=$list;

}

}
else
{
    $message = array('result' => 'No Tasks');
   $completed_task[]=$message;
}


$output['completed_task']=$completed_task;

$pass=$output;


print_r(json_encode($pass));

?>