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
        <title>Admin - Aircraft - Arctic Airlines</title>
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
            <h1>Aircraft</h1>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Model</th>
                    <th>REG</th>
                    <th>Cabin Config</th>
                    <th>Actions</th>
                </tr>
                <?php
                include("../connect.php");
                $select_query = $server_connection->query("SELECT aircraft.ID AS air_id, aircraft.Airframe_type_id, aircraft.REG AS REG, aircraft.HasTwoClass_config AS config,
                airframe_type.ID, airframe_type.Model AS model FROM aircraft JOIN airframe_type ON aircraft.Airframe_type_id = airframe_type.ID ORDER BY aircraft.ID");
                while($row = $select_query->fetch_assoc()){
                    echo"<tr>";
                    echo"<td class='id'>".$row['air_id']."</td>";
                    echo"<td>".$row['model']."</td>";
                    if(substr($row['REG'], 0, 2)=='LN') echo"<td class='flag4'><img src='../../art/flags/norway.png'>".$row['REG']."</td>";
                    elseif(substr($row['REG'], 0, 2)=='OH') echo"<td class='flag4'><img src='../../art/flags/finland.png'>".$row['REG']."</td>";
                    else echo"<td class='flag4'>".$row['REG']."</td>";
                    if($row['config']==1){
                        echo"<td>II Class</td>";
                    }
                    else echo"<td>I Class</td>";
                    echo"<td><a href='./aircraft_mod.php?mod=2&id=".$row['air_id']."'><img class='edit' src='../../art/edit.png'></a><a href='./aircraft_mod.php?mod=1&id=".$row['air_id']."'><img class='trash' src='../../art/trash.png'></a></td>";
                    echo"</tr>";
                }
                $select_query->close();
                $server_connection->close();
                ?>
            </table>
            <a href="./aircraft_mod.php?mod=3"><button class="add">Add new</button></a>
            <a href="./desktop.php"><button class="button">Return</button></a>
        </div>
    </body>
</html>