
<?php
session_start();
if(!isset($_SESSION['admin']))
 die(header("location:index.php?msg=You are not logged in"));
?>

<html>
<body style="font-family: Avenir,'Helvetica Neue','Lato','Segoe UI',Helvetica,Arial,sans-serif;">
<center>
<form action="edit_project.php" method="POST">
<?php 
$ID=$_GET['id'];
include('../connection.php');
$q = "SELECT * FROM `projectdata` WHERE `pid`='".$ID."'";
$r = mysql_query($q);
$a = mysql_fetch_array($r);
echo '<input type="hidden" name="pid" value="'.$ID.'">';

?>
<table>
<tr>
<td>Project name :</td><td> <input type="text" name="name" value="<?php echo($a['name']); ?>"></td>
</tr>
<tr>
<td>Project details : </td><td><textarea name="details"><?php echo($a['details']); ?></textarea></td>
</tr>
<tr>
<td>Project semester : </td><td><input type="text" name="sem" value="<?php echo($a['sem']); ?>"></td>
</tr>
</table>
<input type="hidden" name="fid" placeholder="-1"><br>
<input type="submit" value="submit">
</form>
<a href="home.php">Home</a>
<a href="logout.php">logout</a>
</center>
</body>
</html>

<?php 
if(isset($_POST['name']) && isset($_POST['details']) && isset($_POST['sem']))
{
	$ID=$_POST['pid'];
	$NAME=$_POST['name'];
	$DETAILS=$_POST['details'];
	$SEM=$_POST['sem'];
	$fid=$_POST['fid'];
	
	//$connection=new PDO('mysql:host=localhost;dbname=project_allocation','root','root');
	//if($connection==null)
	//{
		//echo "Failed to obtain connection please try again";
		//die();
	//}
	
	//$sq2="SELECT * FROM facultydata where sname=$sname";
	//$query2=$connection->prepare($sq2);
//	$query2->execute();
	//$row=$query2->fetch(PDO::FETCH_OBJ);
	//$fid=$row->fid;
	//$r = mysql_query($sq2);
	//$a = mysql_fetch_array($r);
	//$fid = $a['fid'];
    $sq1 = "UPDATE `projectdata` SET `name`='".$NAME."', `details`='".$DETAILS."' ,`sem`='".$SEM."' , `fid`='".$fid."' WHERE `pid` = '".$ID."'";
	//$query1=$connection->prepare($sq1);
	//$query1->execute();
	mysql_query($sq1);
	header("Location:editdelete_project.php?msg=details successfully updated");
}

?>
