<?php
$fr_dt=date('M d, Y H:i:s',strtotime($row_exm['Exam_start_time']));
?>
<script>
var deadline = new Date(<?php echo json_encode($fr_dt);?>).getTime();
var x = setInterval(function() {
var now = new Date().getTime();
var t = deadline - now;
    if (t < 0) {
        clearInterval(x);
		alert('You can start your exam.');
	 document.getElementById("btn_start").disabled = false;
    }
}, 1000);
</script>
<table width="100%" cellpadding="10px" cellspacing="0">
<tr>
<td valign="top">
<div class="ex3">
<?php 
echo nl2br($row_exm['Exam_desc']);?>

</div>
</td>
<td valign="top">
<div class="ex4">
<h4>CANDIDATE NAME : <?php echo $fetch['Name']; ?><br /><br />
CANDIDATE REGISTRATION NO : <?php echo $regd_id; ?></h4>
</div>
</td>
</tr>
<tr>
<td align="center"><center><a href="home.php?quesno=1&&subcode=1&&page=set_ques"><button class="extra" id="btn_start" disabled="disabled">I am ready to begin </button></a></center></td><td></td>
</tr>
</table>