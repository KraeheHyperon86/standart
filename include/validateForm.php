<?php
require "autoloader.php";

$session = new Session();
$db = new MySQL();

$name     = Validate::filterRequest("name", "string", '');
$rename   = Validate::filterRequest("rename", "string", '');
$password = Validate::filterRequest("password", "string", '');
$groupPw  = Validate::filterRequest("groupPw", "string", '');
$id       = Validate::filterRequest("id", "int", 0);
$id_group = Validate::filterRequest("id_group", 'int', 0);
$action   = Validate::filterRequest("action", "string", '');
$auth = '';

$userTable      = Config::USER_TABLE;
$userColumn     = Config::USER_NAME_COlUMN;
$passwordColumn = Config::USER_PASSWORD_COLUMN;



if ($action == "Login") {

  $player = $db->selectDB2assoc('SELECT id , id_group,  '.$passwordColumn.' , '.$userColumn.'
                                 FROM '.$userTable.'
                                 WHERE '.$userColumn.' = "'.$name.'" 
                                 AND '.$passwordColumn.'  = "'.md5($password).'"');
                        
  if(count($player) == 1 && hash_equals($player[0][$passwordColumn], md5($password))) {
    $session->setSessionValue("id", $player[0]["id"]);
    $session->setSessionValue($userColumn, $player[0][$userColumn]);
    $session->setSessionValue("id_group", $player[0]["id_group"]); 
    $alert = "Login erfolgreich";
    
  } 
  else {
    $alert = 'Name oder Passwort falsch!';
  } 
}

if ($action == "Registrieren") { 

  $id_group = $db->value("`group`", "id", "groupPw = '$groupPw'");

  if ($id_group == -1) {
    $alert = "Passwort ist keiner Gruppe zugeordnet";
    $auth = 'register';
  }

  if (empty($alert)) {
    $player = $db->selectDB2assoc("SELECT $userColumn FROM $userTable 
                                   WHERE $userColumn = '$name' 
                                   AND id_group = $id_group");
 
    if (!empty($player)) {
      $alert = "Name existiert bereits";
      $auth = 'register';
    }
    else {
      $set = [];
      $set[$userColumn] = $name;
      $set[$passwordColumn] = md5($password);
      $set['id_group'] = $id_group;
      $id = $db->insertDB($userTable, $set);
      $session->setSessionValue($userColumn, $name);
      $session->setSessionValue("id", $id);
      $session->setSessionValue("id_group", $id_group);

      $alert = "Registrierung erfolgreich! Sie sind jetzt angemeldet";
    }
  }
  
}

if ($action == "Umbenennen") {

  if($rename == $name) {
    $alert = "Name ist identisch";
  }
  else {
    $player = $db->selectDB2assoc("SELECT $userColumn FROM $userTable 
                                   WHERE id != $id 
                                   AND $userColumn = '$rename'
                                   AND id_group = $id_group");
    if(!empty($player)) {
      $alert = "Name existiert bereits";
    }
    else {
      $db->updateDB($userTable, $id, [$userColumn  => $rename]);
      $session->setSessionValue($userColumn, $rename);
      $alert = "Name erfolgreich geändert zu ".$rename;
    }
  }    

} 

if ($action == "Logout") {
  $session->logoutUser();
  $alert = "Sie wurden abgemeldet";

}

if ($action == "Löschen") {
  $db->deleteDB($userTable, $session->getUserID());
  $alert = "Account erfolgreich gelöscht";
  $session->logoutUser();
}

$session->setSessionValue("alert", $alert);
$auth = empty($auth) ? 'login' : $auth;
header("Location: ../index.php"."?auth=$auth");
exit();



