<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../CSS/style.css">
        <title>Log in - Arctic Airlines</title>
    </head>
    <body>
        <header>
            <img class="logo" src="../art/logo.png">
            <nav>
                <ul class="nav_links">
                    <li><a href="../index.php">Home Page</a></li>
                    <li><a href="../HTML/signin.html">No account? Create one!</a></li>
                </ul>
            </nav>
        </header>
        <div>
            <form action="../PHP/login2.php" method="GET" enctype="multipart/form-data">
                <label>Email:</label><br>
                <input type="text" name="email" placeholder="Enter your email" required><br>
                <label>Password:</label><br>
                <input type="password" name="password" placeholder="Enter your password" required><br>
                <small>Remember me</small><input type="checkbox" name="remember" value="1"><br>
                <input type="submit" value="Log in">
            </form>
        </div>
    </body>
</html>