<?php
session_start();
if(!isset($_SESSION['userid']))
	die( "BAD LOGIN");

if(empty($_GET['data']))
	die("NO DATAFILENAME GIVEN");
	
	$file = "http://4me302-16.site88.net/".  $_GET['data'] . ".csv";
//$file="1_23.csv";
$csv= file_get_contents($file);
//$rows = explode("\n",$csv); // problems wit CR LF , changed to pregexpression instead.
$rows = preg_split('/\n|\r\n?/', $csv);
$i = 0;
foreach ($rows as $row){
	$line = explode(",",$row);
	//print_r($line);
	$rawdata[$i]['X']= trim($line[0]);
	$rawdata[$i]['Y']= trim($line[1]);
	$rawdata[$i]['time']= trim($line[2]);
	$i++;
	}
	unset($rawdata[0]);
//print_r($rawdata);
$json = json_encode($rawdata);
print($json);
?>