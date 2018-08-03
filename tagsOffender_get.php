<?php
include('common/_cors.php');
//header('Access-Control-Allow-Origin: *');

  include 'sqlQuery.php';
  include 'uuid.php';

  //GET Request
  $variables = explode("/",$_SERVER['REQUEST_URI']);
  $facility = $variables[sizeOf($variables)-2]; //the first variable
  $location = $variables[sizeOf($variables)-1]; //the first variable

  $sql = "SELECT * FROM [dbo].tags WHERE tagtype = ? AND facility = ? AND location = ? AND active = 1";
  $params = array("offender", $facility, $location); 		//establishing params prevents SQL Injection into the DB}
  $jsonResponse = sqlQuery($sql, $params); //submit the query to the DB
  echo $jsonResponse;
?>
