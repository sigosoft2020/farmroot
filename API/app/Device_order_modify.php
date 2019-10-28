<?php 

include 'Device_connection.php';


$LiveTaskID=$_POST['LiveTaskID'];
$OrderID=$_POST['OrderID'];


$GetID=mysqli_query($conn,"SELECT staff_id,customer_id,TaskID FROM live_task WHERE LiveTaskID='$LiveTaskID'");
$Get_row=mysqli_fetch_assoc($GetID);




$staff_id=$Get_row['staff_id'];
$customer_id=$Get_row['customer_id'];
$task_id=$Get_row['TaskID'];



$Named=mysqli_query($conn,"SELECT * FROM staff WHERE staff_id='$staff_id'");
$Named_row=mysqli_fetch_assoc($Named);
$StaffName=$Named_row['name'];

$NamedC=mysqli_query($conn,"SELECT * FROM users WHERE user_id ='$customer_id'");
$Named_rowC=mysqli_fetch_assoc($NamedC);
$mobile =$Named_rowC['name'];




$EndLat=$_POST['EndLat'];
$EndLong=$_POST['EndLong'];




//$CartData=$_POST['CartData'];

$StaffNotes=$_POST['StaffNotes'];

$Mode=$_POST['Mode'];

$GrandTotal=$_POST['GrandTotal'];

date_default_timezone_set('Asia/Kolkata');
$current_date = date('Y-m-d');
$current_time = date('H:i:s');


if($Mode=='Save')
{

$query="UPDATE live_task SET StaffNotes='$StaffNotes' WHERE LiveTaskID='$LiveTaskID'";


}
elseif($Mode=='Finish')
{



$query="UPDATE live_task SET EndTime='$current_time', EndDate='$current_date', EndLat='$EndLat', EndLong='$EndLong', StaffNotes='$StaffNotes', Status='Completed' WHERE LiveTaskID='$LiveTaskID'";

$query2="UPDATE tasks SET task_status='Completed' WHERE task_id='$task_id'";
        mysqli_query($conn,$query2);



//$customer_message="Thank%20you%20for%20purchasing%20from%20Denco%20Dentals.%20Your%20total%20amount%20is%20".$GrandTotal."%20INR%20Your%20agent%20name%20is%20".$AgentName.".%20For%20any%20queries%20please%20call%20us%20on%209746478500.";



//$customer= file_get_contents("http://sms2.sigosoft.com/pushsms.php?username=denco&api_password=0f41e68gyxlhrunaj&sender=DNCODL&to=".$DoctorPhone."&message=".$customer_message."&priority=11");


};







if(mysqli_query($conn,$query))
{


if($Mode=='Save')
{

$save_loc=mysqli_query($conn,"INSERT INTO saved_locations(StaffID, TaskID, CustomerID, Latitude, Longitude,Order_id) VALUES ('$staff_id', '$LiveTaskID', '$customer_id', '$EndLat', '$EndLong','$OrderID')");

};

  $pass['Status']="Success";

  $query="UPDATE delivered_orders SET GrandTotal='$GrandTotal' WHERE TaskID='$LiveTaskID'";

   if(mysqli_query($conn,$query))
   {

  $pass['Order']="Success";
  

}
else
{

$pass['Order']="Failed";

}


}

else
{
    $pass['Status']="Failed";
    $pass['Order']="Failed";
}



print_r(json_encode($pass));


?>