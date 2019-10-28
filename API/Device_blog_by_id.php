<?php
include 'Device_connection.php';
$id = $_POST['blog_id'];


if(!empty($id))
{
		$sql = "SELECT * FROM blog WHERE blog_id = '$id' ";
$result = mysqli_query($conn,$sql);
if(mysqli_num_rows($result) > 0)
{
	while ($row= mysqli_fetch_assoc($result)) 
	{
		$blog[] = $row;
		$status = "success";
	}
}
else
{
	$blog[] = "no blogs";
	$status = "failed";
}
$output['blog'] = $blog;
$output['status'] = $status;

$pass = $output;

print_r(json_encode($pass));

}
else
{
	$status = "Invalid Request";
	print_r(json_encode($status));
}








?>