<?php 

include 'Device_connection.php';

$Username=$_POST['Username'];
$Password=md5($_POST['Password']);




$login=mysqli_query($conn,"SELECT * FROM users WHERE (phone='$Username' OR email='$Username') AND password='$Password'");

if(mysqli_num_rows($login)==1)
{

$row=mysqli_fetch_assoc($login);
$UserID=$row['user_id'];


 
    $pass['login']="Success";
    $pass['UserID']=$UserID;



}

else
{

    $pass['login']="Failed";
    $pass['UserID']="0";
   

}



print_r(json_encode($pass));


?>