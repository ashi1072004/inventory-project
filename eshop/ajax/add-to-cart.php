<?php
include('../../admin/include/connect.php');
session_start();
if (isset($_SESSION['uemail'])) {
    $uemail = $_SESSION['uemail'];
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
// Add to Cart
if (isset($_POST['action']) && $_POST['action'] == 'cart-add') {
    if (isset($_SESSION['uemail'])) {
        $pid = mysqli_real_escape_string($conn, $_POST['pid']);
        $pcode = mysqli_real_escape_string($conn, $_POST['pcode']);
        $pname = mysqli_real_escape_string($conn, $_POST['pname']);
        $psale = mysqli_real_escape_string($conn, $_POST['psale']);
        $ppic = mysqli_real_escape_string($conn, $_POST['ppic']);
        // $ppic = serialize($ppic);

        $select = "SELECT * FROM `add_to_cart` WHERE `pcode`='$pcode' AND `aemail`='$uemail' ";
        $prun = mysqli_query($conn, $select);
        if (mysqli_num_rows($prun) > 0) {
            echo 1; //already exists
        } else {
            $insert = "INSERT INTO `add_to_cart`(`pcode`, `pname`, `pprice`, `pqty`, `ptprice`, `ppic`, `aemail`)VALUES('$pcode', '$pname', '$psale', '1', '$psale', '$ppic', '$uemail') ";
            $arun = mysqli_query($conn, $insert);
            if ($arun) {
                echo 2; //inserted
            } else {
                echo 3; //not inserted
            }
        }
    } else {
        echo 4; //logged out
    }
}
// Delete from Cart
if (isset($_GET['action']) && $_GET['action'] == 'cart-del') {
    $aid = $_GET['aid'];

    $dsql = "DELETE FROM `add_to_cart` WHERE `aid`='$aid' ";
    $drun = mysqli_query($conn, $dsql);
    if ($drun) {
        echo 1; //deleted
    } else {
        echo 2; //not deleted
    }
}
// Empty Cart
if (isset($_GET['action']) && $_GET['action'] == 'cart-empty') {

    $dsql = "DELETE FROM `add_to_cart` WHERE `aemail`='$uemail' ";
    $drun = mysqli_query($conn, $dsql);
    if ($drun) {
        echo 1; //deleted
    } else {
        echo 2; //not deleted
    }
}
// View Cart
if (isset($_GET['action']) && $_GET['action'] == 'cart-show') {
    $psql = "SELECT * FROM `add_to_cart` WHERE `aemail`='$uemail' ";
    $prun = mysqli_query($conn, $psql);
    $output1 = "";
    $tcash = 0;
    if (mysqli_num_rows($prun) > 0) {
        while ($pfetch = mysqli_fetch_assoc($prun)) {
            $output1 .= '<tr>
            <td class="image" data-title="No"><img src="../admin/assets/img/products/' . $pfetch['ppic'] . '" alt="#"></td>
            <td id="acode" class="d-none">' . $pfetch['pcode'] . '</td>
            <td class="product-des" data-title="Description">
                <p class="product-name"><a href="#">' . $pfetch['pname'] . '</a></p>
            </td>
            <td class="price" data-title="Price"><span>' . $pfetch['pprice'] . '</span></td>
            <td class="qty" data-title="Qty">
                <div class="input-group">
                    <div class="button minus">
                        <button type="button" class="btn btn-primary btn-number" data-type="minus" data-field="quant[1]">
                            <i class="ti-minus"></i>
                        </button>
                    </div>
                    <input type="number" min="1" name="quant[1]" id="aqty" class="input-number" data-min="1" value="' . $pfetch['pqty'] . '">
                    <div class="button plus">
                        <button type="button" class="btn btn-primary btn-number" data-type="plus" data-field="quant[1]">
                            <i class="ti-plus"></i>
                        </button>
                    </div>
                </div>
            </td>
            <td class="total-amount" data-title="Total"><span>' . $pfetch['ptprice'] . '</span></td>
            <td class="action" data-title="Remove"><a class="pdel" data-del="' . $pfetch['aid'] . '"><i class="ti-trash remove-icon"></i></a></td>
            </tr>';
            $tcash = $tcash + $pfetch['ptprice'];
        }
        $output2 = '<div class="col-12">
            <div class="total-amount">
                <div class="row">
                    <div class="col-lg-8 col-md-5 col-12"></div>
                    <div class="col-lg-4 col-md-7 col-12">
                        <div class="right">
                            <ul>
                                <li>Cart Subtotal<span>' . $tcash . '</span></li>
                                <li>Shipping (+100)<span>Free</span></li>
                                <li>You Save<span>Rs. 100</span></li>
                                <li class="last">You Pay<span>' . $tcash . '</span></li>
                            </ul>
                            <div class="button5">
                                <a href="./checkout.php" class="btn">Checkout</a>
                                <a href="./shop.php" class="btn">Continue shopping</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>';
        echo json_encode(array('output1' => $output1, 'output2' => $output2));
    } else {
        $output1 = "<tr><td colspan='6' class='text-center'>No Product in Cart</td></tr>";
        echo json_encode(array('output1' => $output1, 'output2' => ''));
    }
}
// Cart Qty change
if (isset($_GET['action']) && $_GET['action'] == 'cart-qty') {
    $aqty = $_GET['aqty'];
    $pcode = $_GET['acode'];

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
            $psql = "UPDATE `add_to_cart` SET `pqty`='$aqty', `ptprice`='$ptprice' WHERE `pcode`='$pcode' AND `aemail`='$uemail' ";
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
// Checkout
if (isset($_POST['action']) && $_POST['action'] == 'checkout') {
    $invoice = mysqli_real_escape_string($conn, $_POST['invoice']);
    $tcash = $_POST['tcash'];
    $coupon = $_POST['coupon'];
    $udate = date("Y/m/d");
    // checkout
    $select = "SELECT * FROM `checkout` WHERE `invoice`='$invoice'";
    $crun = mysqli_query($conn, $select);
    if (mysqli_num_rows($crun) > 0) {
        echo 1; //Invoice Already Exists TRY AGAIN
    } else {
        $asql = "SELECT * FROM `add_to_cart` WHERE `aemail`='$uemail' ";
        $arun = mysqli_query($conn, $asql);
        if (mysqli_num_rows($arun) > 0) {
            $dcsql = "SELECT * FROM `coupon` WHERE `cuname`='$coupon' ";
            $dcrun = mysqli_query($conn, $dcsql);
            $dcfetch = mysqli_fetch_assoc($dcrun);
            $dc = $dcfetch['discount'];
            $insert = "INSERT INTO `checkout`(`invoice`, `uemail`, `tcash`, `discount`, `o_status`, `udate`)VALUES('$invoice', '$uemail', '$tcash', '$dc', 'pending', '$udate')";
            $run = mysqli_query($conn, $insert);
            if ($run) {
                $tcash = 0;
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
                        $tcash += $ptprice;
                        // checkout the order
                        $osql = "INSERT INTO `admin_order`(`invoice`, `pcode`, `pname`, `pprice`, `pqty`, `ptprice`, `aemail`)VALUES('$invoice', '$pcode', '$pname', '$pprice', '$pqty', '$ptprice', '$uemail')";
                        $orun = mysqli_query($conn, $osql);
                        if ($orun) {
                            // update stock
                            $upsql = "UPDATE `product` SET `pstock`='$pstock' WHERE `pcode`='$pcode' ";
                            $uprun = mysqli_query($conn, $upsql);
                            // delete product from cart
                            $odel = "DELETE FROM `add_to_cart` WHERE `aemail` = '$uemail' AND `pcode`='$pcode' ";
                            $drun = mysqli_query($conn, $odel);
                        }
                    } else {
                        $upch = "UPDATE `checkout` SET `tcash`='$tcash' WHERE `invoice`='$invoice' ";
                        $chrun = mysqli_query($conn, $upch);
                        echo 2; // one of the products out of stock
                        exit;
                    }
                }
                // Delete Coupon
                $del = "DELETE FROM `coupon` WHERE `cuname`='$coupon' ";
                $drun = mysqli_query($conn, $del);
                // send mail to user
                require '../../PHPMailer/Exception.php';
                require '../../PHPMailer/PHPMailer.php';
                require '../../PHPMailer/SMTP.php';
                $mail = new PHPMailer(true);
                try {
                    //Server settings
                    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;
                    $mail->isSMTP();
                    $mail->Host = 'smtp.gmail.com';
                    $mail->SMTPAuth = true;
                    $mail->Username = 'ghaniaashi@gmail.com';
                    $mail->Password = 'gbiaavimoqpzydqk';
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                    $mail->Port = 465;
                    //Recipients
                    $mail->setFrom($uemail, 'Eshop');
                    $mail->addAddress($uemail);
                    //Content
                    $mail->isHTML(true);
                    $mail->Subject = 'Order Placed!';
                    $mail->Body    = '<b>Your Order Has Been Placed!</b>';
                    // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                    if ($mail->send()) {
                        echo 3; //Order placed and Message sent
                    }
                } catch (Exception $e) {
                    echo 4; //Order placed but Message not sent
                }
            } else {
                echo 5; //error occured
            }
        } else {
            echo 5; //error occured
        }
    }
}
// View Checkout
if (isset($_GET['action']) && $_GET['action'] == 'checkout-show') {
    $asql = "SELECT * FROM `add_to_cart` WHERE `aemail`='$uemail' ";
    $arun = mysqli_query($conn, $asql);
    if (mysqli_num_rows($arun) > 0)
        $btn = 'id="proceed"';
    else
        $btn = 'disabled';
    $tcash = 0;
    $output = '
    <div class="single-widget">
        <h2>PRODUCTS IN CART</h2>
        <div class="content">
            <ul>';
    while ($afetch = mysqli_fetch_assoc($arun)) {
        $output .= '
                <li>' . $afetch['pname'] . ' (' . $afetch['pqty'] . ')<span>Rs. ' . $afetch['ptprice'] . '</span></li>';
        $tcash = $tcash + $afetch['ptprice'];
    }
    $output .= '
            </ul>
        </div>
    </div>
    <div class="single-widget">
        <h2>Received a Coupon?</h2>
        <div class="content mt-3 mx-4">
            <form id="cform mb-0">
                <input name="cuname" id="cuname" class="mx-1 p-1" placeholder="Enter Your Coupon" aria-describedby="invalid-cuname">
                <button id="coupon" class="btn">Apply</button>
                <small id="invalid-cuname" class="form-text text-danger"></small>
            </form>
        </div>
    </div>
    <div class="single-widget">
        <h2>CART TOTALS</h2>
        <div class="content">
            <ul>
                <li class="d-none" id="coupon-name"></li>
                <li>Sub Total<span>Rs. ' . $tcash . '</span></li>
                <li>Shipping (+100)<span>Free</span></li>
                <li>Discount<span id="dprice"></span></li>
                <li class="last">Total<span id="tcash">' . $tcash . '</span></li>
            </ul>
        </div>
    </div>
    <div class="single-widget">
        <h2>Payments</h2>
        <div class="content">
            <div class="checkbox">
                <label class="checkbox-inline" for="2">
                    <!-- <input name="news" id="2" type="checkbox"> -->
                    Cash On Delivery
                </label>
            </div>
        </div>
    </div>
    <!-- <div class="single-widget payement">
        <div class="content">
            <img src="images/payment-method.png" alt="#">
        </div>
    </div> -->
    <div class="single-widget get-button">
        <div class="content">
            <div class="button">
                <button ' . $btn . ' class="btn">proceed to checkout</button>
            </div>
        </div>
    </div>';
    echo $output;
}
// Delete Order
if (isset($_GET['action']) && $_GET['action'] == 'order-del') {
    $oid = $_GET['oid'];
    $invoice = $_GET['invoice'];
    $sql = "SELECT * FROM `admin_order` WHERE `order_id`='$oid'";
    $run = mysqli_query($conn, $sql);
    $fetch = mysqli_fetch_assoc($run);
    $pcode = $fetch['pcode'];
    $pqty = $fetch['pqty'];
    $upsql = "UPDATE `product` SET `pstock`=`pstock`+$pqty WHERE `pcode`='$pcode' ";
    $uprun = mysqli_query($conn, $upsql);
    if ($uprun) {
        $dsql = "DELETE FROM `admin_order` WHERE `order_id`='$oid' ";
        $drun = mysqli_query($conn, $dsql);
        if ($drun) {
            echo 1; // canceled
            // send mail to user
            require '../../PHPMailer/Exception.php';
            require '../../PHPMailer/PHPMailer.php';
            require '../../PHPMailer/SMTP.php';
            $mail = new PHPMailer(true);
            try {
                //Server settings
                // $mail->SMTPDebug = SMTP::DEBUG_SERVER;
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'ghaniaashi@gmail.com';
                $mail->Password = 'gbiaavimoqpzydqk';
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                $mail->Port = 465;
                //Recipients
                $mail->setFrom($uemail, 'Eshop');
                $mail->addAddress($uemail);
                //Content
                $mail->isHTML(true);
                $mail->Subject = 'Order Canceled!';
                $mail->Body    = '<b>Your Order Has Been Canceled!</b>';
                // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                $mail->send();
            } catch (Exception $e) {
                //Order canceled but Message not sent
            }
            // update checkout tcash
            $select = "SELECT * FROM `admin_order` WHERE `invoice`='$invoice'";
            $prun = mysqli_query($conn, $select);
            if (mysqli_num_rows($prun) > 0) {
                $tcash = 0;
                while ($afetch = mysqli_fetch_assoc($prun)) {
                    $tcash += $afetch['ptprice'];
                }
                $upsql = "UPDATE `checkout` SET `tcash`='$tcash' WHERE `invoice`='$invoice' ";
                $uprun = mysqli_query($conn, $upsql);
            } else {
                $dinv = "DELETE FROM `checkout` WHERE `invoice`='$invoice' ";
                $invrun = mysqli_query($conn, $dinv);
            }
        } else {
            echo 2; // not canceled 
        }
    } else {
        echo 2; // not canceled 
    }
}
// Apply Coupon
if (isset($_GET['action']) && $_GET['action'] == 'coupon') {
    $cuname = $_GET['cuname'];

    $select = "SELECT * FROM `coupon` WHERE `cuname`='$cuname' ";
    $crun = mysqli_query($conn, $select);
    if (mysqli_num_rows($crun) > 0) {
        $fetch = mysqli_fetch_assoc($crun);
        $dc = $fetch['discount'];
        $tsql = "SELECT * FROM `add_to_cart` WHERE `aemail`='$uemail' ";
        $trun = mysqli_query($conn, $tsql);
        if (mysqli_num_rows($trun) > 0) {
            $tcash = 0;
            while ($tfetch = mysqli_fetch_assoc($trun)) {
                $tcash += $tfetch['ptprice'];
            }
            $dprice = $tcash * ($dc / 100);
            $after = $tcash - $dprice;
            echo json_encode(array("dprice" => $dprice, "after" => $after, "coupon" => $cuname));
        }
    } else {
        echo json_encode(array("dprice" => false)); //coupon does not exist
    }
}
