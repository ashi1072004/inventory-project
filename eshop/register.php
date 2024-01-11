<?php
include('../admin/include/connect.php');
?>
<!DOCTYPE html>
<html lang="zxx">

<head>
    <!-- Meta Tag -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name='copyright' content=''>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Title Tag  -->
    <title>Eshop</title>
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="images/favicon.png">
    <!-- Web Font -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">

    <!-- StyleSheet -->

    <!-- Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="css/font-awesome.css">
    <!-- Themify Icons -->
    <link rel="stylesheet" href="css/themify-icons.css">
    <!-- Nice Select CSS -->
    <link rel="stylesheet" href="css/niceselect.css">

    <!-- Eshop StyleSheet -->
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css/responsive.css">



</head>

<body class="js">

    <!-- Preloader -->
    <div class="preloader">
        <div class="preloader-inner">
            <div class="preloader-icon">
                <span></span>
                <span></span>
            </div>
        </div>
    </div>
    <!-- End Preloader -->

    <!-- Breadcrumbs -->
    <div class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bread-inner">
                        <ul class="bread-list">
                            <li><i class="ti-arrow-left"></i><a href="./index.php">Go Back to Home page</a></li>
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
                    <div class="checkout-form">

                        <!-- Form -->
                        <form id="form" class="form">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-group">
                                        <label>First Name<span>*</span></label>
                                        <input type="text" id="ufname" name="ufname" aria-describedby="invalid-fname" required>
                                        <small id="invalid-fname" class="form-text text-danger"></small>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-group">
                                        <label>Last Name</label>
                                        <input type="text" id="ulname" name="ulname" aria-describedby="invalid-lname">
                                        <small id="invalid-lname" class="form-text text-danger"></small>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-group">
                                        <label>Email Address<span>*</span></label>
                                        <input type="email" id="uemail" name="uemail" aria-describedby="invalid-email" required>
                                        <small id="invalid-email" class="form-text text-danger"></small>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-group">
                                        <label>Phone Number</label>
                                        <input type="tel" id="umob" name="umob" aria-describedby="invalid-mob">
                                        <small id="invalid-mob" class="form-text text-danger"></small>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-group">
                                        <label>Country</label>
                                        <input type="text" name="country" id="country" aria-describedby="invalid-cn">
                                        <small id="invalid-cn" class="form-text text-danger"></small>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-group">
                                        <label>State / Divition</label>
                                        <input type="text" name="state" id="state" aria-describedby="invalid-st">
                                        <small id="invalid-st" class="form-text text-danger"></small>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-group">
                                        <label>City</label>
                                        <input type="text" name="city" id="city" aria-describedby="invalid-ct">
                                        <small id="invalid-ct" class="form-text text-danger"></small>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-group">
                                        <label>Postal Code</label>
                                        <input type="text" id="pt_code" name="pt_code" aria-describedby="invalid-code">
                                        <small id="invalid-code" class="form-text text-danger"></small>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-group">
                                        <label>Address Line 1</label>
                                        <input type="text" id="add1" name="add1" aria-describedby="invalid-add1">
                                        <small id="invalid-add1" class="form-text text-danger"></small>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-group">
                                        <label>Address Line 2</label>
                                        <input type="text" id="add2" name="add2" aria-describedby="invalid-add2">
                                        <small id="invalid-add2" class="form-text text-danger"></small>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-group">
                                        <label>Password<span>*</span></label>
                                        <input type="password" id="upass" name="upass" aria-describedby="invalid-upass" required>
                                        <small id="invalid-upass" class="form-text text-danger"></small>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-group">
                                        <label>Confirm Password<span>*</span></label>
                                        <input type="password" id="ucpass" name="ucpass" aria-describedby="invalid-ucpass" required>
                                        <small id="invalid-ucpass" class="form-text text-danger"></small>
                                    </div>
                                </div>
                                <div class="col-12 text-center">
                                    <div class="form-group button">
                                        <button type="submit" name="usub" class="btn">Create Account</button>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <span>Already have an account? <a style="color:blue" href="./login.php">Login</a></span>
                                </div>
                            </div>
                        </form>
                        <!--/ End Form -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--/ End Checkout -->

    <!-- Jquery -->
    <script src="js/jquery.min.js"></script>
    <script src="js/jquery-migrate-3.0.0.js"></script>
    <script src="js/jquery-ui.min.js"></script>
    <!-- Popper JS -->
    <script src="js/popper.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="js/bootstrap.min.js"></script>
    <!-- Nice Select JS -->
    <script src="js/nicesellect.js"></script>
    <!-- ScrollUp JS -->
    <script src="js/scrollup.js"></script>
    <!-- Active JS -->
    <script src="js/active.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../admin/assets/js/custom.js"></script>
    <script>
        $(document).ready(function() {
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
            // Password
            $("#upass").on("input", function() {
                data(checkpass("#upass"), $('#upass'), $('#invalid-upass'));
            });
            // Confirm Password
            $("#ucpass").on("input", function() {
                data(checkpass("#ucpass"), $('#ucpass'), $('#invalid-ucpass'));
            });

            $('#form').on('submit', (e) => {
                e.preventDefault();

                if (checkalpha("#ufname") && checkemail("#uemail") && checkpass("#upass") && checkpass("#ucpass")) {
                    let formdata = new FormData(form);
                    formdata.append("usub", true);
                    // console.log(formdata);
                    $.ajax({
                        method: "POST",
                        url: "./ajax/user-register.php",
                        data: formdata,
                        contentType: false,
                        processData: false,
                        success: function(res) {
                            alert(res);
                            if (res == 1) {
                                Toast.fire({
                                    icon: 'warning',
                                    title: 'Please fill required fields!'
                                });
                            } else if (res == 2) {
                                Toast.fire({
                                    icon: 'warning',
                                    title: 'Email ALready Exists!'
                                });
                            } else if (res == 3) {
                                $("#form").trigger("reset");
                                Toast.fire({
                                    icon: 'success',
                                    title: 'Data inserted!'
                                });
                                setTimeout(() => {
                                    window.location.href = './login.php';
                                }, 1000);
                            } else if (res == 5) {
                                Toast.fire({
                                    icon: 'error',
                                    title: 'Passwords do not match!'
                                });
                            } else {
                                Toast.fire({
                                    icon: 'error',
                                    title: 'Data not inserted'
                                });
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
</body>

</html>