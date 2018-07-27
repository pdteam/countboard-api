<?php
$serverName = "countboard.database.windows.net"; //serverName\instanceName
$connectionInfo = array( "Database"=>"countboard", "UID"=>"e7646c78-5ff9-4b4d-8d10-8cb4b5bed0dd", "PWD"=>"StandAndBeCounted!");
$conn = sqlsrv_connect( $serverName, $connectionInfo);

if( $conn ) {
     echo "Connection established.<br />";
}else{
     echo "Connection could not be established.<br />";
     die( print_r( sqlsrv_errors(), true));
}
?>