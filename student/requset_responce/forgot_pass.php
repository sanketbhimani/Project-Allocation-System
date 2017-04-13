<html>
<head>
</head>
<body style="font-family: Avenir,'Helvetica Neue','Lato','Segoe UI',Helvetica,Arial,sans-serif;">
<center>
<br>
<br>
<br>
<div style="font-size:12px;">You password will be sent to your Email Id<br>But if you have problem with email address then please contact Admin</div>
<br>
<form action="forgot_pass.php" method="post">
Enter your collage id: <input type="text" name="clgid">
<input type="submit" value="submit">
</form>
</center>
</body>
</html>
<?php

if(isset($_POST['clgid'])){
	include('../../connection.php');
	$q = "SELECT * FROM `studentdata` WHERE `clgid` = '".$_POST['clgid']."'";
	$r = mysql_query($q);
	$a = mysql_fetch_array($r);
	include('../../mail/send_mail.php');
	$to = $a['email'];
	$subject = "Project Allocation System Password Recovery";
	$message = "Your Password is : ".$a['password']."<br>and your userid is : ".$a['clgid']."<br>Thank you";
	$mail->SetFrom($to);
$mail->Subject = $subject;
$mail->Body = $message;
$mail->AddAddress($to);
$mail->Send();
header("location:student_login.php?msg=Your password has been sent to your email id");
}


?>