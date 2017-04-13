<?php
session_start();
if(!isset($_SESSION['admin']))
 die(header("location:index.php?msg=You are not logged in"));
?>


<html>
<head>
</head>
<body style="font-family: Avenir,'Helvetica Neue','Lato','Segoe UI',Helvetica,Arial,sans-serif;">
<center>
<div style="font-size:36px;">Student data</div> <br>
<h6 style="color:red;"><?php if(isset($_GET['msg'])){if($_GET['msg']==="true"){echo("Student info successfully updated");}}?></h6><br>
<table border='1'>
<tr>
<th>Student id</th>
<th>collage ID</th>
<th>name</th>
<th>birthdate</th>
<th>sem</th>
<th>cpi</th>
<th>email</th>
<th>password</th>
<th>edit</th>
<th>delete</th>
<?php
include('../connection.php');
$q = "SELECT * FROM `studentdata` WHERE 1";
$r = mysql_query($q);
while($a = mysql_fetch_array($r)){
	echo('<tr>');
	echo('<td>'.$a['studentid'].'</td>');
		echo('<td>'.$a['clgid'].'</td>');
	echo('<td>'.$a['name'].'</td>');
			echo('<td>'.$a['bdate'].'</td>');
						echo('<td>'.$a['sem'].'</td>');
						echo('<td>'.$a['cpi'].'</td>');
	echo('<td>'.$a['email'].'</td>');
		echo('<td>'.$a['password'].'</td>');
echo('<td><button onclick="location.href = \'edit_student.php?studentid='.$a['studentid'].'\';">Edit</button></td>');
echo('<td><button onclick="location.href = \'delete_student.php?studentid='.$a['studentid'].'\';">Delete</button></td>');	echo('</tr>');
}


?>
</table>
</div>
<br>
<a href="home.php">HOME</a><br>
<a href="logout.php">LOG OUT</a>
</center>
</body>
</html>