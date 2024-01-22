<?php
include("./include/connect.php");
session_start();
if (empty($_SESSION['email'])) {
    header('Location: ./login.php');
}
include("./include/header.php");
include("./include/sidebar.php");

$invoice = $_GET['invoice'];
$sql = "SELECT * FROM `checkout` WHERE `invoice`='$invoice' ";
$run = mysqli_query($conn, $sql);
$fetch = mysqli_fetch_assoc($run);
?>
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-body">
            <div class="invoice">
                <div class="invoice-print">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="invoice-title">
                                <h2>Invoice</h2>
                                <div class="invoice-number"><?= $invoice ?></div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <address>
                                        <strong>Billed To:</strong><br>
                                        <?php
                                        $uemail = $fetch['uemail'];
                                        $ucsql = "SELECT * FROM `user` WHERE `uemail`='$uemail' ";
                                        $ucrun = mysqli_query($conn, $ucsql);
                                        if (mysqli_num_rows($ucrun) > 0) {
                                            $ufetch = mysqli_fetch_assoc($ucrun);
                                            echo $ufetch['ufname'] . " " . $ufetch['ulname'] . "<br>";
                                            echo $ufetch['umob'] . "<br>";
                                        }
                                        echo $uemail;
                                        ?><br>
                                    </address>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <address>
                                        <strong>Payment Method:</strong><br>
                                        Cash on delivery<br>
                                    </address>
                                </div>
                                <div class="col-md-6 text-md-right">
                                    <address>
                                        <strong>Checkout Date:</strong><br>
                                        <?= $fetch['udate'] ?><br><br>
                                    </address>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <div class="section-title">Order Summary</div>
                            <p class="section-lead">All items here cannot be deleted.</p>
                            <div class="table-responsive">
                                <table class="table table-striped table-hover table-md">
                                    <tr>
                                        <th data-width="40">#</th>
                                        <th>Item</th>
                                        <th class="text-center">Price</th>
                                        <th class="text-center">Quantity</th>
                                        <th class="text-right">Totals</th>
                                    </tr>
                                    <?php
                                    $osql = "SELECT * FROM `admin_order` WHERE `invoice` = '$invoice' ";
                                    $orun = mysqli_query($conn, $osql);
                                    $id = 1;
                                    while ($row = mysqli_fetch_assoc($orun)) {
                                    ?>
                                        <tr>
                                            <td><?= $id ?></td>
                                            <td><?= $row['pname'] ?></td>
                                            <td class="text-center">Rs. <?= $row['pprice'] ?></td>
                                            <td class="text-center"><?= $row['pqty'] ?></td>
                                            <td class="text-right"><?= $row['ptprice'] ?></td>
                                        </tr>
                                    <?php
                                        $id += 1;
                                    }
                                    ?>
                                </table>
                            </div>
                            <div class="row mt-4">
                                <div class="col-lg-8"></div>
                                <div class="col-lg-4 text-right">
                                    <div class="invoice-detail-item">
                                        <div class="invoice-detail-name">Total</div>
                                        <div class="invoice-detail-value">Rs. <?= $fetch['tcash'] ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="text-md-right">
                    <div class="float-lg-left mb-lg-0 mb-3">
                        <button onclick="cancel()" class="btn btn-danger btn-icon icon-left"><i class="fas fa-times"></i> Cancel</button>
                    </div>
                    <button id="print" class="btn btn-warning btn-icon icon-left"><i class="fas fa-print"></i> Print</button>
                </div>
            </div>
        </div>
    </section>

</div>

<?php
include("./include/footer.php");
?>
<script>
    function cancel() {
        window.location.href = "./view-orders.php";
    }

    $(document).ready(function() {
        $("#print").on("click", function() {
            let invoice = $(".invoice-print").html();
            // console.log(invoice);
            let body = $("body").html();
            $("body").html(invoice);
            window.print();
            $("body").html(body);
            location.reload();
        });


    });
</script>