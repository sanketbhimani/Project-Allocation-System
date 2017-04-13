<?php
session_start();
if(!isset($_SESSION['admin']))
 die(header("location:index.php?msg=You are not logged in"));
?>
<html>
<head>
<title>Change password</title>
</head>
<body style="font-family: Avenir,'Helvetica Neue','Lato','Segoe UI',Helvetica,Arial,sans-serif;">
<center>
<h3>Change password</h3>
<form action="change_pass.php" method="POST">
<h6 style="color:red;">
<?php 
if(isset($_GET['msg'])){
	echo $_GET['msg'];
}

?>
</h6>
<br>
<table>
<tr>
<td>Old Password:</td><td><input name="opass" type="password"></td>
</tr>
<tr>
<td>New Password:</td><td><input name="npass" type="password"></td>
</tr>
<tr>
<td>Conform Password:</td><td><input name="cpass" type="password"></td>
</tr>
</table>
<input type="submit" value="login"><br>
	
</form>
<a href="home.php">home</a>
<a href="logout.php">logout</a>
</center>
</body>
</html>

<?php

if(isset($_POST['opass']) && isset($_POST['npass']) && isset($_POST['cpass'])){
$opass=$_POST['opass'];
$npass=$_POST['npass'];
$cpass=$_POST['cpass'];
include('../connection.php');
//$sql = "SELECT * FROM flag where flag='admin_name'";
$sq2 = "SELECT * FROM flag where flag='admin_password'";
//$r = mysql_query($sql);
//$row = mysql_fetch_array($r);
$r = mysql_query($sq2);
$row1 = mysql_fetch_array($r);
if($npass === $cpass){
if(($row1['value'])===$opass)
{
	$q = "UPDATE `flag` SET `value` = '".$npass."' WHERE `no`=2";
	mysql_query($q);
	header("Location:home.php?msg=password successfully changed");
}
else 
{
	header("Location:change_pass.php?msg=old password is incorrect");
}
}
else{header("Location:change_pass.php?msg=new password and conform password is not matched");}
}
?>