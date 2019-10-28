<?php

include 'Device_connection.php';
$key = $_POST['key'];


$sql="SELECT ProductID,ProductName,manglish_name,malayalam_name FROM products WHERE ProductName LIKE '%$key%'";
$result=mysqli_query($conn,$sql);

$sql1="SELECT ProductID,ProductName,manglish_name,malayalam_name FROM products WHERE  manglish_name LIKE '%$key%'";
$result1=mysqli_query($conn,$sql1);

$sql2="SELECT ProductID,ProductName,manglish_name,malayalam_name FROM products WHERE malayalam_name LIKE '%$key%'";
$result2=mysqli_query($conn,$sql2);


if(mysqli_num_rows($result)>0)
{

while($row=mysqli_fetch_assoc($result))
{
    $message = array('ProductName' => $row['ProductName'],'ProductID' => $row['ProductID'],'result'=>'success');
    $pass[]=$message;
     $res="success";
    $output['result']='success';
   
    
}
while($row1=mysqli_fetch_assoc($result1))
{
    $message1 = array('ProductName' => $row1['manglish_name'],'ProductID' => $row1['ProductID'],'result'=>'success');
    $pass[]=$message1;
     $res="success";
   
}


}
elseif(mysqli_num_rows($result1)>0)
{

while($row1=mysqli_fetch_assoc($result1))
{
    $message1 = array('ProductName' => $row1['manglish_name'],'ProductID' => $row1['ProductID'],'result'=>'success');
    $pass[]=$message1;
     $res="success";
    
   
}
while($row=mysqli_fetch_assoc($result))
{
    $message = array('ProductName' => $row['ProductName'],'ProductID' => $row['ProductID'],'result'=>'success');
    $pass[]=$message;
    $res="success";
    
}

}

elseif(mysqli_num_rows($result2)>0)
{

while($row2=mysqli_fetch_assoc($result2))
{
    $message2 = array('ProductName' => $row2['malayalam_name'],'ProductID' => $row2['ProductID'],'result'=>'success');
    $pass[]=$message2;
    $res="success";
}


}
/*
if(mysqli_num_rows($result)>0)
{

while($row=mysqli_fetch_assoc($result))
{
    $message = array('ProductName' => $row['ProductName'],'ProductID' => $row['ProductID']);
    $pass[]=$message;
    
}




while($row1=mysqli_fetch_assoc($result1))
{
    $message1 = array('ProductName' => $row1['manglish_name'],'ProductID' => $row1['ProductID']);
    $pass[]=$message1;
   
}


while($row2=mysqli_fetch_assoc($result2))
{
    $message2 = array('ProductName' => $row2['malayalam_name'],'ProductID' => $row2['ProductID']);
    $pass[]=$message2;
}


} */

else
{
    $pass=[];
   $res="no data";
// $pass['result']="no data";
}

$output['data']=$pass;
$output['result']=$res;

$pass1=$output;

print_r(json_encode($pass1));

?>
