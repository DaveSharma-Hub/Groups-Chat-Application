
<?php
  include 'session.php';
  include 'mainConnection.php';
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<style>

body {
  margin: 0 auto;
  width: 100%;
  text-align:center;
  /* background: linear-gradient(to right, #6f00ff, #0677f8 ); */
    
}

.w3-container2{
  width: 80%;
  height:70vh;
  overflow: auto;
  /* background: linear-gradient(to right, #6f00ff, #0677f8 ); */
  display: flex;
  flex-direction: column-reverse;
  margin-left:10%; 
  
  
}

.w3-container2 .container1 {
  border: 2px solid #dedede;
  background-color: #f1f1f1;
  border-radius: 5px;
  padding: 10px;
  margin: 10px 0;
   background: linear-gradient(to right,  #009bff ,  #00a2ff   ); */
  margin-right:200px;
  border-radius:10px;
  color:white;
  width:500px;
  overflow:auto;
}

.w3-container2 .darker {
  border-color: #ccc;
  background-color: #ddd;
 background: linear-gradient(to right,  #bc88fa  ,  #8894fa   ); */
  border: 2px solid #dedede;
  border-radius: 5px;
  padding: 10px;
  margin: 10px 0;
  margin-left:530px;
  border-radius:10px;
  color:black;
  width:500px;
  overflow:auto;

}

.w3-container2 .container1::after {
  content: "";
  clear: both;
  display: table;
}

.w3-container2 .container1 img {
  float: left;
  max-width: 60px;
  width: 100%;
  margin-right: 20px;
  border-radius: 50%;
}

.w3-container2 .container1 img.right {
  float: right;
  margin-left: 20px;
  margin-right:0;
}

.w3-container2 .time-right {
  float: right;
  color: white;
}

.w3-container2 .time-left {
  float: left;
  color: black;
}

div.sticky {
  position: -webkit-sticky;
  position: sticky;
  top: 0;
  background-color: #fff;
  padding: 10px;
  font-size: 20px;
  width:80%;
  display:inline-block;
  border-radius:20px;
}

input[type=text], select {
  width: 80%;
  padding: 12px 20px;
  margin: 8px 0;
  display: flex;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
  float:left;
}

input[value="Message"],select{
    color: #adaaac ;
}
input[type=submit] {
  width: 10%;
  background-color:#ff0059;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  display:flex;
  float: left;
  margin-left:5%;
}

#sideGroup input[type="submit"]{
  background-color:Dodgerblue;
  width:40%;
  height:15%;
  padding:8px 8px;
  margin-left:50px;
  text-align:center;
}
#sideGroup input[type="radio"]{
  width:30%;
  float:left;
}
input[type=submit]:hover {
  background-color: #ff009e;
}
img{
  border-radius:10px;
}
.w3-bar-item .badge {
  position: absolute;
  top: 360px;
  right: 40px;
  padding: 5px 10px;
  border-radius: 50%;
  background-color: red;
  color: white;
}

</style>
</head>
<body>
<div class="w3-sidebar w3-bar-block w3-card w3-animate-left w3-indigo" style="display:none" id="leftMenu">
  <button onclick="closeLeftMenu()" class="w3-bar-item w3-button w3-large">Close &times;</button>
  <a href="http://localhost:3000/Users/Daves/Documents/Practice/teamschat/main.php" class="w3-bar-item w3-button"><img src="main.png" alt='Avatar' width="25%">Main Page</a>
  <!-- <a href="http://localhost:3000/Users/Daves/Documents/Practice/teamschat/viewGroups.php" class="w3-bar-item w3-button">View Groups</a> -->
  <?php
    echo "<div id='sideGroup'><p>Choose Groups</p>";
    $stmt = $connection->prepare("select * from login where email=?");
    $stmt->bind_param("s",$email);
    $stmt->execute();
    $stmt_result = $stmt->get_result();
    if($stmt_result->num_rows>0){
        $data = $stmt_result->fetch_assoc();
        $id = $data['loginID'];

        $statement = $connection->prepare("select * from group_head");
        $statement->execute();
        $stmt_result2 = $statement->get_result();
       
        echo "<ul><form action='http://localhost:3000/Users/Daves/Documents/Practice/teamschat/inter.php' method='post'>";
        while($rows =$stmt_result2->fetch_array()){
            $id2 = $rows['groupID'];

            $statement2 = $connection->prepare("select * from group".$id2.";");
            $statement2->execute();
            $stmt_result3 = $statement2->get_result();
            while($check = $stmt_result3->fetch_array()){
                  if($check['loginID']==$id){
                    echo "<input type='radio' id='".$rows['groupID']."' name='groupID' value='".$rows['groupID']."'>";
                    echo "<label for='".$rows['groupID']."'>".$rows['groupNAME']."'</label><br>";
                }
            }
        }
        echo "<input type='submit' value='View'>";
        echo "</form></ul></div>";        
    }
  
  ?>
  <a href="http://localhost:3000/Users/Daves/Documents/Practice/teamschat/createGroup.php" class="w3-bar-item w3-button">Create Group <img src="groups.jpg" alt='Avatar' width="25%"></a>
  <!-- <a href="http://localhost:3000/Users/Daves/Documents/Practice/teamschat/notif.php" class="w3-bar-item w3-button">Notification</a> -->
  <?php

      $notif = $connection ->prepare("select * from login where email=?");
      $notif->bind_param("s",$email);
      $notif->execute();
      $notif_result=  $notif->get_result();
      if($notif_result->num_rows>0){
        $dataiD = $notif_result->fetch_assoc();
        $iD = $dataiD['loginID'];

        $notif2 = $connection ->prepare("select * from friends where toID=? and accepted=?");
        $zero =0;
        $notif2->bind_param("ii",$iD,$zero);
        $notif2->execute();
        $notif2_result=$notif2->get_result();
        $number = $notif2_result->num_rows;
        echo "<a href='http://localhost:3000/Users/Daves/Documents/Practice/teamschat/notif.php' class='w3-bar-item w3-button'>Notification <img src='notif.png' alt='Avatar' width='25%'>";
       // echo "<div id='newNotif'><p>".$number."</p></div>";
       if($number>0){
          echo "<span class='badge'>".$number."</span>";
          echo "</a>";
       }else{
        echo "</a>";
       }
      }
    ?>
  <a href="http://localhost:3000/Users/Daves/Documents/Practice/teamschat/preventReverse.php" class="w3-bar-item w3-button">Logout<img src='logout.png' alt='Avatar' width='20%'></a>
</div>

<div class="w3-sidebar w3-bar-block w3-card w3-animate-right w3-indigo" style="display:none;right:0;" id="rightMenu">
  <button onclick="closeRightMenu()" class="w3-bar-item w3-button w3-large">Close &times;</button>
  <a href="http://localhost:3000/Users/Daves/Documents/Practice/teamschat/editChat.php" class="w3-bar-item w3-button">Edit Chat</a>
  <!-- <a href="#" class="w3-bar-item w3-button">Link 2</a>
  <a href="#" class="w3-bar-item w3-button">Link 3</a> -->
  <?php
    $conn = new mysqli("localhost","dave(2)","ensf409","group_chat");
    if($conn->connect_error){
        die("Failed to connect: ".$conn->connect_error);
    }
      $groupID = $_SESSION['groupID'];
      $right = $conn->prepare("select * from group".$groupID);
      $names = array();
      $right->execute();
      $right_result=$right->get_result();
      while($data=$right_result->fetch_array()){
           $tmpID = $data['loginID'];
          //  echo "<p>".$tmpID."</p>";

           $right2 = $conn->prepare("select * from login where loginID=?");
           $right2->bind_param("i",$tmpID);
           $right2->execute();
           $right2_result=$right2->get_result();
          if($right2_result->num_rows>0){
            $data2 = $right2_result->fetch_assoc();
              array_push($names,$data2['email']);        
          }
      }
     echo "<p><b>Group Members</b></p>";
     for($i=0;$i<count($names);$i++){
          echo "<p>".$names[$i]."</p>";
     }
  ?>
</div>

<div class="w3-indigo">
  <button class="w3-button w3-indigo w3-xlarge w3-left" onclick="openLeftMenu()">&#9776;</button>
  <button class="w3-button w3-indigo w3-xlarge w3-right" onclick="openRightMenu()">&#9776;</button>
  <div class="w3-container">
    <?php
    if($email=="--"){
      header('Location: login.html');
    }else{
      
        $groupID = $_SESSION['groupID'];

        $stmtname = $connection->prepare("select * from group_head where groupID=?;");
        $stmtname->bind_param("i",$groupID);
        $stmtname->execute();
        $stmt_result = $stmtname->get_result();
        if( $stmt_result->num_rows>0){
            $Gname= $stmt_result->fetch_assoc();
            echo "<h1><b>Group: ".$Gname['groupNAME']."</b></h1>";
            //echo "<h1>User: ".$email."</h1>";

        }
    }
    ?>
  </div>
</div>

<div class="w3-container2">
<div class="container" id="output"  data-simplebar></div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    
    <?php
    //session_start();
    $groupID = $_SESSION['groupID'];
    $_SESSION['groupID']=$groupID;
    ?>
    <!-- <?php
        //$groupID = $_POST['groupID'];

        $groupID = $_SESSION['groupID'];

        $stmtname = $connection->prepare("select * from group_head where groupID=?;");
        $stmtname->bind_param("i",$groupID);
        $stmtname->execute();
        $stmt_result = $stmtname->get_result();
        if( $stmt_result->num_rows>0){
            $Gname= $stmt_result->fetch_assoc();
            echo "<h1>Group: ".$Gname['groupNAME']."</h1>";
        }

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
    

    ?> -->
  <!-- <div class="container1">
    <img src="/w3images/bandmember.jpg" alt="Avatar" style="width:100%;">
    <p>Hello. How are you today?</p>
    <span class="time-right">11:00</span>
  </div>

  <div class="container darker">
    <img src="/w3images/avatar_g2.jpg" alt="Avatar" class="right" style="width:100%;">
    <p>Hey! I'm fine. Thanks for asking!</p>
    <span class="time-left">11:01</span>
  </div>

  <div class="container1">
    <img src="/w3images/bandmember.jpg" alt="Avatar" style="width:100%;">
    <p>Sweet! So, what do you wanna do today?</p>
    <span class="time-right">11:02</span>
  </div>

  <div class="container darker">
    <img src="/w3images/avatar_g2.jpg" alt="Avatar" class="right" style="width:100%;">
    <p>Nah, I dunno. Play soccer.. or learn more coding perhaps?</p>
    <span class="time-left">11:05</span>
  </div>

  <div class="container darker">
    <img src="/w3images/avatar_g2.jpg" alt="Avatar" class="right" style="width:100%;">
    <p>Nah, I dunno. Play soccer.. or learn more coding perhaps?</p>
    <span class="time-left">11:05</span>
  </div>
  <div class="container darker">
    <img src="/w3images/avatar_g2.jpg" alt="Avatar" class="right" style="width:100%;">
    <p>Nah, I dunno. Play soccer.. or learn more coding perhaps?</p>
    <span class="time-left">11:05</span>
  </div>
  <div class="container darker">
    <img src="/w3images/avatar_g2.jpg" alt="Avatar" class="right" style="width:100%;">
    <p>Nah, I dunno. Play soccer.. or learn more coding perhaps?</p>
    <span class="time-left">11:05</span>
  </div>-->
</div> 
<div class="sticky">
    <form action="http://localhost:3000/Users/Daves/Documents/Practice/teamschat/sendMessage.php" method="POST">
        <?php
           // $_SESSION['groupID'] = $_POST['groupID']; //or whatever
        ?>
        <!-- <label for="message">Message </label> -->
        <input type="text" id="message" name="message" placeholder="Message">
        <input type="submit" value="Send">

    </form>
  </div>

<script>
    $(document).ready(function(){
        function getData(){
            $.ajax({
                type: 'POST',
                url: 'data.php',
                success: function(data){
                    $('#output').html(data);
                }
            });
        }
        getData();
        setInterval(function () {
            getData(); 
        }, 1000);  // it will refresh your data every 1 sec

    });
</script>


<script>
function openLeftMenu() {
  document.getElementById("leftMenu").style.display = "block";
}

function closeLeftMenu() {
  document.getElementById("leftMenu").style.display = "none";
}

function openRightMenu() {
  document.getElementById("rightMenu").style.display = "block";
}

function closeRightMenu() {
  document.getElementById("rightMenu").style.display = "none";
}
</script>

</body>
</html>