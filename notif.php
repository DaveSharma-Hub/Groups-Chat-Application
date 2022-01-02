<?php
  include 'session.php';
  include 'mainConnection.php';
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

<style>
* {
  box-sizing: border-box;
}

body {
  font: 16px Arial;  
  text-align:center;
}

input {
  border: 1px solid transparent;
  background-color: #f1f1f1;
  padding: 10px;
  font-size: 16px;
}

input[type=text] {
  background-color: #f1f1f1;
  width: 100%;
}

input[type=submit] {
  background-color: DodgerBlue;
  color: #fff;
  cursor: pointer;
  display:inline-block;
}
.w3-card-4{
    display:inline-block;
    width:35%;
}
#sideGroup input[type="radio"]{
  float:left;
}
img{
  border-radius:10px;
}

.w3-bar-item .badge {
  position: absolute;
  top: 340px;
  right: 50px;
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
  <a href="main.php" class="w3-bar-item w3-button"><img src="main.png" alt='Avatar' width="25%">Main Page</a>
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
       
        echo "<ul><form action='teamschat/inter.php' method='post'>";
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
  <a href="createGroup.php" class="w3-bar-item w3-button">Create Group<img src="groups.jpg" alt='Avatar' width="25%"></a>
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
        echo "<a href='notif.php' class='w3-bar-item w3-button'> Notification <img src='notif.png' alt='Avatar' width='20%'>";
       // echo "<div id='newNotif'><p>".$number."</p></div>";
       if($number>0){
          echo "<span class='badge'>".$number."</span>";
          echo "</a>";
       }else{
        echo "</a>";
       }
      }
    ?>
  <a href="preventReverse.php" class="w3-bar-item w3-button">Logout<img src='logout.png' alt='Avatar' width='20%'></a>
</div>

<div class="w3-sidebar w3-bar-block w3-card w3-animate-right w3-indigo" style="display:none;right:0;" id="rightMenu">
  <button onclick="closeRightMenu()" class="w3-bar-item w3-button w3-large">Close &times;</button>
  <a href="editPersonal.php" class="w3-bar-item w3-button">Edit Personal Information</a>
  <a href="viewPersonal.php" class="w3-bar-item w3-button">View Information</a>
</div>

<div class="w3-indigo">
  <button class="w3-button w3-indigo w3-xlarge w3-left" onclick="openLeftMenu()">&#9776;</button>
  <button class="w3-button w3-indigo w3-xlarge w3-right" onclick="openRightMenu()">&#9776;</button>
  <div class="w3-container">
    <?php
    if($email=="--"){
      header('Location: login.html');
    }else{
      echo "<h1>User: ".$email."</h1>";
    }
    ?>
  </div>
</div>

<h2>Friend Request List: </h2>

    <?php
       $stmt =  $connection->prepare("select * from login where email=?");
       $stmt->bind_param("s",$email);
       $stmt->execute();
       $stmt_result = $stmt->get_result();
       if($stmt_result->num_rows>0){
            $data = $stmt_result->fetch_assoc();
            $toID = $data['loginID'];

            $stmt = $connection->prepare("select * from friends where toID=?");
            $stmt->bind_param("i",$toID);
            $stmt->execute();
            $stmt_result = $stmt->get_result();

            while($data = $stmt_result->fetch_array()){
                if($data['accepted']==0){

                    $stmt2 =  $connection->prepare("select * from login where loginID=?");
                    $stmt2->bind_param("i",$data['fromID']);
                    $stmt2->execute();
                    $stmt2_result = $stmt2->get_result();
                    if($stmt2_result->num_rows>0){
                            $data2 = $stmt2_result->fetch_assoc();
                            $fromEmail = $data2['email'];
                            echo "<div class='w3-container'>
                            <div class='w3-card-4 w3-dark-grey' style='display:inline-block width:50%'>";
                            echo " <div class='w3-container w3-center'>
                            <h3>Friend Request</h3>
                            <img src='friend.png' alt='Avatar' style='width:80%'>
                            <h5>".$fromEmail."</h5>
                      
                            <div class='w3-section'>
                               <form action='friendRequest.php' method='POST'>
                               <input type='submit' value='Accept ".$fromEmail."' name='choice'>
                               <input type='submit' value='Decline ".$fromEmail."' name='choice'>
                                </form>
                            </div>
                             </div>";
                             echo "</div>
                                    </div>";
                    }
                }
                 
            }
            
       }


    ?>



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
