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
        <title>Admin - Flights - Arctic Airlines</title>
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
            <h1>Flights</h1>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Flight Nr</th>
                    <th>Departure Date</th>
                    <th>Departure Time</th>
                    <th>Aircraft</th>
                    <th>Actions</th>
                </tr>
                <?php
                include("../connect.php");
                $select_query = $server_connection->query("SELECT flights.ID AS fl_id, flights.Route_id, flights.Dep_date AS dep_date, flights.Dep_time AS dep_time, flights.Aircraft_id,
                routes.ID, routes.Flight_nr AS flight_nr, 
                aircraft.ID, aircraft.REG AS REG FROM flights JOIN routes ON flights.Route_ID = routes.ID JOIN aircraft ON flights.Aircraft_id = aircraft.ID ORDER BY flights.ID");
                while($row = $select_query->fetch_assoc()){
                    echo"<tr>";
                    echo"<td class='id'>".$row['fl_id']."</td>";
                    echo"<td>".$row['flight_nr']."</td>";
                    echo"<td>".$row['dep_date']."</td>";
                    echo"<td>".$row['dep_time']."</td>";
                    echo"<td>".$row['REG']."</td>";
                    echo"<td><a href='./flights_mod.php?mod=2&id=".$row['fl_id']."'><img class='edit' src='../../art/edit.png'></a><a href='./flights_mod.php?mod=1&id=".$row['fl_id']."'><img class='trash' src='../../art/trash.png'></a></td>";
                    echo"</tr>";
                }
                $select_query->close();
                $server_connection->close();
                ?>
            </table>
            <a href="./flights_mod.php?mod=3"><button class="add">Add new</button></a>
            <a href="./desktop.php"><button class="button">Return</button></a>
        </div>
    </body>
</html>