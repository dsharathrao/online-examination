<?php
$atq=mysqli_query($con,"SELECT * FROM student_response WHERE Cand_regd_id='$regd_id' AND Resp_choice!='' AND Mark_review='N'");
$cnt_at=mysqli_num_rows($atq);
$matq=mysqli_query($con,"SELECT * FROM student_response WHERE Cand_regd_id='$regd_id' AND Resp_choice!='' AND Mark_review='Y'");
$cnt_mat=mysqli_num_rows($matq);
$muatq=mysqli_query($con,"SELECT * FROM student_response WHERE Cand_regd_id='$regd_id' AND Resp_choice='' AND Mark_review='N'");
$cnt_muat=mysqli_num_rows($muatq);

$wq=mysqli_query($con,"SELECT * FROM exam_ques_set");
$cnt_wq=mysqli_num_rows($wq);
$watq=mysqli_query($con,"SELECT * FROM student_response WHERE Cand_regd_id='$regd_id'");
$cnt_wat=mysqli_num_rows($watq);
$cnt_uatq=$cnt_wq-$cnt_wat;
$uaq=mysqli_query($con,"SELECT * FROM student_response WHERE Cand_regd_id='$regd_id' AND Resp_choice='' AND Mark_review='N'");
$cnt_uaq=mysqli_num_rows($uaq);
?>