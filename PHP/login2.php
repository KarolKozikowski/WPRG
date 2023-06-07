<?php
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
$select_query=$server_connection->prepare("SELECT users.ID FROM users WHERE Email=? AND user_password=?");
$select_query->bind_param("ss", $email, $password);
$select_query->execute();
$result=$select_query->get_result();
//check if user exists
if($result->num_rows===1){
    while($row=$result->fetch_assoc()) $user_id=$row['ID']; //user ID
    // if(isset($_GET['remember'])){
    //     setcookie("user_log_id", )
    // }
    header("location: ../index.php?$user_id"); //temp
    exit;
}
else{
    header("location: ../PHP/login.php?error=Incorrect password or username");
    exit;
}
$select_query->close();
$server_connection->close();
exit;