<style type="text/css">
input[type=submit]
{
width:150px;
white-space:inherit;
height:50px;
}
.save
{
background-color:#AAFDA6;
border-color:#AAFDA6;
}
.mark
{
background-color:#EEEB7D;
border-color:#EEEB7D;
}
.clear
{
background-color:#FECAC2;
border-color:#FECAC2;
}
button.sub
{
width:150px;
white-space:normal;
outline:none;
}
button.active
{
background-color:#6699FF;
border-color:#6699FF;
}

</style>
<table width="100%" cellpadding="10px" cellspacing="0" border="0" style="height:480px;">
<tr>
<td valign="top" width="70%">
<?php
if($_GET['quesno']&&$_GET['subcode'])
{
$qno=$_GET['quesno'];
$scde=$_GET['subcode']; 
$sql_sub="SELECT * FROM exam_subjects ORDER BY Sub_code";
$qu_sub=mysqli_query($con,$sql_sub);
$j=0;
while($row_sub_list=mysqli_fetch_array($qu_sub))
{
$j++;
$sql_quesset=mysqli_query($con,"SELECT * FROM exam_ques_set WHERE Sub_code='$j' ORDER BY Ques_no");
$row_ques_set=mysqli_fetch_array($sql_quesset);
?>
<a href="home.php?quesno=<?php echo $row_ques_set['Ques_no'];?>&&subcode=<?php echo $j;?>&&page=set_ques"><button class="sub <?php if($scde==$j){?>active<?php }?>"><?php echo $row_sub_list['Sub_name'];?></button></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?php
}
?>
<div class="ex1">
<?php
$q1=mysqli_query($con,"SELECT * FROM exam_ques_set WHERE Ques_no='$qno' AND Sub_code='$scde'");
$row1=mysqli_fetch_array($q1);
$q2=mysqli_query($con,"SELECT max(id) as eid FROM student_response");
$row2=mysqli_fetch_array($q2);
$id=$row2['eid']+1;
$q3=mysqli_query($con,"SELECT * FROM student_response WHERE Ques_no='$qno' AND Cand_regd_id='$regd_id'");
$row3=mysqli_fetch_array($q3);

if(isset($_POST['save_optn']))
{
$optn=$_POST['stu_opt'];
$quesno=$_POST['ques_no'];

$q4=mysqli_query($con,"SELECT * FROM student_response WHERE Ques_no='$quesno' AND Cand_regd_id='$regd_id'");
$count=mysqli_num_rows($q4);
if($count==0)
{
$sql_optn=mysqli_query($con,"INSERT INTO student_response VALUES('$id','$regd_id','$quesno','$optn','N')");
}
else
{
$sql_optn=mysqli_query($con,"UPDATE student_response SET Resp_choice='$optn', Mark_review='N' WHERE Ques_no='$quesno' AND Cand_regd_id='$regd_id'");
}
if($sql_optn)
{
$nxt_ques=$quesno+1;
$ex_q=mysqli_query($con,"SELECT max(Ques_no) as q_max, min(Ques_no) as q_min FROM exam_ques_set");
$row_ex=mysqli_fetch_array($ex_q);
if($nxt_ques==$row_ex['q_max']+1)
{
$nxt_quest=$row_ex['q_min'];
$scde_q=mysqli_query($con,"SELECT * FROM exam_ques_set WHERE Ques_no='$nxt_quest'");
$row_scde=mysqli_fetch_array($scde_q);
$subcde=$row_scde['Sub_code'];
}
if($nxt_ques!=$row_ex['q_max']+1)
{
$nxt_quest=$_POST['ques_no']+1;
$scde_q=mysqli_query($con,"SELECT * FROM exam_ques_set WHERE Ques_no='$nxt_quest'");
$row_scde=mysqli_fetch_array($scde_q);
$subcde=$row_scde['Sub_code'];
}
header("location:home.php?quesno=$nxt_quest&&subcode=$subcde&&page=set_ques");
}
}//OPTION

if(isset($_POST['del_optn']))
{
$ques1=$_POST['ques_no'];
$sub_code=$_POST['sub_code'];
$delq=mysqli_query($con,"DELETE FROM student_response WHERE Cand_regd_id='$regd_id' AND Ques_no='$ques1'");
if($delq)
{
header("location:home.php?quesno=$qno&&subcode=$sub_code&&page=set_ques");
}
}

if(isset($_POST['mrk_review']))
{
$optn=$_POST['stu_opt'];
$quesno=$_POST['ques_no'];

$q4=mysqli_query($con,"SELECT * FROM student_response WHERE Ques_no='$qno' AND Cand_regd_id='$regd_id'");
$count=mysqli_num_rows($q4);
if($count==0)
{
$sql_optn=mysqli_query($con,"INSERT INTO student_response VALUES('$id','$regd_id','$quesno','$optn','Y')");
}
else
{
$sql_optn=mysqli_query($con,"UPDATE student_response SET Resp_choice='$optn', Mark_review='Y' WHERE Ques_no='$qno' AND Cand_regd_id='$regd_id'");
}
if($sql_optn)
{
$nxt_ques=$quesno+1;
$ex_q=mysqli_query($con,"SELECT max(Ques_no) as q_max, min(Ques_no) as q_min FROM exam_ques_set");
$row_ex=mysqli_fetch_array($ex_q);
if($nxt_ques==$row_ex['q_max']+1)
{
$nxt_quest=$row_ex['q_min'];
$scde_q=mysqli_query($con,"SELECT * FROM exam_ques_set WHERE Ques_no='$nxt_quest'");
$row_scde=mysqli_fetch_array($scde_q);
$subcde=$row_scde['Sub_code'];
}
if($nxt_ques!=$row_ex['q_max']+1)
{
$nxt_quest=$_POST['ques_no']+1;
$scde_q=mysqli_query($con,"SELECT * FROM exam_ques_set WHERE Ques_no='$nxt_quest'");
$row_scde=mysqli_fetch_array($scde_q);
$subcde=$row_scde['Sub_code'];
}
header("location:home.php?quesno=$nxt_quest&&subcode=$subcde&&page=set_ques");
}
}//OPTION
if(isset($_POST['final_sub']))
{
header("location:home.php?page=view_resp");
}
?>
<img src="admin/questions/<?php echo $row1['Question']?>"/><br /><br />

</div>
<br />
<form action="" method="post">
<input name="ques_no" id="ques_no" type="hidden" value="<?php echo $qno;?>" />
<input name="sub_code" id="sub_code" type="hidden" value="<?php echo $scde;?>" />
<input name="stu_opt" type="radio" value="A" <?php if($row3['Resp_choice']=='A'){echo 'checked';}?>/> A 
<input name="stu_opt" type="radio" value="B" <?php if($row3['Resp_choice']=='B'){echo 'checked';}?>/> B 
<input name="stu_opt" type="radio" value="C" <?php if($row3['Resp_choice']=='C'){echo 'checked';}?>/> C 
<input name="stu_opt" type="radio" value="D" <?php if($row3['Resp_choice']=='D'){echo 'checked';}?>/> D
<br /><br />

<input type="submit" name="save_optn" value="SAVE RESPONSE" class="save" />
<input type="submit" name="del_optn" value="CLEAR RESPONSE" class="clear"/>
<input type="submit" name="mrk_review" value="MARK FOR REVIEW" class="mark" />
<input type="submit" name="final_sub" value="FINAL SUBMIT" />
</form>
</td>
<td valign="top" width="30%">

<div class="ex2">

<?php
$qans=mysqli_query($con,"SELECT * FROM student_response WHERE Cand_regd_id='$regd_id' AND Resp_choice!='' AND Mark_review='N'");
$cnt_qans=mysqli_num_rows($qans);
$qnans=mysqli_query($con,"SELECT * FROM student_response WHERE Cand_regd_id='$regd_id' AND Resp_choice='' AND Mark_review='N'");
$cnt_qnans=mysqli_num_rows($qnans);
$qamr=mysqli_query($con,"SELECT * FROM student_response WHERE Cand_regd_id='$regd_id' AND Resp_choice!='' AND Mark_review='Y'");
$cnt_qamr=mysqli_num_rows($qamr);
$qnamr=mysqli_query($con,"SELECT * FROM student_response WHERE Cand_regd_id='$regd_id' AND Resp_choice='' AND Mark_review='Y'");
$cnt_qnamr=mysqli_num_rows($qnamr);
$wq=mysqli_query($con,"SELECT * FROM exam_ques_set");
$cnt_wq=mysqli_num_rows($wq);
$watq=mysqli_query($con,"SELECT * FROM student_response WHERE Cand_regd_id='$regd_id'");
$cnt_wat=mysqli_num_rows($watq);
$cnt_qnv=$cnt_wq-$cnt_wat;

$sql_time=mysqli_query($con,"SELECT * FROM exam_name");
$rowtime=mysqli_fetch_array($sql_time);
$jsotme=date('M d, Y H:i:s',strtotime($rowtime['Exam_end_time']));
?>
<script>
var deadline = new Date(<?php echo json_encode($jsotme);?>).getTime();
var x = setInterval(function() {
var now = new Date().getTime();
var t = deadline - now;
var days = Math.floor(t / (1000 * 60 * 60 * 24));
var hours = Math.floor((t%(1000 * 60 * 60 * 24))/(1000 * 60 * 60));
var minutes = Math.floor((t % (1000 * 60 * 60)) / (1000 * 60));
var seconds = Math.floor((t % (1000 * 60)) / 1000);
document.getElementById("timer_set").innerHTML =  hours + "h " + minutes + "m " + seconds + "s ";
    if (t < 0) {
        clearInterval(x);
        //document.getElementById("demo").innerHTML = "EXPIRED";
		alert('Your Exam is Completed and if any issue contact Administrator.');
		window.location.href = "home.php?page=view_resp";
    }
}, 1000);
</script>
<b>Candidate name :</b> <?php echo $fetch['Name']; ?><br /><br />
<b>Time left :</b> <span id="timer_set"></span><br /><br />
<center><b>SUMMARY</b> </center><br />
<button disabled="disabled"><?php echo $cnt_qnv;?></button> questions not yet visited<br />
<button class="crct" disabled="disabled"><?php echo $cnt_qans;?></button> questions answered<br />
<button class="not_ans" disabled="disabled"><?php echo $cnt_qnans;?></button> questions not answered<br />
<button class="ans_mrk" disabled="disabled"><?php echo $cnt_qamr;?></button> questions answered but marked for review<br />
<button class="nans_mrk" disabled="disabled"><?php echo $cnt_qnamr;?></button> questions are not answered but marked for review<br />
<br /><br />
<center><b>QUESTION PALATTE</b> </center><br />
<table border="0" width="50%" cellpadding="10px" cellspacing="0">
<?php
$i=0;
$q5=mysqli_query($con,"SELECT * FROM exam_ques_set ORDER BY Ques_no");
while($f=mysqli_fetch_array($q5))
{
$qu_no=$f['Ques_no'];
$subcde=$f['Sub_code'];
if ($i == 0 || $i%8==0)
{ 
            ?>
			<tr>
			<?php
			}
			$q6=mysqli_query($con,"SELECT * FROM student_response WHERE Ques_no='$qu_no' AND Cand_regd_id='$regd_id'");
			$f1=mysqli_fetch_array($q6);
			?>
			<td>
			<a href="home.php?quesno=<?php echo $qu_no;?>&&subcode=<?php echo $subcde;?>&&page=set_ques"><button <?php if(($f1['Resp_choice']!='')&&($f1['Mark_review']=='N')){?> class="crct" <?php } if(($f1['Resp_choice']=='')&&($f1['Mark_review']=='N')){?>class="not_ans"<?php }if(($f1['Resp_choice']!='')&&($f1['Mark_review']=='Y')){?>class="ans_mrk"<?php }if(($f1['Resp_choice']=='')&&($f1['Mark_review']=='Y')){?>class="nans_mrk"<?php } ?>><?php echo $qu_no;?></button></a>
			</td><!--end of row-->
			<?php
			$i++;
			 if (($i % 8== 0)){
           
			?>
			</tr><!--end of spac-->
			<?php
        }
        }
		}
		?>
		</table>
		</div>
</td>
</tr>

</table>