<?php
session_start();
if(!isset($_SESSION['admin']))
 die(header("location:index.php?msg=You are not logged in"));
?>
<html>
<body style="font-family: avenir,'helvetica neue','lato','segoe ui',helvetica,arial,sans-serif;">
<center>


<?php
$no = $_POST['no'];
$cnt=1;
$name=[];
$fno =  $_POST['fno'];
include('../connection.php');
include("../mail/send_mail.php");
for($i=1;$i<=$fno;$i++){
	if(isset($_POST['name'.$i])){
		$name[$cnt] = $_POST['name'.$i];
		$cnt++;
	
	}
}
$cnt--;
for($i=1;$i<=$cnt;$i++){
	$q = "SELECT * FROM `facultydata` WHERE `sname`='".$name[$i]."'";
	
			//echo($name[$i]);
	$r = mysql_query($q);
	$a = mysql_fetch_array($r);
	if($a['email']===''){
		echo("Faile to send mail to <b>".$name[$i]."</b><br>");
		continue;
	}
	$q = "UPDATE `facultydata` SET `no_project`='".($a['no_project']+$no)."' `ldate` = '".$a['ldate']."' WHERE `sname` = '".$name[$i]."'";
	mysql_query($q);
	$mail->SetFrom($a['email']);
	$mail->Subject = $_POST['subject'];
	$mail->Body = $_POST['message'];
	$mail->AddAddress($a['email']);
	if($mail->Send()){
		echo("mail successfully sent to <b>".$name[$i]."</b><br>");
	}
	else{
		echo("Fail to send mail to <b>".$name[$i]."</b> but he/she will be informed when he/she will open their account<br>");
	}
}

?>
<br>
<button onclick="location.href = 'send_msg_faculty_add_project.php?msg=message sent';">ok</button>
</center>
</body>
</html>