<?php
session_start();
if(!isset($_SESSION['admin']))
 die(header("location:index.php?msg=You are not logged in"));
?>


<html>
<head>
<title>phase_change</title>
</head>
<body  style="font-family: Avenir,'Helvetica Neue','Lato','Segoe UI',Helvetica,Arial,sans-serif;">
<center>
<div style="font-size:18px; color:#ff0000;">
<?php 
if(isset($_GET['msg'])){
	echo $_GET['msg'];
	echo '<br>';
}
?>
</div>
<div style="font-size:24px; padding-bottom:3%;">Currently <?php  $q = "SELECT * FROM `flag` WHERE  `no` = '3'";
include('../connection.php');
$r = mysql_query($q);
$a = mysql_fetch_array($r);
$p = $a['value'];
if($p==1){
	echo("Team formation");
}
else if($p==2){
	echo("Choice filling");
}
else if($p==3){
	echo("Result");
}
 ?> phase is running</div>
<form action="teamformation_phase.php"><input type="submit" value="Start team formation phase"></form>
<form action="choicefilling_phase.php"><input type="submit" value="Start choice filling phase"></form>
<form action="result_phase.php"><input type="submit" value="Start result phase"></form>
<a href="home.php">Home</a>
<a href="logout.php">logout</a>
</center>
</body>
</html>