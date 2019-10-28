<?php 

include 'Device_connection.php';

date_default_timezone_set('Asia/Kolkata');
$current_date = date('Y-m-d');
$current_time = date('H:i:s');


$StaffID=$_POST['staffID'];
$ExpenseCategoryID=$_POST['ExpensecategoryID'];
$ExpenseCategoryName=$_POST['Expensecategory_name'];
$Amount=$_POST['amount'];
$ExpenseDescription=$_POST['expense_dispcription'];

$Latitude=$_POST['latitude'];
$Longitude=$_POST['longitude'];

$query="INSERT INTO expense_table(expense_category_id,expense_category_name, Description, Amount, EDate, staff_id, latitude, longitude) VALUES ('$ExpenseCategoryID','$ExpenseCategoryName', '$ExpenseDescription', '$Amount', '$current_date', '$StaffID', '$Latitude', '$Longitude')";
if (mysqli_query($conn,$query))
{

$pass['status']="Success";


}
else
{

$pass['status']="Failed";



}






print_r(json_encode($pass));

?>














