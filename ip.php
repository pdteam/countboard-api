<?php


echo 'Server IP Address: '.$_SERVER['SERVER_ADDR'];
echo '<br/>';


$externalContent = file_get_contents('http://checkip.dyndns.com/');
preg_match('/Current IP Address: \[?([:.0-9a-fA-F]+)\]?/', $externalContent, $m);
$externalIp = $m[1];

echo $externalIp ;

?>

