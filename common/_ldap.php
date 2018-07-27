<?php
    define('LDAP_URL', 'ldap://adnhq.csc-scc.gc.ca:389');

    class Ldap {
        private static $instance = NULL;
        private function __construct() {}
        private function __clone() {}

        public static function getInstance() {
          if (!isset(self::$instance)) {
              $ldap_conn = ldap_connect(LDAP_URL);
              ldap_set_option($ldap_conn, LDAP_OPT_PROTOCOL_VERSION, 3);
              ldap_set_option($ldap_conn, LDAP_OPT_REFERRALS, 0);

              self::$instance = $ldap_conn;
          }

          return self::$instance;
        }
    }
?>
