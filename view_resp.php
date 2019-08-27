<link rel="stylesheet" href="css/jquery.virtualKeyboard.css" />
<style type="text/css">
input[type=text].virtualKeyboard
{
width:320px;
border-radius:6px;
padding:10px;
outline:none;
text-transform:uppercase;
}
input[type=password].virtualKeyboard
{
width:320px;
border-radius:6px;
padding:10px;
outline:none;
text-transform:uppercase;
}
</style>
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
?><center>
<center><h3>Your response</h3></center><br />
<table width="50%" cellpadding="10" cellspacing="0" align="center" border="1">
<tr>
<td>Number of attempted question </td><td><?php echo $cnt_qans;?></td>
</tr>
<tr>
<td>Number of un-attempted question </td><td><?php echo $cnt_qnans;?></td>
</tr>
<tr>
<td>Number of question not visited </td><td><?php echo $cnt_qnv;?></td>
</tr>
<tr>
<td>Number of attempted question but marked for review </td><td><?php echo $cnt_qamr;?></td>
</tr>
<tr>
<td>Number of un-attempted question but marked for review</td><td><?php echo $cnt_qnamr;?></td>
</tr>
</table>
<br /><br />
<center><h2><font color="red">Your Result will announce shortly,<font color="green"> Thank you</font> </font></h2></center>
<input name="user" type="text" class="virtualKeyboard" placeholder="Give Feedback here" value=""><br /><br />
   
<center><a href="home.php?page=cal_score"><button class="extra">Submit and Exit Exam</button></a></center>

 <script src="http://code.jquery.com/jquery-1.11.2.min.js"></script>
    <script src="js/jquery.virtualKeyboard.js"></script>
    <script>
        $('.virtualKeyboard').vkb();
    </script>