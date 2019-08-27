
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
	$sub_code=$_POST['sub_code'];
	//$ques=mysqli_real_escape_string($con,$_POST['question']);
	$crctopt=$_POST['crctopt'];
	$pos_mrk=$_POST['pos_mrk'];
	$neg_mrk=$_POST['neg_mrk'];
	$ques=$_FILES["productimage1"]["name"];
	/*$opA=$_POST['opA'];
	$opB=$_POST['opB'];
	$opC=$_POST['opC'];
	$opD=$_POST['opD'];*/
//for getting product id
$query=mysqli_query($con,"select max(id) as eid, max(Ques_no) as qno from exam_ques_set");
	$result=mysqli_fetch_array($query);
	 $id=$result['eid']+1;
	$qno=$result['qno']+1;

	move_uploaded_file($_FILES["productimage1"]["tmp_name"],"questions/".$_FILES["productimage1"]["name"]);
$sql=mysqli_query($con,"insert into exam_ques_set values('$id','$sub_code','$qno','$ques','$crctopt','$pos_mrk','$neg_mrk')");

if($sql )
{
$_SESSION['msg']="Question Inserted Successfully !!";
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
								<h3>Insert Questions</h3>
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

			<form class="form-horizontal row-fluid" method="post" action="" enctype="multipart/form-data">

<div class="control-group">
<label class="control-label" for="basicinput">Subject name</label>
<div class="controls">
<select name="sub_code" class="span8 tip"  > 
<?php $query=mysqli_query($con,"select * from exam_subjects");
while($row=mysqli_fetch_array($query))
{?>

<option value="<?php echo $row['Sub_code'];?>"><?php echo $row['Sub_name'];?></option>
<?php } ?>
</select>
</div>
</div>
<!--
									
<div class="control-group">
<label class="control-label" for="basicinput">Sub Category</label>
<div class="controls">
<select   name="subcategory"  id="subcategory" class="span8 tip" >
</select>
</div>
</div>-->
<div class="control-group">
<label class="control-label" for="basicinput">Question</label>
<div class="controls">
<!--<textarea  name="question"  placeholder="Enter Question" rows="6" class="span8 tip" >
</textarea>--><input type="file" name="productimage1" id="productimage1" value="" class="span8 tip" required>
</div>
</div>
<div class="control-group">
<label class="control-label" for="basicinput">Set correct option</label>
<div class="controls">
<select name="crctopt"  id="productAvailability" class="span8 tip" >
<option value="A">A</option>
<option value="B">B</option>
<option value="C">C</option>
<option value="D">D</option>
</select>
</div>
</div>

<div class="control-group">
<label class="control-label" for="basicinput">Positive mark</label>
<div class="controls">
<input type="text" name="pos_mrk"  placeholder="Enter Postive Mark" class="span8 tip" required>
</div>
</div>

<div class="control-group">
<label class="control-label" for="basicinput">Negetive Mark</label>
<div class="controls">
<input type="text" name="neg_mrk"  placeholder="Enter Negetive Mark" class="span8 tip">  
</div>
</div>


	<div class="control-group">
											<div class="controls">
												<button type="submit" name="submit" class="btn">Insert</button>
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