<?php
session_start();
if(!isset($_SESSION['studentid']))
 die(header("location:index.php?flg=redirect"));

include("../../connection.php");
$tmid = $_SESSION['tmid'];
$studentid = $_SESSION['studentid'];
$q = "SELECT * FROM `teamdata` WHERE  `tmid`='".$tmid."'";
$r = mysql_query($q);
$a = mysql_fetch_array($r);
$cnt=1;
while($a['mem'.$cnt]!=''){
	$q = "UPDATE `studentdata` SET `tmid` = '' WHERE `studentid`='".$a['mem'.$cnt]."'";
	mysql_query($q);
	$cnt++;
}
$q = "DELETE FROM `teamdata`  WHERE `tmid`='".$tmid."'";
	mysql_query($q);
	unset($_SESSION['tmid']);
header("student_home.php?msg=Your team is successfully deleted");

?>
