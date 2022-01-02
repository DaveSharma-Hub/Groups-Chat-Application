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
*{
  box-sizing:border-box;
  text-align:center;
}
body {
  margin: 0 auto;
  width: 100%;
  /* padding: 0 20px; */
  text-align:center;
}

.w3-container2 .container1 {
  border: 2px solid #dedede;
  background-color: #f1f1f1;
  border-radius: 5px;
  padding: 10px;
  margin: 10px 0;
}

.w3-container2 .darker {
  border-color: #ccc;
  background-color: #ddd;
}

.w3-container2 .container1::after {
  clear: both;
  display: table;
}

.w3-container2 .container1 img {
  float: left;
  /* max-width: 60px; */
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
  color: #aaa;
}

.w3-container2 .time-left {
  float: left;
  color: #999;
}
form {
    border: 3px solid #f1f1f1;
     max-width: 50%;
      margin-left:25%;
}

input[type="radio"] {
  /* width: 100%; */
  /* max-width:200vh; */
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}
input[type="submit"]{
  background-color:Dodgerblue;
  width:50%;
  border-radius:10px;
  color:white;
  border-color:white;
  height:50px;
}

button {
  background-color: #097e53;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 10%;
}
ul {
  list-style-type: none;
  padding: 0;
  margin: 0;
  /* height:30vh; */
  overflow:auto;
  width:100%;
}

ul li {
  border: 1px solid white;
  margin-top: -1px; /* Prevent double borders */
  background-color: #d7dbdd ; /* #f6f6f6;*/
  padding: 12px;
  border-radius:10px;
}
.w3-bar-item .badge {
  position: absolute;
  top: 350px;
  right: 40px;
  padding: 5px 10px;
  border-radius: 50%;
  background-color: red;
  color: white;
}
img{
  border-radius:10px;
  margin-right:10px;
}
#sideGroup form{
  border: 0px solid #f1f1f1;
}

#sideGroup input[type="radio"]{
  float:left;
  padding:0px 0px;
  margin:0px 0px;
}
#sideGroup input[type="submit"]{
  border-color:transparent;
}
</style>
</head>
<body>
<div class="w3-sidebar w3-bar-block w3-card w3-animate-left w3-indigo" style="display:none" id="leftMenu">
  <button onclick="closeLeftMenu()" class="w3-bar-item w3-button w3-large">Close &times;</button>
  <a href="http://localhost:3000/Users/Daves/Documents/Practice/teamschat/main.php" class="w3-bar-item w3-button"><img src='main.png' alt='Avatar' width='20%'>Main Page</a>
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
  <a href="http://localhost:3000/Users/Daves/Documents/Practice/teamschat/createGroup.php" class="w3-bar-item w3-button">Create Group<img src='groups.jpg' alt='Avatar' width='20%'></a>
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
        echo "<a href='http://localhost:3000/Users/Daves/Documents/Practice/teamschat/notif.php' class='w3-bar-item w3-button'> Notification<img src='notif.png' alt='Avatar' width='20%'>";
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
  <a href="http://localhost:3000/Users/Daves/Documents/Practice/teamschat/editPersonal.php" class="w3-bar-item w3-button">Edit Personal Information</a>
  <a href="http://localhost:3000/Users/Daves/Documents/Practice/teamschat/viewPersonal.php" class="w3-bar-item w3-button">View Information</a>
  <!-- <a href="#" class="w3-bar-item w3-button">Link 3</a> -->
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
<h1>Choose Group</h1>
<?php
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
                    echo "<li><input type='radio' id='".$rows['groupID']."' name='groupID' value='".$rows['groupID']."'>";
                    echo "<label for='".$rows['groupID']."'>".$rows['groupNAME']."'</label><br></li>";
                }
            }
        }
        echo "<input type='submit' value='View'>";
        echo "</form></ul>";        
    }


  
//   <input type="radio" id="css" name="fav_language" value="CSS">
//   <label for="css">CSS</label><br>
//   <input type="radio" id="javascript" name="fav_language" value="JavaScript">
//   <label for="javascript">Java Script</label><br><br>
//   <input type="submit" value="Submit">
 // <label for="fname" name="fname">First name:</label>
  
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