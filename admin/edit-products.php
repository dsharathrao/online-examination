
<?php
session_start();
include('include/config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{
	$pid=intval($_GET['id']);// product id
if(isset($_POST['submit']))
{
	$sub_code=$_POST['sub_code'];
	$crctans=$_POST['crct_ans'];
	$pstv_mrk=$_POST['pstvemrk'];
	$neg_mrk=$_POST['negmrk'];
	
$sql=mysqli_query($con,"update exam_ques_set set Sub_code='$sub_code', Ques_crct_option='$crctans', Ques_mark='$pstv_mrk', Ques_neg_mark='$neg_mrk' where Ques_no='$pid' ");
if($sql)
{
$_SESSION['msg']="Question Updated Successfully !!";
}
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" type="image/x-icon" href="images/logo2.png">
	<title>Admin| Insert Product</title>
	<link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
	<link type="text/css" href="css/theme.css" rel="stylesheet">
	<link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
	<link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600' rel='stylesheet'>
<script src="http://js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
<script type="text/javascript">bkLib.onDomLoaded(nicEditors.allTextAreas);</script>

	


</head>
<body>
<?php include('include/header.php');?>

	<div class="wrapper">
		<div class="container">
			<div class="row">
<?php include('include/sidebar.php');?>				
			<div class="span9">
					<div class="content">

						<div class="module">
							<div class="module-head">
								<h3>Insert Product</h3>
							</div>
							<div class="module-body">

									<?php if(isset($_POST['submit']))
{?>
									<div class="alert alert-success">
										<button type="button" class="close" data-dismiss="alert">×</button>
									<strong>Well done!</strong>	<?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?>
									</div>
<?php } ?>


									<?php if(isset($_GET['del']))
{?>
									<div class="alert alert-error">
										<button type="button" class="close" data-dismiss="alert">×</button>
									<strong>Oh snap!</strong> 	<?php echo htmlentities($_SESSION['delmsg']);?><?php echo htmlentities($_SESSION['delmsg']="");?>
									</div>
<?php } ?>

									<br />

			<form class="form-horizontal row-fluid" name="insertproduct" method="post" enctype="multipart/form-data">

<?php 

$query=mysqli_query($con,"select * from exam_ques_set eqs inner join exam_subjects es on eqs.Sub_code=es.Sub_code where eqs.Ques_no='$pid'");
$cnt=1;
while($row=mysqli_fetch_array($query))
{
 ?>


<div class="control-group">
<label class="control-label" for="basicinput">Subject name</label>
<div class="controls">
<select name="sub_code" class="span8 tip"  >
<option value="<?php echo htmlentities($row['Sub_code']);?>"><?php echo htmlentities($row['Sub_name']);?></option> 
<?php $query=mysqli_query($con,"select * from exam_subjects");
while($rw=mysqli_fetch_array($query))
{
	if($row['Sub_code']==$rw['Sub_code'])
	{
		continue;
	}
	else{
	?>

<option value="<?php echo $rw['Sub_code'];?>"><?php echo $rw['Sub_name'];?></option>
<?php }} ?>
</select>
</div>
</div>

<div class="control-group">
<label class="control-label" for="basicinput">Question</label>
<div class="controls">
<img src="questions/<?php echo htmlentities($row['Question']);?>" width="500" height="100"><br/> <a href="update-image1.php?id=<?php echo $row['Ques_no'];?>">Change Image</a>
</div>
</div>
<div class="control-group">
<label class="control-label" for="basicinput">Set correct answer</label>
<div class="controls">
<select name="crct_ans"  id="productAvailability" class="span8 tip" >
<option value="A" <?php if(isset($row['Ques_crct_option'])&& $row['Ques_crct_option']=='A'){echo 'selected';}?>>A</option>
<option value="B" <?php if(isset($row['Ques_crct_option'])&& $row['Ques_crct_option']=='B'){echo 'selected';}?>>B</option>
<option value="C" <?php if(isset($row['Ques_crct_option'])&& $row['Ques_crct_option']=='C'){echo 'selected';}?>>C</option>
<option value="D" <?php if(isset($row['Ques_crct_option'])&& $row['Ques_crct_option']=='D'){echo 'selected';}?>>D</option>
</select>
</div>
</div>

<div class="control-group">
<label class="control-label" for="basicinput">Positive mark</label>
<div class="controls">
<input type="text" name="pstvemrk"  placeholder="Enter Product Price" value="<?php echo htmlentities($row['Ques_mark']);?>" class="span8 tip" >
</div>
</div>


<div class="control-group">
<label class="control-label" for="basicinput">Negetive mark</label>
<div class="controls">
<input type="text" name="negmrk"  placeholder="Enter Product Shipping Charge" value="<?php echo htmlentities($row['Ques_neg_mark']);?>" class="span8 tip" >
</div>
</div>
<?php } ?>
	<div class="control-group">
											<div class="controls">
												<button type="submit" name="submit" class="btn">Update</button>
											</div>
										</div>
									</form>
							</div>
						</div>


	
						
						
					</div><!--/.content-->
				</div><!--/.span9-->
			</div>
		</div><!--/.container-->
	</div><!--/.wrapper-->

<?php include('include/footer.php');?>

	<script src="scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
	<script src="scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
	<script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="scripts/flot/jquery.flot.js" type="text/javascript"></script>
	<script src="scripts/datatables/jquery.dataTables.js"></script>
	<script>
		$(document).ready(function() {
			$('.datatable-1').dataTable();
			$('.dataTables_paginate').addClass("btn-group datatable-pagination");
			$('.dataTables_paginate > a').wrapInner('<span />');
			$('.dataTables_paginate > a:first-child').append('<i class="icon-chevron-left shaded"></i>');
			$('.dataTables_paginate > a:last-child').append('<i class="icon-chevron-right shaded"></i>');
		} );
	</script>
</body>
<?php } ?>