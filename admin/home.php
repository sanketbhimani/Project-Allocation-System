<?php
session_start();
if(!isset($_SESSION['admin']))
 die(header("location:index.php?msg=You are not logged in"));
?>

<html>
<head>
<title>admin_page</title>
</head>
<body style="font-family: avenir,'helvetica neue','lato','segoe ui',helvetica,arial,sans-serif;">
<center>
<div style="font-size:36px;">welcome admin</div>
<span style="width:33%; float:left;">
<center><br>
<h6 style="color:red;">
<?php 
if(isset($_GET['msg'])){
	echo $_GET['msg'];
}

?>
</h6>
<h3>student</h3>
<button onclick="location.href = 'add_student.php';">add student</button>
<button onclick="location.href = 'show_student.php';">show student</button>
<h3>faculty</h3>
<button onclick="location.href = 'add_faculty.php';">add faculty</button>
<button onclick="location.href = 'show_faculty.php';">show faculty</button>
</center>
</span>
<span style="width:33%; float:left;">
<center>
<h3>project</h3>
<button onclick="location.href = 'add_project.php';">add project</button><br><br>
<button onclick="location.href = 'editdelete_project.php';">edit project</button><br><br>
<button onclick="location.href = 'send_msg_faculty_add_project.php';">ask faculty to add project</button>
</center>
</span>
<span style="width:33%; float:left;">
<center>
<h3>message</h3>
<button onclick="location.href = 'send_msg_student.php';">send message to student</button><br><br>
<button onclick="location.href = 'send_msg_faculty.php';">send message to faculty</button><br><br>

</center>
</span><br style="clear: left;"><br><br><br>
to view & change current phase <a href="phase_change.php">click here</a><br>
to allocate the project manually <a href="allocatemanually.php">click here</a><br>
to change password <a href="change_pass.php">click here</a><br>
Master Reset <a href="reset.php">click here</a><br><br>
<a href="logout.php">logout</a>
</center>
</body>
</html>