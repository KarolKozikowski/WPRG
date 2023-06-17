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
        $aircraft_id=$_GET['id'];
        $delete_query = $server_connection->query("DELETE FROM aircraft WHERE ID=$aircraft_id");
        $server_connection->close();
        exit(header("location: ./aircraft.php"));
    }
    elseif($_GET['mod']==2 && isset($_GET['id'])){
        $aircraft_id=$_GET['id'];
        ?>
        <!DOCTYPE html>
        <html>
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <link rel="stylesheet" href="../../CSS/style.css">
                <link rel="stylesheet" href="../../CSS/style8.css">
                <script type="text/javascript" src="../../JS/scripts.js"></script>
                <title>Admin - Aircraft_edit - Arctic Airlines</title>
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
                    <h1>Edit aircraft ID: <?php echo $aircraft_id ?></h1>
                    <form method='POST' enctype='multipart/form-data'>
                        <table>
                            <tr>
                                <th>ID</th>
                                <th>Model</th>
                                <th>REG</th>
                                <th>Cabin Config</th>
                            </tr>
                            <tr>
                                <?php
                                $select_query = $server_connection->query("SELECT aircraft.ID AS air_id, aircraft.Airframe_type_id, aircraft.REG AS REG, aircraft.HasTwoClass_config AS config,
                                airframe_type.ID, airframe_type.Model AS model FROM aircraft JOIN airframe_type ON aircraft.Airframe_type_id = airframe_type.ID WHERE aircraft.ID=$aircraft_id");
                                while($row = $select_query->fetch_assoc()){
                                    echo"<td class='id'>".$row['air_id']."</td>";
                                    $select2_query = $server_connection->query("SELECT airframe_type.ID, airframe_type.Model, airframe_type.ICAO_reg FROM airframe_type");
                                    echo"<td><select name='model' required>";
                                    while($row2 = $select2_query->fetch_assoc()){
                                        if($row2['ID']==$row['air_id']) echo"<option value='".$row2['ID']."' selected>".$row2['Model']." (".$row2['ICAO_reg'].")</option>";
                                        else echo"<option value='".$row2['ID']."'>".$row2['Model']." (".$row2['ICAO_reg'].")</option>";
                                    }
                                    echo"</select></td>";
                                    $select2_query->close();
                                    echo"<td><input type='text' name='REG' value='".$row['REG']."' minlength=6 maxlength=6 required></td>";
                                    echo"<td><select name='config' required>";
                                    if($row['config']==1){
                                        echo"<option value='0'>I Class</option>";
                                        echo"<option value='1' selected>II Class</option>";
                                    }
                                    else{
                                        echo"<option value='0' selected>I Class</option>";
                                        echo"<option value='1'>II Class</option>";
                                    }
                                    echo"</select></td>";
                                }
                                $select_query->close();
                                ?>
                            </tr>
                        </table>
                        <input class="save" type="submit" value="Save">
                    </form>
                    <?php
                    if(isset($_POST['model'])&&isset($_POST['REG'])&&isset($_POST['config'])){
                        $model = TSA($_POST['model']);
                        $REG = TSA($_POST['REG']);
                        $config = TSA($_POST['config']);
                        $update_query = $server_connection->prepare("UPDATE aircraft SET Airframe_type_id=?, REG=?, HasTwoClass_config=? WHERE aircraft.ID = $aircraft_id");
                        $update_query->bind_param("isi", $model, $REG, $config);
                        $update_query->execute();
                        $update_query->close();
                        $server_connection->close();
                        echo("<meta http-equiv='refresh' content=\"0; url='./aircraft.php'\">");
                    }
                    else{
                        $server_connection->close();
                    }
                    ?>
                    <a href="./aircraft.php"><button class="button">Return</button></a>
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
                <title>Admin - Aircraft_add - Arctic Airlines</title>
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
                    <h1>Add a new aircraft</h1>
                    <a href="./aircraft.php"><button class="button">Return</button></a>
                    <form method='POST' enctype='multipart/form-data'>
                        <table>
                            <tr>
                                <th>ID</th>
                                <th>Model</th>
                                <th>REG</th>
                                <th>Cabin Config</th>
                            </tr>
                            <tr>
                                <?php
                                $ID_query=$server_connection->query("SELECT aircraft.ID FROM aircraft ORDER BY ID DESC LIMIT 1");
                                while($row=$ID_query->fetch_assoc()) $aircraft_id=$row['ID'];
                                $aircraft_id++;
                                $ID_query->close();
                                ?>
                                <td><?php echo $aircraft_id ?></td>
                                <td><select name="air_model" required>
                                    <option value="" selected disabled hidden>Choose aircraft model here</option>
                                    <?php
                                    $select_query = $server_connection->query("SELECT airframe_type.ID AS ID2, airframe_type.Model, airframe_type.ICAO_reg FROM airframe_type");
                                    while($row2=$select_query->fetch_assoc()){
                                        echo"<option value='".$row2['ID2']."'>".$row2['Model']." (".$row2['ICAO_reg'].")</option>";
                                    }
                                    $select_query->close();
                                    ?>
                                </select></td>
                                <td><input type="text" name="REG" placeholder="Enter aircraft REG" minlength='6' maxlength='6' required></td>
                                <td><select name="config" required>
                                    <option value=0>I Class</option>
                                    <option value=1>II Class</option>
                                </select></td>
                            </tr>
                        </table>
                        <input class="add" type="submit" value="Add new">
                    </form>
                    <?php
                    if(isset($_POST['air_model'])&&isset($_POST['REG'])&&isset($_POST['config'])){
                        $air_model = TSA($_POST['air_model']);
                        $REG = TSA($_POST['REG']);
                        $config = TSA($_POST['config']);
                        $insert_query = $server_connection->prepare("INSERT INTO aircraft (ID, Airframe_type_id, REG, HasTwoClass_config) VALUES (?, ?, ?, ?)");
                        $insert_query->bind_param("iisi", $aircraft_id, $air_model, $REG, $config);
                        $insert_query->execute();
                        $insert_query->close();
                        $server_connection->close();
                        echo("<meta http-equiv='refresh' content=\"0; url='./aircraft.php'\">");
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