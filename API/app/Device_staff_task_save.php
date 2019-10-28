<?php 

include 'Device_connection.php';


$staff_id=$_POST['staff_id'];
$customer_id=$_POST['customer_id'];
$StartLat=$_POST['StartLat'];
$StartLong=$_POST['StartLong'];
$GrandTotal=$_POST['GrandTotal'];
//$CartData=$_POST['CartData'];
$staffNotes=$_POST['staffNotes'];
$TaskID=$_POST['TaskID'];
$TaskType =$_POST['TaskType'];
$CreatedDate =$_POST['CreatedDate'];
$DueDate =$_POST['DueDate'];
$AdminNotes =$_POST['AdminNotes'];
$order_no =$_POST['order_no'];
$order_id =$_POST['order_id'];

$Priority =$_POST['Priority'];

$Mode=$_POST['Mode'];


$Named=mysqli_query($conn,"SELECT * FROM staff WHERE staff_id='$staff_id'");
$Named_row=mysqli_fetch_assoc($Named);
$Name=$Named_row['name'];

$NamedC=mysqli_query($conn,"SELECT * FROM users WHERE user_id ='$customer_id'");
$Named_rowC=mysqli_fetch_assoc($NamedC);
$DoctorPhone =$Named_rowC['DoctorPhone'];

date_default_timezone_set('Asia/Kolkata');
$current_date = date('Y-m-d');
$current_time = date('H:i:s');



if($Mode=='Finish')
{


//$query3="UPDATE live_task SET Status='Completed' WHERE TaskID='$TaskID'";
 //       mysqli_query($conn,$query3);

$query="INSERT INTO live_task(staff_id, customer_id, CreatedDate, DueDate, StartDate, EndDate, StartTime , StartLat, StartLong, EndTime, EndLat, EndLong, AdminNotes, StaffNotes, TaskID, Status, TaskType, Priority) VALUES ('$staff_id', '$customer_id', '$CreatedDate', '$DueDate', '$current_date', '$current_date', '$current_time' , '$StartLat', '$StartLong', '$current_time' , '$StartLat', '$StartLong', '$AdminNotes', '$staffNotes', '$TaskID', 'Completed', 'Permanent', '$Priority')";


/*$customer_message="Thank%20you%20for%20purchasing%20from%20Denco%20Dentals.%20Your%20total%20amount%20is%20".$GrandTotal."%20INR%20Your%20agent%20name%20is%20".$AgentName.".%20For%20any%20queries%20please%20call%20us%20on%209746478500.";


$customer= file_get_contents("http://sms2.sigosoft.com/pushsms.php?username=denco&api_password=0f41e68gyxlhrunaj&sender=DNCODL&to=".$DoctorPhone."&message=".$customer_message."&priority=11");*/


}
elseif($Mode=='Save')
{

$query="INSERT INTO live_task(staff_id, customer_id, CreatedDate, DueDate, StartDate, StartTime , StartLat, StartLong, AdminNotes, StaffNotes, TaskID, Status, TaskType, Priority) VALUES ('$staff_id', '$customer_id', '$CreatedDate', '$DueDate', '$current_date', '$current_time' , '$StartLat', '$StartLong', '$AdminNotes', '$staffNotes', '$TaskID', 'Started', 'Permanent','$Priority')";

};








if(mysqli_query($conn,$query))
{

$LiveTaskID=mysqli_insert_id($conn);

 $query2="UPDATE tasks SET task_status='Completed' WHERE task_id='$TaskID'";
        mysqli_query($conn,$query2);
        

if($Mode=='Save')
{

$save_loc=mysqli_query($conn,"INSERT INTO saved_locations(StaffID, TaskID, CustomerID, Latitude, Longitude,Order_id,order_no) VALUES ('$staff_id', '$LiveTaskID', '$customer_id', '$StartLat', '$StartLong','$order_id','$order_no')");



};


    
    
if($TaskType=='Temporary')
{

$update=mysqli_query($conn,"UPDATE tasks SET flag='0' WHERE task_id='$TaskID'");

};

    //$pass['Status']="Success";
    //$pass['LiveTaskID']=$LiveTaskID;

  $query="INSERT INTO  delivered_orders(TaskID, customerID, GrandTotal, StaffID, DeliveredDate, DeliveredTime, StatusO,order_No,order_id) VALUES ('$LiveTaskID', '$customer_id', '$GrandTotal', '$staff_id', '$current_date', '$current_time' , 'Live','$order_no','$order_id')";

   if(mysqli_query($conn,$query))
   {
       
        

    $ID=mysqli_insert_id($conn);
    
        $query1="UPDATE app_orders SET status='Delivered' WHERE OrderID='$order_id'";
        mysqli_query($conn,$query1);
     
    $pass['OrderID']=$ID;


   $pass['Order']="Success";
   


}
else
{

$pass['LiveTaskID']=$LiveTaskID;
$pass['Order']="Failed";
$pass['OrderID']="0";


}


}

else
{

    $pass['LiveTaskID']="0";
    $pass['Status']="Failed";
    $pass['Order']="Failed";
    $pass['OrderID']="0";
}



print_r(json_encode($pass));


?>