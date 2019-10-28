<?php 

include 'Device_connection.php';

$UserID=$_POST['UserID'];


$login=mysqli_query($conn,"SELECT user_id, name, phone, email FROM users WHERE user_id='$UserID'");

if(mysqli_num_rows($login)==1)
{

$row=mysqli_fetch_assoc($login);


$pass['Details']=$row;
  

}

else
{

$pass['Details']="No Data";
 
}



print_r(json_encode($pass));



?>