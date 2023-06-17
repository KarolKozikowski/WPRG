<?php
include("../connect.php");
function TSA($your_stuff){
    $your_stuff = trim($your_stuff);
    $your_stuff = stripslashes($your_stuff);
    $your_stuff = htmlspecialchars($your_stuff);
    return $your_stuff;
}
if(isset($_GET['mod'])){
    if($_GET['mod']==1 && isset($_GET['id'])){
        $airport_id=$_GET['id'];
        $delete_query = $server_connection->query("DELETE FROM airports WHERE ID=$airport_id");
        $server_connection->close();
        exit(header("location: ./airports.php"));
    }
    elseif($_GET['mod']==2 && isset($_GET['id'])){
        $airport_id=$_GET['id'];
        ?>
        <!DOCTYPE html>
        <html>
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <link rel="stylesheet" href="../../CSS/style.css">
                <link rel="stylesheet" href="../../CSS/style8.css">
                <script type="text/javascript" src="../../JS/scripts.js"></script>
                <title>Admin - Airports_edit - Arctic Airlines</title>
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
                    <h1>Edit airport ID: <?php echo $airport_id ?></h1>
                    <form method='POST' enctype='multipart/form-data'>
                        <table>
                            <tr>
                                <th>ID</th>
                                <th>ICAO</th>
                                <th>IATA</th>
                                <th>Municipality</th>
                                <th>Airport Name</th>
                                <th>Country</th>
                            </tr>
                            <tr>
                                <?php
                                $select_query = $server_connection->query("SELECT * FROM airports WHERE ID=$airport_id");
                                while($row = $select_query->fetch_assoc()){
                                    echo"<td class='id'>".$row['ID']."</td>";
                                    echo"<td><input type='text' name='ICAO' value='".$row['ICAO']."' required></td>";
                                    echo"<td><input type='text' name='IATA' value='".$row['IATA']."' required></td>";
                                    echo"<td><input type='text' name='Municipality' value='".$row['Municipality']."' required></td>";
                                    echo"<td><input type='text' name='Name' value='".$row['Name']."' required></td>";
                                    echo"<td><input type='text' name='Country' value='".$row['Country']."' required></td>";
                                }
                                $select_query->close();
                                ?>
                            </tr>
                        </table>
                        <input class="save" type="submit" value="Save">
                    </form>
                    <?php
                    if(isset($_POST['ICAO'])&&isset($_POST['IATA'])&&isset($_POST['Municipality'])&&isset($_POST['Name'])&&isset($_POST['Country'])){
                        $ICAO = TSA($_POST['ICAO']);
                        $IATA = TSA($_POST['IATA']);
                        $Municipality = TSA($_POST['Municipality']);
                        $Name = TSA($_POST['Name']);
                        $Country = TSA($_POST['Country']);
                        $update_query = $server_connection->prepare("UPDATE airports SET ICAO=?, IATA=?, Municipality=?, Name=?, Country=? WHERE airports.ID = $airport_id");
                        $update_query->bind_param("sssss", $ICAO, $IATA, $Municipality, $Name, $Country);
                        $update_query->execute();
                        $update_query->close();
                        $server_connection->close();
                        echo("<meta http-equiv='refresh' content=\"0; url='./airports.php'\">");
                    }
                    else{
                        $server_connection->close();
                    }
                    ?>
                    <a href="./airports.php"><button class="button">Return</button></a>
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
                <title>Admin - Airports_add - Arctic Airlines</title>
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
                    <h1>Add a new airport</h1>
                    <a href="./airports.php"><button class="button">Return</button></a>
                    <form method='POST' enctype='multipart/form-data'>
                        <table>
                            <tr>
                                <th>ID</th>
                                <th>ICAO</th>
                                <th>IATA</th>
                                <th>Municipality</th>
                                <th>Airport Name</th>
                                <th>Country</th>
                            </tr>
                            <tr>
                                <?php
                                $ID_query=$server_connection->query("SELECT airports.ID FROM airports ORDER BY ID DESC LIMIT 1");
                                while($row=$ID_query->fetch_assoc()) $airport_id=$row['ID'];
                                $airport_id++;
                                $ID_query->close();
                                ?>
                                <td><?php echo $airport_id ?></td>
                                <td><input type="text" name="ICAO" placeholder="Enter ICAO code" required></td>
                                <td><input type="text" name="IATA" placeholder="Enter IATA code" required></td>
                                <td><input type="text" name="Municipality" placeholder="Enter Municipality" required></td>
                                <td><input type="text" name="Name" placeholder="Enter airport name" required></td>
                                <td><input type="text" name="Country" placeholder="Enter country name" required></td>
                            </tr>
                        </table>
                        <input class="add" type="submit" value="Add new">
                    </form>
                    <?php
                    if(isset($_POST['ICAO'])&&isset($_POST['IATA'])&&isset($_POST['Municipality'])&&isset($_POST['Name'])&&isset($_POST['Country'])){
                        $ICAO = TSA($_POST['ICAO']);
                        $IATA = TSA($_POST['IATA']);
                        $Municipality = TSA($_POST['Municipality']);
                        $Name = TSA($_POST['Name']);
                        $Country = TSA($_POST['Country']);
                        $insert_query = $server_connection->prepare("INSERT INTO airports (ID, ICAO, IATA, Municipality, Name, Country) VALUES (?, ?, ?, ?, ?, ?)");
                        $insert_query->bind_param("isssss", $airport_id, $ICAO, $IATA, $Municipality, $Name, $Country);
                        $insert_query->execute();
                        $insert_query->close();
                        $server_connection->close();
                        echo("<meta http-equiv='refresh' content=\"0; url='./airports.php'\">");
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