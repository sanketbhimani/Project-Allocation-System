<?php
session_start();
if(!isset($_SESSION['faculty_id']))
 die(header("location:index.php?msg=YOU ARE NOT LOGGED IN"));
?>
<?php
$ID=$_GET['id'];
include("../connection.php");
//try
//{
	//$connection=new PDO('mysql:host=localhost;dbname=project_allocation','root','root');
	//if($connection==null)
	//{
	//	echo "Failed to obtain connection please try again";
	//	die();
	//}
	$UN='0';
	$q = "UPDATE `projectdata` SET `enable`='".$UN."' WHERE `pid` = '".$ID."'";
	//$query1=$connection->prepare($q);
	//$query1->execute();
	mysql_query($q);
	//$eror=$query1->errorInfo();

	//print_r($eror);
	header("Location:editdelete_project.php?msg=DETAILS SUCCESSFULYY UPDATED");
//}
//catch(PDOException $e)
//{
//	echo $e->getMessage();
//	die();
//}
?>