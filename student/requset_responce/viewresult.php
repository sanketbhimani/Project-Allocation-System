<?php
if(isset($_SESSION['tmid'])){
	$tmid = $_SESSION['tmid'];
$q = "SELECT * FROM `teamdata` WHERE `tmid` = '".$tmid."'";
$r = mysql_query($q);
$a = mysql_fetch_array($r);
$pid = $a['pid'];
if($pid!=''){
	$q = "SELECT * FROM `projectdata` WHERE `pid`='".$pid."'";
	$r = mysql_query($q);
	$a = mysql_fetch_array($r);
	echo("You are allocated with ".$a['name']);
}
else{
	echo("You have not allocated with any project there will be second round or contact admin<br>");
}
}
else{
	echo("Something went wrong");
}


?>