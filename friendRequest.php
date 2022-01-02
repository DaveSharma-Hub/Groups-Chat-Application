<?php
    include "session.php";

     $username="";
    $password="";
    $schema="";

    $conn = new mysqli("localhost",$username,$password,$schema);
    $choice= $_POST['choice'];
    // echo $choice;

    if($conn->connect_error){
        die("Failed to connect: ".$conn->connect_error);
    }
    else{
        if($choice[0]=='A'){
            $str = substr($choice,7);
            $stmt = $conn->prepare("select * from login where email=?");
            $stmt->bind_param("s",$email);
            $stmt->execute();
            $stmt_result=$stmt->get_result();
            
            if($stmt_result->num_rows>0){
                $data= $stmt_result->fetch_assoc();
                $toID = $data['loginID'];

                $stmt = $conn->prepare("select * from login where email=?");
                $stmt->bind_param("s",$str);
                $stmt->execute();
                $stmt_result=$stmt->get_result();
                
                if($stmt_result->num_rows>0){
                    $data= $stmt_result->fetch_assoc();
                    $fromID = $data['loginID'];
                    
                    $stmt = $conn->prepare("update friends set accepted=1 where fromID=? and toID=?");
                    $stmt->bind_param("ii",$fromID,$toID);
                    $stmt->execute();

                    $stmt = $conn->prepare("select * from friends where fromID=? and toID=?");
                    $stmt->bind_param("ii",$toID,$fromID);
                    $stmt->execute();
                    $stmt_result= $stmt->get_result();
                    if($stmt_result->num_rows>0){
                        $stmt = $conn->prepare("update friends set accepted=1 where fromID=? and toID=?");
                        $stmt->bind_param("ii",$toID,$fromID);
                        $stmt->execute();
                    }else{
                    $stmt = $conn->prepare("insert into friends(fromID,toID,accepted) values(?,?,?)");
                    $accepted=1;
                    $stmt->bind_param("iii",$toID,$fromID,$accepted);
                    $stmt->execute();
                    }
                    
                    $_SESSION['formdata'] = $email; //or whatever
                    header('Location: notif.php');
                }
            }

        }else if($choice[0]='D'){
            $str = substr($choice,8);

            $stmt = $conn->prepare("select * from login where email=?");
            $stmt->bind_param("s",$email);
            $stmt->execute();
            $stmt_result=$stmt->get_result();
            
            if($stmt_result->num_rows>0){
                $data= $stmt_result->fetch_assoc();
                $toID = $data['loginID'];

                $stmt = $conn->prepare("select * from login where email=?");
                $stmt->bind_param("s",$str);
                $stmt->execute();
                $stmt_result=$stmt->get_result();
                
                if($stmt_result->num_rows>0){
                    $data= $stmt_result->fetch_assoc();
                    $fromID = $data['loginID'];
                    
                    $stmt = $conn->prepare("update friends set accepted=2 where fromID=? and toID=?");
                    $stmt->bind_param("ii",$fromID,$toID);
                    $stmt->execute();

                   

                    $_SESSION['formdata'] = $email; //or whatever
                    header('Location: notif.php');
                }
            }

        }
    }
    



?>
