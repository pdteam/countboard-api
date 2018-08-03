<?php
include('common/_cors.php');
//header('Access-Control-Allow-Origin: *');

  include 'sqlQuery.php';
  include 'uuid.php';

  $postdata = file_get_contents("php://input");
  $request = json_decode($postdata);
  $uuid = $request->uuid;

  $sql = "UPDATE [dbo].tags set ACTIVE = 0 where uuid = ?";
  $params = array($uuid);
  $jsonResponse = sqlQuery($sql, $params);

  echo '{"response":"tag deleted"}';
?>
