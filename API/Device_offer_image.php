<?php 

include 'Device_connection.php';

$query="SELECT * FROM offer_image order by position asc";
$result=mysqli_query($conn,$query);


if(mysqli_num_rows($result)>0)

{

while($row=mysqli_fetch_assoc($result))
{
   $offer_image[]=$row;
   $status="success";

}

}
else
{
   $offer_image[]="No offer_image";
   $status="failed";
}




$output['offer_image']=$offer_image;
$output['Status']=$status;





$pass=$output;


print_r(json_encode($pass));





?>