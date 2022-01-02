<?php
    include "session.php";

    $friend = $_POST['friends'];

    $conn = new mysqli("localhost","dave(2)","ensf409","group_chat");
    if($conn->connect_error){
        die("Failed to connect: ".$conn->connect_error);
    }else{
        $stmt = $conn->prepare("select * from login where email=?");
        $stmt->bind_param("s",$email);
        $stmt->execute();
        $stmt_result = $stmt->get_result();
        if($stmt_result->num_rows){
            $data = $stmt_result->fetch_assoc();
            $myID = $data['loginID'];

            $stmt = $conn->prepare("select * from login where email=?");
            $stmt->bind_param("s",$friend);
            $stmt->execute();
            $stmt_result = $stmt->get_result();
            if($stmt_result->num_rows){
                $data = $stmt_result->fetch_assoc();
                $friendID = $data['loginID'];

                $stmt = $conn->prepare("insert into friends (fromID,toID,accepted) values(?,?,?)");
                $notAccepted=0;
                $stmt->bind_param("iii",$myID,$friendID,$notAccepted);
                $stmt->execute();

                $_SESSION['formdata'] = $email; //or whatever
                header('Location: main.php');
                
            }
        }
    }
    

?>