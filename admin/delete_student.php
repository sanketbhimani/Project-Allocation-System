
<?php
session_start();
if(!isset($_SESSION['admin']))
 die(header("location:index.php?msg=You are not logged in"));
?>

<?php
$studentid = $_GET['studentid'];
include('../connection.php');
$q = "DELETE FROM `studentdata` WHERE `studentid` = '".$studentid."'";
echo($q);
mysql_query($q)
or die(mysql_error());
header("location:show_student.php?msg=true");


?>