<?php
session_start();
echo"user_id: ".$_SESSION['user_id'];
echo" flight_id: ".$_GET['flightid'];
echo" pirce: ".$_GET['price'];
$total=$_GET['price'];
if(isset($_POST['check'])) $total=$total+($_GET['price']*0.2);
if(isset($_POST['hand'])) $total=$total+($_GET['price']*0.1);
if(isset($_POST['kid'])) $total=$total+($_GET['price']*1.2);
echo" TOTAL: ".$total;
?>