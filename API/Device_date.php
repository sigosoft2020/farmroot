<?php 

include 'Device_connection.php';

//$date=$_POST['date'];

$nextTuesday = strtotime('next tuesday');
$weekNo = date('W');
$weekNoNextTuesday = date('W', $nextTuesday);
$d1 =  date('Y-m-d',$nextTuesday);

$nextfriday = strtotime('next friday');
$weekNo = date('W');
$weekNonextfriday = date('W', $nextfriday);
$d2 =  date('Y-m-d',$nextfriday);

//$query="INSERT INTO delivery_date(date1,date2) VALUES ('$d1','$d2')";
$query="UPDATE delivery_date SET date1='$d1',date2='$d2' WHERE id='1'";
$r = mysqli_query($conn,$query);


if(isset($r)){
        
$query1="SELECT * from delivery_date";
$result=mysqli_query($conn,$query1);


if(mysqli_num_rows($result)>=0)

{

while($row=mysqli_fetch_assoc($result))
{
   $date[]=$row;

}

}
else
{
   $date[]="No Data";
}


}

$output['date']=$date;


$pass=$output;


print_r(json_encode($pass));


?>