<?php
include("./include/connect.php");
session_start();
if (empty($_SESSION['email'])) {
  header('Location: ./login.php');
}
$subid = $_GET['subid'];
$csql = "SELECT * FROM `subcategory` WHERE `subid` = '$subid' ";
$crun = mysqli_query($conn, $csql);
$fetch = mysqli_fetch_assoc($crun);

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
                <h4>Update Sub-Category</h4>
                <a class="btn btn-primary text-right" href="./view-subcategory.php">Back</a>
              </div>
              <div class="card-body">
                <div class="form-group">
                  <label>Category Name</label>
                  <select id="catid" class="form-control" name="catid" aria-describedby="invalid-ctg" required="">
                    <option value="">Select one</option>
                    <?php
                    $catsql = "SELECT * FROM `category` ";
                    $catrun = mysqli_query($conn, $catsql);
                    while ($cfetch = mysqli_fetch_assoc($catrun)) {
                      if ($cfetch['cid'] == $fetch['catid']) {
                    ?>
                        <option value="<?php echo $cfetch['cid'] ?>" selected>
                          <?php echo $cfetch['cname'] ?>
                        </option>
                      <?php
                      } else {
                      ?>
                        <option value="<?php echo $cfetch['cid'] ?>">
                          <?php echo $cfetch['cname'] ?>
                        </option>
                    <?php
                      }
                    }
                    ?>
                  </select>
                  <small id="invalid-ctg" class="form-text text-danger"></small>
                </div>
                <input type="hidden" class="form-control" name="subid" value="<?php echo $fetch['subid'] ?>">
                <div class="form-group">
                  <label>Sub-Category Name</label>
                  <input id="subname" type="text" class="form-control" name="subname" value="<?php echo $fetch['subname'] ?>" aria-describedby="invalid-name" required>
                  <small id="invalid-name" class="form-text text-danger"></small>
                </div>
                <div class="form-group mb-0">
                  <label>Sub-Category Description</label>
                  <textarea id="subdes" class="form-control" name="subdes" aria-describedby="invalid-des" required><?php echo $fetch['subdes'] ?></textarea>
                  <small id="invalid-des" class="form-text"></small>
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
    // Catgory ID
    $("#catid").on("input", function() {
      if (!checkid("#catid")) {
        $('#catid').css("border", "1px solid red");
        $('#invalid-ctg').html("Please select a Category!");
      } else {
        $('#catid').css("border", "");
        $('#invalid-ctg').html("");
      }
    });
    // Sub-category name
    $("#subname").on("input", function() {
      if (!checkalpha("#subname")) {
        $('#subname').css("border", "1px solid red");
        $('#invalid-name').html("Invalid! only alphabets allowed");
      } else {
        $('#subname').css("border", "");
        $('#invalid-name').html("");
      }
    });
    //Sub-Catgory description
    $("#subdes").on("input", function() {
      let subdes = $('#subdes').val();
      if (subdes.length < 3) {
        $('#subdes').css("border", "1px solid rgb(219, 219, 92)");
        $('#invalid-des').html("Description is too small!");
        $('#invalid-des').css("color", "rgb(219, 219, 92)");
      } else if (!checkdesc("#subdes")) {
        $('#subdes').css("border", "1px solid red");
        $('#invalid-des').css("color", "red");
        $('#invalid-des').html("Invalid! Description can only include ' \" ? ! , & ( ) - @ _ symbols");
      } else {
        $('#subdes').css("border", "");
        $('#invalid-des').html("");
      }
    });

    $('#form').on('submit', (e) => {
      e.preventDefault();
      if (checkid("#catid") && checkalpha("#subname") && checkdesc("#subdes")) {
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