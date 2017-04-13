<html>
<head>
<title>Faculty login</title>
</head>
<body style="font-family: avenir,'helvetica neue','lato','segoe ui',helvetica,arial,sans-serif;">
<center>
<h3>Faculty Login</h3>
<form action="verification.php" method="post">
<h6 style="color:red;">
<?php 
if(isset($_GET['msg'])){
	echo $_GET['msg'];
}

?>
</h6>
<table>
<tr><td>
username :</td><td> <input type="email" name="uname" placeholder="your email is username"></td></tr><tr>
<td>password : </td><td><input type="password" name="pass"><br></td></tr></table>
<input type="submit" value="login"><br>

</form>
</center>
</body>
</html>