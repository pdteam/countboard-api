<?php

//start of standard header
    include 'sqlQuery.php';
    
    //validate that the session is valid

    
/*
//verify if the session is active
	session_start();
	if(isset($_SESSION["uuidsubscription"]))
	{
		$uuidsubscription = $_SESSION["uuidsubscription"];
		$uuididentity = $_SESSION["uuidvisitor"];
		$uuidsession = $_SESSION["uuidsession"];
	}
	else
	{
		//reset any session variables currently set
		session_unset(); session_destroy(); die();		// load nothing further on this script
	}

//end of standard header
	$postdata = file_get_contents("php://input");
	$request = json_decode($postdata);
*/
//data block
	//$blurfocus = $request->blurfocus;
/*
		$sql = "insert into countboard.devices (uuid, description_en, description_fr, createddate, active) values (?,?,?, SYSDATETIME(), 1)";
		$params = array( 		'uuid123', 'engl', 'fren'			); 		//establishing params prevents SQL Injection into the DB}
		$jsonResponse = sqlQuery($sql, $params); //submit the query to the DB
		echo $jsonResponse;
*/

$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
$rfid = $request->rfid;
$usb = $request->usb;

echo '{"response":"'.$usb.'"}';




?>
