<?php
include("../connect.php");
function TSA($your_stuff){
    $your_stuff = trim($your_stuff);
    $your_stuff = stripslashes($your_stuff);
    $your_stuff = htmlspecialchars($your_stuff);
    return $your_stuff;
}
if(isset($_GET['mod'])&&isset($_GET['id'])){
    $route_id=$_GET['id'];
    if($_GET['mod']==1){
        $delete_query = $server_connection->query("DELETE FROM routes WHERE ID=$route_id");
        $server_connection->close();
        exit(header("location: ./routes.php"));
    }
    elseif($_GET['mod']==2){
        ?>
        <!DOCTYPE html>
        <html>
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <link rel="stylesheet" href="../../CSS/style.css">
                <link rel="stylesheet" href="../../CSS/style8.css">
                <script type="text/javascript" src="../../JS/scripts.js"></script>
                <title>Admin - Routes_edit - Arctic Airlines</title>
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
                    <h1>Edit flitht ID: <?php echo $route_id ?></h1>
                    <form method='POST' enctype='multipart/form-data'>
                        <table>
                            <tr>
                                <th>ID</th>
                                <th>Flight Number</th>
                                <th>Enroute Time[min]</th>
                                <th>Departure</th>
                                <th>Arrival</th>
                            </tr>
                            <tr>
                                <?php
                                $select_query = $server_connection->query("SELECT routes.ID AS r_id, routes.Flight_nr, routes.Enroute_time, routes.Departure_id, routes.Arrival_id,
                                a.ID AS dep_id, b.ID AS arr_id, a.ICAO AS dep_icao, b.ICAO AS arr_icao, a.IATA AS dep_iata, b.IATA AS arr_iata, a.Municipality AS dep_city, b.Municipality AS arr_city,
                                a.Country AS dep_country, b.Country AS arr_country FROM routes
                                JOIN airports AS a ON routes.Departure_id = a.ID
                                JOIN airports AS b ON routes.Arrival_id = b.ID WHERE routes.ID = $route_id");
                                while($row = $select_query->fetch_assoc()){
                                    echo"<td class='id'>".$row['r_id']."</td>";
                                    echo"<td><input type='text' name='flight_nr' value='".$row['Flight_nr']."' required></td>";
                                    echo"<td><input type='text' name='enroute' value='".$row['Enroute_time']."' required</td>";
                                    $select2_query = $server_connection->query("SELECT airports.ID, airports.ICAO, airports.IATA, airports.Municipality FROM airports");
                                    echo"<td><select name='dep_airp'>";
                                    while($row2 = $select2_query->fetch_assoc()){
                                        if($row2['ID']==$row['dep_id']) echo"<option value='".$row2['ID']."' selected>".$row2['ICAO']." / ".$row2['IATA']." (".$row2['Municipality'].")</option>";
                                        else echo"<option value='".$row2['ID']."'>".$row2['ICAO']." / ".$row2['IATA']." (".$row2['Municipality'].")</option>";
                                    }
                                    echo"</select></td>";
                                    $select2_query->close();
                                    $select3_query = $server_connection->query("SELECT airports.ID, airports.ICAO, airports.IATA, airports.Municipality FROM airports");
                                    echo"<td><select name='arr_airp'>";
                                    while($row3 = $select3_query->fetch_assoc()){
                                        if($row3['ID']==$row['arr_id']) echo"<option value='".$row3['ID']."' selected>".$row3['ICAO']." / ".$row3['IATA']." (".$row3['Municipality'].")</option>";
                                        else echo"<option value='".$row3['ID']."'>".$row3['ICAO']." / ".$row3['IATA']." (".$row3['Municipality'].")</option>";
                                    }
                                    echo"</select></td>";
                                    $select3_query->close();
                                }
                                $select_query->close();
                                ?>
                            </tr>
                        </table>
                        <input class="save" type="submit" value="Save">
                    </form>
                    <?php
                    if(isset($_POST['flight_nr'])&&isset($_POST['enroute'])&&isset($_POST['dep_airp'])&&isset($_POST['arr_airp'])){
                        $flight_nr = TSA($_POST['flight_nr']);
                        $enroute = TSA($_POST['enroute']);
                        $dep_airp = TSA($_POST['dep_airp']);
                        $arr_airp = TSA($_POST['arr_airp']);
                        $update_query = $server_connection->prepare("UPDATE routes SET Flight_nr=?, Enroute_time=?, Departure_id=?, Arrival_id=? WHERE routes.ID = $route_id");
                        $update_query->bind_param("iiii", $flight_nr, $enroute, $dep_airp, $arr_airp);
                        $update_query->execute();
                        $update_query->close();
                        $server_connection->close();
                        echo("<meta http-equiv='refresh' content='0'>");
                    }
                    else{
                        $server_connection->close();
                    }
                    ?>
                    <a href="./routes.php"><button class="button">Return</button></a>
                </div>
            </body>
        </html>
        <?php
    }
    else{
        $server_connection->close();
        exit(header("location: ../../HTML/oopsies.html"));
    }
}
else{
    $server_connection->close();
    exit(header("location: ../../HTML/oopsies.html"));
}
?>