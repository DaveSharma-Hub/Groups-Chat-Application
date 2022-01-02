
<!-- 
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<style>

body {
  margin: 0 auto;
  width: 100%;
  padding: 0 20px;
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
  color: #aaa;
}

.w3-container2 .time-left {
  float: left;
  color: #999;
}
</style>
</head>
<body>
<div class="w3-sidebar w3-bar-block w3-card w3-animate-left w3-indigo" style="display:none" id="leftMenu">
  <button onclick="closeLeftMenu()" class="w3-bar-item w3-button w3-large">Close &times;</button>
  <a href="http://localhost:3000/Users/Daves/Documents/Practice/teamschat/viewGroups.php" class="w3-bar-item w3-buton">View Groups</a>
  <a href="http://localhost:3000/Users/Daves/Documents/Practice/teamschat/createGroup.php" class="w3-bar-item w3-button">Create Group</a>
  <a href="http://localhost:3000/Users/Daves/Documents/Practice/teamschat/preventReverse.php" class="w3-bar-item w3-button">Logout</a>
</div>

<div class="w3-sidebar w3-bar-block w3-card w3-animate-right w3-indigo" style="display:none;right:0;" id="rightMenu">
  <button onclick="closeRightMenu()" class="w3-bar-item w3-button w3-large">Close &times;</button>
  <a href="#" class="w3-bar-item w3-button">Link 1</a>
  <a href="#" class="w3-bar-item w3-button">Link 2</a>
  <a href="#" class="w3-bar-item w3-button">Link 3</a>
</div>

<div class="w3-indigo">
  <button class="w3-button w3-indigo w3-xlarge w3-left" onclick="openLeftMenu()">&#9776;</button>
  <button class="w3-button w3-indigo w3-xlarge w3-right" onclick="openRightMenu()">&#9776;</button>
  <div class="w3-container">
    
  </div>
</div>
<div class="w3-container2">
  <div class="container1">
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
</html> -->

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
  <a href="http://localhost:3000/Users/Daves/Documents/Practice/teamschat/main.php" class="w3-bar-item w3-button"><img src="main.png" alt='Avatar' width="25%">Main Page</a>
  <br>
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
       
        echo "<form action='http://localhost:3000/Users/Daves/Documents/Practice/teamschat/inter.php' method='post'>";
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
  <a href="http://localhost:3000/Users/Daves/Documents/Practice/teamschat/createGroup.php" class="w3-bar-item w3-button"> Create Group <img src="groups.jpg" alt='Avatar' width="25%"></a>
  <br>
  <!-- <a href="http://localhost:3000/Users/Daves/Documents/Practice/teamschat/notif.php" class="w3-bar-item w3-button"> <img src="notif.png" alt='Avatar' width="20%">Notification -->
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
        echo "<a href='http://localhost:3000/Users/Daves/Documents/Practice/teamschat/notif.php' class='w3-bar-item w3-button'> Notification <img src='notif.png' alt='Avatar' width='20%'>";
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
      echo "<h1><img src='logo.jpg' alt='Avatar' width='10%'>User: ".$email."</h1>";
    }
    ?>
  </div>
</div>


<p>Search Friends:</p>

<!--Make sure the form has the autocomplete function switched off:-->
<form autocomplete="off" action="http://localhost:3000/Users/Daves/Documents/Practice/teamschat/makeFriends.php" method="POST">
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
          echo "<form id='personalChat' action='http://localhost:3000/Users/Daves/Documents/Practice/teamschat/personalChat.php' method='POST'>";
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

  <!-- <li class='friend selected'>
    <div class='name'>
      Andres Perez
    </div>
  </li>
  <li class='friend'>
    <div class='name'>
      Leah Slaten
    </div>
  </li>
  <li class='friend'>
    <div class='name'>
      Mario Martinez
    </div>
  </li>
  <li class='friend'>
    <div class='name'>
      Cynthia Lo
    </div>
  </li>
  <li class='friend'>
    <div class='name'>
      Sally Lin
    </div>
  </li>
  <li class='friend'>
    <div class='name'>
      Danny Tang
    </div>
  </li>
</ul> -->

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
// var countries = ["Afghanistan","Albania","Algeria","Andorra","Angola","Anguilla","Antigua & Barbuda","Argentina","Armenia","Aruba","Australia","Austria","Azerbaijan","Bahamas","Bahrain","Bangladesh","Barbados","Belarus","Belgium","Belize","Benin","Bermuda","Bhutan","Bolivia","Bosnia & Herzegovina","Botswana","Brazil","British Virgin Islands","Brunei","Bulgaria","Burkina Faso","Burundi","Cambodia","Cameroon","Canada","Cape Verde","Cayman Islands","Central Arfrican Republic","Chad","Chile","China","Colombia","Congo","Cook Islands","Costa Rica","Cote D Ivoire","Croatia","Cuba","Curacao","Cyprus","Czech Republic","Denmark","Djibouti","Dominica","Dominican Republic","Ecuador","Egypt","El Salvador","Equatorial Guinea","Eritrea","Estonia","Ethiopia","Falkland Islands","Faroe Islands","Fiji","Finland","France","French Polynesia","French West Indies","Gabon","Gambia","Georgia","Germany","Ghana","Gibraltar","Greece","Greenland","Grenada","Guam","Guatemala","Guernsey","Guinea","Guinea Bissau","Guyana","Haiti","Honduras","Hong Kong","Hungary","Iceland","India","Indonesia","Iran","Iraq","Ireland","Isle of Man","Israel","Italy","Jamaica","Japan","Jersey","Jordan","Kazakhstan","Kenya","Kiribati","Kosovo","Kuwait","Kyrgyzstan","Laos","Latvia","Lebanon","Lesotho","Liberia","Libya","Liechtenstein","Lithuania","Luxembourg","Macau","Macedonia","Madagascar","Malawi","Malaysia","Maldives","Mali","Malta","Marshall Islands","Mauritania","Mauritius","Mexico","Micronesia","Moldova","Monaco","Mongolia","Montenegro","Montserrat","Morocco","Mozambique","Myanmar","Namibia","Nauro","Nepal","Netherlands","Netherlands Antilles","New Caledonia","New Zealand","Nicaragua","Niger","Nigeria","North Korea","Norway","Oman","Pakistan","Palau","Palestine","Panama","Papua New Guinea","Paraguay","Peru","Philippines","Poland","Portugal","Puerto Rico","Qatar","Reunion","Romania","Russia","Rwanda","Saint Pierre & Miquelon","Samoa","San Marino","Sao Tome and Principe","Saudi Arabia","Senegal","Serbia","Seychelles","Sierra Leone","Singapore","Slovakia","Slovenia","Solomon Islands","Somalia","South Africa","South Korea","South Sudan","Spain","Sri Lanka","St Kitts & Nevis","St Lucia","St Vincent","Sudan","Suriname","Swaziland","Sweden","Switzerland","Syria","Taiwan","Tajikistan","Tanzania","Thailand","Timor L'Este","Togo","Tonga","Trinidad & Tobago","Tunisia","Turkey","Turkmenistan","Turks & Caicos","Tuvalu","Uganda","Ukraine","United Arab Emirates","United Kingdom","United States of America","Uruguay","Uzbekistan","Vanuatu","Vatican City","Venezuela","Vietnam","Virgin Islands (US)","Yemen","Zambia","Zimbabwe"];
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