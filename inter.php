<?php
    include 'session.php';
    $groupID = $_POST['groupID'];
     //session_start();
    echo ($groupID);
    if($groupID!=''){
        $_SESSION['groupID']=$groupID;
        header('Location: chat.php');
    }
    else{
        header('Location: viewGroups.php');
    }
?>