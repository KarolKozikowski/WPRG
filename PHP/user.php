<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../CSS/style.css">
        <title><?php echo $_SESSION["user_name"] ?> - Arctic Airlines</title>
    </head>
    <body>
        <header>
            <img class="logo" src="../art/logo.png">
            <nav>
                <ul class="nav_links">
                    <li><a href="../index.php">Home Page</a></li>
                    <li><a href="../index.php">Bookings</a></li>
                </ul>
            </nav>
        </header>
        <a href='user_edit.php?oper=1'><button class='login_button'>Sign out</button></a>
    </body>
</html>