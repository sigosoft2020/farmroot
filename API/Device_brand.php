<?php 


include 'Device_connection.php';



$query="SELECT BrandID, BrandName, BrandImage FROM brands";
$result=mysqli_query($conn,$query);


if(mysqli_num_rows($result)>0)

{

while($row=mysqli_fetch_assoc($result))
{
   $Brand[]=$row;
   $status="success";

}

}
else
{
   $Brand[]="No Brands";
   $status="failed";
}


$output['Brand']=$Brand;
$output['Status']=$status;

$pass=$output;


print_r(json_encode($pass));

?>