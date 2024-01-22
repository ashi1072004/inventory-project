<?php
include("./include/connect.php");
session_start();
if (empty($_SESSION['email'])) {
    header('Location: ./login.php');
}
$rid = $_GET['rid'];
$rsql = "SELECT * FROM `role` WHERE `rid` = '$rid' ";
$rrun = mysqli_query($conn, $rsql);
$fetch = mysqli_fetch_assoc($rrun);

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
                                <h4>Update Role</h4>
                                <a class="btn btn-primary text-right" href="./view-role.php">Back</a>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <input type="hidden" class="form-control" name="rid" value="<?php echo $fetch['rid'] ?>">
                                    <label for="rname">Role Name</label>
                                    <input id="rname" type="text" class="form-control" name="rname" aria-describedby="invalid-rname" value="<?php echo $fetch['rname'] ?>" required="">
                                    <small id="invalid-rname" class="form-text text-danger"></small>
                                </div>
                                <div class="form-group mb-0">
                                    <label for="raccess">Role Access</label>
                                    <select name="raccess" class="form-control" id="raccess" required>
                                        <option value="none" selected>Select One</option>
                                        <?php
                                        if ($fetch['raccess'] == 'custom') {
                                        ?>
                                            <option value="all">All</option>
                                            <option value="custom" selected>Custom</option>
                                        <?php
                                        } else {
                                        ?>
                                            <option value="all" selected>All</option>
                                            <option value="custom">Custom</option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div id="check" class="form-group mt-4 mb-0">
                                    <label class="form-label mb-2">Select Modules:</label><br>
                                    <?php
                                    if ($fetch['raccess'] == 'custom') {
                                        $roles = unserialize($fetch['ac_array']);
                                        $all_roles = array('Staff', 'Category', 'Sub-Category', 'Supplier', 'Quantity/Measurement', 'Product', 'Register User', 'POS', 'Online Orders', 'Roles');
                                        foreach ($all_roles as $value) {
                                            $isChecked = in_array($value, $roles) ? 'checked' : '';
                                            echo '<input type="checkbox" value="' . htmlspecialchars($value) . '" name="ac_array[]" ' . $isChecked . '>' . htmlspecialchars($value) . '<br>';
                                        }
                                    } else {
                                    ?>
                                        <input type="checkbox" value="Staff" name="ac_array[]">Staff<br>
                                        <input type="checkbox" value="Category" name="ac_array[]">Category<br>
                                        <input type="checkbox" value="Sub-Category" name="ac_array[]">Sub-Category<br>
                                        <input type="checkbox" value="Supplier" name="ac_array[]">Supplier<br>
                                        <input type="checkbox" value="Quantity/Measurement" name="ac_array[]">Quantity/Measurement<br>
                                        <input type="checkbox" value="Product" name="ac_array[]">Product<br>
                                        <input type="checkbox" value="Coupon" name="ac_array[]">Coupon<br>
                                        <input type="checkbox" value="" name="ac_array[]" id="Register User">Register User<br>
                                        <input type="checkbox" value="POS" name="ac_array[]">POS<br>
                                        <input type="checkbox" value="Online Orders" name="ac_array[]">Online Orders<br>
                                        <input type="checkbox" value="Roles" name="ac_array[]">Roles<br>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <button class="btn btn-primary" name="sub">Update</button>
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
        if ($("#raccess").val() === "custom") {
            $("#check").removeClass("d-none");
        } else {
            $("#check").addClass("d-none");
        }
        $("#raccess").on("change", function() {
            if (!($("#raccess").val() === "custom")) {
                $("#check").addClass("d-none");
            } else {
                $("#check").removeClass("d-none");
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
                    url: "./ajax/update.php",
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
                            // $("#form").trigger("reset");
                            Toast.fire({
                                icon: 'success',
                                title: 'Data updated!'
                            });
                        } else {
                            Toast.fire({
                                icon: 'error',
                                title: 'Data not updated'
                            })
                        }
                    }
                });
            } else {
                Toast.fire({
                    icon: 'error',
                    title: 'Please Check Your Inputs!'
                })
            }
        });
    });
</script>