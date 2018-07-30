<?php
  header('Access-Control-Allow-Origin: *');

  include 'sqlQuery.php';
  include 'uuid.php';

  $postdata = file_get_contents("php://input");
  $request = json_decode($postdata);

  $tagtype = $request->tagtype;

  //offenders tags
  if($tagtype == 'offender')
  {
    $rfid = $request->rfid;
    $usb = $request->usb;
    $facility = $request->facility;
    $location = $request->location;
    $oid = $request->oid;
    $uuid = UUID::v4();

    $sql = "INSERT INTO [dbo].tags (uuid, rfid, usb, tagtype, oid, facility, location, createddate, active)
            values (?,?,?,?,?,?,?, SYSDATETIME(), ?)";
    $params = array($uuid, $rfid, $usb, $tagtype, $oid, $facility, $location, 1); 		//establishing params prevents SQL Injection into the DB}
    $jsonResponse = sqlQuery($sql, $params); //submit the query to the DB
  }
  else if($tagtype == 'location')
  {
    $rfid = $request->rfid;
    $usb = $request->usb;
    $facility = $request->facility;
    $location = $request->location;
    $description_en = $request->description_en;
    $description_fr = $request->description_fr;
    $bedid = $request->bedid;
    $uuid = UUID::v4();

    $sql = "INSERT INTO [dbo].tags (uuid, rfid, usb, tagtype, bedid, description_en, description_fr, facility, location, createddate, active)
            values (?,?,?,?,?,?,?,?,?, SYSDATETIME(), ?)";
    $params = array($uuid, $rfid, $usb, $tagtype, $bedid, $description_en, $description_fr, $facility, $location, 1); 		//establishing params prevents SQL Injection into the DB}
    $jsonResponse = sqlQuery($sql, $params); //submit the query to the DB
  }

  echo '{"response":"' . $tagtype  .' tag created"}';
?>
