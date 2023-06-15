<?php
session_start();
include("connect.php");
$user_id=$_SESSION['user_id'];
$info=$server_connection->query("SELECT * FROM users WHERE ID=$user_id");
while($row=$info->fetch_assoc()){
    $fname = $row['First_name'];
    $lname = $row['Last_name'];
    $username = $row['username'];
    $phone = $row['Phone_nr'];
    $email = $row['Email'];
    $country = $row['Country'];
    $is_fat = $row['Is_Fat'];
    $password_hashed = $row['user_password'];
}
$info->close();
$server_connection->close();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../CSS/style.css">
        <link rel="stylesheet" href="../CSS/style6.css">
        <script type="text/javascript" src="../JS/scripts.js"></script>
        <title><?php echo $fname ?> (settings) - Arctic Airlines</title>
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
            <label class="you">Your information: </label>
            <div class="names">
                <h3><?php echo $fname." ".$lname.", ".$username ?></h3>
                <p><?php echo $phone."<br>".$email.", " ?></p>
                <h4><?php echo $country ?></h4>
                <img src="../art/flags/<?php echo strtolower($country) ?>.png">
                <a href="./edit_info.php?settings=true"><button class="button">Edit information</button></a>
            </div>
            <form class="fat" action="../PHP/user_edit.php?oper=3" method='POST'>
                <input type="checkbox" name="is_fat" value="true" <?php if($is_fat==1) echo "checked" ?> onchange="this.form.submit()">
                <small>Morbidly obese (requires 2 seats)</small>
            </form>
            <label class="change">Change password</label>
            <form class="idk_form" action="../PHP/user_edit.php?oper=4" method='POST' enctype='multipart/form-data'>
                <input class="input" type="password" id="pass" name="password" minlength="8" placeholder="Enter current password" required>
                <input name="pass" class="box" type="checkbox" onclick="show_password()">
                <img class="eye" src="../art/eye.png" alt="see passsword">
                <br><input class="input" type="password" id="pass2" name="password2" minlength="8" placeholder="Enter new password" required>
                <input name="pass2" class="box" type="checkbox" onclick="show_password2()">
                <img class="eye" src="../art/eye.png" alt="see passsword">
                <br><input type="submit" class="button3" value="save">
            </form>
            <?php if(isset($_GET['error'])) echo "<h3 class='error'>".$_GET['error']."!</h3>" ?>
            <?php if(isset($_GET['saved'])) echo "<h3 class='saved'>Saved!</h3>" ?>
        </div>
        <a href="./user.php"><button class="button2">Return</button></a>
        <a href="./user_delete.php"><button class="button4">Delete account</button></a>
        <div class="create">
            <p>Account settings</p>
        </div>
    </body>
</html>