<?php
session_start();
if(!isset($_SESSION['studentid']))
 die(header("location:index.php?flg=redirect"));
?>


<?php
include('../../connection.php');
//session_start();
$studentid=$_GET['studentid'];
$mystudentid=$_SESSION['studentid'];
	
	$query = "SELECT * FROM `studentdata`  WHERE `studentid` =".$studentid;
	//echo($query);
	$result = mysql_query($query)
		or die("sql query2".mysql_error());
	$f = mysql_fetch_array( $result);
//print_r($f);
	$query = "SELECT * FROM `studentdata`  WHERE `studentid` =".$mystudentid;
	//echo($query);
	$result = mysql_query($query)
		or die("sql query2".mysql_error());
	$qq = mysql_fetch_array( $result);
	
	$r_name = $f['name'];
				$count=1;
	while($count!=7){
			if($qq['sreq'.$count]==null){
					$query = "UPDATE `studentdata` SET `sreq".$count."` = '".$studentid."' WHERE  `studentid` = '".$mystudentid."'";
					mysql_query($query)
						or die("sql query3".mysql_error());
			
					echo(1);
							break;
				}
				else if($qq['sreq'.$count]===$studentid){
				
								header("location:student_home.php?flg=true");
								die();
					echo(2);
					break;
				}
				$count++;
			}
	$cnt=1;
	while($cnt!=7){
		//echo('req'.$cnt.'<br>');
		if($f['req'.$cnt]==null){
			$query = "SELECT * FROM `studentdata`  WHERE `studentid` =".$studentid;
			$result = mysql_query($query)
				or die("sql query2".mysql_error());
			$f = mysql_fetch_array( $result);

			
				
			$query = "UPDATE `studentdata` SET `req".$cnt."` = $mystudentid WHERE  `studentid` = $studentid";
			mysql_query($query)
				or die("sql query3".mysql_error());
			header("location:student_home.php?flg=true");
				die();
			echo(3);
			break;
		}
		
		else{ if($f['req'.$cnt]===$mystudentid){
				echo(4);
				header("location:student_home.php?flg=true");
									die();
		}
		}
		$cnt++;
	}
	echo("<html><script>alert('You can't send a request to $r_name because his/her mex request limit is over, so ask him/her to delete unwanted request. and then try again');location.href = 'student_home.html';</script></html>");
?>