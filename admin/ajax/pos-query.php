<?php
include("../include/connect.php");
session_start();
// Delete Product from Cart
if (isset($_GET['delaid'])) {
    $aid = $_GET['delaid'];
    $aemail = $_SESSION['email'];
    $del = "DELETE FROM `add_to_cart` WHERE `aid` = '$aid' and `aemail` = '$aemail' ";
    $drun = mysqli_query($conn, $del);
    if ($drun) {
        echo 1;
    } else {
        echo 2;
    }
}
// Delete Product from Cart
if (isset($_GET['empty'])) {
    $aemail = $_SESSION['email'];
    $del = "DELETE FROM `add_to_cart` WHERE `aemail` = '$aemail' ";
    $drun = mysqli_query($conn, $del);
    if ($drun) {
        echo 1;
    } else {
        echo 2;
    }
}
// Add Stock
if (isset($_POST['pqty'])) {
    $pid = $_POST['pid'];
    $pqty = $_POST['pqty'];

    if ($pqty < 0) {
        echo 1;
    } else {
        $select = "SELECT * FROM `product` WHERE `pid`='$pid' ";
        $run = mysqli_query($conn, $select);
        $fetch = mysqli_fetch_assoc($run);
        $pcode = $fetch['pcode'];
        $pname = $fetch['pname'];
        $psale = $fetch['psale'];
        $pstock = $fetch['pstock'];
        $aemail = $_SESSION['email'];
        if (mysqli_num_rows($run) > 0) {
            if ($pstock > 0) {
                $psql = "SELECT * FROM `add_to_cart` WHERE `pcode`='$pcode' AND `pname`='$pname' ";
                $prun = mysqli_query($conn, $psql);
                if (mysqli_num_rows($prun) > 0) {
                    echo 2; //product already in cart
                } else {
                    $ptprice = $psale * $pqty;
                    $insert = "INSERT INTO `add_to_cart`(`pcode`, `pname`, `pstock`, `pprice`, `pqty`, `ptprice`, `aemail`)VALUES('$pcode', '$pname', '$pstock', '$psale', '$pqty', '$ptprice', '$aemail')";
                    $arun = mysqli_query($conn, $insert);
                    if ($arun) {
                        echo 3; //inserted
                    } else {
                        echo 4; //not inserted
                    }
                }
            } else {
                echo 5; //Out of stock

            }
        }
    }
}
// increment quantity
if (isset($_GET['aqty'])) {
    $aqty = $_GET['aqty'];
    $pcode = $_GET['acode'];
    $pname = $_GET['aname'];
    $aemail = $_SESSION['email'];

    if ($aqty < 0) {
        echo 1;
    } else {
        $select = "SELECT * FROM `product` WHERE `pcode`='$pcode' AND `pname`='$pname' ";
        $run = mysqli_query($conn, $select);
        $fetch = mysqli_fetch_assoc($run);
        $pstock = $fetch['pstock'];
        $pprice = $fetch['psale'];
        if (mysqli_num_rows($run) == 1) {
            if ($pstock > 0) {
                $ptprice = $pprice * $aqty;
                $psql = "UPDATE `add_to_cart` SET `pqty`='$aqty', `ptprice`='$ptprice' WHERE `pcode`='$pcode' AND `aemail`='$aemail' ";
                $prun = mysqli_query($conn, $psql);
                if ($prun) {
                    echo 2; //inserted
                } else {
                    echo 3; //not inserted
                }
            } else {
                echo 4; //Out of stock
            }
        }
    }
}
// Insert POS
if (isset($_POST['sub'])) {
    $invoice = mysqli_real_escape_string($conn, $_POST['invoice']);
    $csname = mysqli_real_escape_string($conn, $_POST['csname']);
    $cmob = mysqli_real_escape_string($conn, $_POST['cmob']);
    $tprice = mysqli_real_escape_string($conn, $_POST['tprice']);
    $ostatus = mysqli_real_escape_string($conn, $_POST['ostatus']);
    $aemail = $_SESSION['email'];

    if ($invoice == "" || $csname == "" || $cmob == "" || $ostatus == "none") {
        echo 1; //check inputs
    } else {
        $insert = "INSERT INTO `pos`(`invoice`, `csname`, `cmob`, `tprice`, `ostatus`)VALUES('$invoice', '$csname', '$cmob', '$tprice', '$ostatus')";
        $run = mysqli_query($conn, $insert);
        if ($run) {
            $asql = "SELECT * FROM `add_to_cart` WHERE `aemail`='$aemail' ";
            $arun = mysqli_query($conn, $asql);
            while ($fetch = mysqli_fetch_assoc($arun)) {
                $pcode = $fetch['pcode'];
                $pname = $fetch['pname'];
                $pprice = $fetch['pprice'];
                $pqty = $fetch['pqty'];
                $ptprice = $fetch['ptprice'];
                $osql = "INSERT INTO `admin_order`(`invoice`, `pcode`, `pname`, `pprice`, `pqty`, `ptprice`, `aemail`)VALUES('$invoice', '$pcode', '$pname', '$pprice', '$pqty', '$ptprice', '$aemail')";
                $orun = mysqli_query($conn, $osql);
            }
            $odel = "DELETE FROM `add_to_cart` WHERE `aemail` = '$aemail' ";
            $orun = mysqli_query($conn, $odel);
            if ($orun) {
                echo 2; //inserted
            }
        } else {
            echo 3; //not inserted
        }
    }
}
