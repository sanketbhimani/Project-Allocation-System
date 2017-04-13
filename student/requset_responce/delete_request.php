<?php

//session_start();
if(!isset($_SESSION['studentid']))
 die(header("location:index.php?msg=YOU ARE NOT LOGGED IN"));



//include '../../connection.php';

$sq1="SELECT * FROM `studentdata` where `studentid` = '".$_SESSION['studentid']."'";
$r=mysql_query($sq1);
$row=mysql_fetch_array($r);
for($i=1;$i<=6;$i++)
{
	
	if($row["sreq".$i]!=NULL)
	{
		//echo $row["sreq".$i];
		$q = "SELECT * FROM `studentdata` WHERE `studentid` = '".$row['sreq'.$i]."'";
		//echo($q);
		$r = mysql_query($q)
		or die(mysql_error());
		$a = mysql_fetch_array($r);
		echo('<tr><td>'.$a['name'].' with cpi '.$a['cpi'].'</td>');
		echo '<form action="delete.php" method="post"><input type="hidden" name="clm_nm" value="sreq'.$i.'"><input type="hidden" name="req_val" value="'.$row["sreq".$i].'"><td><input type="submit" value="cancel request"></form></td></tr>';
	}
	
}


?>