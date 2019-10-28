<?php

include 'Device_connection.php';
$category_id = $_POST['category_id'];


$sql="SELECT products.*,brands.* FROM products INNER JOIN brands ON products.BrandID=brands.BrandID WHERE products.CategoryID='$category_id' order by products.percentage desc,products.ProductStock desc";
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
