<?php
    include "session.php";
    include "mainConnection.php";
?>

<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

<style>
* {
  box-sizing: border-box;
}

body {
  /* background-color: #f1f1f1; */
    background-color: #3a3a3a;
}

#regForm {
  background-color: #ffffff;
  margin: 100px auto;
  font-family: sans-serif;
  padding: 40px;
  width: 70%;
  min-width: 300px;
  border-radius:10px;
}

h1 {
  text-align: center;  
}

input {
  padding: 10px;
  width: 100%;
  font-size: 17px;
  font-family: sans-serif;
  border: 1px solid #aaaaaa;
}

/* Mark input boxes that gets an error on validation: */
input.invalid {
  background-color: #ffdddd;
}

/* Hide all steps by default: */
.tab {
  display: none;
}

button {
  background-color: #04AA6D;
  color: #ffffff;
  border: none;
  padding: 10px 20px;
  font-size: 17px;
  font-family: sans-serif;
  cursor: pointer;
}

button:hover {
  opacity: 0.8;
}

#prevBtn {
  background-color: #bbbbbb;
}

input[type=submit]{
    background-color: #2197ff;
    color:white;
}

input[type=submit]:hover{
    color:white;
    background-color:  #21b8ff;
}
#sideGroup input[type="submit"]{
  background-color:Dodgerblue;
  width:40%;
  height:15%;
  padding:8px 8px;
  margin-left:50px;
  text-align:center;
  border-radius:10px;
  color:white;
  border-color:transparent;
}
#sideGroup input[type="radio"]{
  width:30%;
  float:left;
}
img{
  border-radius:10px;
}
.w3-bar-item .badge {
  position: absolute;
  top: 370px;
  right: 50px;
  padding: 5px 10px;
  border-radius: 50%;
  background-color: red;
  color: white;
}
</style>
<body>
<div class="w3-sidebar w3-bar-block w3-card w3-animate-left w3-indigo" style="display:none" id="leftMenu">
  <button onclick="closeLeftMenu()" class="w3-bar-item w3-button w3-large">Close &times;</button>
  <a href="main.php" class="w3-bar-item w3-button"><img src='main.png' alt='Avatar' width='20%'>Main Page</a>
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
       
        echo "<ul><form action='inter.php' method='post'>";
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
  <a href="createGroup.php" class="w3-bar-item w3-button">Create Group<img src='groups.jpg' alt='Avatar' width='20%'></a><br>
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
        echo "<a href='notif.php' class='w3-bar-item w3-button'>Notification <img src='notif.png' alt='Avatar' width='20%'>";
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
<form id="regForm" action="#" method="post">
  <!-- One "tab" for each step in the form: -->
  <label for="name">Name</label><br>
    <?php
        $stmt = $connection->prepare("select * from login where email=?");
        $stmt->bind_param("s",$email);
        $stmt->execute();

        $stmt_result = $stmt->get_result();
        if($stmt_result->num_rows>0){
            $data = $stmt_result->fetch_assoc();
            echo "<p>First: ".$data['name']."</p>";
            echo "<p>Last: ".$data['Lname']."</p>";
        }
    ?>
  <br><br><label for="email">Email</label><br>
  <?php
            echo "<p>Email: ".$email."</p>";        
    ?>
    
  <br><br><label for="password">Login Info</label><br>
  <?php
        $stmt = $connection->prepare("select * from login where email=?");
        $stmt->bind_param("s",$email);
        $stmt->execute();

        $stmt_result = $stmt->get_result();
        if($stmt_result->num_rows>0){
            $data = $stmt_result->fetch_assoc();
            echo "<p>Username: ".$data['email']."</p>";
        }
    ?>
  </div>
</form>
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
