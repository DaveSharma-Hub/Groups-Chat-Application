<?php
    $connection = new mysqli("localhost","dave(2)","ensf409","group_chat");
    if($connection->connect_error){
        die("Failed to connect: ".$connection->connect_error);
    }
?>