<?php
session_start();
if(!isset($_SESSION["user_id"]) || !isset($_SESSION["user_name"])) exit(header("location: ./login.php"));
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../CSS/style.css">
        <link rel="stylesheet" href="../CSS/style9.css">
        <title>Book Flight - Arctic Airlines</title>
    </head>
    <body class="book_body">
        <header>
            <a href="../index.php" class="logo"><img src="../art/logo.png"></a>
            <nav>
                <ul class="nav_links">
                    <li><a href="../index.php">Home Page</a></li>
                    <li><a href="./connections.php">Connections</a></li>
                </ul>
            </nav>
            <?php
            echo "<a href='./user.php'><button class='login_button'>".$_SESSION["user_name"]."</button></a>";
            ?>
        </header>
        <section class="book_background">
            <div class="route_list">
                <form method="POST">
                    <select name="route_id" required onchange="this.form.submit()">
                        <?php
                        if(!isset($_GET['flightnr'])) echo"<option value='' disabled hidden selected>Choose your flight number</option>";
                        include("./connect.php");
                        $select_query = $server_connection->query("SELECT routes.ID AS r_id, routes.Flight_nr, a.ICAO AS a_ICAO, b.ICAO AS b_ICAO FROM routes JOIN airports AS a ON routes.Departure_id = a.ID
                        JOIN airports AS b ON routes.Arrival_id = b.ID");
                        while($row=$select_query->fetch_assoc()){
                            if($row['Flight_nr']<100) $flight_nr="A7 00".$row['Flight_nr'];
                            else $flight_nr="A7 ".$row['Flight_nr'];
                            if(isset($_GET['flightnr']) && $_GET['flightnr']==$row['r_id']) echo"<option value='".$row['r_id']."' selected>".$flight_nr." ".$row['a_ICAO']."->".$row['b_ICAO']."</option>";
                            else echo"<option value='".$row['r_id']."'>".$flight_nr." ".$row['a_ICAO']."->".$row['b_ICAO']."</option>";
                        }
                        ?>
                    </select>
                </form>
                <?php
                if(isset($_POST['route_id'])){
                    $server_connection->close();
                    echo("<meta http-equiv='refresh' content=\"0; url='./book.php?flightnr=".$_POST['route_id']."'\">");
                }
                ?>
                <a href="./connections.php"><button class="find">Find Connections</button></a>
            </div>
            <div class="line"></div>
            <?php
            if(isset($_GET['flightnr'])){
                $route_id=$_GET['flightnr'];
                $select2_query=$server_connection->query("SELECT routes.Flight_nr, routes.Enroute_time, a.IATA AS a_IATA, b.IATA AS b_IATA FROM routes 
                JOIN airports AS a ON routes.Departure_id = a.ID 
                JOIN airports AS b ON routes.Arrival_id = b.ID WHERE routes.ID=$route_id");
                while($row2=$select2_query->fetch_assoc()){
                    $flight_nr=$row2['Flight_nr'];
                    $enroute=$row2['Enroute_time'];
                    $a_IATA=$row2['a_IATA'];
                    $b_IATA=$row2['b_IATA'];
                }
                if($flight_nr<100) $flight_nr="A7 00".$flight_nr;
                else $flight_nr="A7 ".$flight_nr;
                echo"<label class='available'>Available dates for flight ".$flight_nr.":</label>";
                $select3_query=$server_connection->query("SELECT flights.ID AS f_ID, flights.Dep_date, flights.Dep_time, a.REG, a.HasTwoClass_config, ar.ICAO_reg, ar.OperCost_hour
                FROM flights JOIN aircraft AS a ON flights.Aircraft_id = a.ID JOIN airframe_type AS ar ON a.Airframe_type_id = ar.ID WHERE flights.Route_id=$route_id ORDER BY flights.Dep_date");
                ?>
                <div class="flight_list">
                    <?php
                    while($row3=$select3_query->fetch_assoc()){
                        $h=ceil($enroute/60);
                        $price=$row3['OperCost_hour']*$h;
                        echo"<div class='flight_record' onclick=\"window.location='./book.php?flightnr=".$route_id."&flightid=".$row3['f_ID']."';\">";
                        echo"<p class='a_IATA'>".$a_IATA."</p><img class='plne' src='../art/plne.png'><p class='b_IATA'>".$b_IATA."</p>";
                        echo"<p class='dep_time'>".$row3['Dep_date'].", ".$row3['Dep_time']."</p><div class='line2'></div><div class='line3'></div><p class='plne_info'>".$row3['ICAO_reg']." ".$row3['REG']."</p>";
                        echo"<p class='price'>Starting from:</p><p class='price_value'>$".$price."</p>";
                        echo"<img class='ic' src='../art/ic.png'>";
                        if($row3['HasTwoClass_config']==1) echo"<img class='iic' src='../art/iic.png'>";
                        echo"</div>";
                    }
                    ?>
                </div>
                <?php
            }
            if(isset($_GET['flightnr']) && isset($_GET['flightid'])){
                $flightid=$_GET['flightid'];
                ?>
                <label class="options">Additional options:</label>
                <form action="./book2.php?<?php echo"flightid=".$flightid."&price=".$price ?>" method="POST">    
                    <div class="option_list">
                        <div class="also_options">
                            <p class="hand_baggage">Check-In baggage</p>
                            <input type="checkbox" name="check" value="1">
                            <p class="check_baggage">Check-In baggage</p>
                            <input type="checkbox" name="hand" value="1">
                            <p class="kids">Traveling with kids</p>
                            <input type="checkbox" name="kid" value="1">
                            <input class="checkout" type="submit" value="Checkout">
                        </div>
                    </div>
                </form>
                <?php
            }
            ?>
        </section>
    </body>
</html>