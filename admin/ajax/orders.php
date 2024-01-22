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
// view orders
if (isset($_GET['load']) && $_GET['load'] == 'orders') {
    $invoice = $_GET['invoice'];
    $adsql = "SELECT * FROM `admin_order` WHERE `invoice`='$invoice' ";
    $adrun = mysqli_query($conn, $adsql);
    if (mysqli_num_rows($adrun) > 0) {
        $output = "";
        $tcash = 0;
        while ($fetch = mysqli_fetch_assoc($adrun)) {
            $output .= '<tr>
                <td id="acode">' . $fetch['pcode'] . '</td>
                <td>' . $fetch['pname'] . '</td>
                <td>' . $fetch['pprice'] . '</td>
                <td><input type="number" min="1" name="aqty" class="aqty" value="' . $fetch['pqty'] . '" style="width: 50px; outline: none;"></td>
                <td>' . $fetch['ptprice'] . '</td>
            </tr>
            <tr><td><h6>Discounted Price: </h6></td></tr>';
            $tcash += $fetch['ptprice'];
        }
        $upsql = "UPDATE `checkout` SET `tcash`='$tcash' WHERE `invoice`='$invoice' ";
        $uprun = mysqli_query($conn, $upsql);
    } else {
        $output = "<tr class='text-center'><td colspan='5'>Invoice Empty</td></tr>";
    }
    echo $output;
}
