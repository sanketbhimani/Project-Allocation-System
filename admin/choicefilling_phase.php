<?php
session_start();
if(!isset($_SESSION['admin']))
 die(header("location:index.php?msg=You are not logged in"));
?>

<html>
<body style="font-family: Avenir,'Helvetica Neue','Lato','Segoe UI',Helvetica,Arial,sans-serif;">
<center>
<form action="choicefilling_phase.php" method="post">
<table>
<tr>
<td>Maximum choice:</td>  <td><input type="text" name="max_choice"></td>
</tr>
<tr>
<td>Last date: </td><td> <input type="text" name="last_date"></td>
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
if(isset($_POST['max_choice']) && isset($_POST['last_date'])){
	echo("sasaasas");
	include('../connection.php');
	$q = "UPDATE `flag` SET `value` = '".$_POST['max_choice']."' WHERE `flag` = 'max_choice'";
	mysql_query($q)
	or die("1".mysql_error());
		$q = "UPDATE `flag` SET `value` = '".$_POST['last_date']."' WHERE `flag` = 'last_date'";
	mysql_query($q)
	or die("1".mysql_error());
	$q = "UPDATE `flag` SET `value` = '2' WHERE `flag` = 'phase_change'";
	mysql_query($q)
	or die("1".mysql_error());
	header("Location:phase_change.php?msg=successfully phase changed");
}

?>