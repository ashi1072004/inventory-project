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
                <h4>Add Quantity/Measurement</h4>
                <a class="btn btn-primary text-right" href="./view-measure.php">View Quantity/Measurement</a>
              </div>
              <div class="card-body">
                <div class="form-group">
                  <label>Quantity/Measurement Name</label>
                  <input type="text" id="mname" class="form-control" name="mname" aria-describedby="invalid-name" required="">
                  <small id="invalid-name" class="form-text text-danger"></small>
                </div>
                <div class="form-group mb-0">
                  <label>Quantity/Measurement Description</label>
                  <textarea id="mdes" class="form-control" name="mdes" aria-describedby="invalid-des"></textarea>
                  <small id="invalid-des" class="form-text"></small>
                </div>
              </div>
              <div class="card-footer text-right">
                <button class="btn btn-primary" name="msub">Submit</button>
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
    // Quantity/Measurement Name
    $("#mname").on("input", function() {
      if (!checkalpha("#mname")) {
        $('#mname').css("border", "1px solid red");
        $('#invalid-name').html("Invalid! only alphabets allowed");
      } else {
        $('#mname').css("border", "");
        $('#invalid-name').html("");
      }
    });
    //Quantity/Measurement description
    function checkmdes(aid) {
      return $(aid).val().match(/^[a-zA-Z0-9 .'"?!,&()@_\-\\n\\r\\s]*$/);
    }
    $("#mdes").on("input", function() {
      if (!checkmdes("#mdes")) {
        $('#mdes').css("border", "1px solid red");
        $('#invalid-des').css("color", "red");
        $('#invalid-des').html("Invalid! Description can only include ' \" ? ! , & ( ) - @ _ symbols");
      } else {
        $('#mdes').css("border", "");
        $('#invalid-des').html("");
      }
    });


    $('#form').on('submit', (e) => {
      e.preventDefault();
      if (checkalpha("#mname") && checkmdes("#mdes")) {
        let formdata = new FormData(form);
        formdata.append("msub", true);
        $.ajax({
          method: "POST",
          url: "./ajax/insert.php",
          data: formdata,
          contentType: false,
          processData: false,
          success: function(res) {
            if (res == 1) {
              Toast.fire({
                icon: 'warning',
                title: 'Please insert Quantity/Measurement Name!'
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