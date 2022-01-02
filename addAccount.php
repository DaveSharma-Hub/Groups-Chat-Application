<?php
    $email =$_POST['email'];
    $fName =$_POST['fname'];
    $lName = $_POST['lname'];
    $phone = $_POST['phone'];
    $uname = $_POST['uname'];
    $pword = $_POST['pword'];

    $conn = new mysqli("localhost","dave(2)","ensf409","group_chat");
    if($conn->connect_error){
        die("Failed to connect: ".$conn->connect_error);
    }
    else{
        $actualPassword = hash('sha256',$pword);

        $stmt = $conn->prepare("insert into login (email,pass,name,Lname) values(?,?,?,?)");
        $stmt->bind_param("ssss",$email,$actualPassword,$fName,$lName);
        $stmt->execute();

        session_start();
        $_SESSION['formdata'] = $email; //or whatever
        header('Location: main.php');
    }

?>