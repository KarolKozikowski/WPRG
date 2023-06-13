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
        <title><?php echo $fname ?> (Edit) - Arctic Airlines</title>
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
            <form class="idk_form" action="../PHP/user_edit.php?oper=2" method='POST' enctype='multipart/form-data'>
                <label>First name:</label>
                <input class="input" type="text" name="fname" value="<?php echo $fname ?>" placeholder="Enter your first name:" required>
                <br><label>Last name:</label>
                <input class="input" type="text" name="lname" value="<?php echo $lname ?>" placeholder="Enter your last name:" required>
                <br><label>Username:</label>
                <input class="input" type="text" name="username" value="<?php echo $username ?>" placeholder="Enter your username" required>
                <br><label>Country:</label>
                <select class="input" name="country" required>
                    <option <?php if($country=="Finland") echo "selected"; ?> value="Finland">Suomi (Finland)</option>
                    <option <?php if($country=="Norway") echo "selected"; ?> value="Norway">Norge (Norway)</option>
                    <option <?php if($country=="Sweden") echo "selected"; ?> value="Sweden">Sverige (Sweden)</option>
                    <option <?php if($country=="Denmark") echo "selected"; ?> value="Denmark">Danmark (Denmark)</option>
                    <option <?php if($country=="Estonia") echo "selected"; ?> value="Estonia">Eesti (Estonia)</option>
                    <option <?php if($country=="Poland") echo "selected"; ?> value="Poland">Polska (Poland)</option>
                    <option <?php if($country=="Germany") echo "selected"; ?> value="Germany">Deutschland (Germany)</option>
                    <option <?php if($country=="Netherlands") echo "selected"; ?> value="Netherlands">Nederland (Netherlands)</option>
                    <option <?php if($country=="France") echo "selected"; ?> value="France">France</option>
                    <option <?php if($country=="Italy") echo "selected"; ?> value="Italy">Italia (Italy)</option>
                    <option <?php if($country=="Switzerland") echo "selected"; ?> value="Switzerland">Schweiz (Switzerland)</option>
                    <option <?php if($country=="Faroe") echo "selected"; ?> value="Faroe">Forroyar (Faroe Islands)</option>
                    <option <?php if($country=="Iceland") echo "selected"; ?> value="Iceland">Ísland (Iceland)</option>
                    <option <?php if($country=="Greenland") echo "selected"; ?> value="Greenland">Kalaallit Nunaat (Greenland)</option>
                    <option <?php if($country=="UK") echo "selected"; ?> value="UK">United Kingdom</option>
                    <option <?php if($country=="US") echo "selected"; ?> value="US">United States</option>
                    <option <?php if($country=="Canada") echo "selected"; ?> value="Canada">Canada</option>
                    <option <?php if($country=="Australia") echo "selected"; ?> value="Australia">Australia</option>
                    <option <?php if($country=="Japan") echo "selected"; ?> value="Japan">日本 (Japan)</option>
                    <option <?php if($country=="Other") echo "selected"; ?> value="Other">--OTHER--</option>
                </select>
                <br><label>Email:</label>
                <input class="input" type="email" name="email" value="<?php echo $email ?>" placeholder="Enter your email" required>
                <br><label>Phone Number:</label>
                <input class="input" type="tel" name="phone" value="<?php echo $phone ?>" placeholder="Enter your phone number" minlength="8" maxlength="16" required>
                <br><input class="button" type="submit" value="Save">
            </form>
        </div>
        <a href="./user.php"><button class="button2">Cancel</button></a>
        <div class="create">
            <p>Edit your information</p>
        </div>
    </body>
</html>