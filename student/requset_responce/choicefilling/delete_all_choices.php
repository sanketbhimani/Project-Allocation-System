<?php
session_start();
if(!isset($_SESSION['studentid']))
 die(header("location:../index.php?flg=redirect"));
?>

<?php
include('../../../connection.php');
$q = "SELECT * FROM `flag` WHERE `no` = '7'";
$r = mysql_query($q);
$a = mysql_fetch_array($r); 
$lastdate = $a['value'];
$date = date('m/d/Y');
if(!($date>=$lastdate)){
	header("location:student_home.php");
}
//session_start();
$tmid = $_SESSION['tmid'];
$q = "UPDATE `teamdata` SET `choice1` = '0',`choice2` = '0', `choice3` = '0',`choice4` = '0',`choice5` = '0',`choice5` = '0' WHERE `tmid`='".$tmid."'";
mysql_query($q);
header("location:choicefilling.php");


?>