<?php
$link = mysql_connect( "localhost", "root","root");
	if ( ! $link )
			die( "Couldn't connect to MySQL: " .mysql_error());
	
	mysql_select_db( "project_allocation", $link )
		or die ( "Couldn't open project_allocation: ".mysql_error() );



?>