<?php
session_start();
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

//connecting to server
$server_connection = new mysqli("localhost", "root", "", "arctic_airlines");
if(!$server_connection){
    header("location: ../index.php?serwer sie zesral");
    exit;
}

$select_query=$server_connection->prepare("SELECT users.ID, users.First_name, users.user_password FROM users WHERE Email=?");
$select_query->bind_param("s", $email);
$select_query->execute();
$result=$select_query->get_result();

//check if user exists
if($result->num_rows===1){
    while($row=$result->fetch_assoc()){
        $user_id=$row['ID']; //get user ID
        $user_password=$row['user_password']; //hashed password
        $user_name=$row['First_name']; //get user name
    }
    if(password_verify($password, $user_password)){
        $_SESSION["user_id"]=$user_id;
        $_SESSION["user_name"]=$user_name;
        if(isset($_GET['remember'])){
            setcookie("user_id", $user_id, time()+(86400*14), "/");
            setcookie("user_name", $user_name, time()+(86400*14), "/");
        }
        header("location: ../PHP/user.php"); //temp
        $select_query->close();
        $server_connection->close();
        exit;
    }
    else{
        header("location: ../PHP/login.php?error=Incorrect password");
        $select_query->close();
        $server_connection->close();
        exit;
    }
}
else{
    header("location: ../PHP/login.php?error=Incorrect email");
    exit;
}
$select_query->close();
$server_connection->close();
exit;