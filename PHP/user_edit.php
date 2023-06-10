<?php
session_start();
if($_GET['oper']==1){
    session_unset();
    setcookie("user_id", "", time()-3600, "/");
    setcookie("user_name", "", time()-3600, "/");
    header("location: ../index.php");
    exit;
}
?>