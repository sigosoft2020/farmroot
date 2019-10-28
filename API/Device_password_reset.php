
<?php

include 'Device_connection.php';

$phone=$_POST['phone'];
$new_pass=md5($_POST['new_pass']);




$query="UPDATE users SET password='$new_pass' WHERE phone='$phone'";


if(mysqli_query($conn,$query))
{
  $que="SELECT * FROM users where password='$new_pass' AND  phone='$phone'";
$result=mysqli_query($conn,$que);


if(mysqli_num_rows($result)>0)

{
     $pass['Status']="Success";
}
else{
     $pass['Status']="Failed";
}
}

print_r(json_encode($pass));

?>