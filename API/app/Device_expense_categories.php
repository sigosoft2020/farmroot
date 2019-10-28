<?php

include 'Device_connection.php';




$output=array();




$sql= mysqli_query($conn,"SELECT * FROM expense_category WHERE status='Active'");
 

if(mysqli_num_rows($sql) > 0){

while($row=mysqli_fetch_assoc($sql))
{

$exp_cate[]=$row;

}



}

else{

$exp_cate[]="No Categories";

}


$output['Categories']=$exp_cate;





$pass=$output;


print(json_encode($output));


?>

