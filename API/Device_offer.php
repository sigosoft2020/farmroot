<?php 

include 'Device_connection.php';

$currentdate =  date ('Y-m-d');

$query="SELECT *  FROM products where offer_price != 0 and '$currentdate' >= period_from and '$currentdate' <= period_to";
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
    $brand[]="No Brands";
    $status="failed";
}

$output['Brand']=$Brand;
$output['Status']=$status;

$pass=$output;

print_r(json_encode($pass));

?>