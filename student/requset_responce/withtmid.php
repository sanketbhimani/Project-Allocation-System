<?php
//session_start();
if(!isset($_SESSION['studentid']))
 die(header("location:index.php?flg=redirect"));
?>

<div>

<div style="float:left; margin-left:1%;" id="sreqdiv">
<h6>send request</h6>
<input type="text"  onkeyup="search()" id="sreqinput">
<table id="sreqtable">
<?php
$q = 'SELECT * FROM `flag` WHERE `flag`="cpi_range"';
$r = mysql_query($q);
$a1 = mysql_fetch_array($r);

$lim=$a1['value'];



$q = "SELECT * FROM `studentdata` WHERE 1";
$r=mysql_query($q);
while($a=mysql_fetch_array($r)){
		if($a['cpi']>=$cpi-$lim && $a['cpi']<=$cpi+$lim){
	if($a['studentid']!=$studentid && $a['tmid']==null){
		$flg=0;
		for($i=1;$i<=6;$i++){
			if($a['studentid']==$b[$i]){
				$flg=1;
				break;
			}			
		}
		for($i=1;$i<=6;$i++){
			if($a['studentid']==$c[$i]){
				$flg=1;
				break;
			}			
		}		
		if($flg==0){
			echo('<tr id="sreqtr">');
			echo("<td>".$a['name']." with cpi ".$a['cpi']."</td><td><form action='send.php' method='get'><input type='hidden' value='".$a['studentid']."' name='studentid' ><input type='submit' value='send' style='margin-bottom:-18px;'></form></td>");
			echo('</tr>');
		}else{
			$flg=1;
		}
		
	}

	
		}	
}
/*
$q = "SELECT * FROM `teamdata` WHERE 1";
$r=mysql_query($q);
while($a = mysql_fetch_array($r)){
	
	
	
	if($a['tmlock']==0){
		
		$flg=0;
		for($i=1;$i<=6;$i++){
			if($a['mem1']==$b[$i]){
				$flg=1;
				break;
			}			
		}
		for($i=1;$i<=6;$i++){
			if($a['mem1']==$c[$i]){
				$flg=1;
				break;
			}			
		}
		for($i=1;$i<=6;$i++){
			if($a['mem'.$i]==$studentid){
				$flg=1;
				break;
			}			
		}
		if($flg==0){
	echo('<div>');
	$c=0;
	for($i=1;$i<=6;$i++){
//$nm;
	if($a['mem'.$i] !=''){
		$c++;
		$q = "SELECT `name` FROM `studentdata` WHERE `studentid` ='".$a['mem'.$i]."'";
		$r = mysql_query($q);
		$ary = mysql_fetch_array($r);
		$nm[$i] = $ary['name'];
		//echo($nm[$i].'<br>');
	}
	}
	//print_r($name);
	echo('team of ');
	for($i=1;$i<=$c;$i++){
		echo($nm[$i].' ');
	}
		$q = "SELECT `name`, `studentid` FROM `studentdata` WHERE `studentid` ='".$a['mem1']."'";
		$r = mysql_query($q);
		$ary = mysql_fetch_array($r);
	echo("<form action='send.php' method='get'><input type='hidden' value='".$a['tmid']."' name='tmid'><input type='hidden' value='".$ary['studentid']."' name='studentid' ><input type='submit' value='send' ></form></div>");
	}
}
}*/


?>
</table>
</div>
<div style="float:right; margin-right:3%;">
<h6>received request</h6>
<table>
<?php

$q = 'SELECT * FROM `studentdata`  WHERE `studentid`='.$studentid;
$r = mysql_query($q)
or die("bhochu".mysql_error());
$array = mysql_fetch_array($r);
for($i=1;$i<=6;$i++){
	if($array['req'.$i]!=null){
		$q = 'SELECT * FROM `studentdata` WHERE `studentid`="'.$array['req'.$i].'"';
		$r = mysql_query($q)
			or die("sakasjdlkasj".mysql_error());
		$asdf = mysql_fetch_array($r);
		//print_r($asdf);
		if($asdf['tmid']==''){
			echo('<tr>');
			echo("<td>".$asdf['name'].' with cpi '.$asdf['cpi']."</td><form action='accepttm.php' method='get'><input type='hidden' name='tmid' value='".$array['tmid']."'><input type='hidden' name='studentid' value='".$asdf['studentid']."' ><td><input type='submit' value='accept'></td></form>");
			echo('</tr>');
		}/*
		else{
			$q = "SELECT * FROM `teamdata` WHERE `tmid` = '".$asdf['tmid']."'";
			$r=mysql_query($q);
			$a = mysql_fetch_array($r);
			if($a['tmlock']==0){
				echo('<div>');
				$c=0;
				for($i=1;$i<=6;$i++){
					if($a['mem'.$i] !=''){
						$c++;
						$q = "SELECT `name` FROM `studentdata` WHERE `studentid` ='".$a['mem'.$i]."'";
						$r = mysql_query($q);
						$ary = mysql_fetch_array($r);
						$nm[$i] = $ary['name'];
					}
				}
				echo('team of ');
				for($i=1;$i<=$c;$i++){
					echo($nm[$i].' ');
				}
				$q = "SELECT `name`, `studentid` FROM `studentdata` WHERE `studentid` ='".$a['mem1']."'";
				$r = mysql_query($q);
				$ary = mysql_fetch_array($r);
				echo("#################");
				echo("<form action='accepttm.php' method='get'><input type='hidden' value='".$ary['tmid']."' name='tmid'><input type='hidden' value='".$ary['studentid']."' name='studentid' ><input type='submit' value='accept' ></form></div>");
			}
		}*/
	}
	
}


?>
</table>
</div>
<div>
<h6>Sent request</h6>
<table>
<?php 
include('delete_request.php'); ?>
</table>
</div>
</div>