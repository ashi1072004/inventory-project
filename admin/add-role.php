<?php
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
            <div class="row justify-content-center">
                <div class="col-12 col-md-6 col-lg-6">
                    <div class="card">
                        <form id="form">
                            <div class="card-header">
                                <h4>Add a Role</h4>
                                <a class="btn btn-primary text-right" href="./view-role.php">View Roles</a>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="rname">Role Name</label>
                                    <input id="rname" type="text" class="form-control" name="rname" aria-describedby="invalid-rname" required="">
                                    <small id="invalid-rname" class="form-text text-danger"></small>
                                </div>
                                <div class="form-group mb-0">
                                    <label for="raccess">Role Access</label>
                                    <select name="raccess" class="form-control" id="raccess" required>
                                        <option value="none" selected>Select One</option>
                                        <option value="all">All</option>
                                        <option value="custom">Custom</option>
                                    </select>
                                </div>
                                <div id="check" class="form-group mt-4 mb-0 d-none">
                                    <label class="form-label mb-2">Select Modules:</label><br>
                                    <input type="checkbox" value="Category" name="ac_array[]">Category<br>
                                    <input type="checkbox" value="Sub-Category" name="ac_array[]">Sub-Category<br>
                                    <input type="checkbox" value="Supplier" name="ac_array[]">Supplier<br>
                                    <input type="checkbox" value="Quantity/Measurement" name="ac_array[]">Quantity/Measurement<br>
                                    <input type="checkbox" value="Product" name="ac_array[]">Product<br>
                                    <input type="checkbox" value="" name="ac_array[]" id="Register User">Register User<br>
                                    <input type="checkbox" value="POS" name="ac_array[]">POS<br>
                                    <input type="checkbox" value="Online Orders" name="ac_array[]">Online Orders<br>
                                    <input type="checkbox" value="Roles" name="ac_array[]">Roles<br>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <button class="btn btn-primary" name="rsub">Submit</button>
                            </div>
                        </form>
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
        // show checkboxes
        $("#raccess").on("change", function() {
            if ($(this).val() === "custom") {
                $("#check").removeClass("d-none");
            } else {
                $("#check").addClass("d-none");
            }
        });
        // Catgory name
        $("#rname").on("input", function() {
            if (!checkalpha("#rname")) {
                $('#rname').css("border", "1px solid red");
                $('#invalid-rname').html("Invalid! only alphabets allowed");
            } else {
                $('#rname').css("border", "");
                $('#invalid-rname').html("");
            }
        });
        // Form Submit
        $("#form").on("submit", function(e) {
            e.preventDefault();
            if (checkalpha("#rname")) {
                let formdata = new FormData(form);
                $.ajax({
                    method: "POST",
                    url: "./ajax/insert.php",
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
                            $("#form").trigger("reset");
                            Toast.fire({
                                icon: 'success',
                                title: 'Data inserted!'
                            })
                        } else {
                            Toast.fire({
                                icon: 'error',
                                title: 'Data not inserted'
                            })
                        }
                    }
                });
            } else {
                Toast.fire({
                    icon: 'error',
                    title: 'Please Check Your Inputs!'
                });
            }
        });
    });
</script>