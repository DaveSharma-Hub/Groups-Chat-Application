<?php
    $username="";
    $password="";
    $schema="";

    $connection = new mysqli("localhost",$username,$password,$schema);
    if($connection->connect_error){
        die("Failed to connect: ".$connection->connect_error);
    }
?>
