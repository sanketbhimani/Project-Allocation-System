<?php
session_start();
if(!isset($_SESSION['admin']))
 die(header("location:index.php?msg=You are not logged in"));
?>

<html>
<head>
</head>
<style>

#nav {
    
    
margin-left:15%;
    float:left;
	text-align:center;
    padding:5px;	      
}
#section {
 
    float:right;
    padding:10px;	 
	text-align:center;
	margin-right:15%;

}

#footer {
 
    color:white;
    clear:both;
    text-align:center;
   padding:5px;	 	 
}

</style>
<body style="font-family: Avenir,'Helvetica Neue','Lato','Segoe UI',Helvetica,Arial,sans-serif;">
<div id="nav">

<center>
<form action="add_student.php" method="post">
<div style="font-size:24px;">Add student manually</div>
<br><h6 style="color:red;"><?php 
if(isset($_GET['flg']))
{
	if($_GET['flg']==="true")
	{
		echo("Successfully added ".$_GET['clgid']);
	}
}
?></h6><br>
<table>
<tr>
<td>Collage ID: </td>
<td><input type="text" name="clgid" placeholder="14CEUOG069"> </td>
</tr>
<tr>
<td>Name: </td>
<td><input type="text" name="name" placeholder="name surname"> </td>
</tr>
<tr>
<td>Birth date: </td>
<td><input type="text" name="bdate" placeholder="dd/mm/yyyy"> </td>
</tr>
<tr>
<td>CPI: </td>
<td><input type="text" name="cpi" placeholder="9.99"> </td>
</tr>
<tr>
<td>Sem: </td>
<td><input type="text" name="sem" placeholder="4"> </td>
</tr>
<tr>
<td>email: </td>
<td><input type="text" name="email" placeholder="abc@gmail.com"> </td>
</tr>
</table>
<center>
<input type="submit" value="add student">
</center>


</form>
</center>
</div>
<div id="section">

<form method="post" enctype="multipart/form-data" action="student_excel.php">
<div style="font-size:24px;">Add from File</div>
<br>
<h6 style="color:red;"><?php if(isset($_GET['msg'])){if($_GET['msg']==="true"){echo("Students successfully added");}}?></h6>

<br>

Please select a file : <input name="userfile" type="file">

<input type="hidden" name="MAX_FILE_SIZE" value="16000000">
<br>
<input type="submit" value="upload" >
</form>

</div>

<div id="footer"><a href="home.php">HOME</a><br>
<a href="logout.php">LOG OUT</a></div>
</body>
</html>


<?php
if(isset($_POST['clgid']) && isset($_POST['name']) && isset($_POST['bdate']) && isset($_POST['cpi']) && isset($_POST['sem'])){
	include('../connection.php');
	$clgid = $_POST['clgid'];
	$name = $_POST['name'];
	$bdate = $_POST['bdate'];
	$cpi = $_POST['cpi'];
	$sem = $_POST['sem'];
	$email=$_POST['email'];
	$random_string="";
	for($i=0;$i<10;$i++)
	{
		$random_string .= chr(rand(65,90));
	}
	$sq1 = 'INSERT INTO `studentdata` (`clgid`, `name`, `bdate`, `cpi`, `sem` ,`email`,`password`) VALUES ("'.$clgid.'", "'.$name.'", "'.$bdate.'", "'.$cpi.'", "'.$sem.'","'.$email.'","'.$random_string.'")';
	mysql_query($sq1);
	$to=$email;
	//$subject="USERNAME & PASSWORD";
	//$message="YOUR USERNAME IS $clgid & PASSWORD IS $random_string";

	include("../mail/send_mail.php");
	$subject = "Project allocation system";
	$message = "your username is your collage id : ".$clgid."<br>and your password is : ".$random_string." <br>do login and Best Of Luck <br>Thank You!";
	$mail->Subject = $subject;
	$mail->Body = $message;
	$mail->AddAddress($to);
	$mail->Send();
	header('location:add_student.php?flg=true&clgid='.$clgid);
}
?>