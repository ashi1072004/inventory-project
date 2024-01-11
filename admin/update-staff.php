<?php
include("./include/connect.php");
session_start();
if (empty($_SESSION['email'])) {
    header('Location: ./login.php');
}
$adid = $_GET['adid'];
$psql = "SELECT * FROM `admin` WHERE `adid` = '$adid' ";
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
                                <h4>Add Staff</h4>
                                <a class="btn btn-primary text-right" href="./view-staff.php">Back</a>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <input type="hidden" name="adid" value="<?php echo $fetch['adid'] ?>">
                                    <label for="aname">Staff Name</label>
                                    <input id="aname" type="text" class="form-control" name="aname" value="<?php echo $fetch['aname'] ?>" aria-describedby="invalid-aname" required="">
                                    <small id="invalid-aname" class="form-text text-danger"></small>
                                </div>
                                <div class="form-group">
                                    <label for="email">Staff Email</label>
                                    <input id="email" type="email" class="form-control" name="email" value="<?php echo $fetch['email'] ?>" aria-describedby="invalid-email" required="">
                                    <small id="invalid-email" class="form-text text-danger"></small>
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input id="password" type="password" class="form-control" name="password" value="<?php echo $fetch['password'] ?>" aria-describedby="invalid-password" required="">
                                    <small id="invalid-password" class="form-text text-danger"></small>
                                </div>
                                <div class="form-group">
                                    <label for="cpass">Confirm Password</label>
                                    <input id="cpass" type="password" class="form-control" name="cpass" value="<?php echo $fetch['password'] ?>" aria-describedby="invalid-cpass" required="">
                                    <small id="invalid-cpass" class="form-text text-danger"></small>
                                </div>
                                <div class="form-group mb-0">
                                    <label for="roleid">Staff Role</label>
                                    <select name="roleid" class="form-control" id="roleid" required>
                                        <option value="" selected>Select One</option>
                                        <?php
                                        $sql = "SELECT * FROM `role`";
                                        $run = mysqli_query($conn, $sql);
                                        while ($rfetch = mysqli_fetch_assoc($run)) {
                                            if ($rfetch['rid'] == $fetch['roleid']) {
                                        ?>
                                                <option value="<?= $rfetch['rid'] ?>" selected><?= $rfetch['rname'] ?></option>
                                            <?php
                                            } else {
                                            ?>
                                                <option value="<?= $rfetch['rid'] ?>"><?= $rfetch['rname'] ?></option>
                                        <?php
                                            }
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
        // Staff name
        $("#aname").on("input", function() {
            if (!checkalpha("#aname")) {
                $('#aname').css("border", "1px solid red");
                $('#invalid-aname').html("Invalid! only alphabets allowed");
            } else {
                $('#aname').css("border", "");
                $('#invalid-aname').html("");
            }
        });
        // Staff email
        $("#email").on("input", function() {
            let data = checkemail("#email");
            if (!data) {
                $('#email').css("border", "1px solid red");
                $('#invalid-email').html("Invalid Email!");
            } else {
                $('#email').css("border", "");
                $('#invalid-email').html("");
            }
        });
        // Password
        $("#password").on("input", function() {
            let data = checkpass("#password");
            if (!data) {
                $('#password').css("border", "1px solid red");
                $('#invalid-password').html("Invalid password!");
            } else {
                $('#password').css("border", "");
                $('#invalid-password').html("");
            }
        });
        // Form Submit
        $("#form").on("submit", function(e) {
            e.preventDefault();
            if (checkalpha("#aname") && checkemail("#email") && checkpass("#password")) {
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
                                title: 'Data updated!'
                            });
                        } else if (res == 4) {
                            Toast.fire({
                                icon: 'error',
                                title: 'Passwords do not match!'
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