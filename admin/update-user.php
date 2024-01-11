<?php
include("./include/connect.php");
session_start();
if (empty($_SESSION['email'])) {
    header('Location: ./login.php');
}
$uid = $_GET['uid'];
$psql = "SELECT * FROM `user` WHERE `uid` = '$uid' ";
$prun = mysqli_query($conn, $psql);
$fetch = mysqli_fetch_assoc($prun);
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
                                <h4>Add User</h4>
                                <a class="btn btn-primary text-right" href="./view-user.php">Back</a>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label>First Name</label>
                                    <input type="hidden" name="uid" value="<?php echo $fetch['uid'] ?>">
                                    <input type="text" id="ufname" class="form-control" name="ufname" value="<?php echo $fetch['ufname'] ?>" aria-describedby="invalid-fname" required>
                                    <small id="invalid-fname" class="form-text text-danger"></small>
                                </div>
                                <div class="form-group">
                                    <label>Last Name</label>
                                    <input type="text" id="ulname" class="form-control" name="ulname" value="<?php echo $fetch['ulname'] ?>" aria-describedby="invalid-lname" required>
                                    <small id="invalid-lname" class="form-text text-danger"></small>
                                </div>
                                <div class="form-group">
                                    <label>User Email</label>
                                    <input type="email" id="uemail" class="form-control" name="uemail" value="<?php echo $fetch['uemail'] ?>" aria-describedby="invalid-email" required>
                                    <small id="invalid-email" class="form-text text-danger"></small>
                                </div>
                                <div class="form-group">
                                    <label>User Mobile #</label>
                                    <input type="tel" id="umob" class="form-control" name="umob" value="<?php echo $fetch['umob'] ?>" aria-describedby="invalid-mob" required>
                                    <small id="invalid-mob" class="form-text text-danger"></small>
                                </div>
                                <div class="form-group">
                                    <label>Country</label>
                                    <input type="text" id="country" class="form-control" name="country" value="<?php echo $fetch['country'] ?>" aria-describedby="invalid-cn" required>
                                    <small id="invalid-cn" class="form-text text-danger"></small>
                                </div>
                                <div class="form-group">
                                    <label>State</label>
                                    <input type="text" id="state" class="form-control" name="state" value="<?php echo $fetch['state'] ?>" aria-describedby="invalid-st" required>
                                    <small id="invalid-st" class="form-text text-danger"></small>
                                </div>
                                <div class="form-group">
                                    <label>City</label>
                                    <input type="text" id="city" class="form-control" name="city" value="<?php echo $fetch['city'] ?>" aria-describedby="invalid-ct" required>
                                    <small id="invalid-ct" class="form-text text-danger"></small>
                                </div>
                                <div class="form-group">
                                    <label>Address 1</label>
                                    <input type="text" id="add1" class="form-control" name="add1" value="<?php echo $fetch['add1'] ?>" aria-describedby="invalid-add1" required>
                                    <small id="invalid-add1" class="form-text text-danger"></small>
                                </div>
                                <div class="form-group">
                                    <label>Address 2</label>
                                    <input type="text" id="add2" class="form-control" name="add2" value="<?php echo $fetch['add2'] ?>" aria-describedby="invalid-add2" required>
                                    <small id="invalid-add2" class="form-text text-danger"></small>
                                </div>
                                <div class="form-group">
                                    <label>Postal Code</label>
                                    <input type="number" id="pt_code" class="form-control" name="pt_code" value="<?php echo $fetch['pt_code'] ?>" aria-describedby="invalid-code" required>
                                    <small id="invalid-code" class="form-text text-danger"></small>
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" id="upass" class="form-control" name="upass" value="<?php echo $fetch['upass'] ?>" aria-describedby="invalid-upass" required>
                                    <small id="invalid-upass" class="form-text text-danger"></small>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <input type="submit" value="Update" class="btn btn-primary">
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
        let data = function(d, inp, inv) {
            if (!d) {
                $(inp).css("border", "1px solid red");
                $(inv).html("Invalid Data!");
            } else {
                $(inp).css("border", "");
                $(inv).html("");
            }
        };
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
        // Password
        $("#upass").on("input", function() {
            data(checkpass("#upass"), $('#upass'), $('#invalid-upass'));
        });

        $('#form').on('submit', (e) => {
            e.preventDefault();

            if (checkalpha("#ufname") && checkalpha("#ulname") && checkemail("#uemail") && checkmob("#umob") && checkalpha("#country") && checkalpha("#state") && checkalpha("#city") && checkdesc("#add1") && checkadd("#add2") && checkptcode("#pt_code") && checkpass("#upass")) {
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
                            });
                        } else if (res == 2) {
                            Toast.fire({
                                icon: 'success',
                                title: 'Data Updated!'
                            });
                        } else {
                            Toast.fire({
                                icon: 'error',
                                title: 'Data not updated'
                            });
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