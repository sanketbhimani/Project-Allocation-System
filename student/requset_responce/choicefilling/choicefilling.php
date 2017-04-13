<?php
session_start();
if(!isset($_SESSION['studentid']))
 die(header("location:../index.php?flg=redirect"));
?>

<html>
<body style="font-family: Avenir,'Helvetica Neue','Lato','Segoe UI',Helvetica,Arial,sans-serif;">
<center>
<div style="font-size:24px; padding-bottom:3%;">Select your choices with order</div><br>
<a href="../logout.php">Logout</a> <a href="../student_home.php">Home</a><br>
<button onclick="location.href = 'delete_all_choices.php';">Delete all choices</button><br>
<div style="float:right; margin-right:3%; width:30%;">
<h3>Your choice</h3>
<table>
<tr>
<th>name</th>.

	

</tr>
<?php

//session_start();
include('../../../connection.php');
$studentid = $_SESSION['studentid'];
$q = "SELECT * FROM `flag` WHERE `no` = '7'";
$r = mysql_query($q);
$a = mysql_fetch_array($r); 
$lastdate = $a['value'];
$date = date('m/d/Y');
if(!($date<=$lastdate)){
	header("location:../student_home.php");
}
//echo($date);
//echo($studentid);
if(!isset($_SESSION['tmid'])){
	
			$q = "INSERT INTO  `teamdata` (`mem1` ,`avg_cpi`)VALUES ('".$studentid."', '".$_SESSION['cpi']."')";
		mysql_query($q)
		or die("sql query2".mysql_error());
		$tmid = mysql_insert_id();
		$q = "UPDATE `studentdata` SET `sreq1` = '', `sreq2` = '', `sreq3` = '', `sreq4` = '', `sreq5` = '', `sreq6` = '', `tmid`='".$tmid."' WHERE  `studentid` ='".$_SESSION['studentid']."' ";
		mysql_query($q)
		or die("sql query2".mysql_error());
for($i=1;$i<=6;$i++){
				$q = "UPDATE `studentdata` SET `req".$i."` = '' WHERE `req".$i."` = '".$studentid."'";
				//echo($q.'<br>');
					mysql_query($q)
		or die("sql query2".mysql_error());
}
$_SESSION['tmid']=$tmid;
}		

$tmid = $_SESSION['tmid'];


$q = "SELECT * FROM `teamdata` WHERE `tmid` = '".$tmid."'";
$r = mysql_query($q)or die(mysql_error());
$abcd = mysql_fetch_array($r);
$ccnntt=0;
$cnt=1;
while($cnt!=7){
	if($abcd['choice'.$cnt]==0){
		break;
	}
	echo("<tr>");
	$q = "SELECT * FROM `projectdata` WHERE `pid` ='".$abcd['choice'.$cnt]."'";
	//echo($q);
		$r = mysql_query($q) or die(mysql_error());
		$a = mysql_fetch_array($r);
		$name = $a['name'];
		$details = $a['details'];
		echo("<td style='width:30%; '><center><div style='font-size:12px; font-size:18px;'>->".$name."</div></center></td>");
		$ccnntt++;
		$cnt++;
		echo("</tr>");
}
?>
</table>
</div>
<div style="float:left; margin-left:3%;">
<h3>Select choices</h3>
<table>
<tr>
<th>name</th>.
<th>languages</th>
<th>details</th>

<th>add</th>

</tr>
<?php


$date = date('m/d/Y');
//echo("aassakdiplusjdfiogjladkji;dlfjgklasj;ilkjslkjkljkjjjljd");
$q = 'SELECT * FROM `flag` WHERE `flag`="max_choice"';
$r = mysql_query($q);
$a1 = mysql_fetch_array($r);

$lim=$a1['value'];


if($ccnntt<$lim){

//echo($tmid);
$q = "SELECT * FROM `teamdata` WHERE `tmid` = '".$tmid."'";
$r = mysql_query($q)
or die(mysql_error());
$a = mysql_fetch_array($r);

for($i=1;$i<=6;$i++){
		$choice[$i] = $a['choice'.$i];
}
$q = "SELECT * FROM `projectdata` WHERE 1";
$r = mysql_query($q);

while($a = mysql_fetch_array($r)){
	if($a['enable']==1){
		$pid = $a['pid'];
		$flg=0;
		for($i=1;$i<=6;$i++){
			if($choice[$i]==$pid){
				$flg=1;
			}
		}
		if($flg==0){
			$name = $a['name'];
	$details = $a['details'];
	echo("<tr>");
	echo("<td style='width:120px;'><div style='font-size:12px;'>".$name."</div></td><td style='width:auto;'><div >".$a['language']."</div></td><td style='width:auto;'><div style='width:120px;'>".$details."</div></td>");
	echo("<td style='width:auto;'><form action='selectproject.php' method='post'><input type='hidden' name='pid' value='".$a['pid']."'><input type='submit' value='add'></form></td>");
	echo("</tr>");
		}
	}
}
}
else{
	echo("You have selected maximum number of choices");
}

?>
</table>
</div>
</center>
</body>
</html>