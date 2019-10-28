<?php 

include 'Device_connection.php';

$Key=$_POST['Key'];

if($Key=='Brand')
{

   $BrandID=$_POST['BrandID'];
   $query="SELECT * FROM products WHERE BrandId='$BrandID'"; 
   $result=mysqli_query($conn,$query);

if(mysqli_num_rows($result)>0)

{

while($row=mysqli_fetch_assoc($result))
{
   $Product[]=$row;

}

}
else
{
   $Product[]="No Products";
}

$output['Product']=$Product;
$pass=$output;

}
elseif($Key=='SubCategory')
{

$SubategoryID=$_POST['SubCategoryID'];
$status=$_POST['loc_stat'];

if($status == '1'){
    //$query="SELECT * FROM products WHERE Subcategory_ID='$SubategoryID' AND pflag='1'";
    //$result=mysqli_query($conn,$query);
    $query="SELECT products.*,brands.* from products INNER JOIN brands on products.BrandID=brands.BrandID WHERE products.Subcategory_ID='$SubategoryID' AND products.pflag='1' order by products.percentage desc,products.ProductStock desc";
}
else{
    //$query="SELECT * FROM products WHERE Subcategory_ID='$SubategoryID'";
    //$result=mysqli_query($conn,$query);
    $query="SELECT products.*,brands.* FROM products INNER JOIN brands ON products.BrandID=brands.BrandID WHERE products.Subcategory_ID='$SubategoryID' order by products.percentage desc,products.ProductStock desc";
}

$result=mysqli_query($conn,$query);


if(mysqli_num_rows($result)>0)

{

while($row=mysqli_fetch_assoc($result))
{
   $Product[]=$row;

}

}
else
{
   $Product[]="No Products";
}

$output['Product']=$Product;

$pass=$output;

};

print_r(json_encode($pass));

?>