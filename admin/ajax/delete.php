<?php
include("../include/connect.php");

// Delete Coupon
if (isset($_GET['delcuid'])) {
    $cuid = $_GET['delcuid'];
    $del = "DELETE FROM `coupon` WHERE `cuid` = '$cuid' ";
    $drun = mysqli_query($conn, $del);
    if ($drun) {
        echo 1;
    } else {
        echo 2;
    }
}
// Delete Staff
if (isset($_GET['delaid'])) {
    $aid = $_GET['delaid'];
    $del = "DELETE FROM `admin` WHERE `adid` = '$aid' ";
    $drun = mysqli_query($conn, $del);
    if ($drun) {
        echo 1;
    } else {
        echo 2;
    }
}
// Delete Order
if (isset($_GET['deloid'])) {
    $invoice = $_GET['deloid'];
    // also delete record from admin_order matching the invoice
    $select = "SELECT * FROM `admin_order` WHERE `invoice` = '$invoice' ";
    $run = mysqli_query($conn, $select);
    while ($fetch = mysqli_fetch_assoc($run)) {
        $pqty = $fetch['pqty'];
        $pcode = $fetch['pcode'];
        // change stock
        $upsql = "UPDATE `product` SET `pstock`=`pstock`+$pqty WHERE `pcode`='$pcode' ";
        $uprun = mysqli_query($conn, $upsql);
    }

    $adel = "DELETE FROM `admin_order` WHERE `invoice` = '$invoice' ";
    $arun = mysqli_query($conn, $adel);

    if ($arun) {
        $del = "DELETE FROM `pos` WHERE `invoice` = '$invoice' ";
        $drun = mysqli_query($conn, $del);
        if ($drun) {
            echo 1; //deleted
        }
    } else {
        echo 2; //not deleted
    }
}
// Delete User
if (isset($_GET['deluid'])) {
    $uid = $_GET['deluid'];
    $del = "DELETE FROM `user` WHERE `uid` = '$uid' ";
    $drun = mysqli_query($conn, $del);
    if ($drun) {
        echo 1;
    } else {
        echo 2;
    }
}
// Delete Category
if (isset($_GET['delcid'])) {
    $cid = $_GET['delcid'];
    $del = "DELETE FROM `category` WHERE `cid` = '$cid' ";
    $drun = mysqli_query($conn, $del);
    if ($drun) {
        echo 1;
    } else {
        echo 2;
    }
}
// Delete Sub-Category
if (isset($_GET['delsubid'])) {
    $subid = $_GET['delsubid'];
    $del = "DELETE FROM `subcategory` WHERE `subid` = '$subid' ";
    $drun = mysqli_query($conn, $del);
    if ($drun) {
        echo 1;
    } else {
        echo 2;
    }
}
// Delete Supplier
if (isset($_GET['delsupid'])) {
    $supid = $_GET['delsupid'];
    $del = "DELETE FROM `supplier` WHERE `supid` = '$supid' ";
    $drun = mysqli_query($conn, $del);
    if ($drun) {
        echo 1;
    } else {
        echo 2;
    }
}
// Delete Quantity/Measurement
if (isset($_GET['delmid'])) {
    $mid = $_GET['delmid'];
    $mdel = "DELETE FROM `measure` WHERE `mid` = '$mid' ";
    $drun = mysqli_query($conn, $mdel);
    if ($drun) {
        echo 1;
    } else {
        echo 2;
    }
}
// Delete Product
if (isset($_GET['delpid'])) {
    $pid = $_GET['delpid'];
    $psql = "SELECT `ppic` FROM `product` WHERE `pid`='$pid' ";
    $prun = mysqli_query($conn, $psql);
    $fetch = mysqli_fetch_assoc($prun);
    $pics = unserialize($fetch['ppic']);
    if (!empty($pics)) {
        foreach ($pics as $p) {
            unlink('../assets/img/products/' . $p);
        }
    }
    $pdel = "DELETE FROM `product` WHERE `pid` = '$pid' ";
    $drun = mysqli_query($conn, $pdel);
    if ($drun) {
        echo 1;
    } else {
        echo 2;
    }
}
// Delete Role
if (isset($_GET['delrid'])) {
    $rid = $_GET['delrid'];
    $del = "DELETE FROM `role` WHERE `rid` = '$rid' ";
    $drun = mysqli_query($conn, $del);
    if ($drun) {
        echo 1;
    } else {
        echo 2;
    }
}
