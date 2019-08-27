<?php    
session_start(); 
unset($_SESSION['exam_user']);
if(isset($_SERVER['HTTP_REFERER'])) {
 header('Location:index.php');  
} else {
 header('Location: index.php');  
}
exit;  
?>