<?php

class Config {
  //Website 
  
  const URL = 'localhost/standart';
  const DOMAIN = 'localhost';
  const TITLE = 'standart'; 


  //USER Auth Table 

  const USER_TABLE = 'player';
  const USER_NAME_COlUMN = 'name';
  const USER_PASSWORD_COLUMN = 'passwort';


  //MySQL server connection details

  const SERVER_NAME = "localhost";
  const USER_NAME = "root";
  const PASSWORD = "";
  const PORT = "3306";

  //Session Config

  //Minutes until session expires
  const SESSION_TIMEOUT = 30;
  //seconds until cookie expires
  const COOKIE_TTL = 1800;
  //seconds until cookie expires
  const HTTPS_ONLY = true;
}