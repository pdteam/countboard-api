<?php
  require_once('../common/_shared.php');

  $content = file_get_contents('php://input');
  $api_route = cleanInput(json_decode($content, true)["api_route"]);

  //check login
  if($api_route==1){
    $username = cleanInput(json_decode($content, true)["username"]);
    $password = cleanInputPW(json_decode($content, true)["password"]);

    $user = User::login($username, $password);
    $error = json_decode($user, true)["error"];
    if($error !== NULL){
        if(intval($error)==0){
            Audit::addEvent('login', $username, getClientIP(), 'Unable to login ['.$error.']');
        }else if(intval($error)==1){
            Audit::addEvent('login', $username, getClientIP(), 'Invalid username or password ['.$error.']');
        }else if(intval($error)==3){
            Audit::addEvent('login', $username, getClientIP(), 'User does not exist in AD ['.$error.']');
        }else if(intval($error)==2){
           Audit::addEvent('login', $username, getClientIP(), 'Successful LOGIN');
         }
    }

    if(intval($error)==2){
      echo json_encode(json_decode($user, true)['token']);
    }else{
      echo $user;
    }

  //logout
}else if($api_route==99){
    $accountNt = cleanInput(json_decode($content, true)["accountNt"]);
    Audit::addEvent('logout', $accountNt, getClientIP(), 'Successful LOGOUT');
    echo 1;
  }
?>
