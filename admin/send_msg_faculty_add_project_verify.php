<?php
session_start();
if(!isset($_SESSION['admin']))
 die(header("location:index.php?msg=You are not logged in"));
?>
<html>
<body style="font-family: avenir,'helvetica neue','lato','segoe ui',helvetica,arial,sans-serif;">
<center>
<h3> Verify mail before send</h3>
this message will be send to <?php $cnt=1;
if(!isset($_POST['fno'])){
	header("location:send_msg_faculty_add_project.php?msg=add faculty name");
	die();
}

$fno =  $_POST['fno'];
for($i=1;$i<=$fno;$i++){
	if($_POST['name'.$i]!=null){
echo($_POST['name'.$i]." ");
	}
}	?>
<form action='send_msg_faculty_add_project_mail.php' method="post">

<?php
$cnt=1;
$fno =  $_POST['fno'];
for($i=1;$i<=$fno;$i++){
	if($_POST['name'.$i]!=null){
		echo("<input type='hidden' name='name".$i."' value='".$_POST['name'.$i]."'>\n");
		$cnt++;
	}
}
echo("<input type='hidden' name='fno' value='".$_POST['fno']."'>\n");
echo("<input type='hidden' name='no' value='".$_POST['no']."'>\n");
$cnt--;
?>
Subject:
<textarea name='subject' rows="1" cols="60">Regarding add project form project allocation system</textarea>
<br>
Message:
<textarea name='message' rows="6" cols="60">Hello,<br>
	You are requested to add project. Login using your username and password provided to you and add project with full details in project allocation system. You need to add minimum <?php echo($_POST['no']);?> project.<br>
		you need to add all project before <?php echo($_POST['ldate']);?>.<br>
	<?php echo($_POST['msg']);?></textarea>
<br>
<input type="submit" value="send">
</form>
</center>
</body>
</html>