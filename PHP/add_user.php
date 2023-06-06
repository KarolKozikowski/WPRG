<?php
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
if(isset($_GET['password'])) $password = TSA($_GET['password']);
else $password=null;
//connecting to server
$server_connection = new mysqli("localhost", "root", "", "arctic_airlines");
if(!$server_connection){
    header("location: ../index.html?serwer sie zesral");
    exit();
}
$max_id=$server_connection->query("SELECT users.ID FROM users ORDER BY ID DESC LIMIT 1");
while($row=$max_id->fetch_assoc()) $user_id = $row['ID']+1;
$insert_query=$server_connection->prepare("INSERT INTO users (ID, First_name, Last_name, Phone_nr, Email, Country, Is_Fat, username, user_password) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
$insert_query->bind_param("isssssiss", $user_id, $fname, $lname, $phone, $email, $country, $is_fat, $username, $password);
$insert_query->execute();
header("location: ../index.html");
exit();
?>