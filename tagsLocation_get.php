<?php
  header('Access-Control-Allow-Origin: *');

  include 'sqlQuery.php';

  //GET Request
  $variables = explode("/",$_SERVER['REQUEST_URI']);
  $facility = $variables[sizeOf($variables)-2]; //the first variable
  $location = $variables[sizeOf($variables)-1]; //the first variable

  $sql = "SELECT * from [dbo].tags where tagtype = ? and facility = ? and location = ? and active = 1";
  $params = array( "location", $facility, $location );
  $jsonResponse = sqlQuery($sql, $params);
  echo $jsonResponse;
?>
