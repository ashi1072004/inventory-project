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
            <div class="row justify-content-center">
                <div class="col-12 col-md-6 col-lg-6">
                    <div class="card">
                        <form id="form">
                            <div class="card-header">
                                <h4>Add Coupons</h4>
                                <a class="btn btn-primary text-right" href="./view-coupon.php">View Coupons</a>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="nc">No. of Coupons</label>
                                    <input id="nc" type="number" min="1" class="form-control" name="nc" required="">
                                </div>
                                <div class="form-group">
                                    <label for="startd">Start Date</label>
                                    <input id="startd" type="date" class="form-control" name="startd" aria-describedby="invalid-startd" required="">
                                    <small id="invalid-startd" class="form-text text-danger"></small>
                                </div>
                                <div class="form-group">
                                    <label for="endd">End Date</label>
                                    <input id="endd" type="date" class="form-control" name="endd" aria-describedby="invalid-endd" required="">
                                    <small id="invalid-endd" class="form-text text-danger"></small>
                                </div>
                                <div class="form-group">
                                    <label for="discount">Discount</label>
                                    <select name="discount" id="discount" class="form-control" required="">
                                        <option value="">Select One</option>
                                        <option value="10">10%</option>
                                        <option value="20">20%</option>
                                        <option value="30">30%</option>
                                        <option value="40">40%</option>
                                        <option value="50">50%</option>
                                        <option value="60">60%</option>
                                        <option value="70">70%</option>
                                        <option value="80">80%</option>
                                        <option value="90">90%</option>
                                    </select>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <button class="btn btn-primary" name="sub">Submit</button>
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
        // Start date
        let currentd = new Date().toJSON().slice(0, 10);
        $("#startd").val(currentd);
        // alert($("#endd").val());
        $("#startd").attr("min", currentd);

        function startd() {
            var startd = $("#startd").val();
            $("#endd").attr("min", startd);
            return (startd < currentd);
        }
        $("#startd").on("input", function() {
            if (startd()) {
                $('#startd').css("border", "1px solid red");
                $('#invalid-startd').html("Start Date should not be less than current date.");
            } else {
                $('#startd').css("border", "");
                $('#invalid-startd').html("");
            }
        });
        // End date
        function endd() {
            var startd = $("#startd").val();
            var endd = $("#endd").val();
            return (endd < startd);
        }
        $("#endd").on("input", function() {
            if (endd()) {
                $('#endd').css("border", "1px solid red");
                $('#invalid-endd').html("End Date should not be less than Start date.");
            } else {
                $('#endd').css("border", "");
                $('#invalid-endd').html("");
            }
        });
        // Form Submit
        $("#form").on("submit", function(e) {
            e.preventDefault();
            if (!startd() && !endd()) {
                let formdata = new FormData(form);
                formdata.append("cusub", true);
                // alert(formdata);
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
                            Toast.fire({
                                icon: 'warning',
                                title: 'Invalid Dates!'
                            })
                        } else if (res == 3) {
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
                })
            }
        });
    });
</script>