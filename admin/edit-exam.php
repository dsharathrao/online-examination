
<?php
session_start();
include('include/config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{
if(isset($_POST['submit']))
{
	$exm_name=$_POST['exm_name'];
	$start_tme=$_POST['start_tme'];
	$end_tme=$_POST['end_tme'];
	$exm_desc=$_POST['exm_desc'];
	$id=intval($_GET['id']);
$sql=mysqli_query($con,"update exam_name set Exam_name='$exm_name', Exam_desc='$exm_desc', Exam_start_time='$start_tme', Exam_end_time='$end_tme' where id='$id'");
if($sql)
{
$_SESSION['msg']="Exam Updated !!";
}
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" type="image/x-icon" href="images/logo2.png">
	<title>Admin| Edit Exam</title>
	<link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
	<link type="text/css" href="css/theme.css" rel="stylesheet">
	<link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
	<link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600' rel='stylesheet'>
	<script src="scripts/DateTimePicker.js" type="text/javascript"></script>
	<script src="nicEdit-latest.js" type="text/javascript"></script>
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
								<h3>Edit Exam</h3>
							</div>
							<div class="module-body">

									<?php if(isset($_POST['submit']))
{?>
									<div class="alert alert-success">
										<button type="button" class="close" data-dismiss="alert">×</button>
									<strong>Well done!</strong>	<?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?>
									</div>
<?php } ?>


									<br />

			<form class="form-horizontal row-fluid" name="Category" method="post" >
<?php
$id=intval($_GET['id']);
$query=mysqli_query($con,"select * from exam_name where id='$id'");
while($row=mysqli_fetch_array($query))
{
?>									
<div class="control-group">
<label class="control-label" for="basicinput">Exam name</label>
<div class="controls">
<input type="text" placeholder="Enter category Name"  name="exm_name" value="<?php echo  htmlentities($row['Exam_name']);?>" class="span8 tip" required>
</div>
</div>
<div class="control-group">
<label class="control-label" for="basicinput">Exam Start time</label>
<div class="controls">
<input type="text" id="stme" readonly="readonly"  name="start_tme" placeholder="Enter start time" value="<?php echo $row['Exam_start_time'];?>">
                        <img src="images/cal.gif" style="cursor: pointer;" onClick="javascript:NewCssCal('stme','yyyyMMdd','dropdown',true,'24',true)" />
</div>
</div>
<div class="control-group">
<label class="control-label" for="basicinput">Exam End time</label>
<div class="controls">
<input type="text" id="endtme" readonly="readonly"  name="end_tme" placeholder="Enter end time" value="<?php echo $row['Exam_end_time'];?>">
                        <img src="images/cal.gif" style="cursor: pointer;" onClick="javascript:NewCssCal('endtme','yyyyMMdd','dropdown',true,'24',true)" />
</div>
</div>
<div class="control-group">
<label class="control-label" for="basicinput">Exam Description</label>
<div class="controls">
<textarea  name="exm_desc"  placeholder="Enter Exam Description" rows="6" class="span8 tip">
<?php echo nl2br($row['Exam_desc']);?>
</textarea>
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