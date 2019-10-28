<?php

include 'Device_connection.php';

$code=$_POST['voucher_code'];
$user_id=$_POST['userID'];
$GrandTotal=$_POST['GrandTotal'];
// $code='TEST123';
// $user_id='1';
// $GrandTotal='100';

date_default_timezone_set('Asia/Kolkata');
$cur_date = date('h:i:s', time());
$d=date('Y-m-d');

if($code != NULL){

$query="SELECT * from voucher where voucher_code='$code' ";
$result=mysqli_query($conn,$query);
$row = mysqli_fetch_array($result);
$voucheramount = $row['2'];
// print_r($voucheramount);
// print_r($GrandTotal);

if(mysqli_num_rows($result)>0)

{
    $query3="SELECT * from voucher where voucher_code='$code' AND minimum_cart_value<='$GrandTotal'";
    $result3=mysqli_query($conn,$query3);
    if(mysqli_num_rows($result3)>0)
  
    {
    
    $query2="SELECT * from users where voucher_code='$code' AND user_id='$user_id'";
    $result2=mysqli_query($conn,$query2);
    if(mysqli_num_rows($result2)>0)
    {
        
        $data['result']="Already Used";
    }
    else{
         $query1="SELECT * from voucher where voucher_code='$code' AND valid_to 
        >='$d'";
        $result1=mysqli_query($conn,$query1);
        if(mysqli_num_rows($result1)>0)
        {
            $row=mysqli_fetch_assoc($result1);
            if($row['amount'] > $GrandTotal)
            {
              $data['result']="Voucher not aplicable";
            }
            else
            {
              $data['vouchers']=$row;
              $data['result']="success";   
            }
            // while($row=mysqli_fetch_assoc($result1))
            // {
            //     // if($row['amount'] > $GrandTotal)
            //     // {
            //     //     $data['result']="Voucher not aplicable";
            //     // }
            //     // else
            //     // {
            //     //     $data['vouchers']=$row;
            //     //     $data['result']="success";   
            //     // }
            //     print_r($row);
            //     echo "<br>";

            // }
        }
        else{
            $data['result']="Expired";
       }
    }
}

else{
    $data['result']="Minimum Cart Value Required";
}

}


else
{
   $data['result']="Invalid Code";
}
}
else{
    $data['result']="Failed";
}

$output['data']=$data;

$pass=$output;

print_r(json_encode($pass));

?>
