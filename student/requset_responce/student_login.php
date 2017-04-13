<html>
<head>
<title>Student Login</title>
</head>
<body style="font-family: Avenir,'Helvetica Neue','Lato','Segoe UI',Helvetica,Arial,sans-serif;">
<center style="margin-top:15%;">
<h3>Student Login</h3>
<form method="post" action="student_login.php">
<h6 style="color:red;">
<?php
	if(isset($_GET['flg'])){
		if($_GET['flg']==="false"){
			echo("Invalid Collage ID or Password");
		}
		else if($_GET['flg']==="logout"){
			echo("Successfully logout");
		}
		else if($_GET['flg']==="redirect"){
			echo("You are not logged in, login first");
		}
		else if($_GET['flg']==="not_allow"){
			echo("You are not allowed this time");
		}
	}
 if(isset($_GET['msg'])){
	echo($_GET['msg']);
}
	
?>
</h6>
<table>
<tr>
<td>Collage ID:</td><td><input name="clgid" type="text"></td>
</tr>
<tr>
<td>Password:</td><td><input name="pass" type="password"></td>
</tr>
</table>
<input type="submit" style="margin-top:15px; width:6%;" value="login">
</form>
<a href="forgot_pass.php">Forgot password?</a>
</center>
</body>
</html>
<?php
if(isset($_POST['clgid']) && $_POST['pass']){
 
	$clgid =$_POST['clgid'];
$pass =$_POST['pass'];
	include('../../connection.php');
	

	$query = 'SELECT * FROM `studentdata`';
	$q_result = mysql_query($query)
	or die("sdas".mysql_error());
	$fff=0;
	while($f = mysql_fetch_array( $q_result)){
		if($f['clgid']==$clgid){
			if($f['password']===$pass){
				$fff=1;
				$q = 'SELECT * FROM `flag` WHERE `flag`="sem"';
			
$r = mysql_query($q);
$a1 = mysql_fetch_array($r);

$lim=$a1['value'];
//echo($lim);
//echo($f['sem']!=$lim);
if($f['sem']!=$lim){
	header("location:index.php?flg=not_allow");
	break;
}

				session_start();
				$_SESSION['studentid']=$f['studentid'];
				//echo("sjkashkdjhsakjhdkjashdjhkj");
				header("location:student_home.php");
			}
		}
	}
	if($fff==0){
		header("location:index.php?flg=false");
	}
//echo("sanket");
}
?>