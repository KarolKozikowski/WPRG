<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'arctic_airlines');
try{
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    @$server_connection = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
}
catch(mysqli_sql_exception $exception){
    exit(header("location: ../HTML/oopsies.html"));
    die();
}