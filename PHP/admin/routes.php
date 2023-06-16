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
        <title>Admin - Routes - Arctic Airlines</title>
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
            <h1>Routes</h1>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Flight Number</th>
                    <th>Enroute Time[min]</th>
                    <th>Departure</th>
                    <th>Arrival</th>
                    <th>Actions</th>
                </tr>
                <?php
                include("../connect.php");
                $select_query = $server_connection->query("SELECT routes.ID AS r_id, routes.Flight_nr, routes.Enroute_time, routes.Departure_id, routes.Arrival_id,
                a.ID, b.ID, a.ICAO AS dep_icao, b.ICAO AS arr_icao, a.IATA AS dep_iata, b.IATA AS arr_iata, a.Municipality AS dep_city, b.Municipality AS arr_city,
                a.Country AS dep_country, b.Country AS arr_country FROM routes
                JOIN airports AS a ON routes.Departure_id = a.ID
                JOIN airports AS b ON routes.Arrival_id = b.ID");
                while($row = $select_query->fetch_assoc()){
                    echo"<tr>";
                    echo"<td class='id'>".$row['r_id']."</td>";
                    echo"<td>".$row['Flight_nr']."</td>";
                    echo"<td>".$row['Enroute_time']."</td>";
                    echo"<td class='flag'><img src='../../art/flags/".strtolower($row['dep_country']).".png'>(".$row['dep_city'].")__".$row['dep_icao']." / ".$row['dep_iata']."_</td>";
                    echo"<td class='flag2'><img src='../../art/flags/".strtolower($row['arr_country']).".png'>(".$row['arr_city'].")__".$row['arr_icao']." / ".$row['arr_iata']."_</td>";
                    echo"<td><a href='./routes_mod.php?mod=2&id=".$row['r_id']."'><img class='edit' src='../../art/edit.png'></a><a href='./routes_mod.php?mod=1&id=".$row['r_id']."'><img class='trash' src='../../art/trash.png'></a></td>";
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