<?php
$sql="SELECT * FROM student_response stres INNER JOIN exam_ques_set eqs ON stres.Ques_no=eqs.Ques_no WHERE stres.Cand_regd_id='$regd_id' AND stres.Resp_choice!='' ORDER BY eqs.Ques_no";
$q1=mysqli_query($con,$sql);
$sql_cnt=mysqli_num_rows($q1);
$mrk_ob=0;
while($row=mysqli_fetch_array($q1))
{
if($row['Resp_choice']==$row['Ques_crct_option'])
{
$mrk_ob=$mrk_ob+$row['Ques_mark'];
}
if($row['Resp_choice']!=$row['Ques_crct_option'])
{
$mrk_ob=$mrk_ob-$row['Ques_neg_mark'];
}
}
$q2=mysqli_query($con,"SELECT max(id) as m_id FROM student_mark");
$row_id=mysqli_fetch_array($q2);
$id=$row_id['m_id']+1;
$ins=mysqli_query($con,"INSERT INTO student_mark VALUES('$id','$regd_id','$mrk_ob')");
if($ins)
{
header("location:logout.php");
}
?>