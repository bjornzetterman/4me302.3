<?php
session_start();
if(!isset($_SESSION['userid']))
	die( "BAD LOGIN");

if(empty($_GET['data']))
	die("NO DATAFILENAME GIVEN");
	
	$file = "http://4me302-16.site88.net/".  $_GET['data'] . ".csv";

	// like a proxy..
$csv= file_get_contents($file);
echo $csv;


?>