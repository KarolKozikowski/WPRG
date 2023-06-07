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
                    <li><a href="../index.php">Home Page</a></li>
                    <li><a href="../PHP/login.php">Already have an account?</a></li>
                </ul>
            </nav>
        </header>
        <div>
            <h1>More info:</h1>
            <form action="add_user.php" method='GET' enctype='multipart/form-data'>
                <label>Email:</label>
                <input type="email" name="email" placeholder="enter your email" required>
                <?php
                $phone = array(
                    "Finland" => "+358",
                    "Norway" => "+47",
                    "Sweden" => "+46",
                    "Denmark" => "+45",
                    "Estonia" => "+372",
                    "Poland" => "+48",
                    "Germany" => "+49",
                    "Netherlands" => "+31",
                    "France" => "+33",
                    "Italy" => "39",
                    "Switzerland" => "+41",
                    "FIslands" => "+298",
                    "Iceland" => "+354",
                    "Greenland" => "+299",
                    "UK" => "+44",
                    "US" => "+1",
                    "Canada" => "+1",
                    "Australia" => "+61",
                    "Japan" => "+81",
                    "Other" => "+"
                );
                ?>
                <label>Phone Number:</label>
                <input type="tel" name="phone" placeholder="phone number" value="<?php echo $phone[$_GET['country']] ?>" minlength="8" maxlength="16" required>
                <br><label>Obese:</label>
                <input type="checkbox" name="is_fat" value="true">
                <small>Check this box if you need two seats</small>
                <br><label>Username:</label>
                <input type="text" name="username" placeholder="enter your username" required>
                <br><label>Password:</label>
                <input type="password" name="password" placeholder="enter your password" required>
                <input hidden type="text" name="fname" value="<?php echo $_GET['fname'] ?>">
                <input hidden type="text" name="lname" value="<?php echo $_GET['lname'] ?>">
                <input hidden type="text" name="country" value="<?php echo $_GET['country'] ?>">
                <br><input type="submit" value="Create Account">
            </form>
        </div>
    </body>
</html>