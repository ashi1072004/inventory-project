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
                <h4>Add Supplier</h4>
                <a class="btn btn-primary text-right" href="./view-supplier.php">View Supplier</a>
              </div>
              <div class="card-body">
                <div class="form-group">
                  <label>Supplier Name</label>
                  <input type="text" id="supname" class="form-control" name="supname" aria-describedby="invalid-name" required>
                  <small id="invalid-name" class="form-text text-danger"></small>
                </div>
                <div class="form-group">
                  <label>Supplier Email</label>
                  <input type="email" id="supemail" class="form-control" name="supemail" aria-describedby="invalid-email" required>
                  <small id="invalid-email" class="form-text text-danger"></small>
                </div>
                <div class="form-group">
                  <label>Supplier Mobile #</label>
                  <input type="tel" id="supmob" class="form-control" name="supmob" aria-describedby="invalid-mob" required>
                  <small id="invalid-mob" class="form-text text-danger"></small>
                </div>
              </div>
              <div class="card-footer text-right">
                <button class="btn btn-primary" name="supsub">Submit</button>
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
    // Supplier name
    $("#supname").on("input", function() {
      let data = checkalpha("#supname");
      if (!data) {
        $('#supname').css("border", "1px solid red");
        $('#invalid-name').html("Invalid Supplier Name!");
      } else {
        $('#supname').css("border", "");
        $('#invalid-name').html("");
      }
    });
    // Supplier email
    $("#supemail").on("input", function() {
      let data = checkemail("#supemail");
      if (!data) {
        $('#supemail').css("border", "1px solid red");
        $('#invalid-email').html("Invalid Email!");
      } else {
        $('#supemail').css("border", "");
        $('#invalid-email').html("");
      }
    });
    // Supplier mobile
    $("#supmob").on("input", function() {
      let data = checkmob("#supmob");
      if (!data) {
        $('#supmob').css("border", "1px solid red");
        $('#invalid-mob').html("Invalid Mobile number!");
      } else {
        $('#supmob').css("border", "");
        $('#invalid-mob').html("");
      }
    });

    $('#form').on('submit', (e) => {
      e.preventDefault();

      if (checkalpha("#supname") && checkemail("#supemail") && checkmob("#supmob")) {
        let formdata = new FormData(form);
        formdata.append("supsub", true);
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
        })
      }
    });
  });
</script>