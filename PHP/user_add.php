<?php
session_start();
function TSA($your_stuff){
    $your_stuff = trim($your_stuff);
    $your_stuff = stripslashes($your_stuff);
    $your_stuff = htmlspecialchars($your_stuff);
    return $your_stuff;
}

//TSA makes sure no unauthorized html lines go through :)
if(isset($_GET['fname'])) $fname = TSA($_GET['fname']);
else $fname=null;
if(isset($_GET['lname'])) $lname = TSA($_GET['lname']);
else $lname=null;
if(isset($_GET['country'])) $country = TSA($_GET['country']);
else $country=null;
if(isset($_GET['email'])) $email = TSA($_GET['email']);
else $email=null;
if(isset($_GET['phone'])) $phone = TSA($_GET['phone']);
else $phone=null;
if(isset($_GET['is_fat'])) $is_fat = 1;
else $is_fat=0;
if(isset($_GET['username'])) $username = TSA($_GET['username']);
else $username=null;
if(isset($_GET['password'])){
    $password = TSA($_GET['password']);
    $password_hashed = password_hash($password, PASSWORD_DEFAULT);
}
else $password=null;

//connecting to server
$server_connection = new mysqli("localhost", "root", "", "arctic_airlines");
if(!$server_connection){
    header("location: ../index.php?serwer sie zesral");
    exit;
}

//chcecking if email already exists
$search_query=$server_connection->prepare("SELECT users.ID FROM users WHERE Email=?");
$search_query->bind_param("s", $email);
$search_query->execute();
$search_query_result = $search_query->get_result();
if($search_query_result->num_rows > 0){
    header("location: ../PHP/signin.php?fname=$fname&lname=$lname&country=$country&error=Email taken");
    $search_query->close();
    $server_connection->close();
    exit;
}
$search_query->close();

//calculating user id cause DB doesn't have auto increment
$max_id=$server_connection->query("SELECT users.ID FROM users ORDER BY ID DESC LIMIT 1");
while($row=$max_id->fetch_assoc()) $user_id = $row['ID']+1;
$max_id->close();

//inserting user info into DB and go home
$insert_query=$server_connection->prepare("INSERT INTO users (ID, First_name, Last_name, Phone_nr, Email, Country, Is_Fat, username, user_password) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
$insert_query->bind_param("isssssiss", $user_id, $fname, $lname, $phone, $email, $country, $is_fat, $username, $password_hashed);
$insert_query->execute();
$_SESSION["user_id"]=$user_id;
$_SESSION["user_name"]=$user_name;
header("location: ../index.php");
$insert_query->close();
$server_connection->close();
exit;
?>