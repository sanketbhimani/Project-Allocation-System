<?php
session_start();
if(!isset($_SESSION['admin']))
 die(header("location:index.php?msg=You are not logged in"));
?>


<html>
<head>
<title>teamformation_phase</title>
</head>
<body style="font-family: Avenir,'Helvetica Neue','Lato','Segoe UI',Helvetica,Arial,sans-serif;">
<center>
<form action="teamformation_phase.php" method="post">
<table>
<tr>
<td>Sem :</td><td> <input type="text" name="sem"></td>
</tr>
<tr>
<td>Range of CPI : </td><td><input type="text" name="cpi_range"></td>
</tr>
<tr>
<tr>
<td>Maximum no of team member :</td> <td><input type ="text" name="max_tsize"></td>
</tr>
<tr>
<td>Last date for team formation phase:</td><td> <input type="text" name="last_date"></td>
</tr>
</table>
<input type="submit" value="submit">

</form>

<a href="home.php">Home</a>
<a href="logout.php">logout</a>
</center>
</body>
</html>
<?php

if(isset($_POST['sem']) && isset($_POST['cpi_range']) && isset($_POST['max_tsize']) && isset($_POST['last_date']) ){
include('../connection.php');
include('../mail/send_mail.php');
echo("asdsadasds");
//$connection=new PDO('mysql:host=localhost;dbname=project_allocation','root','root');
//if($connection==null)
//{
	//echo "Failed to obtain connection please try again";
	//die();
//}

$sem=$_POST['sem'];
$cpi_range=$_POST['cpi_range'];
$max_tsize=$_POST['max_tsize'];
$last_date=$_POST['last_date'];

$sq1="UPDATE `flag` SET `value`='".$sem."' WHERE flag='sem'";
$sq2="UPDATE `flag` SET `value`='".$cpi_range."' WHERE flag='cpi_range'";
$sq3="UPDATE `flag` SET `value`='".$max_tsize."' WHERE flag='max_tsize'";
$sq4="UPDATE `flag` SET `value`='".$last_date."' WHERE flag='last_date'";
$sq5="UPDATE `flag` SET `value`='1' WHERE flag='phase_change'";

mysql_query($sq1)
or die("1".mysql_error());
mysql_query($sq2)
or die("1".mysql_error());
mysql_query($sq3)
or die("1".mysql_error());
mysql_query($sq4)
or die("1".mysql_error());
mysql_query($sq5)
or die("1".mysql_error());


$q = 'SELECT * FROM `studentdata` WHERE `sem` = "'.$sem.'"';
$r = mysql_query($q);
while($a = mysql_fetch_array($r)){
	if($a['email']!=''){
		$to = $a['email'];
		$subject = "Regarding phase change in project allocation system";
		$message = "Dear Students,\nCurrantly team  formation phase is now started so you all are requested to form your team by sending and accepting request. You can create a team with maximum ".$max_tsize." members. you can choose that members only which have their CPI in range of plus and minus ".$cpi_range." of your CPI. so now start creating your team.\nBest Of Luck\n project alloction \n Admin";
		include("../mail/send_mail.php");
		$mail->Subject = $subject;
	$mail->Body = $message;
	$mail->AddAddress($to);
	$mail->Send();
	}
}
	header("Location:phase_change.php?msg=successfully phase changed");
}
?>