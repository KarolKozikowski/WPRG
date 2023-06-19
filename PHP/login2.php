<?php
session_start();
include("connect.php");
function TSA($your_stuff){
    $your_stuff = trim($your_stuff);
    $your_stuff = stripslashes($your_stuff);
    $your_stuff = htmlspecialchars($your_stuff);
    return $your_stuff;
}
//TSA makes sure no unauthorized html lines go through :)

if(isset($_GET['email'])) $email = TSA($_GET['email']);
else $email=null;
if(isset($_GET['password'])) $password = TSA($_GET['password']);
else $password=null;

$select_query=$server_connection->prepare("SELECT users.ID, users.username, users.user_password FROM users WHERE Email=?");
$select_query->bind_param("s", $email);
$select_query->execute();
$result=$select_query->get_result();

//check if user exists
if($result->num_rows===1){
    while($row=$result->fetch_assoc()){
        $user_id=$row['ID']; //get user ID
        $user_password=$row['user_password']; //hashed password
        $username=$row['username']; //get user name
    }
    if(password_verify($password, $user_password)){
        $_SESSION["user_id"]=$user_id;
        $_SESSION["user_name"]=$username;
        if(isset($_GET['remember'])){
            setcookie("user_id", $user_id, time()+(86400*14), "/");
            setcookie("user_name", $username, time()+(86400*14), "/");
        }
        $select_query->close();
        $server_connection->close();
        if($user_id==1) exit(header("location: ../PHP/admin/desktop.php"));
        else exit(header("location: ../index.php"));
    }
    else{
        $select_query->close();
        $server_connection->close();
        exit(header("location: ../PHP/login.php?error=Incorrect password"));
    }
}
else{
    exit(header("location: ../PHP/login.php?error=Incorrect email"));
}
$select_query->close();
$server_connection->close();
exit;