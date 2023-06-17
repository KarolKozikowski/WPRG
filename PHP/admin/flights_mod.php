<?php
include("../connect.php");
if(isset($_GET['mod'])){
    if($_GET['mod']==1 && isset($_GET['id'])){
        $flight_id=$_GET['id'];
        $delete_query = $server_connection->query("DELETE FROM flights WHERE ID=$flight_id");
        $server_connection->close();
        exit(header("location: ./flights.php"));
    }
    elseif($_GET['mod']==2 && isset($_GET['id'])){
        $flight_id=$_GET['id'];
        ?>
        <!DOCTYPE html>
        <html>
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <link rel="stylesheet" href="../../CSS/style.css">
                <link rel="stylesheet" href="../../CSS/style8.css">
                <script type="text/javascript" src="../../JS/scripts.js"></script>
                <title>Admin - Flights_edit - Arctic Airlines</title>
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
                    <h1>Edit flight ID: <?php echo $flight_id ?></h1>
                    <form method='POST' enctype='multipart/form-data'>
                        <table>
                            <tr>
                                <th>ID</th>
                                <th>Flight Nr</th>
                                <th>Departure Date</th>
                                <th>Departure Time</th>
                                <th>Aircraft</th>
                            </tr>
                            <tr>
                                <?php
                                $select_query = $server_connection->query("SELECT flights.ID AS fl_id, flights.Route_id AS route_id, flights.Dep_date AS dep_date, flights.Dep_time AS dep_time, flights.Aircraft_id AS airc_id,
                                routes.ID, routes.Flight_nr AS flight_nr, 
                                aircraft.ID, aircraft.REG AS REG FROM flights JOIN routes ON flights.Route_ID = routes.ID JOIN aircraft ON flights.Aircraft_id = aircraft.ID WHERE flights.ID=$flight_id");
                                while($row = $select_query->fetch_assoc()){
                                    echo"<td class='id'>".$row['fl_id']."</td>";
                                    $select2_query = $server_connection->query("SELECT routes.ID, routes.Flight_nr FROM routes");
                                    echo"<td><select name='route_id' required>";
                                    while($row2 = $select2_query->fetch_assoc()){
                                        if($row2['ID']==$row['route_id']) echo"<option value='".$row2['ID']."' selected>".$row2['Flight_nr']."</option>";
                                        else echo"<option value='".$row2['ID']."'>".$row2['Flight_nr']."</option>";
                                    }
                                    echo"</select></td>";
                                    $select2_query->close();
                                    echo"<td><input type='date' name='dep_date' value='".$row['dep_date']."'required></td>";
                                    echo"<td><input type='time' name='dep_time' value='".$row['dep_time']."'required></td>";
                                    $select3_query = $server_connection->query("SELECT aircraft.ID, aircraft.REG from aircraft");
                                    echo"<td><select name='airc_id' required>";
                                    while($row3=$select3_query->fetch_assoc()){
                                        if($row3['ID']==$row['airc_id']) echo"<option value='".$row3['ID']."' selected>".$row3['REG']."</option>";
                                        else echo"<option value='".$row3['ID']."'>".$row3['REG']."</option>";
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
                    if(isset($_POST['route_id'])&&isset($_POST['dep_date'])&&isset($_POST['dep_time'])&&isset($_POST['airc_id'])){
                        $route_id=$_POST['route_id'];
                        $dep_date=$_POST['dep_date'];
                        $dep_time=$_POST['dep_time'];
                        $airc_id=$_POST['airc_id'];
                        $update_query = $server_connection->query("UPDATE flights SET Route_id=$route_id, Dep_date='$dep_date', Dep_time='$dep_time' , Aircraft_id=$airc_id WHERE flights.ID=$flight_id");
                        $server_connection->close();
                        echo("<meta http-equiv='refresh' content=\"0; url='./flights.php'\">");
                    }
                    else{
                        $server_connection->close();
                    }
                    ?>
                    <a href="./flights.php"><button class="button">Return</button></a>
                </div>
            </body>
        </html>
        <?php
    }
    elseif($_GET['mod']==3){
        ?>
        <!DOCTYPE html>
        <html>
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <link rel="stylesheet" href="../../CSS/style.css">
                <link rel="stylesheet" href="../../CSS/style8.css">
                <script type="text/javascript" src="../../JS/scripts.js"></script>
                <title>Admin - Flight_add - Arctic Airlines</title>
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
                    <h1>Add a new flight</h1>
                    <a href="./flights.php"><button class="button">Return</button></a>
                    <form method='POST' enctype='multipart/form-data'>
                        <table>
                            <tr>
                                <th>ID</th>
                                <th>Flight Nr</th>
                                <th>Departure Date</th>
                                <th>Departure Time</th>
                                <th>Aircraft</th>
                            </tr>
                            <tr>
                                <?php
                                $ID_query=$server_connection->query("SELECT flights.ID FROM flights ORDER BY ID DESC LIMIT 1");
                                while($row=$ID_query->fetch_assoc()) $flight_id=$row['ID'];
                                $flight_id++;
                                $ID_query->close();
                                ?>
                                <td><?php echo $flight_id ?></td>
                                <td><select name="route_id" required>
                                    <option value="" selected disabled hidden>Choose route here</option>
                                    <?php
                                    $select_query = $server_connection->query("SELECT routes.ID, routes.Flight_nr FROM routes");
                                    while($row2=$select_query->fetch_assoc()){
                                        echo"<option value='".$row2['ID']."'>".$row2['Flight_nr']."</option>";
                                    }
                                    $select_query->close();
                                    ?>
                                </select></td>
                                <td><input type="date" name="dep_date" required></td>
                                <td><input type="time" name="dep_time" required></td>
                                <td><select name="airc_id" required>
                                    <option value="" selected disabled hidden>Choose aircraft here</option>
                                    <?php
                                    $select2_query = $server_connection->query("SELECT aircraft.ID, aircraft.REG FROM aircraft");
                                    while($row3=$select2_query->fetch_assoc()){
                                        echo"<option value='".$row3['ID']."'>".$row3['REG']."</option>";
                                    }
                                    ?>
                                </select></td>
                            </tr>
                        </table>
                        <input class="add" type="submit" value="Add new">
                    </form>
                    <?php
                    if(isset($_POST['route_id'])&&isset($_POST['dep_date'])&&isset($_POST['dep_time'])&&isset($_POST['airc_id'])){
                        $route_id=$_POST['route_id'];
                        $dep_date=$_POST['dep_date'];
                        $dep_time=$_POST['dep_time'];
                        $airc_id=$_POST['airc_id'];
                        $insert_query = $server_connection->query("INSERT INTO flights (ID, Route_id, Dep_date, Dep_time, Aircraft_id) VALUES ($flight_id, $route_id, '$dep_date', '$dep_time', $airc_id)");
                        $server_connection->close();
                        echo("<meta http-equiv='refresh' content=\"0; url='./flights.php'\">");
                    }
                    else{
                        $server_connection->close();
                    }
                    ?>
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