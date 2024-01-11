<?php
include("./include/connect.php");
session_start();
if (empty($_SESSION['email'])) {
    header('Location: ./login.php');
}
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
                            <h4>View Online Orders</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover" id="tableExport" style="width:100%;">
                                    <thead>
                                        <tr>
                                            <th>Invoice</th>
                                            <th>Email</th>
                                            <th>Customer Name</th>
                                            <th>Contact No.</th>
                                            <th>Country</th>
                                            <th>State</th>
                                            <th>City</th>
                                            <th>Address1</th>
                                            <th>Address2</th>
                                            <th>Postal Code</th>
                                            <th>Total Cash</th>
                                            <th>Order Date</th>
                                            <th>Status</th>
                                            <th colspan="3" class="text-center">Actions</th>
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
        $(document).on("click", ".del", function() {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "btn btn-success",
                cancelButtonColor: "btn btn-danger",
                confirmButtonText: "Yes"
            }).then((result) => {
                if (result.isConfirmed) {
                    let invoice = $(this).data("id");
                    // alert(invoice);
                    let btn = this;
                    $.ajax({
                        method: "GET",
                        url: "./ajax/orders.php",
                        data: {
                            "invoice": invoice,
                            "action": "cancel"
                        },
                        success: function(res) {
                            // alert(res);
                            if (res == 1) {
                                Swal.fire({
                                    title: "Canceled!",
                                    text: "Order has been canceled.",
                                    icon: "success"
                                });
                                $(btn).closest("tr").fadeOut();
                            } else {
                                Swal.fire({
                                    text: "Order not canceled.",
                                    icon: "error"
                                });
                            }
                        }
                    });
                }
            });
        });
        $(document).on("click", ".com", function() {
            let oid = $(this).data("id");
            // alert(uid);
            let btn = this;
            $.ajax({
                method: "GET",
                url: "./ajax/orders.php",
                data: {
                    "oid": oid,
                    "action": "complete"
                },
                success: function(res) {
                    // alert(res);
                    if (res == 1) {
                        Toast.fire({
                            icon: 'success',
                            title: 'Status changed!'
                        });
                        showOrder();
                    } else {
                        Toast.fire({
                            icon: 'success',
                            title: 'Status not changed!'
                        });
                    }
                }
            });
        });
        // view Order
        showOrder();

        function showOrder() {
            $.ajax({
                method: "GET",
                url: "./ajax/view.php",
                data: {
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