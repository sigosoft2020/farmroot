<?php 

include 'Device_connection.php';



$query="SELECT * FROM category WHERE CStatus='Active'";
$result=mysqli_query($conn,$query);


if(mysqli_num_rows($result)>0)

{

while($row=mysqli_fetch_assoc($result))
{
   $Category[]=$row;
   $status="success";
}

}
else
{
    $Category[]="No Category";
    $status="failed";
}




$output['Category']=$Category;
$output['Status']=$status;




$pass=$output;


print_r(json_encode($pass));





?>