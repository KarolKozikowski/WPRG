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
            <p>Are you sure you want to permanently delete your account?</p>
            <div class="usure">
                <a href="./settings.php"><button class="button3">No</button></a>
                <a href="./user_delete2.php"><button class="button4">Yes</button></a>
            </div>
        </div>
        <div class="error">
            <p>Delete Account?</p>
        </div>
    </body>
</html>