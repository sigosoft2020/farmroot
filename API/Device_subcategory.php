<?php 

include 'Device_connection.php';

$cat=$_POST['category'];
//$query="SELECT * FROM subcategory where category_id='$cat'";
$query="SELECT category.*,subcategory.* FROM category INNER JOIN subcategory ON subcategory.category_id=category.category_id where subcategory.category_id='$cat' and subcategory.Status='Active'";
//$query="SELECT category.*,subcategory.*,count(subcategory.Category_Id) as countofcat FROM category INNER JOIN subcategory ON subcategory.category_id=category.category_id where subcategory.category_id='$cat'";


//$query="SELECT category.*,subcategory.*,count(products.ProductID) as countofcat FROM category INNER JOIN subcategory ON subcategory.category_id=category.category_id  INNER JOIN products ON products.CategoryID=category.category_id where subcategory.category_id='$cat' and products.CategoryID='$cat'";
$result=mysqli_query($conn,$query);
if(mysqli_num_rows($result)>0)
{

while($row=mysqli_fetch_assoc($result))
    {
      $subcategory[]=$row;
    }
}
else
{
   $subcategory[]="No SubCategory";
}


$output['subcategory']=$subcategory;
$pass=$output;
print_r(json_encode($pass));


?>