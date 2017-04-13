<?php
session_start();
if(!isset($_SESSION['studentid']))
 die(header("location:index.php?flg=redirect"));
?>

<?php
//session_start();
include('../../connection.php');
$q = "SELECT * FROM `studentdata` WHERE `studentid` = '".$_SESSION['studentid']."'";
//$q = mysql_real_escape_string($q);
//echo($q);
$r = mysql_query($q)
or die(mysql_error());
	
$a = mysql_fetch_array($r);
if($a['email']===''){
	header("location:add_email.php");
}
?>
<html>
<head>

</head>
<body style="font-family: Avenir,'Helvetica Neue','Lato','Segoe UI',Helvetica,Arial,sans-serif;">
<script type="text/javascript" src="jquery.min.js"></script>
<script type="text/javascript" src="jquery.plugin.min.js"></script> 
<script type="text/javascript" src="jquery.countdown.min.js"></script>

<div style="float:right">
time left<br>
<div id="timer">
</div>
</div><br><br><br>
<center>
<h6 style="color:red;"><?php if(isset($_GET['msg'])){
	echo($_GET['msg']);
}
	?></h6>
<div style="font-size:30px;"><?php 
$cnt=0;
$q = "SELECT * FROM `flag` WHERE `no` = '3'";
$r = mysql_query($q);
$a = mysql_fetch_array($r); 
$phase = $a['value'];
$q = "SELECT * FROM `flag` WHERE `no` = '7'";
$r = mysql_query($q);
$a = mysql_fetch_array($r); 
$lastdate = $a['value'];
$date = date('m/d/Y');
if($phase==1){
	if($date<=$lastdate){
	echo('Currently team formation phase is running');
	}
	else{
		echo(' team formation phase is over');
	}
}
else if($phase == 2){
	if($date<=$lastdate){
	echo('Currently choice filing phase is running');
	}else{
			echo('choice filing phase is over');
	}
}
else if($phase == 3){

	echo("Currently result is being displayed");
}
?></div>

<?php

include('../../connection.php');
$q = 'SELECT * FROM `flag` WHERE `flag`="max_tsize"';
$r = mysql_query($q);
$a1 = mysql_fetch_array($r);
$tmlimit = $a1['value'];
//session_start();
$studentid = $_SESSION['studentid'];

$q = 'SELECT * FROM `studentdata` WHERE `studentid`='.$studentid;
$r = mysql_query($q);
$a = mysql_fetch_array($r);
$_SESSION['cpi']=$a['cpi'];
$q = 'SELECT * FROM `flag` WHERE `flag`="phase_change"';
$r = mysql_query($q);
$bb = mysql_fetch_array($r);

$clgid = $a['clgid'];
$name = $a['name'];
$tmid = $a['tmid'];
$cpi = $a['cpi'];

if($tmid == ''){
echo("<h2>Hi ".$name."</h2><h4>Your CPI : ".$cpi."</h4>");

}
else{
	
	$_SESSION['tmid']=$tmid;
	$r = mysql_query("SELECT * FROM `teamdata` WHERE `tmid` = '".$tmid."'");
	$a1 = mysql_fetch_array($r);
			
		echo("<h2>Hi ".$name."</h2><h4>Your team's average CPI : ".$a1['avg_cpi']."</h4>
		<h4>Your other team members are:</h4>");
				echo("<table>");
				for($i=1;$i<=6;$i++){
					if($a1['mem'.$i] !=''){
						$cnt++;
						$q = "SELECT * FROM `studentdata` WHERE `studentid` ='".$a1['mem'.$i]."'";
						$r = mysql_query($q);
						$ary = mysql_fetch_array($r);
						//$nm[$i] = $ary['name'];
						echo("<tr>");
						echo("<td>".$ary['name']."</td><td>".$ary['cpi']."</td>");
						echo("</tr>");
					}
				}
				echo("</table>");
				echo("<button onclick=\"location.href = 'delete_team.php';\">Delete Team</button><br>");
				/*echo('<h2>Welcome!<br>Team of ');
				for($i=1;$i<=$cnt;$i++){
					echo($nm[$i].' ');
				}*/
			//echo("</h2><h3>And your average CPI : ".$a1['avg_cpi'].'</h3>');
			
}
for($i=1;$i<=6;$i++){
	$b[$i]=$a['sreq'.$i];
	
}
for($i=1;$i<=6;$i++){
	$c[$i]=$a['req'.$i];
	
}

if($bb['value']==1 ){
	echo("Team formation phase is running<br>");
	if($date<=$lastdate){
	if($cnt<$tmlimit){
	echo("Create your team by sending request and if you don't want to create a team just don't do anything");
if($tmid==null){

include("withouttmid.php");
	
	
}
else{
	$r = mysql_query("SELECT `mem1` FROM `teamdata` WHERE `tmid` = '".$tmid."'");
			$qwerty = mysql_fetch_array($r);
	$_SESSION['studentid'] = $qwerty['mem1'];
	$studentid = $_SESSION['studentid'];
	include("withtmid.php");
	
}
	}
	else{
		echo("Your team has maximum number of team member<br>");
}}
else{
	echo("<br><strong>Sorry the time is over</strong>");
}
}
else if($bb['value']==2){
	echo("Team formation is over now fill your choice<br>");
	if($date<=$lastdate){
	echo('<a href="choicefilling/choicefilling.php">fill choices</a><br>');
	}
	else{
		echo('<br><strong>Sorry the time is over</strong><br>');
	}
}
else if($bb['value']==3){
	include('viewresult.php');
}
$q = 'SELECT * FROM `flag` WHERE `flag`="last_date"';
$r = mysql_query($q);
$aaa = mysql_fetch_array($r);


?>
<script>
var lastdate = '<?php echo($aaa['value']); ?>';
var ldate = new Date(lastdate);
$("#timer").countdown({until: ldate});
</script>
<table style="visibility:hidden;" id="sreq">
</table>
<script>
var table = document.getElementById("sreqtable").innerHTML;
//("#"+table+"#");
if(table=='\n'){
	//alert("aaa");
	document.getElementById("sreqtable").innerHTML="<center>There is no student,<br>to whom you can send request :[</center>";
}
document.getElementById("sreq").innerHTML = table;
var ttable = document.getElementById("sreq").rows;
var input = document.getElementById("sreqinput");
function search(){
	
	if(input.value==''){
		document.getElementById("sreqtable").innerHTML = table;
	}
	else{
		var val = input.value;
		
		document.getElementById("sreqtable").innerHTML = '';
		//alert(ttable.length);
		for(i=0;i<ttable.length;i++){ 
		//alert(ttable.item(i).cells.item(0).innerHTML.match(new RegExp('^'+val+'[a-z]*')));
			if(ttable.item(i).cells.item(0).innerHTML.match(new RegExp('^'+val+'[a-z]*'))!=null){
				//alert("jj"); 
				document.getElementById("sreqtable").innerHTML += '<tr>'+ttable.item(i).innerHTML+'</tr>';
			}
		}
	}
}
</script>
<br>
<a href="logout.php">Logout</a><br>
to change password <a href="change_pass.php">click here</a><br>
</center>
</body>
</html>


