
<?php
session_start();
if(!isset($_SESSION['studentid']))
 die(header("location:index.php?flg=redirect"));
?>

<?php
include('../../connection.php');
//session_start();
$mystudentid = $_SESSION['studentid'];
$studentid = $_GET['studentid'];
$q = "SELECT * FROM `studentdata`  WHERE `studentid`='".$mystudentid."' OR `studentid` ='".$studentid."' ";
$r  = mysql_query($q);
$a = mysql_fetch_array($r);
if($a['tmid']!=''){
	header("location:student_home.php?msg=Something went wrong");
}
$a = mysql_fetch_array($r);
if($a['tmid']!=''){
	header("location:student_home.php?msg=Something went wrong");
}
$cnnt=0;
if($_GET['tmid']==null){
			$q = "INSERT INTO  `teamdata` (`mem1`, `mem2`) VALUES ('".$mystudentid."', '".$studentid."')";
		mysql_query($q)
		or die("sql query2".mysql_error());
		$tmid = mysql_insert_id();
		$q = "SELECT * FROM `studentdata` WHERE `studentid` = '".$mystudentid."' OR `studentid` = '".$studentid."'";
		$r = mysql_query($q)
		or die("sql query2".mysql_error());
			$a = mysql_fetch_array($r);
			for($i=1;$i<=6;$i++){
			$sreq1[$i]=$a['sreq'.$i];
			$req1[$i]=$a['req'.$i];
		}
	$a = mysql_fetch_array($r);
	for($i=1;$i<=6;$i++){
		$sreq2[$i]=$a['sreq'.$i];
		$req1[$i]=$a['req'.$i];
	}
$q = "UPDATE `studentdata` SET `sreq1` = '', `sreq2` = '', `sreq3` = '', `sreq4` = '', `sreq5` = '', `sreq6` = '' WHERE `studentid` = '".$studentid."' OR `studentid` ='".$mystudentid."' ";
echo($q);
mysql_query($q)
		or die("sql query2".mysql_error());
		$q = "UPDATE `studentdata` SET `tmid` = '".$tmid."' WHERE `studentid`='".$mystudentid."' OR `studentid` ='".$studentid."' ";
		mysql_query($q)
		or die("sql query2".mysql_error());

		for($i=1;$i<=6;$i++){
		
	

				$q = "UPDATE `studentdata` SET `req".$i."` = '' WHERE `req".$i."` = '".$studentid."'";
				//echo($q.'<br>');
					mysql_query($q)
		or die("sql query2".mysql_error());
						$q = "UPDATE `studentdata` SET `sreq".$i."` = '' WHERE `sreq".$i."` = '".$studentid."'";
							mysql_query($q)
		or die("sql query2".mysql_error());
	
				$q = "UPDATE `studentdata` SET `req".$i."` = '' WHERE `req".$i."` = '".$mystudentid."'";
				mysql_query($q)
		or die("sql query2".mysql_error());
		$q = "UPDATE `studentdata` SET `sreq".$i."` = '' WHERE `sreq".$i."` = '".$mystudentid."'";
						mysql_query($q)
		or die("sql query2".mysql_error());
	
	}
	

	
	

	
	
	}
	else{
	//	echo("$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$");
		$tmid = $_GET['tmid'];
		for($i=1;$i<=6;$i++){
		
	

				$q = "UPDATE `studentdata` SET `req".$i."` = '' WHERE `req".$i."` = '".$studentid."'";
				//echo($q.'<br>');
					mysql_query($q)
		or die("sql query2".mysql_error());
						$q = "UPDATE `studentdata` SET `sreq".$i."` = '' WHERE `sreq".$i."` = '".$mystudentid."'";
							mysql_query($q)
		or die("sql query2".mysql_error());
	
				//$q = "UPDATE `studentdata` SET `req".$i."` = '' WHERE `req".$i."` = '".$mystudentid."'";
					//mysql_query($q)
		//or die("sql query2".mysql_error());
		//$q = "UPDATE `studentdata` SET `sreq".$i."` = '' WHERE `sreq".$i."` = '".$mystudentid."'";
			//				mysql_query($q)
		//or die("sql query2".mysql_error());
		}
	$q = "SELECT * FROM `teamdata`  WHERE `tmid` = '".$tmid."'";
$r = mysql_query($q);
$a = mysql_fetch_array($r);
$cnt=0;
for($i=1;$i<=6;$i++){
	if($a['mem'.$i]!=''){
		$cnt++;
	}
	else{
		break;
	}
}
$cnt++;
$q = "UPDATE `teamdata` SET `mem".$cnt."` = '".$studentid."' WHERE `tmid` = '".$tmid."'";
mysql_query($q);	
		mysql_query("UPDATE `studentdata` SET `tmid` = '".$tmid."' WHERE `studentid` = '".$studentid."'");
		
	$cnnt = $cnt;
	
	
	}
	
		//set avg_cpi in teamdata table
	
		if($cnnt==0){
		$cnnt=2;
	}
	$r = mysql_query("SELECT * FROM `teamdata` WHERE `tmid` = '".$tmid."'");
	$a = mysql_fetch_array($r);
	$totalcpi=0;
	for($i=1;$i<=$cnnt;$i++){
		$r = mysql_query("SELECT `cpi` FROM `studentdata` WHERE `studentid` = '".$a['mem'.$i]."'")
		or die("asasassaas".mysql_error());
		$datacpi = mysql_fetch_array($r);
		echo($a['mem'.$i]."   ".$datacpi['cpi']."<br>");
		$totalcpi += $datacpi['cpi'];		
	}
	$totalcpi = $totalcpi/($cnnt);
	mysql_query("UPDATE `teamdata` SET `avg_cpi` = '".$totalcpi."' WHERE `tmid` ='".$tmid."'")
	or die("cpi".mysql_error());
	
header("location:student_home.php");
?>