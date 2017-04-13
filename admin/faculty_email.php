
<?php
session_start();
if(!isset($_SESSION['admin']))
 die(header("location:index.php?msg=You are not logged in"));
?>

<?php

	if(move_uploaded_file($_FILES['userfile']['tmp_name'],'./upload_database/faculty_email.xlsx'))
	{
		//echo "true";
		$link = mysql_connect( "localhost", "root","root");
		if ( ! $link )
			die( "Couldn't connect to MySQL: " .mysql_error());
		mysql_select_db( "project_allocation", $link )
			or die ( "Couldn't open project_allocation: ".mysql_error() );
		include './../PHPExcel/IOFactory.php';
		$inputfilename = './upload_database/faculty_email.xlsx';
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
		$q = "SELECT * FROM `facultydata` WHERE `email` = '".$data[0]."'";
		$r = mysql_query($q)
		or die("asa".mysql_error());
		$a = mysql_fetch_array($r);
		if($a==null){
		
		//if($a['clgid']==null)
		$query = 'INSERT INTO `facultydata` (`'.$clmtitle[0].'`,`'.$clmtitle[1].'`,`'.$clmtitle[2].'`,`password`) VALUES ("'.$data[0].'","'.$data[1].'","'.$data[2].'","'.$random_string.'")';
		$result = mysql_query($query)
			or die("sql query".mysql_error());
			$to=$data;
			$message="your USERNAME is ".$_POST['email']." password is".$random_string;
			$subject="Project Allocation System";
			include ("./../mail/send_mail.php");
			$mail->Subject = $subject;
	$mail->Body = $message;
	$mail->AddAddress($to);
	$mail->Send();
			header('location:add_faculty.php?flg=true');
		}

	}
	header('location:add_faculty.php?flg=true');
	}
?>