<?php
session_start();
function TSA($your_stuff){
    $your_stuff = trim($your_stuff);
    $your_stuff = stripslashes($your_stuff);
    $your_stuff = htmlspecialchars($your_stuff);
    return $your_stuff;
}
$user_id=$_SESSION['user_id'];
//TSA makes sure no unauthorized html lines go through :)
if(isset($_POST['password'])) $password = TSA($_POST['password']);
else $password=null;
//Connecting to server
include("connect.php");
$select_query = $server_connection->query("SELECT users.user_password FROM users WHERE ID=$user_id");
while($row = $select_query->fetch_assoc()) $password_hashed = $row['user_password'];
$select_query->close();
//verification
if(!password_verify($password, $password_hashed)){
    exit(header("location: ./user_delete2.php?error=Incorrect password"));
}
$delete_query = $server_connection->query("DELETE FROM users WHERE ID=$user_id");
$server_connection->close();
exit(header("location: ./user_edit.php?oper=1"));
?>