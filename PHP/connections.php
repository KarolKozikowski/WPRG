<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../CSS/style.css">
        <link rel="stylesheet" href="../CSS/style9.css">
        <title>Connections - Arctic Airlines</title>
    </head>
    <body>
        <header id="page1">
            <a href="../index.php" class="logo"><img src="../art/logo.png"></a>
            <nav>
                <ul class="nav_links">
                    <li><a href="../index.php">Home Page</a></li>
                    <li><a href="./book.php">Bookings</a></li>
                </ul>
            </nav>
            <?php
            if(isset($_SESSION["user_name"])) echo "<a href='./user.php'><button class='login_button'>".$_SESSION["user_name"]."</button></a>";
            else echo "<a href='./login.php'><button class='login_button'>Sign in</button></a>";
            ?>
        </header>
        <section class="main_sectoin">
            <div class="blur">
                <h1>Where are we going?</h1>
                <form method="POST">
                    <select name="arr_airp" required onchange="this.form.submit()">
                        <option value="" disabled hidden selected><?php if(isset($_POST['arr_airp'])) echo"Choose a different destination here"; else echo"Choose your destination here";  ?></option>
                        <?php
                        include("./connect.php");
                        $select_query=$server_connection->query("SELECT airports.ID, airports.Municipality, airports.Country FROM airports ORDER BY Country");
                        while($row=$select_query->fetch_assoc()){
                            if($row['Municipality']=='Helsinki')echo"<option class'helsinki' value='".$row['ID']."'>".strtoupper($row['Municipality'])." (".$row['Country'].")</option>";
                            else echo"<option value='".$row['ID']."'>".$row['Municipality']." (".$row['Country'].")</option>";
                        }
                        ?>
                    </select>
                </form>
            </div>
            <?php
            if(isset($_POST['arr_airp'])){
                $airport_id = $_POST['arr_airp'];
                $search_query=$server_connection->query("SELECT airports.Municipality AS city FROM airports WHERE airports.ID = $airport_id");
                while($row2=$search_query->fetch_assoc()) $city=$row2['city'];
                $select_query2=$server_connection->query("SELECT routes.ID AS r_id, routes.Flight_nr, routes.Enroute_time, routes.Departure_id, routes.Arrival_id, 
                a.ID AS a_id, a.IATA AS a_IATA, a.Municipality AS a_city, a.Country AS a_country, b.ID AS b_id, b.IATA AS b_IATA, b.Municipality AS b_city, b.Country AS b_country FROM routes 
                JOIN airports AS a ON routes.Departure_id = a.ID 
                JOIN airports AS b ON routes.Arrival_id = b.ID WHERE routes.Arrival_id = $airport_id");
                if($select_query2->num_rows>0){
                    echo"<div class='text'><label>Available connections to ".$city.":</label></div>";
                    while($row3=$select_query2->fetch_assoc()){
                        echo"<div class='route'>";
                        echo"<h2 class='text_from'>".$row3['a_city']." (".$row3['a_IATA'].")</h2>";
                        echo"<h2 class='text_to'>".$row3['b_city']." (".$row3['b_IATA'].")</h2>";
                        echo"<img class='img_from' src='../art/flags/".strtolower($row3['a_country']).".png'>";
                        echo"<img class='img_to' src='../art/flags/".strtolower($row3['b_country']).".png'>";
                        echo"<img class='img_dep' src='../art/dep.png'>";
                        echo"<img class='img_arr' src='../art/arr.png'>";
                        $hours=floor($row3['Enroute_time']/60);
                        $minutes=$row3['Enroute_time']-($hours*60);
                        if($hours==0)$hours="";
                        else $hours = $hours."h ";
                        echo"<p class='enroute'>".$hours.$minutes."min</p>";
                        if($row3['Flight_nr']<100) $flight_nr="00".$row3['Flight_nr'];
                        else $flight_nr=$row3['Flight_nr'];
                        echo"<small class='flight_nr'>A7 ".$flight_nr."</small>";
                        if(isset($_SESSION["user_id"]) && isset($_SESSION["user_name"])) echo"<a href='./book.php?flightnr=".$row3['r_id']."'><button class='book'>Book Flight</button></a>";
                        else echo"<a href='./login.php'><button class='book'>Book Flight</button></a>";
                        echo"</div>";
                    }
                    echo"<a href='#page1'><button class='top'>Top of the page</button></a>";
                }
                else echo"<div class='text'><label>Sorry, unfortunately we do not fly to this location.</label></div>";
            }
            $server_connection->close();
            ?>
        </section>
        <footer>
            <p>&copy; 2023 Karol Kozikowski. Not all rights reserved.</p>
        </footer>
    </body>
</html>