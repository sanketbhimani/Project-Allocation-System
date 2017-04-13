<html>
<head>
<title>admin login</title>
</head>
<body style="font-family: Avenir,'Helvetica Neue','Lato','Segoe UI',Helvetica,Arial,sans-serif;">
<center>
<h3>Admin Login</h3>
<form action="index.php" method="POST">
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
<td>Username:</td><td><input name="uname" type="text"></td>
</tr>
<tr>
<td>Password:</td><td><input name="pass" type="password"></td>
</tr>
</table>
<input type="submit" value="login"><br>
	
</form>
</center>
</body>
</html>

<?php

if(isset($_POST['uname']) && isset($_POST['pass'])){
$uname=$_POST['uname'];
$pass=$_POST['pass'];
include('../connection.php');
$sql = "SELECT * FROM flag where flag='admin_name'";
$sq2 = "SELECT * FROM flag where flag='admin_password'";
$r = mysql_query($sql);
$row = mysql_fetch_array($r);
$r = mysql_query($sq2);
$row1 = mysql_fetch_array($r);
if(($row['value'])===$uname)
{
	if($pass===$row['value'])
	{
		session_start();
		$_SESSION['admin']='logged in';
		header("Location:home.php");
	}
	else
	{
		header("Location:index.php?msg=password incorrect");
	}
}
else 
{
	header("Location:index.php?msg=username incorrect");
}
}
?>