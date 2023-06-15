<?php
include("./check.php");
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../../CSS/style.css">
        <link rel="stylesheet" href="../../CSS/style8.css">
        <script type="text/javascript" src="../../JS/scripts.js"></script>
        <title>Admin - Desktop - Arctic Airlines</title>
    </head>
    <body>
        <header>
            <a href="../../index.php" class="logo"><img src="../../art/logo.png"></a>
            <nav>
                <ul class="nav_links">
                    <li><a href="../../index.php">Home Page</a></li>
                </ul>
            </nav>
        </header>
        <div class="box">
            <h1>Database Tables:</h1>
            <div class="users" onclick="window.location='./users.php';">
                <div class="blur">
                    <small>Edit</small>
                </div>
                <p>Users</p>
            </div>
            <div class="routes" onclick="window.location='./routes.php';">
                <div class="blur">
                    <small>Edit</small>
                </div>
                <p>Routes</p>
            </div>
            <div class="flights">
                <div class="blur">
                    <small>Edit</small>
                </div>
                <p>Flights</p>
            </div>
            <div class="airports">
                <div class="blur">
                    <small>Edit</small>
                </div>
                <p>Airports</p>
            </div>
            <div class="aircraft">
                <div class="blur">
                    <small>Edit</small>
                </div>
                <p>Aircraft</p>
            </div>
        </div>
    </body>
</html>