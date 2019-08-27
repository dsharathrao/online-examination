
<?php
session_start();
include('include/config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{
if(isset($_GET['del']))
		  {
		  $pic_query=mysqli_query($con,"select * from exam_ques_set where Ques_no = '".$_GET['id']."'");
$row_pic=mysqli_fetch_array($pic_query);
		   $dir='questions/'.$row_pic['Question'];
		         unlink($dir);
		          //$sql1=mysqli_query($con,"delete from exam_ques_option where Ques_no = '".$_GET['id']."'");
				  $sql1=mysqli_query($con,"delete from exam_ques_set where Ques_no = '".$_GET['id']."'");
				  if($sql1)
				  {
				
                  $_SESSION['delmsg']="Question deleted !!";
				  }
		  }

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" type="image/x-icon" href="images/logo2.png">
	<title>Admin| Manage</title>
	<link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
	<link type="text/css" href="css/theme.css" rel="stylesheet">
	<link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
	<link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600' rel='stylesheet'>
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
								<h3>Manage Questions</h3>
							</div>
							<div class="module-body table">
	<?php if(isset($_GET['del']))
{?>
									<div class="alert alert-error">
										<button type="button" class="close" data-dismiss="alert">×</button>
									<strong>Oh snap!</strong> 	<?php echo htmlentities($_SESSION['delmsg']);?><?php echo htmlentities($_SESSION['delmsg']="");?>
									</div>
<?php } ?>

									<br />

							
								<table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped	 display" width="100%">
									<thead>
										<tr>
										    <th>Subject</th>
											<th>Question no</th>
											<th>Question </th>
											<th>Correct Ans </th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>

<?php
 $query=mysqli_query($con,"select * from exam_ques_set eqs inner join exam_subjects exs on exs.Sub_code=eqs.Sub_code order by eqs.Ques_no ");
$cnt=1;
while($row=mysqli_fetch_array($query))
{
?>									
										<tr>
											<td><?php echo htmlentities($row['Sub_name']);?></td>
											<td><?php echo htmlentities($row['Ques_no']);?></td>
											<td> <img src="questions/<?php echo $row['Question'];?>" ></td>
										<td> <?php echo $row['Ques_crct_option'];?></td>
											<td>
											<a href="edit-products.php?id=<?php echo $row['Ques_no']?>" ><i class="icon-edit"></i></a>
											<a href="manage-products.php?id=<?php echo $row['Ques_no']?>&del=delete" onClick="return confirm('Are you sure you want to delete?')"><i class="icon-remove-sign"></i></a></td>
										</tr>
										<?php $cnt=$cnt+1; } ?>
										
								</table>
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