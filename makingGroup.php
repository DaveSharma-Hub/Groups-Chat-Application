<?php
    include 'session.php';

    $arr = array();
    $name = $_POST["Gname"];
    $num = $_SESSION['numData'];

    for($i=1;$i<$num;$i++){
        array_push($arr,$_POST["user$i"]);
        echo($_POST["user$i"]);
    }

    $conn = new mysqli("localhost","dave(2)","ensf409","group_chat");
    if($conn->connect_error){
        die("Failed to connect: ".$connection->connect_error);
    }else{
        $stmt = $conn->prepare("select * from group_head");
        $stmt->execute();
        $stmt_result = $stmt->get_result();
        $number = $stmt_result->num_rows;
        $stmt2 = $conn->prepare("create table group".$number."(
            thisID INTEGER UNIQUE AUTO_INCREMENT,
            loginID INTEGER NOT NULL,
            primary key(thisID)
        );");

        $stmt2->execute();

        $stmtGroup = $conn->prepare("insert into group_head (groupID, groupNAME) values(?,?);");
        $stmtGroup->bind_param("is",$number,$name);
        $stmtGroup->execute();

        $idArray = array();

        $stmt3 = $conn->prepare("select * from login");
        $stmt3->execute();
        $stmt3_result = $stmt3->get_result();
        while($data=$stmt3_result->fetch_array()){
            for($i=0;$i<count($arr);$i++){
                if($data['email']==$arr[$i]){
                    array_push($idArray,$data['loginID']);
                }
            }
        }

        $stmt3 = $conn->prepare("select * from login where email=?");
        $stmt3->bind_param("s",$email);
        $stmt3->execute();
        $stmt3_result = $stmt3->get_result();
        if($stmt3_result->num_rows>0){
            $data = $stmt3_result->fetch_assoc();
            $currentID = $data['loginID'];
            array_push($idArray,$currentID);
        }

        for($i=0;$i<count($idArray);$i++){
            $statement = $conn->prepare("insert into group".$number." (loginID) values(".$idArray[$i].");");
            $statement->execute();
        }
        
        session_start();
        $_SESSION['formdata'] = $email; //or whatever
        header('Location: createGroup.php');

    }


?>