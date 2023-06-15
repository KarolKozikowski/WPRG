<?php
include("../connect.php");
if(isset($_GET['mod'])&&isset($_GET['id'])){
    if($_GET['mod']==1){
        $user_id=$_GET['id'];
        $delete_query = $server_connection->query("DELETE FROM users WHERE ID=$user_id");
        $server_connection->close();
        exit(header("location: ./users.php"));
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
$server_connection->close();
?>