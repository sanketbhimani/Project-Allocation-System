<?php
session_start();
if(!isset($_SESSION['studentid']))
 die(header("location:../index.php?flg=redirect"));
?>

<?php
//session_start();
$tmid = $_SESSION['tmid'];
$pid = $_POST['pid'];
include("../../../connection.php");
$q = "SELECT * FROM `flag` WHERE `no` = '7'";
$r = mysql_query($q);
$a = mysql_fetch_array($r); 
$lastdate = $a['value'];
$date = date('m/d/Y');
if(!($date>=$lastdate)){
	header("location:student_home.php");
}
$q = "SELECT * FROM `teamdata` WHERE `tmid` = '".$tmid."'";
$r = mysql_query($q);
$a = mysql_fetch_array($r);
$cnt=1;
while(1){
	if($cnt >6 ) {
		break;
	}
	if($a['choice'.$cnt]==0 ){
		break;
	}
	$cnt++;
}
$q = "UPDATE `teamdata` SET `choice".$cnt."` = '".$pid."' WHERE `tmid`='".$tmid."'";
mysql_query($q);
header("location:choicefilling.php");

?>