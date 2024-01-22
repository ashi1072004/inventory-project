<?php
include("../include/connect.php");
session_start();
// view user
if (isset($_GET['load']) && $_GET['load'] == 'user') {
    $sql = "SELECT * FROM `user` ";
    $run = mysqli_query($conn, $sql);
    if (mysqli_num_rows($run) > 0) {
        $fetch = mysqli_fetch_all($run, MYSQLI_ASSOC);
        echo json_encode($fetch);
        // while ($fetch = mysqli_fetch_assoc($run)) {
        //     $output = '<tr>
        //         <td>' . $fetch['ufname'] . '</td>
        //         <td>' . $fetch['ulname'] . '</td>
        //         <td>' . $fetch['uemail'] . '</td>
        //         <td>' . $fetch['umob'] . '</td>
        //         <td>' . $fetch['country'] . '</td>
        //         <td>' . $fetch['state'] . '</td>
        //         <td>' . $fetch['city'] . '</td>
        //         <td>' . $fetch['add1'] . '</td>
        //         <td>' . $fetch['add2'] . '</td>
        //         <td>' . $fetch['pt_code'] . '</td>
        //         <td>' . $fetch['upass'] . '</td>
        //         <td>' . $fetch['udate'] . '</td>';
        //     if ($fetch['ustatus'] == 'Confirmed') {
        //         $output .= '<td class="text-success">' . $fetch['ustatus'] . '</td>
        //             <td><button data-con="' . $fetch['uid'] . '" class="confirm"><span data-feather="user-x" data-toggle="tooltip" title="Pending"></span></button></td>';
        //     } else {
        //         $output .= '<td class="text-danger">' . $fetch['ustatus'] . '</td>
        //             <td><button data-con="' . $fetch['uid'] . '" class="confirm"><span data-feather="user-check" data-toggle="tooltip" title="Confirm"></span></button></td>';
        //     }
        //     $output .= '<td><a href="./update-user.php?uid=' . $fetch['uid'] . '"><span data-feather="edit" data-toggle="tooltip" title="Update"></span></a></td>
        //         <td><button data-id="' . $fetch['uid'] . '" class="del"><span data-feather="trash-2" data-toggle="tooltip" title="Delete"></span></button></td>
        //     </tr>';
        //     echo $output;
        // }
    } else {
        exit;
        // echo json_encode(array("message" => "No Record Found", "status" => false));
    }
}
// view cart
if (isset($_GET['load']) && $_GET['load'] == 'cart') {
    $aemail = $_SESSION['email'];
    $sql = "SELECT * FROM `add_to_cart` WHERE `aemail`='$aemail' ";
    $run = mysqli_query($conn, $sql);
    if (mysqli_num_rows($run) > 0) {
        $tcash = 0;
        $output = "";
        while ($fetch = mysqli_fetch_assoc($run)) {
            $output .= '<tr>
                <td id="acode">' . $fetch['pcode'] . '</td>
                <td>' . $fetch['pname'] . '</td>
                <td>' . $fetch['pprice'] . '</td>
                <td>' . $fetch['ptprice'] . '</td>
                <td><input type="number" min="1" name="aqty" class="aqty" value="' . $fetch['pqty'] . '" style="width: 50px; outline: none;"></td>
                <td><button data-id="' . $fetch['aid'] . '" class="btn btn-sm btn-danger del">Delete</button></td>
                </tr>';
            $tcash = $tcash + $fetch['ptprice'];
        }
        $output .= '<tr><td colspan="7"><h3>Total Cash: ' . $tcash . '</h3></td></tr>';
        echo json_encode(array('output' => $output, 'tcash' => $tcash));
    } else {
        $output = "<tr class='text-center'><td colspan='7'>No Record Found</td></tr>";
        echo json_encode(array('output' => $output, 'tcash' => ''));
    }
}
// view update cart
if (isset($_GET['invoice'])) {
    $invoice = $_GET['invoice'];
    // $aemail = $_SESSION['email'];
    $adsql = "SELECT * FROM `admin_order` WHERE `invoice`='$invoice' ";
    $adrun = mysqli_query($conn, $adsql);
    if (mysqli_num_rows($adrun) > 0) {
        $tcash = 0;
        $output = "";
        while ($fetch = mysqli_fetch_assoc($adrun)) {
            $output .= '<tr>
                <td id="acode">' . $fetch['pcode'] . '</td>
                <td>' . $fetch['pname'] . '</td>
                <td>' . $fetch['pprice'] . '</td>
                <td>' . $fetch['ptprice'] . '</td>
                <td><input type="number" min="1" name="aqty" class="aqty" value="' . $fetch['pqty'] . '" style="width: 50px; outline: none;"></td>
                <td><button data-id="' . $fetch['order_id'] . '" class="btn btn-sm btn-danger del">Delete</button></td>
                </tr>';
            $tcash = $tcash + $fetch['ptprice'];
        }
        $psql = "UPDATE `pos` SET `tprice`='$tcash' WHERE `invoice`='$invoice' ";
        $prun = mysqli_query($conn, $psql);
        $output .= '<tr><td colspan="7"><h3>Total Cash: ' . $tcash . '</h3></td></tr>';
        echo json_encode(array('output' => $output, 'tcash' => $tcash));
    } else {
        $psql = "UPDATE `pos` SET `tprice`=0 WHERE `invoice`='$invoice' ";
        $prun = mysqli_query($conn, $psql);
        $output = "<tr class='text-center'><td colspan='7'>No Record Found</td></tr>";
        echo json_encode(array('output' => $output, 'tcash' => ''));
    }
}
// view stock
if (isset($_GET['load']) && $_GET['load'] == 'pos') {
    $sql = "SELECT * FROM `product` WHERE `pstock`>0 ";
    $run = mysqli_query($conn, $sql);
    // $fetch = mysqli_fetch_all($run, MYSQLI_ASSOC);
    if (mysqli_num_rows($run) > 0) {
        // echo json_encode($fetch);
        $output = "";
        while ($fetch = mysqli_fetch_assoc($run)) {
            $output .= '<tr>
                <td>' . $fetch['pcode'] . '</td>
                <td>' . $fetch['pname'] . '</td>
                <td>' . $fetch['psale'] . '</td>
                <td>' . $fetch['pstock'] . '</td>
                <td><input type="number" min="1" name="pqty" id="pqty" style="width: 50px; outline: none;"></td>
                <td><button data-add="' . $fetch['pid'] . '" class="btn btn-sm btn-primary add">Add</button></td>
                </tr>';
        }
        echo $output;
    } else {
        echo "<tr class='text-center'><td colspan='7'>No Record Found</td></tr>";
        // echo json_encode(array("message" => "No Record Found", "status" => false));
    }
}
// view orders
if (isset($_GET['load']) && $_GET['load'] == 'orders') {
    $psql = "SELECT * FROM `checkout` ";
    $prun = mysqli_query($conn, $psql);
    if (mysqli_num_rows($prun) > 0) {
        $output = '';
        while ($fetch = mysqli_fetch_assoc($prun)) {
            $uemail = $fetch['uemail'];
            $sql = "SELECT * FROM `user` WHERE `uemail`='$uemail' ";
            $run = mysqli_query($conn, $sql);
            if ($fetch['o_status'] == 'pending') {
                $class = 'class="text-danger"';
                $btn = '<td>
                    <button data-id="' . $fetch['ucid'] . '" class="btn btn-sm btn-success com m-1">Confirm</button>
                </td>';
                // <a href="./update-order.php?invoice=' . $fetch['invoice'] . '" class="btn btn-sm btn-primary m-1">Edit</a>
            } else {
                $class = 'class="text-success"';
                $btn = '<td><button data-id="' . $fetch['ucid'] . '" class="btn btn-sm btn-danger com m-1">Pending</button></td>';
            }
            $output .= '
            <tr>
                <td>' . $fetch['invoice'] . '</td>
                <td>' . $uemail . '</td>';
            if (mysqli_num_rows($run) > 0) {
                $ufetch = mysqli_fetch_assoc($run);
                $output .= '
                <td>' . $ufetch['ufname'] . ' ' . $ufetch['ulname'] . '</td>
                <td>' . $ufetch['umob'] . '</td>
                <td>' . $ufetch['country'] . '</td>
                <td>' . $ufetch['state'] . '</td>
                <td>' . $ufetch['city'] . '</td>
                <td>' . $ufetch['add1'] . '</td>
                <td>' . $ufetch['add2'] . '</td>
                <td>' . $ufetch['pt_code'] . '</td>';
            } else {
                $output .= '<td colspan="8" class="text-center">User Left</td>';
            }

            $output .= '
                <td>' . $fetch['tcash'] . '</td>
                <td>' . $fetch['discount'] . '%</td>
                <td>' . $fetch['udate'] . '</td>
                <td ' . $class . '>' . $fetch['o_status'] . '</td>
                <td><a href="./invoice-o.php?invoice=' . $fetch['invoice'] . '" class="btn btn-sm btn-warning text-white m-1">Invoice</a></td>
                ' . $btn . '
                <td><button data-id="' . $fetch['invoice'] . '" class="btn btn-sm btn-secondary del m-1">Cancel</button></td>
            </tr>';
        }
        echo $output;
    }
}
