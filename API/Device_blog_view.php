<?php

include 'Device_connection.php';
$blog_id = $_POST['blog_id'];
$user_id = $_POST['user_id'];


$sql = "SELECT * FROM blog WHERE blog_id = '$blog_id' ";
$result=mysqli_query($conn,$sql);

  
if(mysqli_num_rows($result)>0)
{

while($row=mysqli_fetch_assoc($result))
{
    $blog[]=$row;
    $status="success";
    
    $count = mysqli_query($conn,"SELECT * FROM blog_likes WHERE blog_id='$blog_id' ");
    $likes = mysqli_num_rows($count);

    $validate=mysqli_query($conn,"SELECT * FROM blog_likes WHERE user_id='$user_id' AND blog_id='$blog_id' ");
    $user_like = mysqli_num_rows($validate);
    
    if($user_like > 0) 
    {
      $user_status ="Liked";
    }
    else{
        $user_status ="No Likes";
    }
}

}
else
{
   $blog[]="no data";
   $status="failed";
   $likes = '0';
   $user_status = 'No Likes';
}

$output['blog'] = $blog;
$output['likes'] = $likes;
$output['Status']=$status;
$output ['user_status'] = $user_status;

$pass=$output;
print_r(json_encode($pass));

?>
