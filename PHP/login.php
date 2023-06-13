<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../CSS/style.css">
        <link rel="stylesheet" href="../CSS/style4.css">
        <script type="text/javascript" src="../JS/scripts.js"></script>
        <title>Log in - Arctic Airlines</title>
    </head>
    <body>
        <header>
            <a href="../index.php" class="logo"><img src="../art/logo.png"></a>
            <nav>
                <ul class="nav_links">
                    <li><a href="../index.php">Home Page</a></li>
                    <li><a href="../HTML/signin.html">No account? Create one!</a></li>
                </ul>
            </nav>
        </header>
        <div class="idk">
            <form class="idk_form" action="../PHP/login2.php" method="GET" enctype="multipart/form-data">
                <label>Email:</label><br>
                <input class="input" type="text" name="email" placeholder="Enter your email" required><br>
                <label>Password:</label><br>
                <input class="input" type="password" id="pass" name="password" placeholder="Enter your password" required>
                <input name="pass" type="checkbox" onclick="show_password()">
                <img class="eye" src="../art/eye.png" alt="see passsword"><br>
                <div class="check"><small for="remember">Remember me</small><input type="checkbox" id="remember" name="remember" value="1"><br></div>
                <input class="button" type="submit" value="Log in">
            </form>
        </div>
        <?php
        if(isset($_GET['error'])){
            echo "<div class='error'>";
            echo "<p>".$_GET['error']."</p>";
            echo "</div>";
        }
        else{
            echo "<div class='create'>";
            echo "<p>Log in</p>";
            echo "</div>";
        }
        ?>
    </body>
</html>