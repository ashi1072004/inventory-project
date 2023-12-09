<?php
include("../include/connect.php");
session_start();
$email = mysqli_real_escape_string($conn, $_POST['email']);
$password = mysqli_real_escape_string($conn, $_POST['password']);

$select = "SELECT * FROM `admin` WHERE `email`='$email' AND `password`='$password'";
$run = mysqli_query($conn, $select);
if (mysqli_num_rows($run) == 1) {
    $fetch = mysqli_fetch_assoc($run);
    $_SESSION['email'] = $fetch['email'];
    echo 1;
    // header('Location: ../index.php');
    // .!empty($_SERVER['HTTP_REFERER']) ? 
    //   $_SERVER['HTTP_REFERER'] : 
} else {
    echo 2;
}
