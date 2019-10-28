
<?php

include 'Device_connection.php';

$user=$_POST['user_id'];
$phone=$_POST['phone'];

$query="UPDATE users SET phone='$phone' WHERE user_id='$user'";

if(mysqli_query($conn,$query))
{
  $que="SELECT phone FROM users where user_id='$user' AND  phone='$phone'";
$result=mysqli_query($conn,$que);


if(mysqli_num_rows($result)>0)
    {
        
         $pass['status']="Success";
    }
else
   {
         $pass['status']="Failed";
   }
}


print_r(json_encode($pass));

?>