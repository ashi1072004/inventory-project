<?php
include("./include/connect.php");
session_start();
if (empty($_SESSION['email'])) {
    header('Location: ./login.php');
}

$posid = $_GET['posid'];
$select = "SELECT * FROM `pos` WHERE `posid` = '$posid' ";
$run = mysqli_query($conn, $select);
$fetch = mysqli_fetch_assoc($run);
$invoice = $fetch['invoice'];

include("./include/header.php");
include("./include/sidebar.php");
?>
<style>
    td>button,
    td>button:focus {
        border: none;
        outline: none;
        background: none;
        color: #6777ef;
    }
</style>
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-body">
            <div class="row justify-content-between">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Product Stock</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover" id="tableExport" style="width:100%">
                                    <thead>
                                        <tr>
                                            <!-- <th>ID</th> -->
                                            <th>Product Code</th>
                                            <th>Product Name</th>
                                            <th>Product Price</th>
                                            <th>Stock</th>
                                            <th>Qty</th>
                                            <th>Add</th>
                                        </tr>
                                    </thead>
                                    <tbody id="pos">

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-6">
                    <div class="card">
                        <form id="form">
                            <div class="card-header">
                                <h4>Checkout</h4>
                                <a class="btn btn-primary text-right" href="./view-pos.php">Back</a>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Ìnvoice</label>
                                    <input id="invoice" type="text" class="form-control" name="invoice" value="<?php echo $fetch['invoice'] ?>" aria-describedby="invalid-invoice" readonly>
                                    <small id="invalid-invoice" class="form-text text-danger"></small>
                                </div>
                                <div class="form-group">
                                    <label>Customer Name</label>
                                    <input type="text" id="csname" class="form-control" name="csname" value="<?php echo $fetch['csname'] ?>" aria-describedby="invalid-csname" required>
                                    <small id="invalid-csname" class="form-text text-danger"></small>
                                </div>
                                <div class="form-group">
                                    <label>Contact No.</label>
                                    <input type="tel" id="cmob" class="form-control" name="cmob" value="<?php echo $fetch['cmob'] ?>" aria-describedby="invalid-cmob" required>
                                    <small id="invalid-cmob" class="form-text text-danger"></small>
                                </div>
                                <div class="form-group">
                                    <label>Total Cash</label>
                                    <input type="number" id="tprice" class="form-control" name="tprice" readonly>
                                </div>
                                <div class="form-group">
                                    <label>Status</label>
                                    <select name="ostatus" id="ostatus" class="form-control" required>
                                        <option value="none">None</option>
                                        <?php
                                        if ($fetch['ostatus'] == "Pending") {
                                        ?>
                                            <option value="Pending" selected>Pending</option>
                                            <option value="complete">Complete</option>
                                        <?php
                                        } else {
                                        ?>
                                            <option value="Pending">Pending</option>
                                            <option value="complete" selected>Complete</option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <button class="btn btn-primary" name="sub">Update</button>
                            </div>
                        </form>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h4>View Order List</h4>
                            <button class="btn btn-danger text-right empty">Empty Table</button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover" id="tableExport" style="width:100%">
                                    <thead>
                                        <tr>
                                            <!-- <th>ID</th> -->
                                            <th>Product Code</th>
                                            <th>Product Name</th>
                                            <th>Product Price</th>
                                            <th>Total Price</th>
                                            <th>Qty</th>
                                            <!-- <th>Admin Email</th> -->
                                            <th colspan='2'>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody id="cart-table">

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
        // Delete product from cart
        $(document).on("click", ".del", function() {
            let oid = $(this).data("id");
            // alert(aid);
            let btn = this;
            $.ajax({
                method: "GET",
                url: "./ajax/pos-query.php",
                data: {
                    "del-order": oid
                },
                success: function(res) {
                    if (res == 1) {
                        Toast.fire({
                            icon: 'success',
                            title: 'Product deleted from cart!'
                        });
                        $(btn).closest("tr").fadeOut();
                        showUpCart();
                        showPOS();
                    } else {
                        Toast.fire({
                            icon: 'success',
                            title: "Data couldn't be deleted!"
                        });
                    }
                }
            });
        });
        // empty table
        $(".empty").on("click", function() {
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
                    $.ajax({
                        method: "GET",
                        url: "./ajax/pos-query.php",
                        data: {
                            "empty-order": $("#invoice").val()
                        },
                        success: function(res) {
                            if (res == 1) {
                                Swal.fire({
                                    title: "Deleted!",
                                    text: "Data deleted!",
                                    icon: "success"
                                });
                                showUpCart();
                                showPOS();
                            } else if (res == 3) {
                                Swal.fire({
                                    text: "Table is Empty!",
                                    icon: "warning"
                                });
                            } else {
                                Swal.fire({
                                    text: "Data not deleted!",
                                    icon: "error"
                                });
                            }
                        }
                    });
                }
            });
        });
        // add stock
        $(document).on("click", ".add", function() {
            var id = $(this).data("add");
            var pqty = $(this).closest("tr").find("#pqty").val();
            $.ajax({
                method: "POST",
                url: "./ajax/pos-query.php",
                data: {
                    "pid": id,
                    "pqty": pqty,
                    "admin-add": $("#invoice").val()
                },
                success: function(res) {
                    // alert(res);
                    if (res == 1) {
                        Toast.fire({
                            icon: 'error',
                            title: 'Invalid Stock Value!'
                        })
                    } else if (res == 2) {
                        Toast.fire({
                            icon: 'warning',
                            title: 'Product already exists in Order List!'
                        })
                    } else if (res == 3) {
                        $("#pqty").trigger("reset");
                        Toast.fire({
                            icon: 'success',
                            title: 'Product Added!'
                        });
                        showUpCart();
                        showPOS();
                    } else if (res == 4) {
                        Toast.fire({
                            icon: 'error',
                            title: 'Product not added!'
                        })
                    } else {
                        Toast.fire({
                            icon: 'warning',
                            title: 'Product Out of Stock!'
                        });
                    }
                }
            });
        });
        // increment quantity
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
                    "in-order": $("#invoice").val()
                },
                success: function(res) {
                    // alert(res);
                    if (res == 1) {
                        Toast.fire({
                            icon: 'error',
                            title: 'Invalid Stock Value!'
                        });
                        showUpCart();
                    } else if (res == 2) {
                        console.log("Quantity changed!");
                        showUpCart();
                        showPOS();
                    } else if (res == 3) {
                        console.log("Quantity not changed!");
                        showUpCart();
                    } else {
                        Toast.fire({
                            icon: 'warning',
                            title: 'Product Out of Stock!'
                        });
                        showUpCart();
                    }
                }
            });
        });
        // Update POS
        $('#form').on('submit', (e) => {
            e.preventDefault();

            let formdata = new FormData(form);
            formdata.append("upsub", true);
            $.ajax({
                method: "POST",
                url: "./ajax/pos-query.php",
                data: formdata,
                contentType: false,
                processData: false,
                success: function(res) {
                    // alert(res);
                    if (res == 1) {
                        Toast.fire({
                            icon: 'warning',
                            title: 'Please fill all the fields!'
                        })
                    } else if (res == 2) {
                        Toast.fire({
                            icon: 'success',
                            title: 'Data updated!'
                        });
                        showUpCart();
                        showPOS();
                    } else {
                        Toast.fire({
                            icon: 'error',
                            title: 'Data not updated!'
                        })
                    }
                }
            });
        });
        // view Stock
        showPOS();

        function showPOS() {
            $.ajax({
                method: "GET",
                url: "./ajax/view.php",
                data: {
                    'load': 'pos'
                },
                success: function(res) {
                    $("#pos").html(res);
                }
            });
        }
        // update cart
        showUpCart();

        function showUpCart() {
            $.ajax({
                method: "GET",
                url: "./ajax/view.php",
                data: {
                    'invoice': $("#invoice").val()
                },
                success: function(res) {
                    res = JSON.parse(res);
                    $("#cart-table").html(res.output);
                    $("#tprice").val(res.tcash);
                }
            });
        }
    });
</script>