<?php
session_start();
if(!isset($_SESSION['admin']))
 die(header("location:index.php?msg=You are not logged in"));
?>
<?php

include('../connection.php');
$q = "UPDATE `studentdata` SET req1 = '', req2 = '', req3 = '', req4 = '', req5 = '', req6 = '', sreq1 = '', sreq2 = '', sreq3 = '', sreq4 = '', sreq5 = '', sreq6 = '', `tmid` = '' WHERE 1";
 mysql_query($q);	
$q = "TRUNCATE teamdata";
 mysql_query($q);	
 header("location:home.php");
?>