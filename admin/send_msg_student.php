<?php
session_start();
if(!isset($_SESSION['admin']))
 die(header("location:index.php?msg=You are not logged in"));
?>


<html>
<head>
<title>Send message</title>
</head>
<body style="font-family: Avenir,'Helvetica Neue','Lato','Segoe UI',Helvetica,Arial,sans-serif;"><center>
<div style="font-size:30px;">Send message to student</div>
<h5>(This message will be send to all student)</h5>
<br><h6 style="color:red;"><?php if(isset($_GET['msg'])){if($_GET['msg']==="true"){echo("Massage successfully sent");}}?></h6><br>
<table>
<form action="send_msg_student.php" method="post">
<tr>
<td>

Enter subject: </td><td><input type="text" name="subject" required></td>
</tr>
<tr><td>
Enter message: </td><td><textarea name="msg" rows="5" cols="50"></textarea></td>
</tr></table>

<br><input type="submit" value="send">
</form>
<br><br>
<a href="home.php">HOME</a><br>
<a href="logout.php">LOG OUT</a>
</center>
</body>
</html>

<?php 
if (isset($_POST['msg']))
{
	include('../connection.php');
//	$sq1="UPDATE flag SET value='".$_POST['msg']."' WHERE flag='faculty_msg'";
//	$query=$connection->prepare($sq1);
//	$query->execute();
	$sq2="SELECT * FROM studentdata";
	$r = mysql_query($sq2);
	require_once('./../mail/class.phpmailer.php');
	$subject = $_POST['subject'];
		$message = $_POST['msg'];
		$mail = new PHPMailer();
		$mail->IsSMTP();
		$mail->SMTPDebug = 1;
		$mail->SMTPAuth = true;
		$mail->SMTPSecure = 'tls';
		$mail->Host = "smtp.gmail.com";
		$mail->Posrt = 587;
		$mail->IsHTML(true);
		$mail->Username = "snk.bhimani.jnd@gmail.com";
		$mail->Password = "SNK.bhimani3";
		//$mail->SetFrom($to);
		$mail->Subject = $subject;
		$mail->Body = $message;
	while($row=mysql_fetch_array($r))
	{
		
		$to = $row['email'];
		
		$mail->AddAddress($to);
		if($mail->Send())
		{
			echo("Email sent to ".$row['clgid']." ".$to);
			//echo "Mail has successfully sent";
		}
	
	}
	header("Location:send_msg_student.php?msg=true");
}
?>