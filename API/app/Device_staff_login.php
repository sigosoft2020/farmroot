<?php 

include 'Device_connection.php';

$uname=$_POST['username'];
$Password=md5($_POST['password']);




$login=mysqli_query($conn,"SELECT staff_id,name FROM staff WHERE mobile='".$uname."' AND password='".$Password."' AND status='active'");

if(mysqli_num_rows($login)>0)
{

$row=mysqli_fetch_assoc($login);
$staff_id=$row['staff_id'];


    $pass['login']="Success";
    $pass['staff']=$row;



}

else
{

    $pass['login']="Failed";
   

}



print_r(json_encode($pass));


?>