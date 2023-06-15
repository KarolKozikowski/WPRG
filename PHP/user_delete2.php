<?php
session_start();
$user_id=$_SESSION['user_id'];
$user_name=$_SESSION['user_name'];
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../CSS/style.css">
        <link rel="stylesheet" href="../CSS/style7.css">
        <script type="text/javascript" src="../JS/scripts.js"></script>
        <title><?php echo $user_name ?> (Delete account) - Arctic Airlines</title>
    </head>
    <body>
        <header>
            <a href="../index.php" class="logo"><img src="../art/logo.png"></a>
            <nav>
                <ul class="nav_links">
                    <li><a href="../index.php">Home Page</a></li>
                    <li><a href="./user.php">Desktop</a></li>
                </ul>
            </nav>
        </header>
        <div class="idk">
            <?php if(isset($_GET['error'])) echo "<p>Enter the CORRECT password to permanently delete your account</p>"; else echo "<p>Enter password to permanently delete your account</p>";?>
            <form class="delete_form" action="user_delete3.php" method="POST" enctype="multipart/form-data">
                <label>Enter password</label><br>
                <input class="input" type="password" id="pass" name="password" placeholder="Enter your password" required>
                <input name="pass" type="checkbox" onclick="show_password()">
                <img class="eye" src="../art/eye.png" alt="see passsword"><br>
                <input type="submit" value="Delete account">
            </form>
        </div>
        <a href="./settings.php"><button class="button2">Cancel</button></a>
        <div class="error">
            <p>Delete Account?</p>
        </div>
    </body>
</html>