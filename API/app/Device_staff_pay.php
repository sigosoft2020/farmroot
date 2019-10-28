<?php

include 'Device_connection.php';


$order_id=$_POST['order_id'];
$staff_id=$_POST['staff_id'];
$customer_id=$_POST['customer_id'];

$query=mysqli_query($conn,"SELECT app_orders.GrandTotal,sum(payment_collection.Amount) as toal_paid,(app_orders.GrandTotal-sum(payment_collection.Amount)) as balance FROM app_orders INNER JOIN payment_collection ON app_orders.OrderID=payment_collection.order_id WHERE payment_collection.customerID='$customer_id' AND payment_collection.StaffID='$staff_id' AND payment_collection.order_id='$order_id'");


if(isset($query))
{

    while($row=mysqli_fetch_assoc($query))
    {
        if($row['GrandTotal']==NULL)
        {
            $data['result']='No Payments';
            $data['status']='failed';
        }
        else
        {
            $data['result']=$row;
            $data['status']='success';
        }
       
    }

}

else
{
     //$message = array('result' => 'No Data');
     $data['result']='No Data';
     $data['status']='failed';

}


$output['data']=$data;

$pass=$output;



print_r(json_encode($pass));


?>