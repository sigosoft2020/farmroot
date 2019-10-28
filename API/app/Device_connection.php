<?php
$conn = mysqli_connect("localhost","farmroot_farmroo","farmroot@123","farmroot_farmroot");

// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
?>

