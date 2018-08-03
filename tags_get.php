<?php
include('common/_cors.php');
//header('Access-Control-Allow-Origin: *');

  include 'sqlQuery.php';

  $variables = explode("/",$_SERVER['REQUEST_URI']);
  $facility = $variables[sizeOf($variables)-2]; //the first variable
  $location = $variables[sizeOf($variables)-1]; //the first variable

  $sql = "SELECT * FROM [dbo].tags WHERE facility = ? AND location = ? AND active = 1";
  $params = array( $facility, $location );
  $jsonResponse = sqlQuery($sql, $params);
  echo $jsonResponse;
?>
