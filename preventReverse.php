<?php
    //include 'main.php';
    include 'session.php';
    
    $email="--";
    $_SESSION['formdata']="--";
    session_abort();
    header('Location: login.html');
?>