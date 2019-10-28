<?php

include 'Device_connection.php';

$user_id=$_POST['user_id'];
$add_id=$_POST['address_id'];
$name=$_POST['name'];
$mobile=$_POST['mobile'];
$house=$_POST['house'];
$city=$_POST['locality'];
$house_no=$_POST['house_no'];
$landmark=$_POST['landmark'];

$tme=time();

$query="UPDATE address_table SET house='$house',city='$city',landmark='$landmark',house_no='$house_no',new_name='$name',new_mobile='$mobile',edited_time='$tme' WHERE user_id='$user_id' AND address_id='$add_id'";


if(mysqli_query($conn,$query))

{
     $pass['Status']="Success";
}
else{
     $pass['Status']="Failed";
}


print_r(json_encode($pass));

?>