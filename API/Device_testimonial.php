<?php

include 'Device_connection.php';



$query="SELECT * FROM testimonial";
$result=mysqli_query($conn,$query);


if(mysqli_num_rows($result)>0)

{

while($row=mysqli_fetch_assoc($result))
{
   $testimonial[]=$row;
   $status="success";

}

}
else
{
   $testimonial[]="No Testimonials";
   $status="failed";
}


$output['testimonial']=$testimonial;
$output['Status']=$status;


$pass=$output;


print_r(json_encode($pass));





?>
