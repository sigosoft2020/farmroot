<?php 

include 'Device_connection.php';



$query="SELECT * FROM package";
$result=mysqli_query($conn,$query);


if(mysqli_num_rows($result)>0)

{

while($row=mysqli_fetch_assoc($result))
{
   $package[]=$row;

}

}
else
{
   $package[]="No package";
}




$output['package']=$package;





$pass=$output;


print_r(json_encode($pass));





?>