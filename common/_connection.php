<?php
    define('SERVER_NAME', 's1000pd-datb120.csc-scc.gc.ca\OCMPP');
    define('DATABASE_NAME', 'omcp');
    define('USERNAME', 'OCM_OWNER');
    define('PASSWORD', 'Ocm_own3r');

    class Db {
        private static $instance = NULL;
        private function __construct() {}
        private function __clone() {}

        public static function getInstance() {
            $connectionInfo = array(
                "Database"=>DATABASE_NAME,
                "UID"=>USERNAME,
                "PWD"=>PASSWORD,
                "CharacterSet" => "UTF-8");

            if (!isset(self::$instance)) {
              self::$instance = sqlsrv_connect(SERVER_NAME, $connectionInfo);
            }

          return self::$instance;
        }
    }
?>
