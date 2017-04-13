<?php
session_start();
if(!isset($_SESSION['faculty_id']))
 die(header("location:index.php?msg=you are not logged in"));
?>
<html>
<head>
<title>faculty home</title>
</head>
<body style="font-family: avenir,'helvetica neue','lato','segoe ui',helvetica,arial,sans-serif;">
<center>
<h6 style="color:red;">
<?php 
if(isset($_GET['msg'])){
	echo $_GET['msg'];
}

?>
</h6><br>
<br>

<?php  
	include("../connection.php");
	$q = "SELECT * FROM `facultydata` WHERE `fid`='".$_SESSION['faculty_id']."'";
	$r = mysql_query($q);
	$a = mysql_fetch_array($r);
	echo("<h2>Welcome ".$a['name']."</h2>");
	if($a['no_project']>0){
		echo("<h3 style='color:red;'>You need to add ".$a['no_project']." more project before ".$a['ldate'].".</h3>");
	}
	else{
		echo("</h3><h5>no more project is required but still you can add more project which will be counted for next time when required</h5>");
	}

 ?>

	<form action="add_project.php"><input type="submit" value="click here to add project"></form>



<form action="editdelete_project.php"><input type="submit" value="click here to edit or delete project"></form>
to change password <a href="change_pass.php">click here</a><br>
<a href="logout.php">logout</a>
</center>
</body>
</html>