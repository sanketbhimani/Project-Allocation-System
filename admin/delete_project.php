<?php
session_start();
if(!isset($_SESSION['admin']))
 die(header("location:index.php?msg=You are not logged in"));
?>

<?php 
$ID=$_GET['id'];
	include("../connection.php");
	//$connection=new PDO('mysql:host=localhost;dbname=project_allocation','root','root');
	//if($connection==null)
	//{
		//echo "Failed to obtain connection please try again";
		//die();
	//}
	//echo $ID;
    $sq1 = "DELETE FROM `projectdata` WHERE `pid` = '".$ID."'";
	//$query1=$connection->prepare($sq1);
	//$query1->execute();
	mysql_query($sq1);
	header("Location:editdelete_project.php?msg=DETAILS SUCCESSFULYY DELETED");
?>