<?php
include("../include/connect.php");
session_start();
// complete order
if (isset($_GET['action']) && $_GET['action'] == 'complete') {
    $uid = $_GET['oid'];
    $select = "SELECT * FROM `checkout` WHERE `uid`='$uid' ";
    $srun = mysqli_query($conn, $select);
    $fetch = mysqli_fetch_assoc($srun);
    $o_status = ($fetch['o_status'] == 'complete') ? 'pending' : 'complete';
    $sql = "UPDATE `checkout` SET `o_status`='$o_status' WHERE `uid`='$uid'";
    $run = mysqli_query($conn, $sql);
    if ($run)
        echo 1;
    else
        echo 2;
}
// cancel order
if (isset($_GET['action']) && $_GET['action'] == 'cancel') {
    $invoice = $_GET['invoice'];
    $sql = "SELECT * FROM `admin_order` WHERE `invoice`='$invoice'";
    $run = mysqli_query($conn, $sql);
    while ($fetch = mysqli_fetch_assoc($run)) {
        $pcode = $fetch['pcode'];
        $pqty = $fetch['pqty'];
        $select = "UPDATE `product` SET `pstock`=`pstock`+$pqty WHERE `pcode`='$pcode' ";
        $prun = mysqli_query($conn, $select);
        $msg = $prun ? 'right' : 'not right';
        if ($msg == 'not right')
            break;
    }
    if ($msg == 'right') {
        $dsql = "DELETE FROM `admin_order` WHERE `invoice`='$invoice' ";
        $drun = mysqli_query($conn, $dsql);
        if ($drun) {
            $dsql = "DELETE FROM `checkout` WHERE `invoice`='$invoice' ";
            $drun = mysqli_query($conn, $dsql);
            echo 1; // canceled
        } else {
            echo 2; // not canceled 
        }
    } else {
        echo 2; // not canceled
    }
}
