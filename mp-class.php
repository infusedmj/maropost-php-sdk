<?php

class MP {
	static $auth_token 	= "{ENTER YOUR AUTH TOKEN}";
	static $url_api 	= "http://app.maropost.com/accounts/{ENTER MAROPOST ACCT ID}/";

	function request($action, $endpoint, $dataArray) {
		$url = self::$url_api . $endpoint . ".json"; 
	  	$ch = curl_init();

	  	$dataArray['auth_token'] = self::$auth_token;
	  	$json = json_encode($dataArray);

	    //curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
	    curl_setopt($ch, CURLOPT_MAXREDIRS, 10 );
	    curl_setopt($ch, CURLOPT_URL, $url);

	    switch($action){
	            case "POST":
	            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
	            curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
	            break;
	        case "GET":
	            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
	            curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
	            break;
	        case "PUT":
	            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
	            curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
	            break;
	        case "DELETE":
	            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
	            curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
	            break;
	        default:
	            break;
	    }
	    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json','Accept: application/json'));
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
	    $output = curl_exec($ch);
	    curl_close($ch);
	    $decoded = json_decode($output);
	    return $decoded;
	}
}

// EXAMPLE 1: Add new contact to Maropost:
$mp = new MP;
$newcontact = $mp->request('POST','lists/2356/contacts', array(
		'first_name'  => 'John',
		'last_name'   => 'Smith',
		'email' 	  => 'jsmith@jsmith.com'
	));

?>
