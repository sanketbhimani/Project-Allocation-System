
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
<div style="font-size:36px;">Faculty data</div> <br>

<table border='1'>
<tr>
<th>Faculty id</th>

<th>Short name</th>
<th>name</th>
<th>Email</th>
<th>password</th>

<?php
include('../connection.php');
$q = "SELECT * FROM `facultydata` WHERE 1";
$r = mysql_query($q);
while($a = mysql_fetch_array($r)){
	echo('<tr>');
	echo('<td>'.$a['fid'].'</td>');
		echo('<td>'.$a['sname'].'</td>');
	echo('<td>'.$a['name'].'</td>');
			echo('<td>'.$a['email'].'</td>');
						echo('<td>'.$a['password'].'</td>');
						// echo('<td>'.$a['cpi'].'</td>');
						// echo('<td>'.$a['cpi'].'</td>');
	// echo('<td>'.$a['email'].'</td>');
		// echo('<td>'.$a['password'].'</td>');
// echo('<td><button onclick="location.href = \'edit_student.php?studentid='.$a['studentid'].'\';">Edit</button></td>');
// echo('<td><button onclick="location.href = \'delete_student.php?studentid='.$a['studentid'].'\';">Delete</button></td>');	echo('</tr>');
echo("</tr>");
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