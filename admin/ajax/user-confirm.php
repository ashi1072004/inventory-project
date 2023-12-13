<?php
include("../include/connect.php");
// --------------------------- User Confirm --------------------------------
if (isset($_GET['conid'])) {
    $conid = $_GET['conid'];
    $sql = "SELECT * FROM `user` WHERE `uid`='$conid' ";
    $run = mysqli_query($conn, $sql);
    $fetch = mysqli_fetch_assoc($run);
    if ($fetch['ustatus'] == "Pending") {
        $ustatus = 'Confirmed';
    } else {
        $ustatus = 'Pending';
    }
    $update = "UPDATE `user` SET `ustatus`='$ustatus' WHERE `uid`='$conid' ";
    $run = mysqli_query($conn, $update);
    if ($run) {
        echo 1;
    } else {
        echo 2;
    }
}
