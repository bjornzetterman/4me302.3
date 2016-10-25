<?php
session_start();
	  require_once("functions.php");
	  echo "<div id='top'>Username:  " . $_SESSION['username'] ."(".$_SESSION['Role'].")" . " - E-mail:" . $_SESSION['email'] . "( ". $_SESSION['Organization'] . " ) <a href='logout.php'>Logout</a></div>";
//echo $_SESSION['RoleId'];


switch($_SESSION['RoleId']){
	case '1';
			//we asume that facebook means patient.
						dispalyvideos();
						displaystats();
						//Number of exercise session per day/week/month,
	break;
	
    case '2';
	//echo "twitterstuff";
		displayPatienData();
		//getdata("Note","User_IDmed","2");
	break;
	
	
    case '3';
        echo 'Google choice';
		displayPatienData();
		echo "<hr />";
		//add this rss http://www.news-medical.net/tag/feed/Parkinsons-Disease.aspx
		displayrss();
    break;
	
    default;
        echo 'Ehhm something wrong?';
    break;
}
  echo "<br> <a href='logout.php'>Logout</a>";
 
  function displayrss(){
  //https://www.developphp.com/video/PHP/simpleXML-Tutorial-Learn-to-Parse-XML-Files-and-RSS-Feeds
	$html = "";
	$url = "http://www.news-medical.net/tag/feed/Parkinsons-Disease.aspx";
	$xml = simplexml_load_file($url);
	for($i = 0; $i < 10; $i++){
		$title = $xml->channel->item[$i]->title;
		$link = $xml->channel->item[$i]->link;
		$description = $xml->channel->item[$i]->description;
		$pubDate = $xml->channel->item[$i]->pubDate;
		
			$html .= "<a href='$link'><h3>$title</h3></a>";
		$html .= "$description";
		$html .= "<br />$pubDate<hr />";
	}
	echo $html;
  }
  
function dispalyvideos(){
echo '<iframe width="560" height="315" src="https://www.youtube.com/embed/xkMOjvjwhdU?rel=0&autoplay=0" frameborder="0" allowfullscreen></iframe>';
}
function displaystats(){
	$Therapy = getdata("Therapy","User_IDpatient", $_SESSION['userid']);//leta reda på den aktuelle användarens Therapys
//	print_r($Therapy);
//echo "XML ATTRIBUT: ". xml_attribute($Therapy, 'id') . "// ";
	$Test = getdata("Test","Therapy_IDtherapy", "1");//vika test finns.
	//print_r($Test);
	$i = 0;
	
	foreach($Test as $t){
	echo $t['dateTime'];
		$date = date_create_from_format('Y-m-d H:i:s', $t['dateTime']);
		$tstamp = getdate($date);
		$d[$i] [$tstamp['year']] [$tstamp['month']] [$tstamp['mday']] = 	$t['Therapy_IDtherapy'];
		$i++;
	}
	print_r($d);
}

function displayPatienData(){
	$Therapies = getdata("Therapy","User_IDmed",$_SESSION['userid']);//leta reda på den aktuelle användarens Therapys
		foreach($Therapies as $k=>$Therapy){
			//print_r($Therapy);
			$patient =  gettable('User',(string)$Therapy->User_IDpatient);
			$medic =  gettable('User',(string)$Therapy->User_IDmed);
			$therapylist =  gettable('Therapy_List',(string)$Therapy->TherapyList_IDtheraphylist);
			$medicinelist =  gettable('Medicine',(string)$therapylist->Medicine_IDmedicine);
			
			
			echo "<hr /> <div> ";
			echo "Patientname : " . $patient->userID[0]->username . "<br />\n" ;
			echo "Physician/med : " . $medic->userID[0]->username . "<br />\n" ;
			echo "Therapy list : " . $therapylist->therapy_listID[0]->name . "<br />\n" ;
			echo "Medicine list : " . $medicinelist->medicineID[0]->name . " , dosage: ".$therapylist->therapy_listID[0]->Dosage ."<br />\n" ;
			echo "Therapylist id: " . $Therapy->TherapyList_IDtherapylist."<br />\n" ;
			//print_r($patient);
			
			$Tests = getdata("Test","Therapy_IDtherapy", (string)xml_attribute($Therapy, 'id'));//leta reda på den aktuelle användarens Therapys
			//print_r($Tests);
			//print_r(gettable("Test"));
			foreach($Tests as $k1 => $Test){
				echo "\n---------TEST------------------------------<br />\n";
				echo "Testtime: " . (string) $Test->dateTime . " - - _ testID " . (string)xml_attribute($Test, 'id')."<br />\n";
				//print_r($k1);
				
				//$TestSessions = getdata("Test_Session","Test_IDtest", (string)$Test->testID[0]->id);
				$TestSessions = getdata("Test_Session","Test_IDtest", (string)xml_attribute($Test, 'id'));
				//print_r($TestSessions);
				foreach($TestSessions as $k2 => $Session){
					echo "++++++++TESTSESSION+++++++++++++++++++++++++++++<br />\n";
					echo "Test Session type: " . (string) $Session->type . "<br />\n";
					echo "Test Data URL :<a href='http://4me302-16.site88.net/".(string) $Session->DataURL.".csv'>http://4me302-16.site88.net/".(string) $Session->DataURL.".csv</a><br />\n";
					echo "Visual style :<a href='visual.php?data=".(string) $Session->DataURL."'>GO TO VISUAL ANALYZE</a><br />\n";
					//print_r($Session);
					
					//http://4me302-16.site88.net/data1.csv
					$Notes = getdata("Note","Test_Session_IDtest_session", (string)xml_attribute($Session, 'id'));
					foreach($Notes as $k3 => $Note){
					//print_r($Note);
					$userm = gettable("User",(string)$Note->User_IDmed);
					$rolem = gettable("Role",(string) $userm->userID[0]->Role_IDrole);
						echo "NOTE: ".(string)$Note->note. "by ".(string) $userm->userID[0]->username ." ( ". (string) $rolem->roleID[0]->name." ) " . "<br />"; //(string) $user->userID[0]->username;
					}
					echo "++++++++++++++++++++++++++++++++++++++++++++<br />\n";
				}
				
				echo "-------------------------------------------<br />\n";
			}
			echo "</div>";
		}
}
?>