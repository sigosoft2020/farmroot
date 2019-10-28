
<?php

include 'Device_connection.php';

$user_id=$_POST['user_id'];
$house=$_POST['house'];
$house_no=$_POST['house_no'];
$city=$_POST['city'];
$pincode=$_POST['pincode'];
$place=$_POST['place'];

$tme=time();


$query="INSERT INTO address_table(house,house_no,city,pincode,user_id,place,edited_time) VALUES ('$house','$house_no','$city','$pincode','$user_id','$place','$tme')";


if(mysqli_query($conn,$query))
{
    $pass['Status']="Success";
}
else
{
    $pass['Status']="Failed";
}

print_r(json_encode($pass));

?>