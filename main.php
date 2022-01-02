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
  background-color:transparent;
}

body {
  font: 16px Arial;  
  text-align:center; 
}

/*the container must be positioned relative:*/
.autocomplete {
  position: relative;
  display: inline-block;
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
}

.name input[type=submit] {
  background-color: #33c1ff;
  color: #fff;
  float:left;
}

.autocomplete-items {
  position: absolute;
  border: 1px solid #d4d4d4;
  border-bottom: none;
  border-top: none;
  z-index: 99;
  /*position the autocomplete items to be the same width as the container:*/
  top: 100%;
  left: 0;
  right: 0;
}

.autocomplete-items div {
  padding: 10px;
  cursor: pointer;
  background-color: #fff; 
  border-bottom: 1px solid #d4d4d4; 
}

/*when hovering an item:*/
.autocomplete-items div:hover {
  background-color: #e9e9e9; 
}

/*when navigating through the items using the arrow keys:*/
.autocomplete-active {
  background-color: DodgerBlue !important; 
  color: #ffffff; 
}

html, body {
  font-family: sans-serif;
  width: 100%;
  height: 100%;
  margin: 0;
  align-items:center;
}

#friend-list { 
  display: inline-block;
  margin: 0;
  padding: 0;
  width: 400px;
  height: 50%;
  background: #EEE;
  list-style-type: none;
  overflow:auto;
  margin-top:20px;

}

.friend {
  
  width: 400px;
  height: 80px;
  background: #EEE;
  border-bottom: 1px solid #DDD;
  cursor: pointer;
  display: flex;
  align-items: center;
}

.friend img {
  width: 45px;
  height: 45px;
  border-radius: 30px;
  border: 2px solid #AAA;
  object-fit: cover;
  margin-left: 5px;
  margin-right: 10px;
}

.friend .name {
  font-size: 18px;
}

.friend.selected {
  background: #43A047;
  color: white;
}

.friend.selected img {
  border-color: white;
}

.friend:not(.selected):hover {
  background: #DDD;
}
#sideGroup input[type="submit"]{
  background-color:Dodgerblue;
  width:40%;
  height:15%;
  padding:8px 8px;
  margin-left:50px;
  text-align:center;
  border-radius:10px;
}
#sideGroup input[type="radio"]{
  width:30%;
  float:left;
}

#leftMenu a{
  color:white;
  font-size:large;
  background-color:transparent;
  background:transparent;
}
#leftMenu img{
  background:transparent;
  border-radius:10px;
  margin-right:2px;
}
#newNotif{
  background-color:red;
  color:white;
  width:10%;
  float:left;
  max-height:10px;
  border-radius:10px;
}
#notif{
  float:left;
}
.w3-bar-item .badge {
  position: absolute;
  top: 405px;
  right: 40px;
  padding: 5px 10px;
  border-radius: 50%;
  background-color: red;
  color: white;
}
img{
  margin-left:3px;
  border-radius:50px;
  margin-right:10px;
}

</style>
</head>     
<body>
<div class="w3-sidebar w3-bar-block w3-card w3-animate-left w3-indigo" style="display:none" id="leftMenu">
  <button onclick="closeLeftMenu()" class="w3-bar-item w3-button w3-large">Close &times;</button>
  <a href="main.php" class="w3-bar-item w3-button"><img src="main.png" alt='Avatar' width="25%">Main Page</a>
  <br>
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
       
        echo "<form action='inter.php' method='post'>";
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
        echo "<br><input type='submit' value='View'>";
        echo "</form></div>";        
    }
  
  ?>
  <br>
  <br>
  <a href="createGroup.php" class="w3-bar-item w3-button"> Create Group <img src="groups.jpg" alt='Avatar' width="25%"></a>
  <br>
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
  <br>
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
      echo "<h1><img src='logo.jpg' alt='Avatar' width='10%'>User: ".$email."</h1>";
    }
    ?>
  </div>
</div>


<p>Search Friends:</p>

<!--Make sure the form has the autocomplete function switched off:-->
<form autocomplete="off" action="makeFriends.php" method="POST">
  <div class="autocomplete" style="width:300px;">
    <input id="myInput" type="text" name="friends" required>
  </div>
  <input type="submit" value="Add">
</form>
<br><br>
<p>Friends List:</p>

<ul id='friend-list'>
<?php
  $statement = $connection->prepare("select * from login where email=?");
  $statement->bind_param("s",$email);
  $statement->execute();
  $result = $statement->get_result();
  if($result->num_rows>0){
      $data = $result->fetch_assoc();
      $loginID = $data['loginID'];

    $statement = $connection->prepare("select * from friends where fromID=?");
    $statement->bind_param("i",$loginID);
    $statement->execute();
    $result = $statement->get_result();
    while($data = $result->fetch_array()){
      
      $statement2 = $connection->prepare("select * from login where loginID=?");
      $statement2->bind_param("i",$data['toID']);
      $statement2->execute();
      $result2 = $statement2->get_result();
      if($result2->num_rows>0){
        $friend = $result2->fetch_assoc();
        $friendEmail = $friend['email'];
        if($data['accepted']==1){
          echo "<li class='friend selected'>";
          echo "<div class='name'>";
          // echo "&nbsp;".$friendEmail."&nbsp;&nbsp;&nbsp;&nbsp;
        // echo &nbsp;&nbsp;&nbsp; Accepted";
          echo "<form id='personalChat' action='personalChat.php' method='POST'>";
          echo "<input type='submit' value='Chat with&nbsp;".$friendEmail."' id='login-form-submit' name='chat'>";
          echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
          echo "<label for='personalChat' value='".$friendEmail."' name='label'><b>".$friendEmail."&nbsp;&nbsp;&nbsp; Accepted</b></label>";
          echo "</form>";
          echo "</div>";
          echo "</li>";
        }
        else if($data['accepted']==0){
          echo "<li class='friend'>";
          echo "<div class='name'>";
          echo  "&nbsp;".$friendEmail."&nbsp;&nbsp;&nbsp;&nbsp;
          &nbsp;&nbsp;&nbsp; Not Accepted";
          echo "</div>";
          echo "</li>";
        }
      }
    }
  }
?>
</ul>

  

<?php
  $stmt = $connection->prepare("select * from login");
  $array = array();
  $stmt->execute();
  $stmt_result = $stmt->get_result();
    while($data=$stmt_result->fetch_array()){
        array_push($array,$data['email']);
    }
  
?>
<script>
function autocomplete(inp, arr) {
  /*the autocomplete function takes two arguments,
  the text field element and an array of possible autocompleted values:*/
  var currentFocus;
  /*execute a function when someone writes in the text field:*/
  inp.addEventListener("input", function(e) {
      var a, b, i, val = this.value;
      /*close any already open lists of autocompleted values*/
      closeAllLists();
      if (!val) { return false;}
      currentFocus = -1;
      /*create a DIV element that will contain the items (values):*/
      a = document.createElement("DIV");
      a.setAttribute("id", this.id + "autocomplete-list");
      a.setAttribute("class", "autocomplete-items");
      /*append the DIV element as a child of the autocomplete container:*/
      this.parentNode.appendChild(a);
      /*for each item in the array...*/
      for (i = 0; i < arr.length; i++) {
        /*check if the item starts with the same letters as the text field value:*/
        if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
          /*create a DIV element for each matching element:*/
          b = document.createElement("DIV");
          /*make the matching letters bold:*/
          b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
          b.innerHTML += arr[i].substr(val.length);
          /*insert a input field that will hold the current array item's value:*/
          b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
          /*execute a function when someone clicks on the item value (DIV element):*/
          b.addEventListener("click", function(e) {
              /*insert the value for the autocomplete text field:*/
              inp.value = this.getElementsByTagName("input")[0].value;
              /*close the list of autocompleted values,
              (or any other open lists of autocompleted values:*/
              closeAllLists();
          });
          a.appendChild(b);
        }
      }
  });
  /*execute a function presses a key on the keyboard:*/
  inp.addEventListener("keydown", function(e) {
      var x = document.getElementById(this.id + "autocomplete-list");
      if (x) x = x.getElementsByTagName("div");
      if (e.keyCode == 40) {
        /*If the arrow DOWN key is pressed,
        increase the currentFocus variable:*/
        currentFocus++;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 38) { //up
        /*If the arrow UP key is pressed,
        decrease the currentFocus variable:*/
        currentFocus--;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 13) {
        /*If the ENTER key is pressed, prevent the form from being submitted,*/
        e.preventDefault();
        if (currentFocus > -1) {
          /*and simulate a click on the "active" item:*/
          if (x) x[currentFocus].click();
        }
      }
  });
  function addActive(x) {
    /*a function to classify an item as "active":*/
    if (!x) return false;
    /*start by removing the "active" class on all items:*/
    removeActive(x);
    if (currentFocus >= x.length) currentFocus = 0;
    if (currentFocus < 0) currentFocus = (x.length - 1);
    /*add class "autocomplete-active":*/
    x[currentFocus].classList.add("autocomplete-active");
  }
  function removeActive(x) {
    /*a function to remove the "active" class from all autocomplete items:*/
    for (var i = 0; i < x.length; i++) {
      x[i].classList.remove("autocomplete-active");
    }
  }
  function closeAllLists(elmnt) {
    /*close all autocomplete lists in the document,
    except the one passed as an argument:*/
    var x = document.getElementsByClassName("autocomplete-items");
    for (var i = 0; i < x.length; i++) {
      if (elmnt != x[i] && elmnt != inp) {
        x[i].parentNode.removeChild(x[i]);
      }
    }
  }
  /*execute a function when someone clicks in the document:*/
  document.addEventListener("click", function (e) {
      closeAllLists(e.target);
  });
}

/*An array containing all the country names in the world:*/
var countries =  <?php echo json_encode($array); ?>;
/*initiate the autocomplete function on the "myInput" element, and pass along the countries array as possible autocomplete values:*/
autocomplete(document.getElementById("myInput"), countries);
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
