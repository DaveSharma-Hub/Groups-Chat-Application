<?php
    $email = $_POST['username'];
    $password=$_POST['password'];

    $conn= new mysqli("localhost","dave(2)","ensf409","group_chat");

    if($conn->connect_error){
        die("Failed to connect: ".$con->connect_error);
    }else{

        $stmt = $conn->prepare("select * from login where email=?");
        $stmt->bind_param("s",$email);
        $stmt->execute();

       $stmt_result= $stmt->get_result();
       if($stmt_result->num_rows>0){
            $data = $stmt_result->fetch_assoc();
            if(hash('sha256',$password)==$data['pass']){
                //logged in
                session_start();
                $_SESSION['formdata'] = $email; //or whatever
                 header('Location: main.php');
            }
            else{
                header('Location: login.html');
            }
       }
       else{
        header('Location: signup.html');
       }
    }


?>