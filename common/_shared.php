<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    //header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    date_default_timezone_set('America/Toronto');
    error_reporting('E_ALL & ~E_WARNING');

    require_once('_helper.php');
    require_once('_jwt_helper.php');
    require_once('_ldap.php');

    require_once('Audit.php');
    require_once('User.php');
?>
