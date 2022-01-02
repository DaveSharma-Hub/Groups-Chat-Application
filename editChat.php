<?php
    include 'session.php';
    include 'mainConnection.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> 
    <script>

    </script>

</head>

<style>
    body {font-family: Arial, Helvetica, sans-serif;
    text-align: center;
      font-size:large;
}
* {box-sizing: border-box}
form {
    border: 3px solid #f1f1f1;
    /* max-width: 40%; */
    display: inline-block;
}
/* Full-width input fields */
input[type=text], input[type=password] {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  display: inline-block;
  border: none;
  background: #f1f1f1;
}

input[type=text]:focus, input[type=password]:focus {
  background-color: #ddd;
  outline: none;
}

hr {
  border: 1px solid #f1f1f1;
  margin-bottom: 25px;
}

/* Set a style for all buttons */
button {
  background-color: blue;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  /* width: 100%; */
  opacity: 0.9;
}

button:hover {
  opacity:1;
}

/* Extra styles for the cancel button */
.cancelbtn {
  padding: 14px 20px;
  background-color: light-blue;
}

/* Float cancel and signup buttons and add an equal width */
.cancelbtn, .signupbtn {
  float: center;
  width: 50%;
}

/* Add padding to container elements */
.container {
  padding: 16px;
}

/* Clear floats */
.clearfix::after {
  content: "";
  clear: both;
  display: table;
}

/* Change styles for cancel button and signup button on extra small screens */
@media screen and (max-width: 300px) {
  .cancelbtn, .signupbtn {
     width: 100%;
  }
}

#content{
    width: 50%;
    margin: 20px auto;
    border: 1px solid #cbcbcb;
}
/* form{
    width: 50%;
    margin: 20px auto;
}
form div{
    margin-top: 5px;
} */
#img_div{
    width: 80%;
    padding: 5px;
    margin: 15px auto;
    border: 1px solid #cbcbcb;
}
#img_div:after{
    content: "";
    display: block;
    clear: both;
}
img{
    border-radius:10px;
}
#sideGroup form{
  border:0px;
  width:100%;
}

#sideGroup input[type="submit"]{
  border-radius:7px;
  background-color:Dodgerblue;
  border-color:transparent;
  color:white;
  padding:8px 8px;
}
#sideGroup input[type="radio"]{
  float:left;
}
.w3-bar-item .badge {
  position: absolute;
  top: 430px;
  right: 43px;
  padding: 5px 12px;
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

  <a href="createGroup.php" class="w3-bar-item w3-button">Create Group <img src='groups.jpg' alt='Avatar' width='20%'></a><br>
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
  <a href="editChat.php" class="w3-bar-item w3-button">Edit Chat</a>
  <a href="#" class="w3-bar-item w3-button">Link 2</a>
  <a href="#" class="w3-bar-item w3-button">Link 3</a>
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
   
  <div class="w3-container">
  <?php
  
        // session_start();
        $email =$_SESSION['formdata'];
        echo "<h1>Username: ";
        echo $email;
        echo "</h1>";

        // session_start();
        // $email =$_SESSION['formdata'];
        session_abort();

        

  
    ?>
  
  </div>
    <?php
    // session_start();
    $holder=$_SESSION['formdata']; //or whatever
    $_SESSION['formdata'] = $holder; 
    ?>
  <form action="edit.php" method="post" style="border:1px solid #ccc">
        <div class="container">
          <h1>Change Group Name</h1>
          <p>Please type new group name</p>
          <hr>
      
          <label for="psw"><b>Name</b></label>
          <input type="text" placeholder="Enter Name" name="name" required>
      
          <label for="psw-repeat"><b>Give Roles</b></label>
          <input type="text" placeholder="Repeat Password" name="roles">
              
          <div class="clearfix">
            <button type="submit" class="signupbtn">Update</button>
            <button type="button" class="Log In" onclick="window.location.href='chat.php';">Back</button>  
          </div>
        </div>
      </form>
    </div>
  
  
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
