<?php
include('../../admin/include/connect.php');
session_start();
$uemail = mysqli_real_escape_string($conn, $_POST['uemail']);
$upass = mysqli_real_escape_string($conn, $_POST['upass']);

$select = "SELECT * FROM `user` WHERE `uemail`='$uemail' AND `upass`='$upass' AND `ustatus`='Confirmed' ";
$run = mysqli_query($conn, $select);
if (mysqli_num_rows($run) == 1) {
    $fetch = mysqli_fetch_assoc($run);
    $_SESSION['email'] = $fetch['uemail'];
    echo 1;
    // header('Location: ../index.php');
    // .!empty($_SERVER['HTTP_REFERER']) ? 
    //   $_SERVER['HTTP_REFERER'] : 
} else {
    echo 2;
}
