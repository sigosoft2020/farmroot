<?php 

include 'Device_connection.php';
$time=time('h-m');
$date1 = date_default_timezone_set('Asia/Kolkata');

$date=date('Y-m-d');
$today = date("g:i:s");
//print_r($today);

//$query="SELECT todays_deal.*, products.* FROM todays_deal INNER JOIN products ON todays_deal.TodaysDeal_ProductId=products.ProductID";
//$query="SELECT todays_deal.*, products.*,brands.* FROM todays_deal INNER JOIN products ON todays_deal.TodaysDeal_ProductId=products.ProductID INNER JOIN brands ON products.BrandID=brands.BrandID";
$query="SELECT products.*,brands.*,todays_deal.* from products inner join brands ON products.BrandID=brands.BrandID INNER JOIN todays_deal ON todays_deal.TodaysDeal_Id=products.todays_offer_id  where products.todays_offer_status='1' and todays_deal.date='$date' and ProductStock>0 and products.percentage!='0' ORDER BY todays_deal.possition asc";
$result=mysqli_query($conn,$query);


if(mysqli_num_rows($result)>0)

{

while($row=mysqli_fetch_assoc($result))
{
   
   $Deals[]=$row;
   $status="success";
   

}

}
else
{
   
   $Deals[]="No Deals";
   $status="failed";;
}




$output['Deals']=$Deals;
$output['Status']=$status;





$pass=$output;


print_r(json_encode($pass));





?>