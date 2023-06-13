<?php
session_start();

////////////////////////////////////////// MULTI PURPOSE FILE //////////////////////////////////////////////

if(isset($_GET['oper'])){
    
    //  1 - LOG OUT
    if($_GET['oper']==1){
        session_unset();
        setcookie("user_id", "", time()-3600, "/");
        setcookie("user_name", "", time()-3600, "/");
        header("location: ../index.php");
        exit;
    }
    
    //  2 - UPDATE USER INFO
    elseif($_GET['oper']==2){
        //TSA makes sure no unauthorized html lines go through :)
        function TSA($your_stuff){
            $your_stuff = trim($your_stuff);
            $your_stuff = stripslashes($your_stuff);
            $your_stuff = htmlspecialchars($your_stuff);
            return $your_stuff;
        }
        if(isset($_POST['fname'])) $fname = TSA($_POST['fname']);
        else $fname=null;
        if(isset($_POST['lname'])) $lname = TSA($_POST['lname']);
        else $lname=null;
        if(isset($_POST['username'])) $username = TSA($_POST['username']);
        else $username=null;
        if(isset($_POST['country'])) $country = TSA($_POST['country']);
        else $country=null;
        if(isset($_POST['email'])) $email = TSA($_POST['email']);
        else $email=null;
        if(isset($_POST['phone'])) $phone = TSA($_POST['phone']);
        else $phone=null;
        $user_id=$_SESSION['user_id'];
        //Connecting to server
        include("connect.php");
        //Update query
        $update_query = $server_connection->prepare("UPDATE users SET First_name = ?, Last_name=?, Phone_nr=?, Email=?, Country=?, username=? WHERE ID=$user_id");
        $update_query->bind_param("ssssss", $fname, $lname, $phone, $email, $country, $username);
        $update_query->execute();
        $update_query->close();
        //checking if it executed succesfully
        $check_query = $server_connection->query("SELECT users.First_name FROM users WHERE ID=$user_id");
        while($row = $check_query->fetch_assoc()){
            if($fname != $row['First_name']){
                $check_query->close();
                $server_connection->close();
                exit(header("location: ../HTML/oopsies.html"));
            }
            $_SESSION['user_name']=$row['First_name'];
        }
        $check_query->close();
        $server_connection->close();
        exit(header("location: ./user.php"));
    }
    
    //  3 - UPDATE "is_fat" ONLY
    elseif($_GET['oper']==3){
        if(isset($_POST['is_fat'])) $is_fat=1;
        else $is_fat=0;
        $user_id=$_SESSION['user_id'];
        //Connecting to server
        include("connect.php");
        $update_query = $server_connection->prepare("UPDATE users SET Is_Fat=? WHERE ID=$user_id");
        $update_query->bind_param("i", $is_fat);
        $update_query->execute();
        $update_query->close();
        $server_connection->close();
        exit(header("location: ./settings.php"));
    }

    //  4 - CHANGE PASSWORD
    elseif($_GET['oper']==4){
        //TODO
    }
    
    else{
        exit(header("location: ../HTML/oopsies.html"));
    }
}

else{
    exit(header("location: ../HTML/oopsies.html"));
}
?>