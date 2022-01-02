<?php
    include 'session.php';

    $groupID = $_SESSION['groupID'];
    $message =$_POST['message'];

    if($message==''){
        header('Location: chat.php');
    }

     $username="";
    $password="";
    $schema="";

    $conn = new mysqli("localhost",$username,$password,$schema);
    
    if($conn->connect_error){
        die("Failed to connect: ".$conn->connect_error);
    }else{
        $statement = $conn->prepare("select * from login where email=?");
        $statement->bind_param("s",$email);
        $statement->execute();
        $statement_result = $statement->get_result();
        if($statement_result->num_rows>0){
            $data = $statement_result->fetch_assoc();
            $loginID=$data['loginID'];
    
            $stmt = $conn->prepare("insert into message (senderID,groupID,message) values(?,?,?)");
            $stmt->bind_param("iis",$loginID,$groupID,$message);
            $stmt->execute();

            session_start();
            $_SESSION['formdata'] = $email; //or whatever
            $_SESSION['groupID'] = $groupID; //or whatever

            header('Location: chat.php');
        }
    }

?>
