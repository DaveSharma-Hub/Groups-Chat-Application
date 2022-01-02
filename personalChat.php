<?php
    include 'session.php';

    $other = $_POST['chat'];
    $str = substr($other,11);

     $username="";
    $password="";
    $schema="";

    $conn = new mysqli("localhost",$username,$password,$schema);
    if($conn->connect_error){
        die($conn->connect_error);
    }else{

        $stmt3 = $conn->prepare("select * from login where email=?");
        $stmt3->bind_param("s",$email);
        $stmt3->execute();
        $stmt3_result = $stmt3->get_result();
        if($stmt3_result->num_rows>0){
            $data = $stmt3_result->fetch_assoc();
            $currentID = $data['loginID'];
        
            $stmt2 = $conn->prepare("select * from login where email=?");
            $stmt2->bind_param("s",$str);
            $stmt2->execute();
            $stmt2_result = $stmt2->get_result();
            if($stmt2_result->num_rows>0){
                $data = $stmt2_result->fetch_assoc();
                $otherID = $data['loginID'];

                $stmt = $conn->prepare("select * from personal_group_chat");
                $stmt->execute();
                $stmt_result = $stmt->get_result();
                $checker=0;
                while($groupChat = $stmt_result->fetch_array()){
                            if(($groupChat['id1']==$currentID && $groupChat['id2']==$otherID)||
                            ($groupChat['id2']==$currentID && $groupChat['id1']==$otherID)){
                                $checker=1;
                                $_SESSION['groupID']=$groupChat['groupID'];
                                header('Location: chat.php');
                            }
                }
                if($checker==0){
                   //echo "bye";
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
                
        
                        $stmtGroup = $conn->prepare("insert into personal_group_chat (groupID,id1,id2) values(?,?,?);");
                        $stmtGroup->bind_param("iii",$number,$currentID,$otherID);
                        $stmtGroup->execute();

                        $stmtGroup = $conn->prepare("insert into group_head (groupID,groupNAME) values(?,?);");
                        $name = "personal";
                        $stmtGroup->bind_param("is",$number,$name);
                        $stmtGroup->execute();
                
                        
                
                        $statement = $conn->prepare("insert into group".$number." (loginID) values(?);");
                        $statement->bind_param("i",$currentID);
                        $statement->execute();

                        $statement = $conn->prepare("insert into group".$number." (loginID) values(?);");
                        $statement->bind_param("i",$otherID);
                        $statement->execute();

                        
                        $_SESSION['groupID']=$number;
                        header('Location: chat.php');
                }
            }
        }
    }
?>
