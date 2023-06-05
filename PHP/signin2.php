<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../CSS/style.css">
        <title>Sign In - Arctic Airlines</title>
    </head>
    <body>
        <header>
            <img class="logo" src="../art/logo.png">
            <nav>
                <ul class="nav_links">
                    <li><a href="../index.html">Home Page</a></li>
                    <li><a href="../index.html">Already have an account?</a></li>
                </ul>
            </nav>
        </header>
        <div>
            <h1>More info:</h1>
            <form method='GET' enctype='multipart/form-data'>
                <label>Phone Number:</label>
                <input type="tel" name="phone" placeholder="123-456-789" pattern="[0-9]{3}-[0-9]{3}-[0-9]{3}" required>
            </form>
        </div>
    </body>
</html>