<?php
  session_start();
  if(empty($_SESSION['email'])){
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
                <h4>Add Category</h4>
                <a class="btn btn-primary text-right" href="./view-category.php">View Category</a>
              </div>
              <div class="card-body">
                <div class="form-group">
                  <label for="cname">Category Name</label>
                  <input id="cname" type="text" class="form-control" name="cname" aria-describedby="invalid-cname"
                    required="">
                  <small id="invalid-cname" class="form-text text-danger"></small>
                </div>
                <div class="form-group mb-0">
                  <label for="cdes">Category Description</label>
                  <textarea id="cdes" class="form-control" name="cdes" aria-describedby="invalid-cdes"
                    required=""></textarea>
                  <small id="invalid-cdes" class="form-text"></small>
                </div>
              </div>
              <?php //echo $cname." ".$cdes." ".$cdate;?>
              <div class="card-footer text-right">
                <button class="btn btn-primary" name="catsub">Submit</button>
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
  $(document).ready(function () {
    // Catgory name
    $("#cname").on("input", function () {
      if (!checkalpha("#cname")) {
        $('#cname').css("border", "1px solid red");
        $('#invalid-cname').html("Invalid! only alphabets allowed");
      } else {
        $('#cname').css("border", "");
        $('#invalid-cname').html("");
      }
    });
    //Catgory description
    $("#cdes").on("input", function () {
      let cdes = $('#cdes').val();
      let data = checkdesc("#cdes");
      if (cdes.length < 3) {
        $('#cdes').css("border", "1px solid rgb(219, 219, 92)");
        $('#invalid-cdes').html("Description is too small!");
        $('#invalid-cdes').css("color", "rgb(219, 219, 92)");
      } else if (!data) {
        $('#cdes').css("border", "1px solid red");
        $('#invalid-cdes').css("color", "red");
        $('#invalid-cdes').html("Invalid! Description can only include ' \" ? ! , & ( ) - @ _ symbols");
      } else {
        $('#cdes').css("border", "");
        $('#invalid-cdes').html("");
      }
    });
    // Form Submit
    $("#form").on("submit", function (e) {
      e.preventDefault();
      if (checkalpha("#cname") && checkdesc("#cdes")) {
        let formdata = new FormData(form);
        formdata.append("catsub", true);
        $.ajax({
          method: "POST",
          url: "./ajax/insert.php",
          data: formdata,
          contentType: false,
          processData: false,
          success: function (res) {
            // alert(res);
            if (res == 1) {
              Toast.fire({
                icon: 'warning',
                title: 'Please fill all the fields!'
              })
            } else if (res == 2) {
              Toast.fire({
                icon: 'warning',
                title: 'Category already exists!'
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