<?php
session_start();
if(isset($_COOKIE["user_id"]) && isset($_COOKIE["user_name"])){
    $_SESSION["user_id"]=$_COOKIE["user_id"];
    $_SESSION["user_name"]=$_COOKIE["user_name"];
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="CSS/style.css">
        <title>Arctic Airlines</title>
    </head>
    <body>
        <header>
            <img class="logo" src="art/logo.png">
            <nav>
                <ul class="nav_links">
                    <li><a href="./PHP/connections.php">Connections</a></li>
                    <li><a href="./PHP/book.php">Book Flight</a></li>
                    <li><a href="#">About</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
            </nav>
            <?php
            if(isset($_SESSION["user_name"])) echo "<a href='PHP/user.php'><button class='login_button'>".$_SESSION["user_name"]."</button></a>";
            else echo "<a href='PHP/login.php'><button class='login_button'>Sign in</button></a>";
            if(isset($_SESSION['user_id']) && $_SESSION['user_id']==1) echo "<a href='PHP/admin/desktop.php'><button class='admin_button'>Admin</button></a>";
            ?>
        </header>
        <section class="main_sectoin">
            <h1>Arctic Airlines</h1>
            <p>Your gateway to The North</p>
            <?php
            if(isset($_SESSION["user_name"])) echo "<a href='./PHP/connections.php' class='main_button'>Let's fly!</a>";
            else echo"<a href='HTML/signin.html' class='main_button'>Get Started</a>"; 
            if(isset($_GET['error'])) echo"<h2 class='error10'>".$_GET['error']."</h2>";
            ?>
        </section>
        <footer>
            <p>&copy; 2023 Karol Kozikowski. Not all rights reserved.</p>
        </footer>
    </body>
</html>