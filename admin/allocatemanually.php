<html>
<head>
</head>
<body style="font-family: Avenir,'Helvetica Neue','Lato','Segoe UI',Helvetica,Arial,sans-serif;">
<center>
<div style="font-size:36px;">Add project Manually</div> <br>
<form method="post" action="allocatemanually.php">
<div style="font-size:12px;">First add team member and at last add project id</div><br>
<div style="font-size:12px;">Here Studentid you can find from show student</div><br>
<table>
<tr><td>Student id for 1st team member : </td><td><input type="text" name="studentid1"></td></tr>
<tr><td>Student id for 2nd team member : </td><td><input type="text" name="studentid2"></td></tr>
<tr><td>Student id for 3rd team member : </td><td><input type="text" name="studentid3"></td></tr>
<tr><td>Student id for 4th team member : </td><td><input type="text" name="studentid4"></td></tr>
<tr><td>Student id for 5th team member : </td><td><input type="text" name="studentid5"></td></tr>
<tr><td>Student id for 6th team member : </td><td><input type="text" name="studentid6"></td></tr>
<tr><td>Project id : </td><td><input type="text" name="pid" required></td></tr>
</table>
<div style="font-size:12px;">Project id you can find from from "Edit project" add it manually</div> <br>
<input type="submit" value="submit">
</form>
</center>
</body>
</html>


<?php
if(isset($_POST['pid'])){
	$q = "INSERT INTO `teamdata` (`pid`, `mem1`, `mem2`, `mem3`, `mem4`, `mem5`, `mem6`) VALUE ('".$_POST['pid']."', '".$_POST['studentid1']."', '".$_POST['studentid2']."', '".$_POST['studentid3']."', '".$_POST['studentid4']."', '".$_POST['studentid5']."', '".$_POST['studentid6']."') ";
	include('../connection.php');
	mysql_query($q)
	or die(mysql_error());
	header("location:home.php?msg=successfully allocated");
}

?>