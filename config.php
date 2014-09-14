<?php

/*
 * To make it easier to change the DB credentials, let's make a nice array
 * You can change the config used by modifying just the variable $db_config_used
 * 
 * Below, we get the value in the selected array based on the key (host, user, pwd, etc...)
 * That way, when we change the credentials, we have to do it only in one place instead of 3.
 */

/*Configuration section*/
$db_config_used = "fwm";

//Field work manager project
$db_config["fwm"]["host"] = "localhost";
$db_config["fwm"]["user"] = "baiken_fwm_1";
$db_config["fwm"]["pwd"] = "fwm1_62313One@";
$db_config["fwm"]["default_db_name"] = "baiken_fwm_1";

//Another project example
$db_config["tmpl"]["host"] = "";
$db_config["tmpl"]["user"] = "";
$db_config["tmpl"]["pwd"] = "";
$db_config["tmpl"]["default_db_name"] = "";
/*End of Configuration section*/

//get the array with the database config to use
$db = $db_config[$db_config_used];

/*  PDO method   */
try {
    $DBH = new PDO("mysql:host=" . $db["host"] . ";dbname=" . $db["default_db_name"], $db["user"], $db["pwd"]);
    $DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo $e->getMessage();
}  