<?php
include("./check.php");
?>
<!DOCTYPE hrml>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../../CSS/style.css">
        <link rel="stylesheet" href="../../CSS/style8.css">
        <script type="text/javascript" src="../../JS/scripts.js"></script>
        <title><?php echo $fname ?> Admin - Users - Arctic Airlines</title>
    </head>
    <body>
        <header>
            <a href="../../index.php" class="logo"><img src="../../art/logo.png"></a>
            <nav>
                <ul class="nav_links">
                    <li><a href="../../index.php">Home Page</a></li>
                    <li><a href="./desktop.php">Admin Desktop</a></li>
                </ul>
            </nav>
        </header>
        <div class="box">
            <h1>Users</h1>
            <table>
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Username</th>
                    <th>Country</th>
                    <th>Phone Number</th>
                    <th>Email</th>
                    <th>Is_Fat?</th>
                    <th>Actions</th>
                </tr>
                <?php
                include("../connect.php");
                $select_query = $server_connection->query("SELECT * FROM users");
                while($row = $select_query->fetch_assoc()){
                    echo"<tr>";
                    echo"<td class='id'>".$row['ID']."</td>";
                    echo"<td>".$row['First_name']."</td>";
                    echo"<td>".$row['Last_name']."</td>";
                    echo"<td>".$row['username']."</td>";
                    echo"<td>".$row['Country']."</td>";
                    echo"<td>".$row['Phone_nr']."</td>";
                    echo"<td>".$row['Email']."</td>";
                    if($row['Is_Fat']==1) echo"<td class='red'>Yes</td>";
                    else echo"<td>No</td>";
                    if($row['ID']==1) echo"<td><img src='../../art/trash.png' class='trash2'></td>";
                    else echo"<td><a href='./users_mod.php?mod=1&id=".$row['ID']."'><img src='../../art/trash.png' class='trash'></a></td>";
                    echo"</tr>";
                }
                $select_query->close();
                $server_connection->close();
                ?>
            </table>
            <a href="./desktop.php"><button class="button">Return</button></a>
        </div>
    </body>
</html>