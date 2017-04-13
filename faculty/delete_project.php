<?php
session_start();
if(!isset($_SESSION['faculty_id']))
 die(header("location:index.php?msg=YOU ARE NOT LOGGED IN"));
?>
<?php 
$ID=$_GET['id'];
include('../connection.php');
	//$connection=new PDO('mysql:host=localhost;dbname=project_allocation','root','root');
	//if($connection==null)
	//{
	//	echo "Failed to obtain connection please try again";
	//	die();
	//}
	//echo $ID;
	$fid = $_SESSION['faculty_id'];
    $sq1 = "DELETE FROM `projectdata` WHERE `pid` = '".$ID."'";
	//$query1=$connection->prepare($sq1);
	//$query1->execute();
	mysql_query($sq1);
	$r = mysql_query("SELECT * FROM `facultydata` WHERE `fid`='".$fid."'");
	$a = mysql_fetch_array($r);
	
	$sq1 = "UPDATE `facultydata` SET `no_project`= '".($a['no_project']+1)."'  WHERE `fid` = '".$fid."'";
	//echo($sq1);
	mysql_query($sq1)
	or die(mysql_error());
	header("Location:editdelete_project.php?msg=DETAILS SUCCESSFULY DELETED");
?>