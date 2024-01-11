<?php
include("../include/connect.php");
session_start();
// complete order
if (isset($_GET['action']) && $_GET['action'] == 'complete') {
    $ucid = $_GET['oid'];
    $select = "SELECT * FROM `checkout` WHERE `ucid`='$ucid' ";
    $srun = mysqli_query($conn, $select);
    $fetch = mysqli_fetch_assoc($srun);
    $o_status = ($fetch['o_status'] == 'complete') ? 'pending' : 'complete';
    $sql = "UPDATE `checkout` SET `o_status`='$o_status' WHERE `ucid`='$ucid'";
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
    if (mysqli_num_rows($run) > 0) {
        while ($fetch = mysqli_fetch_assoc($run)) {
            $pcode = $fetch['pcode'];
            $pqty = $fetch['pqty'];
            $select = "UPDATE `product` SET `pstock`=`pstock`+$pqty WHERE `pcode`='$pcode' ";
            $prun = mysqli_query($conn, $select);
            if ($prun) {
                $dsql = "DELETE FROM `admin_order` WHERE `invoice`='$invoice' AND `pcode`='$pcode' ";
                $drun = mysqli_query($conn, $dsql);
            } else {
                exit;
            }
        }
    }
    $dsql = "DELETE FROM `checkout` WHERE `invoice`='$invoice' ";
    $drun = mysqli_query($conn, $dsql);
    if ($drun) {
        echo 1; // canceled
    } else {
        echo 2; // not canceled 
    }
}
