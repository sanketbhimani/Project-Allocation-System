<?php
session_start();
if(!isset($_SESSION['faculty_id']))
 die(header("location:index.php?msg=YOU ARE NOT LOGGED IN"));
?>
<html>
<head>
</head>
<body style="font-family: avenir,'helvetica neue','lato','segoe ui',helvetica,arial,sans-serif;">
<center>
<?php
if(isset($_GET['flg']))
{
	if($_GET['flg']==="true")
	{
		echo("Successfully added ");
	}
}
?>
<form action="add_project.php" method="post">
<table>

<tr>
<td>Project Name: </td>
<td><input type="text" name="name"> </td>
</tr>

<tr>
<td>Project Details: </td>
<td><textarea name="details" rows="5" cols="50"></textarea> </td>
</tr>
<tr>
<tr>
<td>Languages  used: </td>
<td><input  type="text" name="language" ></td>
</tr>
<tr>
<td>Project Semester: </td>
<td>
<select name="sem">
<option>1</option>
<option>2</option>
<option>3</option>
<option>4</option>
<option>5</option>
<option>6</option>
<option>7</option>
<option>8</option>
</select>
</td>
</tr>

</table>

<input type="submit" value="add project">
</form>
<a href="home.php">Home</a>
<a href="logout.php">logout</a>
</center>
</body>
</html>


<?php
if((isset($_POST['name'])))
{
//	$connection=new PDO('mysql:host=localhost;dbname=project_allocation','root','root');
//	if($connection==null)
//	{
//		echo "Failed to obtain connection please try again";
//		die();
//	}
include('../connection.php');
	$name = $_POST['name'];
	$details = $_POST['details'];
	$sem = $_POST['sem'];
	$language = $_POST['language'];
	$fid = $_SESSION['faculty_id'];
	$snk = 1;
	$sq1 = 'INSERT INTO `projectdata` (`name`,`details`,`fid`,`sem`, `enable`,`language`) VALUES ("'.$name.'","'.$details.'","'.$fid.'","'.$sem.'", "'.$snk.'", "'.$language.'")';
	//$query=$connection->prepare($sq1);
	//$query->execute();
	//print_r ($query->errorInfo());
	mysql_query($sq1);
	$q = "SELECT * FROM `facultydata` WHERE `fid`='".$fid."'";
	$r = mysql_query($q);
	$asdf = 1;
	$a = mysql_fetch_array($r);
	$qqq = "UPDATE `facultydata` SET `no_project`='".($a['no_project']-$asdf)."' WHERE `fid` = '".$fid."'";
	//echo('<br>'.$qqq);	
	mysql_query($qqq)
	or die(mysql_error());
	header('location:add_project.php?flg=true');
}
?>