<?php
include('./include/all-header.php');
if (empty($_SESSION['uemail'])) {
    echo '<script>window.location.href="./login.php"</script>';
}
$uemail = $_SESSION['uemail'];

$sql = "SELECT * FROM `user` WHERE `uemail`='$uemail' ";
$run = mysqli_query($conn, $sql);
$fetch = mysqli_fetch_assoc($run);
?>
<!-- Breadcrumbs -->
<div class="breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="bread-inner">
                    <ul class="bread-list">
                        <li><a href="./index.php">Home<i class="ti-arrow-right"></i></a></li>
                        <li class="active"><a href="./profile.php">My Account</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Breadcrumbs -->

<!-- Start Checkout -->
<section class="shop checkout section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-12">
                <h2>Your Email</h2>
                <form id="emform" class="form">
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="form-group">
                            <label>Email</label>
                            <span class="float-right" style="cursor: pointer;" title="Edit"><i class="fa fa-pencil" aria-hidden="true"></i></span>
                            <input type="email" id="uemail" name="uemail" value="<?= $fetch['uemail'] ?>" readonly>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-lg-8 col-12">
                <h2>Your Profile Details <span id="edit" class="float-right" style="cursor: pointer;" title="Edit"><i class="fa fa-pencil" aria-hidden="true"></i></span></h2>
                <!-- Form -->
                <form id="form" class="form">
                    <div class="row mt-2">
                        <div class="col-lg-6 col-md-6 col-12">
                            <div class="form-group">
                                <input type="hidden" id="uid" name="uid" value="<?= $fetch['uid'] ?>" readonly>
                                <label>First Name<span>*</span></label>
                                <input type="text" id="ufname" name="ufname" value="<?= $fetch['ufname'] ?>" aria-describedby="invalid-fname" required readonly>
                                <small id="invalid-fname" class="form-text text-danger"></small>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-12">
                            <div class="form-group">
                                <label>Last Name<span>*</span></label>
                                <input type="text" id="ulname" name="ulname" value="<?= $fetch['ulname'] ?>" aria-describedby="invalid-lname" required readonly>
                                <small id="invalid-lname" class="form-text text-danger"></small>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-12">
                            <div class="form-group">
                                <label>Phone Number<span>*</span></label>
                                <input type="tel" id="umob" name="umob" value="<?= $fetch['umob'] ?>" aria-describedby="invalid-mob" required readonly>
                                <small id="invalid-mob" class="form-text text-danger"></small>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-12">
                            <div class="form-group">
                                <label>Country<span>*</span></label>
                                <input type="text" id="country" name="country" value="<?= $fetch['country'] ?>" aria-describedby="invalid-cn" required readonly>
                                <small id="invalid-cn" class="form-text text-danger"></small>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-12">
                            <div class="form-group">
                                <label>State / Divition<span>*</span></label>
                                <input type="text" id="state" name="state" value="<?= $fetch['state'] ?>" aria-describedby="invalid-st" required readonly>
                                <small id="invalid-st" class="form-text text-danger"></small>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-12">
                            <div class="form-group">
                                <label>City<span>*</span></label>
                                <input type="text" id="city" name="city" value="<?= $fetch['city'] ?>" aria-describedby="invalid-ct" required readonly>
                                <small id="invalid-ct" class="form-text text-danger"></small>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-12">
                            <div class="form-group">
                                <label>Address Line 1<span>*</span></label>
                                <input type="text" id="add1" name="add1" value="<?= $fetch['add1'] ?>" aria-describedby="invalid-add1" required readonly>
                                <small id="invalid-add1" class="form-text text-danger"></small>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-12">
                            <div class="form-group">
                                <label>Address Line 2<span>*</span></label>
                                <input type="text" id="add2" name="add2" value="<?= $fetch['add2'] ?>" aria-describedby="invalid-add2" required readonly>
                                <small id="invalid-add2" class="form-text text-danger"></small>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-12">
                            <div class="form-group">
                                <label>Postal Code<span>*</span></label>
                                <input type="text" id="pt_code" name="pt_code" value="<?= $fetch['pt_code'] ?>" aria-describedby="invalid-code" required readonly>
                                <small id="invalid-code" class="form-text text-danger"></small>
                            </div>
                        </div>
                        <div class="col-12 text-center d-none" id="btns">
                            <button class="btn" id="save">Save</button>
                            <button class="btn" id="cancel">Cancel</button>
                        </div>
                    </div>
                </form>
                <!--/ End Form -->
            </div>
        </div>
    </div>
</section>
<?php
include('./include/footer.php');
?>
<script>
    $(document).ready(function() {
        $("#edit").on("click", function() {
            $("#btns").removeClass("d-none");
            $("#edit").addClass("d-none");
            $("#form input").removeAttr("readonly");
        });
        $("#cancel").on("click", function(e) {
            e.preventDefault();
            $("#btns").addClass("d-none");
            $("#edit").removeClass("d-none");
            $("#form input").attr("readonly", true);
        });
        // validate data
        function data(d, inp, inv) {
            if (!d) {
                $(inp).css("border", "1px solid red");
                $(inv).html("Invalid Data!");
            } else {
                $(inp).css("border", "");
                $(inv).html("");
            }
        }
        // User fname
        $("#ufname").on("input", function() {
            data(checkalpha("#ufname"), $('#ufname'), $('#invalid-fname'));
        });
        // User lname
        $("#ulname").on("input", function() {
            data(checkalpha("#ulname"), $('#ulname'), $('#invalid-lname'));
        });
        // User email
        $("#uemail").on("input", function() {
            data(checkemail("#uemail"), $('#uemail'), $('#invalid-email'));
        });
        // User mobile
        $("#umob").on("input", function() {
            data(checkmob("#umob"), $('#umob'), $('#invalid-mob'));
        });
        // Country
        $("#country").on("input", function() {
            data(checkalpha("#country"), $('#country'), $('#invalid-cn'));
        });
        // State
        $("#state").on("input", function() {
            data(checkalpha("#state"), $('#state'), $('#invalid-st'));
        });
        // City
        $("#city").on("input", function() {
            data(checkalpha("#city"), $('#city'), $('#invalid-ct'));
        });
        // Address1
        $("#add1").on("input", function() {
            data(checkdesc("#add1"), $('#add1'), $('#invalid-add1'));
        });
        // Address2
        $("#add2").on("input", function() {
            data(checkadd("#add2"), $('#add2'), $('#invalid-add2'));
        });
        // Postal Code
        $("#pt_code").on("input", function() {
            data(checkptcode("#pt_code"), $('#pt_code'), $('#invalid-code'));
        });
        // checkout
        $("#save").on("click", function(e) {
            e.preventDefault();
            if (checkalpha("#ufname") && checkalpha("#ulname") && checkmob("#umob") && checkalpha("#country") && checkalpha("#state") && checkalpha("#city") && checkdesc("#add1") && checkadd("#add2") && checkptcode("#pt_code")) {
                let formdata = new FormData(form);
                $.ajax({
                    method: "POST",
                    url: "./ajax/user-register.php",
                    data: formdata,
                    contentType: false,
                    processData: false,
                    success: function(res) {
                        // alert(res);
                        if (res == 1) {
                            Toast.fire({
                                icon: 'warning',
                                title: 'Fields cannot be empty!'
                            });
                        } else if (res == 2) {
                            // $("#form").trigger("reset");
                            Toast.fire({
                                icon: 'success',
                                title: 'Data Updated'
                            });
                            $("#btns").addClass("d-none");
                            $("#edit").removeClass("d-none");
                            $("#form input").attr("readonly", true);
                        } else {
                            Toast.fire({
                                icon: 'error',
                                title: 'Error Occured! Could not Proceed'
                            });
                        }
                    }
                });
            } else {
                Toast.fire({
                    icon: 'warning',
                    title: 'Please Check Your Inputs!'
                });
            }
        });
    });
</script>