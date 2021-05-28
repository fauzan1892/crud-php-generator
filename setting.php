<?php
/*
|--------------------------------------------------------------------------
| Koneksi PHP MySQL
|--------------------------------------------------------------------------
|
*/
    $host = "localhost";
    $user = "root";
    $pass = "";
    $db   = "crud_generator";

    $connectdb = new PDO("mysql:host=$host;dbname=$db", $user, $pass);

    $title_apl = 'CRUD PHP Generator';
    
    error_reporting(2);

/*
|--------------------------------------------------------------------------
| BASE SITE URL
|--------------------------------------------------------------------------
|
*/

$baseURL  = "http://localhost/testing/crud-php-generator/";