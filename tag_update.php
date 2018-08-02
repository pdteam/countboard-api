<?php
  header('Access-Control-Allow-Origin: *');

  include 'sqlQuery.php';
  include 'uuid.php';

  $postdata = file_get_contents("php://input");
  $request = json_decode($postdata);

  $rfid = $request->rfid;
  $inout = $request->inout;
  $locationuuid = $request->locationuuid;

  /*
  uuid: this.decryptedPayload.uuid,
  device: this.decryptedPayload.device,
  location: this.decryptedPayload.location,
  rfid: this.decryptedPayload.rfid,
  usb: null,
  inout: inout,
  time: this.decryptedPayload.time
  */


  if($inout == 1) //checked into a location
{
  //update the current tag location
  $sql = "UPDATE  [dbo].tags set locationuuid = ? where rfid = ? and active = 1";
  $params = array($locationuuid, $rfid); 		//establishing params prevents SQL Injection into the DB}
  $jsonResponse = sqlQuery($sql, $params); //submit the query to the DB
}
else // checked out of a location
{
//update the current tag location
  $sql = "UPDATE  [dbo].tags set locationuuid = ? where rfid = ? and active = 1";
  $params = array(null, $rfid); 		//establishing params prevents SQL Injection into the DB}
  $jsonResponse = sqlQuery($sql, $params); //submit the query to the DB
}


  echo '{"response":"tag update complete"}';

  ?>
