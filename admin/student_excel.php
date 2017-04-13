<?php
session_start();
if(!isset($_SESSION['admin']))
 die(header("location:index.php?msg=You are not logged in"));
?>


<?php

$link = mysql_connect( "localhost", "root","root");
if ( ! $link )
		die( "Couldn't connect to MySQL: " .mysql_error());
mysql_select_db( "project_allocation", $link )
	or die ( "Couldn't open project_allocation: ".mysql_error() );
	
if(move_uploaded_file($_FILES['userfile']['tmp_name'],'./upload_database/student_info.xlsx'))
{
	echo "true";
	include './../PHPExcel/IOFactory.php';
	$inputfilename = './upload_database/student_info.xlsx';
	try
	{
		$inputfiletype = PHPExcel_IOFactory::identify($inputfilename);
		$objreader = PHPExcel_IOFactory::createReader($inputfiletype);
		$objphpexcel = $objreader->load($inputfilename);
	}
	catch(Exception $e)
	{
		die('Error loading file'.$e);
	}
	$sheet = $objphpexcel->getSheet(0);
	$highestrow = $sheet->getHighestRow();
	$highestcolumn = $sheet->getHighestColumn();
	$rowdata = $sheet->rangeToArray('A1:'.$highestcolumn.'1',NULL,NULL,TRUE,FALSE);
	for($column='A';$column<=$highestcolumn;$column++)
	{
		$clmtitle[ord($column)-ord('A')]=$rowdata[0][ord($column)-ord('A')];
	}

	for($row=2; $row<=$highestrow;$row++)
	{
		$random_string="";
		for($i=0;$i<10;$i++)
		{
			$random_string .= chr(rand(65,90));
		}
		
		$rowdata = $sheet->rangeToArray('A'.$row.':'.$highestcolumn.$row,NULL,NULL,TRUE,FALSE);
		for($column='A';$column<=$highestcolumn;$column++)
		{
			$data[ord($column)-ord('A')]=$rowdata[0][ord($column)-ord('A')];

		}
		$q = "SELECT * FROM `studentdata` WHERE `clgid` = '".$data[0]."'";
		$r = mysql_query($q)
		or die(mysql_error());
		$a = mysql_fetch_array($r);
		if($a==null){
		
		//if($a['clgid']==null)
		$query = 'INSERT INTO `studentdata` (`'.$clmtitle[0].'`,`'.$clmtitle[1].'`,`'.$clmtitle[2].'`,`'.$clmtitle[3].'`,`'.$clmtitle[4].'`,`'.$clmtitle[5].'`,`password`) VALUES ("'.$data[0].'","'.$data[1].'","'.$data[2].'","'.$data[3].'","'.$data[4].'","'.$data[5].'","'.$random_string.'")';
		$result = mysql_query($query)
			or die("sql query".mysql_error());
		$to=$email;
		//$subject="USERNAME & PASSWORD";
		//$message="YOUR USERNAME IS $clgid & PASSWORD IS $random_string";
		include("../mail/send_mail.php");
	$subject = "Project allocation system";
	$message = "your username is your collage id : ".$clgid."<br>and your password is : ".$random_string." <br>do login and Best Of Luck <br>Thank You!";
	$mail->Subject = $subject;
	$mail->Body = $message;
	$mail->AddAddress($to);
	$mail->Send();
		}
	}
	header("Location:add_student.php?msg=true");
}
?>