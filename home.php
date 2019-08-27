<?php
error_reporting(1);
session_start();
include('database/db.php');

?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="shortcut icon" type="image/x-icon" href="images/logo2.png">
<title>ONLINE EXAM</title>
<script type="text/javascript">
document.onkeydown = function (e) {
        return false;
}
</script>
        
		
</script>
<script type="text/javascript" src="js/confirm.js" ></script>
<script src="js/datepicker.js" type="text/javascript"></script>
<style type="text/css">
input[type=number]::-webkit-inner-spin-button, 
input[type=number]::-webkit-outer-spin-button { 
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    margin: 0; 
}
body
{
width:1340px;
}
select, input
{
outline:none;
}
select:focus
{
background-color:#CCFF99;
}
input:focus
{
background-color:#CCFF99;
}
ul
{
list-style:none;
width:98.3%;
margin-top:0px;
margin-left:-12px;
background:url('images/transparent.png');
height:28px;
padding-top:15px;

}
.main
{
background-repeat:repeat;
min-height:450px;
width:100%;
margin-left:-12px;
padding-top:45px;
padding-left:15px;
margin-top:-14px;
}
ul li 
{
display:inline;
padding-left:30px;
}
ul li a
{
text-decoration:none;
color:#000000;
font-weight:bold;
}
.header
{
width:101.8%;
height:40px;
background-color:#3AA56A; 
color:#FFFFFF;
font-size:20px;
font-weight:bolder;
}
.footer
{
text-align:center;
width:102%;
margin-left:-9px;
background:url('images/transparent.png') repeat;
height:25px;
}

div.ex1
{
    width: 850px;
    height: 410px;
    overflow: scroll;
}
div.ex2
{
    width:400px;
    height: 450px;
    overflow: scroll;
}
div.ex3
{
    width: 850px;
    height: 450px;
    overflow: scroll;
}
div.ex4
{
    width:400px;
    height: 450px;
    overflow: scroll;
}
button
{
width:30px;
height:30px;
}
button.crct
{
background-color:#88FB97;
border-color:#88FB97;
}
button.not_ans
{
background-color:#F5825A;
border-color:#F5825A;
}
button.ans_mrk
{
background-color:#FFCC33;
border-color:#FFCC33;
}
button.nans_mrk
{
background-color:#A8B1F7;
border-color:#A8B1F7;
}

button.extra
{
width:150px;
height:30px;
}
</style>
</head>

<body rightmargin="0" leftmargin="0" topmargin="0">
<?php
if($_SESSION['exam_user'])
{
$regd_id=$_SESSION['exam_user'];
$can_q=mysqli_query($con,"SELECT * FROM student WHERE Regd_id='$regd_id'");
$fetch=mysqli_fetch_array($can_q);
$sql_exm=mysqli_query($con,"select * from exam_name");
$row_exm=mysqli_fetch_array($sql_exm);
?>
<div class="header">
<center><?php echo $row_exm['Exam_name'];?></center>
</div>
<div class="main">
 <?php 
	if(!$_REQUEST['page'])
	{
	include('main.php');
	}
	if($_REQUEST['page']=='set_ques')
	{
	include('set_ques.php');
	}
	if($_REQUEST['page']=='view_resp')
	{
	include('view_resp.php');
	}
	if($_REQUEST['page']=='cal_score')
	{
	include('cal_score.php');
	}
		?>
	
	
</div>

<?php
}
else
{
header('location:index.php');
}
?>
</body>
</html>
