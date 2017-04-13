<?php
session_start();
if(!isset($_SESSION['admin']))
 die(header("location:index.php?msg=You are not logged in"));
?>


<html>
<head>
<title>
</title>
</head>
<body style="font-family: Avenir,'Helvetica Neue','Lato','Segoe UI',Helvetica,Arial,sans-serif;">
<center>

<div style="font-size:18px; color:#ff0000;">
<?php
if(isset($_GET['msg'])){
	echo($_GET['msg']);
}
if(isset($_GET['flg']))
{
	if($_GET['flg']==="true")
	{
		echo("Successfully added ");
	}
}
?></div>
<h3> This message will be send to given faculties </h3>
<input type="text" id="no_of_faculty" placeholder="No of faculty you want to send mail"><button onclick="fun()">ok</button>
<form action="send_msg_faculty_add_project_verify.php" method="post">
<div id="faculty"><br>
add faculty short name in small letter<br><br>
</div><br>
<div id="aaa"></div>
<table>
<tr>
<td>No of project they should add: </td>
<td><input  type="text" name="no" ></td>
</tr>
<tr>
<td>last date to add project: </td>
<td><input  type="text" name="ldate" ></td>
</tr>
<tr>
<td>Any msg: </td>
<td><textarea name="msg" rows="6" cols="60"></textarea> </td>
</tr>

</table>
<input type="submit" value="send mail">
</form>
<a href="home.php">Home</a>
<a href="logout.php">logout</a>
</center>
</body>
<script>
function fun(){
	var no = document.getElementById('no_of_faculty').value;
	for(i=1;i<=no;i++){
		document.getElementById('faculty').innerHTML += "<input type='text' name='name"+i+"' placeholder='abc' value>";
		if(i%5==0){
			document.getElementById('faculty').innerHTML += "<br>";
		}
	}
	document.getElementById('aaa').innerHTML='<input type="hidden" value="'+no+'" name="fno" >';
}
</script>
</html>
