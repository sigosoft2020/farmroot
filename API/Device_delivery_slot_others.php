<?php 

include 'Device_connection.php';

$Key=$_POST['Key'];

if($Key=='Others')
{

   $query="SELECT * FROM delivery_slot WHERE category='Others'"; 
   $result=mysqli_query($conn,$query);



if(mysqli_num_rows($result)>0)

{

while($row=mysqli_fetch_assoc($result))
{
   $slot[]=$row;
   $status="success";

}

}
else
{
   $slot[]="No slot";
   $status="failed";
}




$output['slot']=$slot;
$output['Status']=$status;

$pass=$output;




}




print_r(json_encode($pass));





?>