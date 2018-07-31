<?php
  require_once('_connection.php');

  define('USER_DOMAIN', 'CSC-SCC\\');
  define('LDAP_BASE_DN', 'DC=csc-scc,DC=gc,DC=ca');
  define("LDAP_ADMIN_USER","svc-000cbspps");
  define("LDAP_ADMIN_PASS","Password4");

  class User {

    public function __construct() {
    }

    //get token
    public static function getToken($data){
        return JWT::encode($data, 'csc_ocmp_lp_app', 'HS256');
    }

    //login
    public static function login($username, $password){
        date_default_timezone_set('UTC');

        $ldap_conn = Ldap::getInstance();
        if ($ldap_conn) {
          $isInLDAP = User::isUserInLdap($username);
          $json = json_decode($isInLDAP, true)["data"];

          if($isInLDAP && $json){
            $ldapBindAdmin = ldap_bind($ldap_conn, USER_DOMAIN.$username, $password);
            if ($ldapBindAdmin){
               //firstname
               if(isset($json["givenname"]["0"])){
                 $firstName = $json["givenname"]["0"];
               }
               //lastname
               if(isset($json["sn"]["0"])){
                 $lastName = $json["sn"]["0"];
               }
               //accountNt
               if(isset($json["samaccountname"]["0"])){
                 $accountNt = $json["samaccountname"]["0"];
               }
               //dn
               if(isset($json["dn"]["0"])){
                 $dn = $json["dn"]["0"];
               }

               $data = array(
                 'accountNt' => $accountNt,
                 'password' => $password,
                 'firstName' => $firstName,
                 'lastName' => $lastName,
                 'dn' => $dn,
                 'createdAt' => date("Y-m-d H:i:s"),
                 'expiresAt' => date("Y-m-d H:i:s", strtotime('+1 day'))
               );

                return json_encode(['token' => User::getToken($data), 'error' => 2]);
              }else{
                return json_encode(['error' => 1]); //invalid username/pass
              }
          }else{
            return json_encode([ 'error' => 3]); //not in ldap
          }
        }

         return json_encode([ 'error' => 0]);
      }

      //verify token
      public static function verifyToken($username, $password){
        $ldap_conn = Ldap::getInstance();
        if ($ldap_conn) {
            $ldapBindAdmin = ldap_bind($ldap_conn, USER_DOMAIN.$username, $password);
            if ($ldapBindAdmin){
              return true;
            }
        }

        return false;
      }

    //check if user in LDAP
    public static function isUserInLdap($accountNt){
       $entries = null;
       $ldap_conn = Ldap::getInstance();
       if ($ldap_conn) {
         $bind = ldap_bind($ldap_conn, LDAP_ADMIN_USER, LDAP_ADMIN_PASS);
         $filter="(&(objectClass=user)(samaccountname=$accountNt))";
         $attr = array('samaccountname','givenname', 'sn');
         $result = ldap_search($ldap_conn,LDAP_BASE_DN,$filter,$attr);
         if($result){
           $temp = ldap_get_entries($ldap_conn,$result);
           if($temp['count'] > 0){
             $entries = ldap_get_entries($ldap_conn,$result)['0'];
           }
         }
       }

       return json_encode([ 'data' => $entries ]);
     }
  }

  //create user
  function createUser() {
      $instance = new User();
      return $instance;
  }
?>
