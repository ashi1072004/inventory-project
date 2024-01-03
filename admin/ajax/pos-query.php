<?php
include("../include/connect.php");
session_start();
// Delete Product from Admin Order
if (isset($_GET['del-order'])) {
    $oid = $_GET['del-order'];
    $del = "DELETE FROM `admin_order` WHERE `order_id` = '$oid' ";
    $drun = mysqli_query($conn, $del);
    if ($drun) {
        echo 1;
    } else {
        echo 2;
    }
}
// Empty Order from invoice
if (isset($_GET['empty-order'])) {
    $invoice = $_GET['empty-order'];

    $del = "DELETE FROM `admin_order` WHERE `invoice` = '$invoice' ";
    $drun = mysqli_query($conn, $del);
    if ($drun) {
        echo 1;
    } else {
        echo 2;
    }
}
// Add Stock to Admin order
if (isset($_POST['admin-add'])) {
    $invoice = $_POST['admin-add'];
    $pid = $_POST['pid'];
    $pqty = $_POST['pqty'];

    if ($pqty < 1) {
        echo 1;
    } else {
        $select = "SELECT * FROM `product` WHERE `pid`='$pid' ";
        $run = mysqli_query($conn, $select);
        if (mysqli_num_rows($run) > 0) {
            $fetch = mysqli_fetch_assoc($run);
            $pcode = $fetch['pcode'];
            $pname = mysqli_real_escape_string($conn, mysqli_real_escape_string($conn, $fetch['pname']));
            $psale = $fetch['psale'];
            $pstock = $fetch['pstock'];
            $aemail = $_SESSION['email'];
            if ($pstock >= $pqty) {
                $psql = "SELECT * FROM `admin_order` WHERE `invoice`='$invoice' AND `pcode`='$pcode' ";
                $prun = mysqli_query($conn, $psql);
                if (mysqli_num_rows($prun) > 0) {
                    echo 2; //product already in order
                } else {
                    // insert order into list
                    $ptprice = $psale * $pqty;
                    $insert = "INSERT INTO `admin_order`(`invoice`, `pcode`, `pname`, `pprice`, `pqty`, `ptprice`, `aemail`)VALUES('$invoice', '$pcode', '$pname', '$psale', '$pqty', '$ptprice', '$aemail')";
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
// increment quantity in order list
if (isset($_GET['in-order'])) {
    $invoice = $_GET['in-order'];
    $aqty = $_GET['aqty'];
    $pcode = $_GET['acode'];
    $aemail = $_SESSION['email'];

    if ($aqty < 1) {
        echo 1; //invalid value
    } else {
        $select = "SELECT * FROM `product` WHERE `pcode`='$pcode' ";
        $run = mysqli_query($conn, $select);
        $fetch = mysqli_fetch_assoc($run);
        $pstock = $fetch['pstock'];
        $pprice = $fetch['psale'];
        if ($pstock >= $aqty) {
            $ptprice = $pprice * $aqty;
            $psql = "UPDATE `admin_order` SET `pqty`='$aqty', `ptprice`='$ptprice' WHERE `pcode`='$pcode' AND `invoice`='$invoice' ";
            $prun = mysqli_query($conn, $psql);
            if ($prun) {
                echo 2; //updated
            } else {
                echo 3; //not updated
            }
        } else {
            echo 4; //Out of stock
        }
    }
}
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
// Empty Cart
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
// Add Stock to Cart
if (isset($_POST['cart-add'])) {
    $pid = $_POST['pid'];
    $pqty = $_POST['pqty'];

    if ($pqty < 1) {
        echo 1;
    } else {
        $select = "SELECT * FROM `product` WHERE `pid`='$pid' ";
        $run = mysqli_query($conn, $select);
        if (mysqli_num_rows($run) > 0) {
            $fetch = mysqli_fetch_assoc($run);
            $pcode = $fetch['pcode'];
            $pname = mysqli_real_escape_string($conn, mysqli_real_escape_string($conn, $fetch['pname']));
            $psale = $fetch['psale'];
            $pstock = $fetch['pstock'];
            $aemail = $_SESSION['email'];
            if ($pstock >= $pqty) {
                $psql = "SELECT * FROM `add_to_cart` WHERE `pcode`='$pcode' ";
                $prun = mysqli_query($conn, $psql);
                if (mysqli_num_rows($prun) > 0) {
                    echo 2; //product already in cart
                } else {
                    $ptprice = $psale * $pqty;
                    $insert = "INSERT INTO `add_to_cart`(`pcode`, `pname`, `pprice`, `pqty`, `ptprice`, `aemail`)VALUES('$pcode', '$pname', '$psale', '$pqty', '$ptprice', '$aemail') ";
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
// increment quantity in cart
if (isset($_GET['in-cart'])) {
    $aqty = $_GET['aqty'];
    $pcode = $_GET['acode'];
    $aemail = $_SESSION['email'];

    if ($aqty < 1) {
        echo 1; //invalid value
    } else {
        $select = "SELECT * FROM `product` WHERE `pcode`='$pcode' ";
        $run = mysqli_query($conn, $select);
        if (mysqli_num_rows($run) == 1) {
            $fetch = mysqli_fetch_assoc($run);
            $pstock = $fetch['pstock'];
            $pprice = $fetch['psale'];
            if ($pstock >= $aqty) {
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

    if ($invoice == "" || $csname == "" || $cmob == "" || $tprice == "" || $ostatus == "none") {
        echo 1; //check inputs
    } else {
        $select = "SELECT * FROM `pos` WHERE `invoice`='$invoice'";
        $crun = mysqli_query($conn, $select);
        if (mysqli_num_rows($crun) > 0) {
            echo 2; //Already Exists
        } else {
            $insert = "INSERT INTO `pos`(`invoice`, `csname`, `cmob`, `tprice`, `ostatus`)VALUES('$invoice', '$csname', '$cmob', '$tprice', '$ostatus')";
            $run = mysqli_query($conn, $insert);
            if ($run) {
                $asql = "SELECT * FROM `add_to_cart` WHERE `aemail`='$aemail' ";
                $arun = mysqli_query($conn, $asql);
                while ($fetch = mysqli_fetch_assoc($arun)) {
                    $pcode = $fetch['pcode'];
                    $pname = mysqli_real_escape_string($conn, $fetch['pname']);
                    $pprice = $fetch['pprice'];
                    $pqty = $fetch['pqty'];
                    $ptprice = $fetch['ptprice'];
                    // minus qty from stock
                    $mssql = "SELECT * FROM `product` WHERE `pcode`='$pcode' ";
                    $msrun = mysqli_query($conn, $mssql);
                    $msfetch = mysqli_fetch_assoc($msrun);
                    $pstock = $msfetch['pstock'];
                    $pstock = $pstock - $pqty;
                    //double check out-of-stock condition
                    if ($pstock >= 0) {
                        $upsql = "UPDATE `product` SET `pstock`='$pstock' WHERE `pcode`='$pcode' ";
                        $uprun = mysqli_query($conn, $upsql);
                    } else {
                        //may be no need of this else case
                        echo "out of stock";
                        break;
                    }
                    // checkout the order
                    $osql = "INSERT INTO `admin_order`(`invoice`, `pcode`, `pname`, `pprice`, `pqty`, `ptprice`, `aemail`)VALUES('$invoice', '$pcode', '$pname', '$pprice', '$pqty', '$ptprice', '$aemail')";
                    $orun = mysqli_query($conn, $osql);
                }
                if (isset($orun) && $orun == true) {
                    $odel = "DELETE FROM `add_to_cart` WHERE `aemail` = '$aemail' ";
                    $drun = mysqli_query($conn, $odel);
                }
                echo 3; //inserted
            } else {
                echo 4; //not inserted
            }
        }
    }
}
// Update POS
if (isset($_POST['upsub'])) {
    $invoice = mysqli_real_escape_string($conn, $_POST['invoice']);
    $csname = mysqli_real_escape_string($conn, $_POST['csname']);
    $cmob = mysqli_real_escape_string($conn, $_POST['cmob']);
    $tprice = mysqli_real_escape_string($conn, $_POST['tprice']);
    $ostatus = mysqli_real_escape_string($conn, $_POST['ostatus']);
    $aemail = $_SESSION['email'];

    if ($invoice == "" || $csname == "" || $cmob == "" || $tprice == "" || $ostatus == "none") {
        echo 1; //check inputs
    } else {
        $insert = "UPDATE `pos` SET `csname`='$csname', `cmob`='$cmob', `tprice`='$tprice', `ostatus`='$ostatus' WHERE `invoice`='$invoice' ";
        $run = mysqli_query($conn, $insert);
        if ($run) {
            //get pqty
            $sql = "SELECT * FROM `admin_order` WHERE `invoice` = '$invoice' ";
            $run = mysqli_query($conn, $sql);
            while ($fetch = mysqli_fetch_assoc($run)) {
                $pqty = $fetch['pqty'];
                $pcode = $fetch['pcode'];
                // minus qty from stock
                $psql = "SELECT * FROM `product` WHERE `pcode`='$pcode' ";
                $prun = mysqli_query($conn, $psql);
                $pfetch = mysqli_fetch_assoc($prun);
                $pstock = $pfetch['pstock'];
                $pstock = $pstock - $pqty;
                //double check out-of-stock condition
                if ($pstock >= 0) {
                    $upsql = "UPDATE `product` SET `pstock`='$pstock' WHERE `pcode`='$pcode' ";
                    $uprun = mysqli_query($conn, $upsql);
                }
            }
            echo 2; //updated
        } else {
            echo 3; //not updated
        }
    }
}
