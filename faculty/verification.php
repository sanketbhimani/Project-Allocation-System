
<?php
include('../connection.php');
$uname=$_POST['uname'];
$pass=$_POST['pass'];
$sql = "SELECT * FROM `facultydata` WHERE `email`='".$uname."'";
$r = mysql_query($sql)
or die(mysql_error());

$a = mysql_fetch_array($r);

	if($pass===($a['password']))
	{
		session_start();
		$_SESSION['faculty_id']=$a['fid'];
		//echo($_SESSION['faculty_id']);
		header("Location:home.php");
	}
	else
	{
		header("Location:index.php?msg=username or password incorrect");
	}

?>