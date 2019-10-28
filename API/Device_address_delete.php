<?php
include 'Device_connection.php';
$address_id = $_POST['address_id'];
// $address_id = '4'; #testing purposes


if(!empty($address_id))
{
	$valid = "SELECT * FROM address_table WHERE address_id = '$address_id' ";
	$result = mysqli_query($conn,$valid);
	if(mysqli_num_rows($result) > 0)
	{
		 $query = "DELETE FROM address_table WHERE address_id = '$address_id' ";
		 	if($conn->query($query) === TRUE)
		 	{
		 		$status = 'Address Deleted Successfully';
		 	}
		 	else
		 	{
		 		$status = 'Error Deleting Address';
		 	}
	}
	else
	{
		$status = 'invalid address id';
	}


}
else
{
	$status = 'invalid request';
}

$output['Status']=$status;

$pass=$output;


print_r(json_encode($pass));


?>