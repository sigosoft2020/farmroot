<?php 

include 'Device_connection.php';



$query="SELECT * FROM  delivery_locations";
$result=mysqli_query($conn,$query);


if(mysqli_num_rows($result)>0)

{

while($row=mysqli_fetch_assoc($result))
{
   $locations[]=$row;

}

}
else
{
   $locations[]="No locations";
}




$output['locations']=$locations;





$pass=$output;


print_r(json_encode($pass));





?>