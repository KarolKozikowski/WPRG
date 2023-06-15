<?php
session_start();
if(!isset($_SESSION['user_id']) || $_SESSION['user_id']!=1) exit(header("location: ../../index.php?error=You don't have administrator rights")); //just in case
?>