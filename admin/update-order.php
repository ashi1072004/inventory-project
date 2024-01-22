<?php
include("./include/connect.php");
session_start();
if (empty($_SESSION['email'])) {
    header('Location: ./login.php');
}
$invoice = $_GET['invoice'];
include("./include/header.php");
include("./include/sidebar.php");
?>
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Invoice: <span id="inv"><?= $invoice ?></span> Details</h4>
                            <a class="btn btn-primary float-right" href="./view-orders.php">Back</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover" style="width:100%;">
                                    <thead>
                                        <tr>
                                            <th>Product Code</th>
                                            <th>Product Name</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            <th>Total Price</th>
                                        </tr>
                                    </thead>
                                    <tbody id="orders-table">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php
include("./include/footer.php");
?>
<script>
    $(document).ready(function() {
        // change quantity
        $(document).on("change", ".aqty", function() {
            let aqty = $(this).val();
            var acode = $(this).closest("tr").find("#acode").text();
            // alert(aqty);
            $.ajax({
                method: "GET",
                url: "./ajax/pos-query.php",
                data: {
                    "aqty": aqty,
                    "acode": acode,
                    "in-order": $("#inv").text()
                },
                success: function(res) {
                    // alert(res);
                    if (res == 1) {
                        Toast.fire({
                            icon: 'error',
                            title: 'Invalid Stock Value!'
                        });
                        showOrder();
                    } else if (res == 2) {
                        console.log("Quantity changed!");
                        showOrder();
                    } else if (res == 3) {
                        console.log("Quantity not changed!");
                        showOrder();
                    } else {
                        Toast.fire({
                            icon: 'warning',
                            title: 'Product Out of Stock!'
                        });
                        showOrder();
                    }
                }
            });
        });
        // view Order
        showOrder();

        function showOrder() {
            var invoice = $("#inv").text();
            $.ajax({
                method: "GET",
                url: "./ajax/orders.php",
                data: {
                    'invoice': invoice,
                    'load': 'orders'
                },
                success: function(res) {
                    // alert(res);
                    $("#orders-table").html(res);
                }
            });
        }
    });
</script>