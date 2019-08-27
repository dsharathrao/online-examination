<?php
session_start();
$_SESSION['alogin']=="";
unset($_SESSION['alogin']);
//session_destroy();
$_SESSION['errmsg']="You have successfully logout";
?>
<script language="javascript">
document.location="index.php";
</script>
