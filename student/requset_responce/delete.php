<?php

session_start();
if(!isset($_SESSION['studentid']))
 die(header("location:index.php?msg=YOU ARE NOT LOGGED IN"));



	$sreq=$_POST['clm_nm'];
	$val=$_POST['req_val'];
	include '../../connection.php';
	$sq1="UPDATE `studentdata` SET `".$sreq."`='' WHERE `studentid`='".$_SESSION['studentid']."'";
	mysql_query($sq1);
	$sq1 = "SELECT * FROM `studentdata` WHERE `studentid` = '".$val."'";
	$r = mysql_query($sq1);
	$a = mysql_fetch_array($r);
	for($i = 1; $i<7;$i++){
		if($a['req'.$i]===$_SESSION['studentid']){
			$sq1 = "UPDATE `studentdata` SET `req".$i."` = '' WHERE `studentid` = '".$val."'";
			mysql_query($sq1);
			header("Location:student_home.php?resuestdelete=true");
		}
	}
	



?>