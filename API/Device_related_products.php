<?php

include 'Device_connection.php';
$blog_id = $_POST['blog_id'];


$sql="SELECT blog_products.*,products.* FROM `blog_products` INNER JOIN products ON products.ProductID=blog_products.product_id WHERE blog_products.blog_id='$blog_id' AND products.ProductStock!='0'";
$result=mysqli_query($conn,$sql);


if(mysqli_num_rows($result)>0)
{

while($row=mysqli_fetch_assoc($result))
{
    $list[]=$row;
    $status="success";
}

}
else
{
   $list[]="no data";
   $status="failed";
}

$output['list']=$list;
$output['Status']=$status;

$pass=$output;
print_r(json_encode($pass));

?>
