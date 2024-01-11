<?php
include('../../admin/include/connect.php');
// ----------------------------- User Register--------------------------------
if (isset($_POST['usub'])) {
    $ufname = mysqli_real_escape_string($conn, $_POST['ufname']);
    $ulname = mysqli_real_escape_string($conn, $_POST['ulname']);
    $uemail = mysqli_real_escape_string($conn, $_POST['uemail']);
    $umob = mysqli_real_escape_string($conn, $_POST['umob']);
    $country = mysqli_real_escape_string($conn, $_POST['country']);
    $state = mysqli_real_escape_string($conn, $_POST['state']);
    $city = mysqli_real_escape_string($conn, $_POST['city']);
    $add1 = mysqli_real_escape_string($conn, $_POST['add1']);
    $add2 = mysqli_real_escape_string($conn, $_POST['add2']);
    $pt_code = mysqli_real_escape_string($conn, $_POST['pt_code']);
    $upass = mysqli_real_escape_string($conn, $_POST['upass']);
    $ucpass = mysqli_real_escape_string($conn, $_POST['ucpass']);
    $ustatus = 'Pending';
    $udate = date("Y/m/d");

    if ($ufname == "" || $uemail == "" || $upass == "" || $ucpass == "") {
        echo 1; //fields cannot be empty
    } else {
        $select = "SELECT * FROM `user` WHERE `uemail`='$uemail'";
        $crun = mysqli_query($conn, $select);
        if (mysqli_num_rows($crun) > 0) {
            echo 2; //email already exists
        } else {
            if ($upass == $ucpass) {
                $insert = "INSERT INTO `user`(`ufname`, `ulname`, `uemail`, `umob`, `country`, `state`, `city`, `add1`, `add2`, `pt_code`, `upass`, `ustatus`, `udate`)VALUES('$ufname', '$ulname', '$uemail', '$umob', '$country', '$state', '$city', '$add1', '$add2', '$pt_code', '$upass', '$ustatus','$udate')";
                $run = mysqli_query($conn, $insert);
                if ($run) {
                    echo 3; //inserted
                } else {
                    echo 4; // not inserted
                }
            } else {
                echo 5; // passwords don't match
            }
        }
    }
}
// ----------------------------- User Edit--------------------------------
if (isset($_POST['uid'])) {
    $uid = mysqli_real_escape_string($conn, $_POST['uid']);
    $ufname = mysqli_real_escape_string($conn, $_POST['ufname']);
    $ulname = mysqli_real_escape_string($conn, $_POST['ulname']);
    $umob = mysqli_real_escape_string($conn, $_POST['umob']);
    $country = mysqli_real_escape_string($conn, $_POST['country']);
    $state = mysqli_real_escape_string($conn, $_POST['state']);
    $city = mysqli_real_escape_string($conn, $_POST['city']);
    $add1 = mysqli_real_escape_string($conn, $_POST['add1']);
    $add2 = mysqli_real_escape_string($conn, $_POST['add2']);
    $pt_code = mysqli_real_escape_string($conn, $_POST['pt_code']);

    if ($ufname == "") {
        echo 1; //fields cannot be empty
    } else {
        $upsql = "UPDATE `user` SET `ufname`='$ufname', `ulname`='$ulname', `umob`='$umob', `country`='$country', `state`='$state', `city`='$city', `add1`='$add1', `add2`='$add2', `pt_code`='$pt_code' WHERE `uid`='$uid' ";
        $run = mysqli_query($conn, $upsql);
        if ($run) {
            echo 2; //updated
        } else {
            echo 3; // not updated
        }
    }
}
