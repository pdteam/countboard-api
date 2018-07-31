<?php
  header('Access-Control-Allow-Origin: *');

  include 'sqlQuery.php';
  include 'uuid.php';

  $postdata = file_get_contents("php://input");
  $request = json_decode($postdata);

  $uuid = $request->uuid;
  $device = $request->device;
  $facility = $request->facility;
  $location = $request->location;
  $locationuuid = $request->locationuuid;
  $rfid = $request->rfid;
  $usb = $request->usb;
  $inout = $request->inout;
  $time = $request->time;

  /*
  uuid: this.decryptedPayload.uuid,
  device: this.decryptedPayload.device,
  location: this.decryptedPayload.location,
  rfid: this.decryptedPayload.rfid,
  usb: null,
  inout: inout,
  time: this.decryptedPayload.time
  */

  $sql = "INSERT INTO [dbo].taps (uuid, device, facility,  location,  locationuuid, rfid, usb, inout, [time], createddate, active)
          VALUES (?,?,?,?,?,?,?,?,?, SYSDATETIME(), ?)";
  $params = array($uuid, $device, $facility, $location, $locationuuid, $rfid, $usb, $inout, $time, 1); 		//establishing params prevents SQL Injection into the DB}
  $jsonResponse = sqlQuery($sql, $params); //submit the query to the DB
?>
