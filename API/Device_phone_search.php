<?php

include 'Device_connection.php';


$ph=$_POST['phone'];


if($ph != NULL){
$query="SELECT * from users where phone='$ph' OR email='$ph' ";

$result=mysqli_query($conn,$query);


if(mysqli_num_rows($result)>0)

{
    while($row=mysqli_fetch_assoc($result))
{
   $search['user_id']=$row['user_id'];
   $search['search']="success";

}

  



}
else
{
    $search['user_id']="";
   $search['search']="Failed";
}
}
else{
    $search['user_id']="";
    $search['search']="Failed";
}

$output['data']=$search;

$pass=$output;

print_r(json_encode($pass));

?>
