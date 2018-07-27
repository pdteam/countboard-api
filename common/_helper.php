<?php
    function cleanInput($data){
      $data = trim($data);
      $data = strip_tags($data);
      $data = htmlspecialchars($data);

      return $data;
    }

    function cleanInputPW($data){
      $data = trim($data);

      return $data;
    }

    function getFullDateTime(){
        $now = time();
        $now -= 5 * 3600;

        // Is it DST?
        $ar = localtime($now,true);
        if ($ar['tm_isdst']) {
            $now += 3600;
        }

        return gmstrftime('%c', $now);
    }

    function getTodaysDate(){
        return date("Y-m-d");
    }

    function getMaxDate(){
        return date("Y-m-d", strtotime("+1 week"));
    }

    function getMinDate(){
        return date("Y-m-d", strtotime("-1 week"));
    }

    // Function to get the client IP address
    function getClientIP() {
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if(isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }

    /**
     * Get hearder Authorization
     * */
    function getAuthorizationHeader(){
            $headers = null;
            if (isset($_SERVER['Authorization'])) {
                $headers = trim($_SERVER["Authorization"]);
            }
            else if (isset($_SERVER['HTTP_AUTHORIZATION'])) { //Nginx or fast CGI
                $headers = trim($_SERVER["HTTP_AUTHORIZATION"]);
            } elseif (function_exists('apache_request_headers')) {
                $requestHeaders = apache_request_headers();
                // Server-side fix for bug in old Android versions (a nice side-effect of this fix means we don't care about capitalization for Authorization)
                $requestHeaders = array_combine(array_map('ucwords', array_keys($requestHeaders)), array_values($requestHeaders));
                //print_r($requestHeaders);
                if (isset($requestHeaders['Authorization'])) {
                    $headers = trim($requestHeaders['Authorization']);
                }
            }
            return $headers;
    }

    /**
     * get access token from header
     * */
    function getBearerToken() {
        $headers = getAuthorizationHeader();
        // HEADER: Get the access token from the header
        if (!empty($headers)) {
            if (preg_match('/Bearer\s(\S+)/', $headers, $matches)) {
                return $matches[1];
            }
        }
        return null;
    }

    function isAutorized(){
      if(getBearerToken()){
        $data = JWT::decode(getBearerToken(), 'csc_ocmp_lp_app');
        if($data){
          return User::verifyToken($data->accountNt, $data->password);
        }
      }

      return false;
    }

    function handleSqlError(){
        if( ($errors = sqlsrv_errors() ) != null) {
            return json_encode([ 'data' => 0, 'error' => $errors[0][ 'code']]);
        }

        return json_encode([ 'data' => 0, 'error' => -1]);
    }
?>
