<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../CSS/style.css">
        <link rel="stylesheet" href="../CSS/style3.css">
        <title>Sign In - Arctic Airlines</title>
        <script type="text/javascript" src="../JS/scripts.js"></script>
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
        <div class="idk">
            <div class="line"></div>
            <div class="info">
                <label>First name</label><br>
                <p><?php echo $_GET['fname'] ?></p><br>
                <label>Last name</label><br>
                <p><?php echo $_GET['lname'] ?></p><br>
                <label>Country</label><br>
                <img class="flag" src="../art/flags/<?php echo strtolower($_GET['country']) ?>.png" alt="flag">
                <p class="country"><?php echo $_GET['country'] ?></p>
            </div>
            <form class="idk_form" action="user_add.php" method='GET' enctype='multipart/form-data'>
                <label>Email:</label><br>
                <input class="input" type="email" name="email" placeholder="enter your email" required>
                <br><label>Username:</label><br>
                <input class="input" type="text" name="username" placeholder="enter your username" required>
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
                    "Faroe" => "+298",
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
                <br><label>Phone Number:</label><br>
                <input class="input" type="tel" name="phone" placeholder="phone number" value="<?php echo $phone[$_GET['country']] ?>" minlength="8" maxlength="16" required>
                <br><label>Password:</label><br>
                <input class="input" type="password" id="pass" name="password" minlength="8" placeholder="enter your password" required>
                <input name="pass" type="checkbox" onclick="show_password()">
                <img class="eye" src="../art/eye.png" alt="see passsword">
                <div class="check">
                    <br><input type="checkbox" id="fat" name="is_fat" value="true">
                    <small for="fat">Morbidly obese (requires 2 seats)</small>
                </div>
                <input hidden type="text" name="fname" value="<?php echo $_GET['fname'] ?>">
                <input hidden type="text" name="lname" value="<?php echo $_GET['lname'] ?>">
                <input hidden type="text" name="country" value="<?php echo $_GET['country'] ?>">
                <br><input class="button" type="submit" value="Create Account">
            </form>
        </div>
        <a href="../HTML/signin.html"><button class="button2">Go back</button></a>
        <?php
        if(isset($_GET['error'])){
            echo "<div class='error'>";
            echo "<p>".$_GET['error']."</p>";
            echo "</div>";
        }
        else{
            echo "<div class='create'>";
            echo "<p>Create a new account</p>";
            echo "</div>";
        }
        ?>
    </body>
</html>