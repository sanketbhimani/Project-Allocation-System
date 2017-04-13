<?php
session_start();
if(!isset($_SESSION['studentid']))
 die(header("location:index.php?flg=redirect"));
?>

<html>
<head>
</head>
<body style="font-family: Avenir,'Helvetica Neue','Lato','Segoe UI',Helvetica,Arial,sans-serif;">
<center>
<div style="font-size:36px;">You have not enter your email so kindly enter You email</div><br><br>
<div style="font-size:12px; color=red;"><?php if(isset($_GET['msg'])){ if($_GET['msg']==='1'){echo("Conform email is not match try again");}

}?></div>
<form action="add_email.php" method="post">
<table>
<tr>
<td>
Enter Email-Id:
</td>
<td>
<input type="text" name="email">
</td>
</tr>
<tr>
<td>
Conform  Email-Id:
</td>
<td>
<input type="text" name="cemail">
</td>
</tr>
</table>
<input type="submit" value="submit">
</form>
</center>
</body>
</html>

<?php
if(isset($_POST['email']) && isset($_POST['cemail'])){
include('../../connection.php');
//session_start();
$studentid = $_SESSION['studentid'];
if($_POST['email']===$_POST['cemail']){
$q = "UPDATE `studentdata` SET `email`='".$_POST['email']."' WHERE `studentid`='".$studentid."'";
mysql_query($q)
or die("sdas".mysql_error());
echo("kjchsjkhkdsjkdscjds");
header("location:student_home.php");
}
else{
	header('location:add_email.php?msg=1');
}


}
?>