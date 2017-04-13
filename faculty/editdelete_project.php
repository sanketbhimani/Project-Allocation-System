<?php
session_start();
if(!isset($_SESSION['faculty_id']))
 die(header("location:index.php?msg=YOU ARE NOT LOGGED IN"));
?>
<html>
<body style="font-family: Avenir,'Helvetica Neue','Lato','Segoe UI',Helvetica,Arial,sans-serif;">
<center>
<h2>List of Project</h2>
<table border="1">
<tr>
<th>Project ID</th>
<th>Project title</th>
<th>Sem</th>
<th>Project details</th>

<th>Delete</th>
<th>Edit</th>
</tr>
<?php
//session_start();
$fid = $_SESSION['faculty_id'];

	//echo "<br>";	
		include('../connection.php');
	//$connection=new PDO('mysql:host=localhost;dbname=project_allocation','root','root');
	//if($connection==null)
	//{
	//	echo "Failed to obtain connection please try again";
	//	die();
	//}

	$sq1 = "SELECT * FROM projectdata";
	//$query=$connection->prepare($sq1);
	//$row=$query->execute();
	$r = mysql_query($sq1)
	or die('aaa'.mysql_error());
	
	while($a = mysql_fetch_array($r))
	{
	
		if($a['fid']===$fid){
			echo("<tr>");
			echo '<td>'. $a['pid' ].' </td><td>'. $a['name' ].' </td><td>'.$a['sem'] .'</td><td>'.$a['details'].'</td>';
			/*if ($a['enable']=='1' )
			{
				echo '<form action="unenable_project.php"><input type="hidden" name="id" value="'.$a['pid'].'"><input type="submit" value="disable"></form>';
			}
			else
			{
				echo '<form action="enable_project.php"><input type="hidden" name="id" value="'.$a['pid'].'"><input type="submit" value="enable"></form>';
			}*/
			echo '<td><form action="delete_project.php"><input type="hidden" name="id" value="'.$a['pid'].'"><input type="submit" value="delete"></form></td><td>
			<form action="edit_project.php"><input type="hidden" name="id" value="'.$a['pid'].'"><input type="submit" value="edit"></form></td>'; 
			//echo '<br/>';
			echo("</tr>");
		}
	}
	



?>
</table>
<a href="home.php">Home</a>
<a href="logout.php">logout</a>
</center>
</body>
</html>