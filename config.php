<?php
/**
 * Created by PhpStorm.
 * User: mcarp
 * Date: 08-01-2018
 * Time: 11:37
 */
// Database information //
define('_DB_HOST_', 'localhost'); // Host
define('_DB_NAME_', 'undervisning'); // Database Navn
define('_DB_USER_', 'root'); // Database Bruger
define('_DB_PASSWORD_', ''); // Database Adgangskode
define('_DB_PREFIX_', ''); // Database Prefix
define('_MYSQL_ENGINE_', 'InnoDB'); // Database Motor
// Automatisk Klasse Indlæser //
function ClassLoader($className)
{
    $className = str_replace('\\', '/', $className);
    if(file_exists(__DIR__ . '/classes/' . $className . '.php')){
        require_once(__DIR__ . '/classes/' . $className . '.php');
    } else {
        echo 'Fejl: '. __DIR__ .'/classes/'. $className . '.php';
    }
}
spl_autoload_register('ClassLoader');
// Håndtere database forbindelse //
$db = new DB('mysql:host='._DB_HOST_.';dbname='._DB_NAME_.';charset=utf8',_DB_USER_,_DB_PASSWORD_);
// Sæt debug status
// 1 = On
// 0 = Off
$debug = 1;
// Build Nummer
// Ændres for hver gang vi har opdateret vores kode
$buildnr = 123;