<?php
    include 'mainConnection.php';
    include 'session.php';

        //$groupID = $_POST['groupID'];
        $groupID = $_SESSION['groupID'];

       

        $stmt = $connection->prepare("select * from message where groupID=?;");
        $stmt->bind_param("i",$groupID);
        $stmt->execute();
        $stmt_result = $stmt->get_result();
        while($data = $stmt_result->fetch_array()){
            $stmt2 = $connection->prepare("select * from login where loginID=?;");
            $stmt2->bind_param("i",$data['senderID']);
            $stmt2->execute();
            $stmt2_result =$stmt2->get_result();
            if($stmt2_result->num_rows>0){
               
                $otherData=$stmt2_result->fetch_assoc();
                $otherEmail = $otherData['email'];

                if($otherEmail==$email){
                    echo "<div class='container1'>";
                    echo "<span class='time-right'>".$otherEmail."</span>";
                    echo "<p>".$data['message']."</p>";
                    // echo  "<span class="time-right">11:00</span>
                    echo "</div>";
                }
                else{
                    echo "<div class='darker'>";
                    echo "<span class='time-left'>".$otherEmail."</span>";
                    echo "<p>".$data['message']."</p>";
                    // echo  "<span class="time-right">11:00</span>
                    echo "</div>";
                }
            }  
        }      
?>
