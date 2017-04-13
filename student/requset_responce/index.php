<?php
if(isset($_GET['flg'])){
	header("location:student_login.php?flg=".$_GET['flg']);
}
else{
	header("location:student_login.php");
}
?>