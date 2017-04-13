<?php session_start();
if(!isset($_SESSION['id'])){
	header('location:index.php');
}
?>



<?php
session_start();
session_unset();
session_destroy();
header("location:index.php?msg=successfully logout");
?>