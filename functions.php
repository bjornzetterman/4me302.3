<?php
 function gettable($table,$id=""){
 if(empty($table))
	return 0;
	
//	http://4me302-16.site88.net/index.php?table=User&id=3
	$url = "http://4me302-16.site88.net/getData.php";
	$url .= "?table=".$table;
	if(!empty($id)){
		$url .= "&id=".$id;
		$objects=simplexml_load_file($url);
	}else{
		$objects=simplexml_load_file($url);
	}
	//error_log($url);
	return $objects;
  }
  
  
  function getdata($table,$keyname,$keyvalue){
  //this function uses gettable function.
   if(empty($table))
	return 0;
	
	 if(empty($keyname))
	return 0;
  
   if(empty($keyvalue))
	return 0;
	
	$data = gettable($table);
	//error_log("//*[".$keyname."=".$keyvalue."]");
	$result= $data->xpath("//*[".$keyname."=".$keyvalue."]");
	return $result;
  }

  
  function xml_attribute($object, $attribute){
		if(isset($object[$attribute]))
			return (string) $object[$attribute];
	}
  ?>