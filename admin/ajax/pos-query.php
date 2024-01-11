<?php
include("../include/connect.php");
session_start();
// -------------------------- Update POS --------------------------
// Delete Product from Admin Order
if (isset($_GET['del-order'])) {
    $oid = $_GET['del-order'];
    $sql = "SELECT * FROM `admin_order` WHERE `order_id` = '$oid' ";
    $run = mysqli_query($conn, $sql);
    $fetch = mysqli_fetch_assoc($run);
    $invoice = $fetch['invoice'];
    $pcode = $fetch['pcode'];
    $pqty = $fetch['pqty'];
    $upsql = "UPDATE `product` SET `pstock`=`pstock`+$pqty WHERE `pcode`='$pcode' ";
    $uprun = mysqli_query($conn, $upsql);
    if ($uprun) {
        $del = "DELETE FROM `admin_order` WHERE `order_id` = '$oid' ";
        $drun = mysqli_query($conn, $del);
        if ($drun) {
            echo 1;
        }
    } else {
        echo 2;
    }
}
// Empty Order list from invoice
if (isset($_GET['empty-order'])) {
    $invoice = $_GET['empty-order'];
    $sql = "SELECT * FROM `admin_order` WHERE `invoice` = '$invoice' ";
    $run = mysqli_query($conn, $sql);
    if (mysqli_num_rows($run) > 0) {
        while ($fetch = mysqli_fetch_assoc($run)) {
            $pcode = $fetch['pcode'];
            $pqty = $fetch['pqty'];
            $upsql = "UPDATE `product` SET `pstock`=`pstock`+$pqty WHERE `pcode`='$pcode' ";
            $uprun = mysqli_query($conn, $upsql);
        }
        if ($uprun) {
            $del = "DELETE FROM `admin_order` WHERE `invoice` = '$invoice' ";
            $drun = mysqli_query($conn, $del);
            if ($drun) {
                echo 1;
            }
        } else {
            echo 2;
        }
    } else {
        echo 3; //table empty
    }
}
// Add Stock to order list
if (isset($_POST['admin-add'])) {
    $invoice = $_POST['admin-add'];
    $pid = $_POST['pid'];
    $pqty = $_POST['pqty'];

    if ($pqty < 1) {
        echo 1;
    } else {
        $select = "SELECT * FROM `product` WHERE `pid`='$pid' ";
        $run = mysqli_query($conn, $select);
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
                echo 2; //product already in order list
            } else {
                // insert order into list
                $ptprice = $psale * $pqty;
                $insert = "INSERT INTO `admin_order`(`invoice`, `pcode`, `pname`, `pprice`, `pqty`, `ptprice`, `aemail`)VALUES('$invoice', '$pcode', '$pname', '$psale', '$pqty', '$ptprice', '$aemail')";
                $arun = mysqli_query($conn, $insert);
                if ($arun) {
                    $upsql = "UPDATE `product` SET `pstock`=`pstock`-$pqty WHERE `pcode`='$pcode' ";
                    $uprun = mysqli_query($conn, $upsql);
                    if ($uprun) {
                        echo 3; //inserted
                    }
                } else {
                    echo 4; //not inserted
                }
            }
        } else {
            echo 5; //Out of stock
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
        $asql = "SELECT * FROM `admin_order` WHERE `invoice` = '$invoice' AND `pcode`='$pcode' ";;
        $arun = mysqli_query($conn, $asql);
        $afetch = mysqli_fetch_assoc($arun);
        $pqty = $afetch['pqty'];
        $select = "SELECT * FROM `product` WHERE `pcode`='$pcode' ";
        $run = mysqli_query($conn, $select);
        $fetch = mysqli_fetch_assoc($run);
        if ($aqty < $pqty) {
            $pqty = $pqty - $aqty;
            $upsql = "UPDATE `product` SET `pstock`=`pstock`+$pqty WHERE `pcode`='$pcode' ";
            $uprun = mysqli_query($conn, $upsql);
        } else {
            $pqty = $aqty - $pqty;
            $pstock = $fetch['pstock'];
            if ($pstock >= $pqty) {
                $upsql = "UPDATE `product` SET `pstock`=`pstock`-$pqty WHERE `pcode`='$pcode' ";
                $uprun = mysqli_query($conn, $upsql);
            } else {
                echo 4; //Out of stock
                exit;
            }
        }
        if ($uprun) {
            $pprice = $fetch['psale'];
            $ptprice = $pprice * $aqty;
            $psql = "UPDATE `admin_order` SET `pqty`='$aqty', `ptprice`='$ptprice' WHERE `pcode`='$pcode' AND `invoice`='$invoice' ";
            $prun = mysqli_query($conn, $psql);
            if ($prun) {
                echo 2; //updated
            } else {
                echo 3; //not updated
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
    $odate = date("Y/m/d");
    $aemail = $_SESSION['email'];

    if ($invoice == "" || $csname == "" || $cmob == "" || $tprice == "" || $ostatus == "none") {
        echo 1; //check inputs
    } else {
        $upsql = "UPDATE `pos` SET `csname`='$csname', `cmob`='$cmob', `tprice`='$tprice', `posdate`='$odate', `ostatus`='$ostatus' WHERE `invoice`='$invoice' ";
        $run = mysqli_query($conn, $upsql);
        if ($run) {
            echo 2; //updated
        } else {
            echo 3; //not updated
        }
    }
}
// -------------------------- Insert POS --------------------------
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
    $odate = date("Y/m/d");
    $aemail = $_SESSION['email'];

    if ($invoice == "" || $csname == "" || $cmob == "" || $tprice == "" || $ostatus == "none") {
        echo 1; //check inputs
    } else {
        $select = "SELECT * FROM `pos` WHERE `invoice`='$invoice'";
        $crun = mysqli_query($conn, $select);
        if (mysqli_num_rows($crun) > 0) {
            echo 2; //Already Exists
        } else {
            $insert = "INSERT INTO `pos`(`invoice`, `csname`, `cmob`, `tprice`, `posdate`, `ostatus`)VALUES('$invoice', '$csname', '$cmob', '$tprice', '$odate', '$ostatus')";
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
