<?php 
ob_start();
include('database/db.php');
session_start();
$msg='';
?>
<?php
if(isset($_POST['login'])) 
{
$username=ucwords(strtoupper($_POST['user']));
$password=ucwords(strtoupper($_POST['pass']));
if(($username=='')&&($password==''))
{
$msg='Registration number or Password not given';
header("location:index.php?msg=$msg");
}
else
{
$sql="SELECT * FROM student WHERE Regd_id='$username' AND Password='$password'";
$query=mysqli_query($con,$sql);
$row=mysqli_fetch_array($query);
$count=mysqli_num_rows($query);
if($count>0)
{
$_SESSION['exam_user']=$row['Regd_id'];
header("location:home.php");
}
else
{
$msg='Wrong input';
header("location:index.php?msg=$msg");
}
}
}
ob_flush();
?>
