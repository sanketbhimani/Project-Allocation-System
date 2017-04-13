<?php
session_start();
if(!isset($_SESSION['admin']))
 die(header("location:index.php?msg=You are not logged in"));
?>


<?php
//include('../connection.php');
$q = "SELECT * FROM `teamdata` ORDER BY `avg_cpi` DESC";
$r = mysql_query($q);

while($a = mysql_fetch_array($r)){
	for($i=1;$i<=6;$i++){
		echo($a['tmid']." ".$i."<br>");
		if($a['choice'.$i]==0){
			break;
		}
		$q = "SELECT * FROM `projectdata` WHERE `pid` = '".$a['choice'.$i]."'";
		$r1 = mysql_query($q);
		$p = mysql_fetch_array($r1);
		if($p['tmid']==0){
			$q = "UPDATE `projectdata` SET `tmid` = '".$a['tmid']."' WHERE `pid` = '".$p['pid']."'";
			mysql_query($q);
			$q = "UPDATE `teamdata` SET `pid` = '".$p['pid']."' WHERE `tmid` = '".$a['tmid']."'";
			mysql_query($q);
			break;
		}
	}
}


?>