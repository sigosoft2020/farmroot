<?php 

include 'Device_connection.php';

$current = date('Y-m-d');

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
  

  if($row['period_to']<=$current) {
    $Product[]=$row;
   $product['percentage'] =$row['percentage']; 
  }
  else{
    $Product[]=$row;
    $product['percentage'] ='';
  }

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
$k = 0;
while($row=mysqli_fetch_assoc($result))
{

  $current_date=strtotime($current);
  $end_date=strtotime($row['period_to']);

  if(CURDATE() == $end_date) {
   
   $percentage=$row['period_to']; 
  }
  else{
    
    $percentage=0;
  }
  $Product[$k]['percentage']=$percentage;
  $Product[]=$row;
  $k++;
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