<?php
    include "session.php";

    $name = $_POST['name'];
    
    $id= $_SESSION['groupID'];

     $username="";
    $password="";
    $schema="";

    $conn = new mysqli("localhost",$username,$password,$schema);
    if($conn->connect_error){
        die($conn->connect_error);
    }else{
        $stmt = $conn->prepare("select* from group_head where groupID=?");
        $stmt->bind_param("i",$id);
        $stmt->execute();
        $stmt_result = $stmt->get_result();
        if($stmt_result->num_rows>0){
            $stmt = $conn->prepare("update group_head set groupNAME=? where groupID=?");
            $stmt->bind_param("si",$name,$id);
            $stmt->execute();
        }
        header('Location: editChat.php');

    }
?>
