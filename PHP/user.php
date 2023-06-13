<?php
session_start();
include("connect.php");
$user_id=$_SESSION['user_id'];
$info=$server_connection->query("SELECT * FROM users WHERE ID=$user_id");
while($row=$info->fetch_assoc()){
    $fname = $row['First_name'];
    $lname = $row['Last_name'];
    $username = $row['username'];
    $phone = $row['Phone_nr'];
    $email = $row['Email'];
    $country = $row['Country'];
}
$info->close();
$server_connection->close();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../CSS/style.css">
        <link rel="stylesheet" href="../CSS/style5.css">
        <title><?php echo $_SESSION["user_name"] ?> - Arctic Airlines</title>
    </head>
    <body>
        <header>
            <a href="../index.php" class="logo"><img src="../art/logo.png"></a>
            <nav>
                <ul class="nav_links">
                    <li><a href="../index.php">Home Page</a></li>
                    <li><a href="../index.php">Bookings</a></li>
                    <a href="#"><img src="../art/settings.png" class="settings"></a>
                    <a href='user_edit.php?oper=1'><button class='login_button'>Sign out</button></a>
                </ul>
            </nav>
        </header>
        <h1 class="create"><?php echo "Welcome, ".$fname."!"?></h1>
        <div class="idk">
            <label class="label1">Booked Flights</label>
            <div class="table">
                <p>You don't have any booked flights</p>
                <a href='#'><button class='button'>Book Flight</button></a>
            </div>
            <label class="label2">Your Information</label>
            <div class="table2">
                <table>
                    <tr>
                        <th>Full name</th>
                        <td><?php echo $fname." ".$lname  ?></td>
                    </tr>
                    <tr>
                        <th>Username</th>
                        <td><?php echo $username ?></td>
                    </tr>
                    <tr>
                        <th>Country</th>
                        <td><?php echo $country ?></td>
                    </tr>
                    <tr>
                        <th>Phone nr</th>
                        <td><?php echo $phone ?></td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td><?php echo $email ?></td>
                    </tr>
                </table>
                <a href='./edit_info.php'><button class='button2'>Edit</button></a>
            </div>
        </div>
    </body>
</html>