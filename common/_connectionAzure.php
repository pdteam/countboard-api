<?php
    define('SERVER_NAME', 'countboard.database.windows.net');
    define('DATABASE_NAME', 'countboard');
    define('USERNAME', 'e7646c78-5ff9-4b4d-8d10-8cb4b5bed0dd');
    define('PASSWORD', 'StandAndBeCounted');

    class DbAzure {
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
