<?php
include 'Device_connection.php';


$item=$_POST['item'];
$item_id=$_POST['item_id'];


if($item == "category"){
    $query="SELECT * from category where Category_Id='$item_id'";
    
    $result=mysqli_query($conn,$query);

        if(mysqli_num_rows($result)>0)
        
        {
           while($row=mysqli_fetch_assoc($result))
            {
           $search['Item']=$item;
           $search['Title']=$row['Category_Title'];
           $search['Id']=$row['Category_Id'];
           $status="success";
            }
        }
        else{
           $search['Item']=[];
           $search['Title']=[];
           $search['Id']=[];
           $status="failed";
        }
   
}
else{
    $query1="SELECT * from products where ProductID='$item_id'";

    $result=mysqli_query($conn,$query1);

        if(mysqli_num_rows($result)>0)
        {
           while($row=mysqli_fetch_assoc($result))
           {
           $search['Item']=$item;
           $search['Title']=$row['ProductName'];
           $search['Id']=$row['ProductID'];
           $status="success";
           }
        }
        else{
           $search['Item']=[];
           $search['Title']=[];
           $search['Id']=[];
           $status="failed";
        }
}

$output['data']=$search;
$output['status']=$status;
$pass=$output;
print_r(json_encode($pass));
?>
