<?php
header('Access-Control-Allow-Origin: *');


//do nothing
//images are served from the URL right into the IMG tag


/*

$oid = htmlspecialchars($_GET["oid"]);

$name = $oid.'.jpg';
$fp = fopen($name, 'rb');
header("Content-Type: image/png");
header("Content-Length: " . filesize($name));
fpassthru($fp);


*/
//echo ''

/*
$img_src = '123.jpg';
$imgbinary = fread(fopen($img_src, "r"), filesize($img_src));
$img_str = base64_encode($imgbinary);

header("Content-Type: text/plain");
echo $img_str;
*/
?>