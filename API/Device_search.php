<?php

include 'Device_connection.php';
$pro_id = $_POST['prod_id'];


$sql="SELECT products.*,brands.* FROM products INNER JOIN brands ON products.BrandID=brands.BrandID WHERE products.ProductID='$pro_id' order by products.ProductID desc";
$result=mysqli_query($conn,$sql);


if(mysqli_num_rows($result)>0)
{

while($row=mysqli_fetch_assoc($result))
{
    $list[]=$row;
}


}
else
{
   $list[]="no data";
}



$output['list']=$list;

$pass=$output;
print_r(json_encode($pass));



?>
