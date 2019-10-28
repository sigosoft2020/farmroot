<?php 

include 'Device_connection.php';

$UserID=$_POST['UserID'];

//$query="SELECT * FROM address_table WHERE user_id='$UserID'";
$query="SELECT users.*,address_table.* FROM users INNER JOIN address_table ON address_table.user_id=users.user_id where users.user_id='$UserID' order by edited_time desc";
$result=mysqli_query($conn,$query);


if(mysqli_num_rows($result)>0)

{

while($row=mysqli_fetch_assoc($result))
{
   $order_items[]=$row;
   $status="success";

}

}
else
{
   
   $order_items[]="No Data";
   $status="failed";
}


$output['order_items']=$order_items;
$output['Status']=$status;

$pass=$output;


print_r(json_encode($pass));


?>