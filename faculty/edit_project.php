<?php
session_start();
if(!isset($_SESSION['faculty_id']))
 die(header("location:index.php?msg=YOU ARE NOT LOGGED IN"));
?>
<html>
<body>
<form action="edit_project.php" method="POST">
<?php 
$ID=$_GET['id'];

echo '<input type="hidden" name="pid" value="'.$ID.'">';

?>
<br>
PROJECT NAME:  <input type="text" name="name">
<br>PROJECT DETAILS : <textarea name="details"></textarea><br>
PROJECT SEMESTER : <input type="text" name="sem"><br>
<input type="submit" value="submit">
</form>
</body>
</html>

<?php 
if(isset($_POST['name']))
{
	$ID=$_POST['pid'];
	$NAME=$_POST['name'];
	$DETAILS=$_POST['details'];
	$SEM=$_POST['sem'];
	include('../connection.php');
	//$connection=new PDO('mysql:host=localhost;dbname=project_allocation','root','root');
	//if($connection==null)
	//{
	//	echo "Failed to obtain connection please try again";
	//	die();
	//}
    $sq1 = "UPDATE `projectdata` SET `name`='".$NAME."', `details`='".$DETAILS."' ,`sem`='".$SEM."' WHERE `pid` = '".$ID."'";
	//$query1=$connection->prepare($sq1);
	//$query1->execute();
	mysql_query($sq1);
	header("Location:editdelete_project.php?msg=DETAILS SUCCESSFULYY UPDATED");
}

?>
