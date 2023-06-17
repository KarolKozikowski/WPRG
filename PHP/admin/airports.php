<?php
include("./check.php");
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../../CSS/style.css">
        <link rel="stylesheet" href="../../CSS/style8.css">
        <script type="text/javascript" src="../../JS/scripts.js"></script>
        <title>Admin - Airports - Arctic Airlines</title>
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
            <h1>Airports</h1>
            <table>
                <tr>
                    <th>ID</th>
                    <th>ICAO</th>
                    <th>IATA</th>
                    <th>Municipality</th>
                    <th>Airport Name</th>
                    <th>Country</th>
                    <th>Actions</th>
                </tr>
                <?php
                include("../connect.php");
                $select_query = $server_connection->query("SELECT * FROM airports");
                while($row = $select_query->fetch_assoc()){
                    echo"<tr>";
                    echo"<td class='id'>".$row['ID']."</td>";
                    echo"<td>".$row['ICAO']."</td>";
                    echo"<td>".$row['IATA']."</td>";
                    echo"<td>".$row['Municipality']."</td>";
                    echo"<td>".$row['Name']."</td>";
                    echo"<td class='flag3'>".$row['Country']." <img src='../../art/flags/".strtolower($row['Country']).".png'></td>";
                    echo"<td><a href='./airports_mod.php?mod=2&id=".$row['ID']."'><img class='edit' src='../../art/edit.png'></a><a href='./airports_mod.php?mod=1&id=".$row['ID']."'><img class='trash' src='../../art/trash.png'></a></td>";
                    echo"</tr>";
                }
                $select_query->close();
                $server_connection->close();
                ?>
            </table>
            <a href="./airports_mod.php?mod=3"><button class="add">Add new</button></a>
            <a href="./desktop.php"><button class="button">Return</button></a>
        </div>
    </body>
</html>