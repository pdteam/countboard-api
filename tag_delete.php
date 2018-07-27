<?php

header('Access-Control-Allow-Origin: *');

//start of standard header
    include 'sqlQuery.php';
    include 'uuid.php';
    
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
    --data model
    [ID] [int] IDENTITY(1,1) NOT NULL,
	[uuid] [nvarchar](50) NOT NULL,
	[rfid] [nvarchar](50)  NULL,
	[usb] [nvarchar](50)  NULL,
	[tagtype] [nvarchar](50) NOT NULL,
	[OID] [nvarchar](50) NULL,
	[FPS] [nvarchar](50) NULL,
	[longitude] [float] NULL,
	[latitude] [float] NULL,
	[description_en] [nvarchar](100) NULL,
	[description_fr] [nvarchar](100) NULL,
	[createddate] [datetime2](7) not NULL,
	[deactivateddate] [datetime2](7) NULL,
    [active] [int] not NULL,
    */

$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
$uuid = $request->uuid;

$sql = "update countboard.tags set active = 0 where uuid = ?";
$params = array( 	                $uuid	); 		//establishing params prevents SQL Injection into the DB}
$jsonResponse = sqlQuery($sql, $params); //submit the query to the DB


/*
if($tagtype == 'location')
{
//offenders tags
$rfid = $request->rfid;
$usb = $request->usb;
$description_en = $request->description_en;
$description_fr = $request->description_fr;
$longitude = $request->longitude;
$latitude = $request->latitude;

$sql = "insert into countboard.tags (uuid, rfid, usb, tagtype, longitude, latitude, description_en, description_fr  createddate, active) values (?,?,?,?,?,? SYSDATETIME(), 1)";
$params = array( 		UUID::v4(), $rfid, $usb, $tagtype, $longitude, $latitude, $description_en, $description_fr			); 		//establishing params prevents SQL Injection into the DB}
$jsonResponse = sqlQuery($sql, $params); //submit the query to the DB

}

//echo $jsonResponse;


//echo '{"response":"' . $tagtype  .' tag created"}';
*/
//echo $postdata;//

echo '{"response":"tag deleted"}';

?>
