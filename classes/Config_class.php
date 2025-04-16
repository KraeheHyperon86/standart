<?php

class Config {
  //Website 
  
  const URL = 'localhost/standart';
  const DOMAIN = 'localhost';
  const TITLE = 'standart'; 
  const ROOT = 'standart';


  //USER Auth Table 

  const USER_TABLE = 'player';
  const USER_NAME_COlUMN = 'name';
  const USER_PASSWORD_COLUMN = 'passwort';


  //MySQL server connection details
  const DB_NAME = "";
  const SERVER_NAME = "localhost"; // Is always localhost
  const USER_NAME = "root";
  const PASSWORD = "";
  const PORT = "3306";

  //Session Config

 //Minutes until session expiresDOMAIN
  const SESSION_TIMEOUT = 120;
  //seconds until cookie expires
  const COOKIE_TTL = 7200;
  // Deny Sesssion Acess from Client Side Script
  const HTTP_ONLY = true;
  // Session will only be sent over HTTPS, false while in develop
  const SECURE = false;
}
