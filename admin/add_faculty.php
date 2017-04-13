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
    
    
 
    float:left;
	text-align:center;
    padding:5px;	      
}
#section {

    float:right;
    padding:15px;	 
	text-align:center;

}

#footer {
 
    color:white;
    clear:both;
    text-align:center;
   padding:5px;	 	 
}

</style>
<body style="font-family: Avenir,'Helvetica Neue','Lato','Segoe UI',Helvetica,Arial,sans-serif;">

<center>
<div style="color:red;">
<?php
if(isset($_GET['flg']))
{
	if($_GET['flg']==="true")
	{
		echo("Successfully added ");
	}
}
?>
</div>
</center>

<div id="nav">

<br><center>

<div style="font-size:24px;" >Add Faculty Manually </div>
<div style="width:60%; font-size:12px;">(Enter Faculty email id,  this will send email to faculty member with their generated password and other details will be added by faculty)</div><br>

<form action="add_faculty.php" method="post">
<table>
<tr>
<td>Faculty Email: </td>
<td><input type="text" name="email" placeholder="Ex: bhavikbhalodia@gmail.com" required> </td>
</tr>
<tr>
<td>short name: </td>
<td><input type="text" name="sname" placeholder="Ex:TVR" required> </td>
</tr>
<tr>
<td>name: </td>
<td><input type="text" name="name" placeholder="Ex: tushar ratanpara" required> </td>
</tr>
</table>
<br>
<input type="submit" value="add faculty">


</form>
</center>
</div>
<div id="section">
<center>
<form method="post" enctype="multipart/form-data" action="faculty_email.php">
<div style="font-size:24px;" >Add Faculty From Excel File</div>
<table>
<tr>
<td>Please select a file :  </td><td>   <input name="userfile" type="file"></td><br><br>

<input type="hidden" name="MAX_FILE_SIZE" value="16000000">
</tr>
</table>
<br><input type="submit" value="upload" >

</form>

</div>
</center>
<div id="footer"><a href="home.php">HOME</a><br>
<a href="logout.php">LOG OUT</a></div>

</body>
</html>


<?php

if ((isset($_POST['email'])))
{
	$random_string="";
	for($i=0;$i<10;$i++)
	{
		$random_string .= chr(rand(65,90));
	}
	include("../connection.php");
	$query = 'INSERT INTO `facultydata` (`email`,`password`,`name`,`sname`) VALUES ("'.$_POST['email'].'","'.$random_string.'", "'.$_POST['name'].'","'.$_POST['sname'].'")';
	$result = mysql_query($query)
	or die("sql query".mysql_error());
	
	$to=$_POST['email'];
	$message="your USERNAME IS ".$_POST['email']." password is".$random_string;
	$subject="Project Allocation System";
	include ("./../mail/send_mail.php");
	$mail->Subject = $subject;
	$mail->Body = $message;
	$mail->AddAddress($to);
	$mail->Send();
	header('location:add_faculty.php?flg=true&email='.$_POST['email']);
}
?>