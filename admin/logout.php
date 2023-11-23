<?php
    include("./include/connect.php");
    session_start();
    if(!empty($_SESSION['email'])){
        session_destroy();
        header('Location: ./login.php');
    }
?>