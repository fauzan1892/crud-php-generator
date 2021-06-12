<?php

/*
|--------------------------------------------------------------------------
| Connect DB PHP MySQL
|--------------------------------------------------------------------------
|
*/
    $host = "localhost";
    $user = "root";
    $pass = "";
    $db   = "crud_generator";

    $connectdb = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
/*
|--------------------------------------------------------------------------
| Project Title Name
|--------------------------------------------------------------------------
|
*/
    $title_apl = 'CRUD PHP Generator';

/*
|--------------------------------------------------------------------------
| BASE SITE URL
|--------------------------------------------------------------------------
|
*/
    global $baseURL;
    $baseURL  = "http://localhost/testing/crud-php-generator/";

/*
|--------------------------------------------------------------------------
| Date Default Timezone SET
|--------------------------------------------------------------------------
|
*/
    date_default_timezone_set("Asia/Jakarta");

/*
|--------------------------------------------------------------------------
| Error Reporting
|--------------------------------------------------------------------------
|
*/
    // ini_set('display_errors', '1');
    // ini_set('display_startup_errors', '1');
    error_reporting(2);