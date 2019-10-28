<?php 

include 'Device_connection.php';

$Key=$_POST['Key'];
$d=date('Y-m-d');

if($Key=='Others')
{

   $query="SELECT * FROM delivery WHERE category='Non Vegetables' and delivery_date>='$d'"; 
   $result=mysqli_query($conn,$query);



if(mysqli_num_rows($result)>0)

{

while($row=mysqli_fetch_assoc($result))
{
   $date[]=$row;
   $status="success";

}

}
else
{
   $date=[];
   $status="failed";
}




$output['date']=$date;
$output['Status']=$status;





$pass=$output;




}




print_r(json_encode($pass));





?>