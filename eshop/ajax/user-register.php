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

    if ($ufname == "" || $ulname == "" || $uemail == "" || $umob == "" || $country == "" || $state == "" || $city == "" || $add1 == "" || $pt_code == "" || $upass == "" || $ucpass == "") {
        echo 1;
    } else {
        if ($upass == $ucpass) {
            $insert = "INSERT INTO `user`(`ufname`, `ulname`, `uemail`, `umob`, `country`, `state`, `city`, `add1`, `add2`, `pt_code`, `upass`, `ucpass`, `ustatus`, `udate`)VALUES('$ufname', '$ulname', '$uemail', '$umob', '$country', '$state', '$city', '$add1', '$add2', '$pt_code', '$upass', '$ucpass', '$ustatus','$udate')";
            $run = mysqli_query($conn, $insert);
            if ($run) {
                // echo "<script> alert('Data Inserted!')</script>";
                echo 2;
            } else {
                // echo "<script> alert('Data Not Inserted!')</script>";
                echo 3;
            }
        } else {
            echo 4;
        }
    }
}
