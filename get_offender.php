<?php

include('common/_cors.php');
//header('Access-Control-Allow-Origin: *');


//get the variables from the URL instead of by name with  a regular GET command
$variables = explode("/",$_SERVER['REQUEST_URI']);
$NTAccount = $variables[sizeOf($variables)-2]; //the first variable
$location = $variables[sizeOf($variables)-1]; //the first variable


$str = file_get_contents('data/offender.json');
echo $str;

?>
