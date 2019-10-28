<?php

include 'Device_connection.php';
$sql = "SELECT * FROM blog_categories";
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







?>