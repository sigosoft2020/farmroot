<?php

include 'Device_connection.php';

$user_id=$_POST['user_id'];
$blog_id=$_POST['blog_id'];
$status=$_POST['status'];

date_default_timezone_set("Asia/Kolkata"); 
$current = date('Y-m-d H:i:s');

if($status=='Like')
{
    
 $validate=mysqli_query($conn,"SELECT * FROM blog_likes WHERE user_id='$user_id' AND blog_id='$blog_id' ");
    if(mysqli_num_rows($validate)<=0)
  {
       
  $query="INSERT INTO blog_likes(user_id,blog_id,timestamp) VALUES ('$user_id','$blog_id','$current')";

    if(mysqli_query($conn,$query))
    {
        $like_id = mysqli_insert_id($conn);
        
        $count = mysqli_query($conn,"SELECT * FROM blog_likes WHERE blog_id='$blog_id' ");
        $likes = mysqli_num_rows($count);
        
        // $pass['id'] = $like_id;
        $pass['Status']="Success";
        $pass['likes'] = $likes;
    }
    else
    {
        $pass['Status']="Failed";
    }
  }
  else{
      $pass['Status']="Like Already Added";
  }
}
else{
    $query="DELETE FROM blog_likes WHERE user_id='$user_id' AND blog_id='$blog_id'";

    if(mysqli_query($conn,$query))
    {
        $pass['Status']="Success";
    }
    else
    {
        $pass['Status']="Failed";
    }
}
print_r(json_encode($pass));

?>