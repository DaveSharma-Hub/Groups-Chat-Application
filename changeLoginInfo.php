<?php
    include 'session.php';

    $fName = $_POST['fname'];
    $lName = $_POST['lname'];
    $newEmail = $_POST['email'];

    $uname = $_POST['uname'];
    $pword =$_POST['pword'];

     $username="";
    $password="";
    $schema="";

    $conn = new mysqli("localhost",$username,$password,$schema);

    if($conn->connect_error){
        die("Failed to connect: ".$con->connect_error);
    }else{
        if($fName!=''){
            $stmt = $conn->prepare("update login set name=? where email=?;");
            $stmt->bind_param("ss",$fName,$email);
            $stmt->execute();
        }
        if($lName!=''){
            $stmt = $conn->prepare("update login set Lname=? where email=?;");
            $stmt->bind_param("ss",$lName,$email);
            $stmt->execute();
        }
        if($pword!=''){
            $stmt = $conn->prepare("update login set pass=? where email=?;");
            $pass = hash('sha256',$pword);
            $stmt->bind_param("ss",$pass,$email);
            $stmt->execute();
        }
        if($uname!=''){
            $stmt = $conn->prepare("update login set email=? where email=?;");
            $stmt->bind_param("ss",$uname,$email);
            $stmt->execute();
        }
        header('Location: main.php');

    }
?>
