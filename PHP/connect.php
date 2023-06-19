<?php
define('DB_SERVER', 'default');
define('DB_USERNAME', 'default');
define('DB_PASSWORD', 'default');
define('DB_NAME', 'default');
try{
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    @$server_connection = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
}
catch(mysqli_sql_exception $exception){
    exit(header("location: ../HTML/oopsies.html"));
    die();
}