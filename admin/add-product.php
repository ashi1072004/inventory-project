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
                <h4>Add Product</h4>
                <a class="btn btn-primary text-right" href="./view-product.php">View Product</a>
              </div>
              <div class="card-body">
                <div class="form-group">
                  <label>Category Name</label>
                  <select id="pcat" class="form-control" name="pcat" aria-describedby="invalid-pcat" required>
                    <option value="" selected>Select one</option>
                    <?php
                    $catsql = "SELECT * FROM `category` ";
                    $catrun = mysqli_query($conn, $catsql);
                    while ($cfetch = mysqli_fetch_assoc($catrun)) {
                    ?>
                      <option value="<?php echo $cfetch['cid'] ?>">
                        <?php echo $cfetch['cname'] ?>
                      </option>
                    <?php
                    }
                    ?>
                  </select>
                  <small id="invalid-pcat" class="form-text text-danger"></small>
                </div>
                <div class="form-group">
                  <label>Sub-Category Name</label>
                  <select id="psubcat" class="form-control" name="psubcat" aria-describedby="invalid-psubcat" required>
                    <option value="" selected>Select one</option>
                    <?php
                    $subsql = "SELECT * FROM `subcategory` ";
                    $subrun = mysqli_query($conn, $subsql);
                    while ($sfetch = mysqli_fetch_assoc($subrun)) {
                    ?>
                      <option value="<?php echo $sfetch['subid'] ?>">
                        <?php echo $sfetch['subname'] ?>
                      </option>
                    <?php
                    }
                    ?>
                  </select>
                  <small id="invalid-psubcat" class="form-text text-danger"></small>
                </div>
                <div class="form-group">
                  <label>Supplier Name</label>
                  <select id="psup" class="form-control" name="psup" aria-describedby="invalid-psup" required>
                    <option value="" selected>Select one</option>
                    <?php
                    $supsql = "SELECT * FROM `supplier` ";
                    $suprun = mysqli_query($conn, $supsql);
                    while ($supfetch = mysqli_fetch_assoc($suprun)) {
                    ?>
                      <option value="<?php echo $supfetch['supid'] ?>">
                        <?php echo $supfetch['supname'] ?>
                      </option>
                    <?php
                    }
                    ?>
                  </select>
                  <small id="invalid-psup" class="form-text text-danger"></small>
                </div>
                <div class="form-group">
                  <label>Product Code</label>
                  <input id="pcode" type="text" class="form-control" name="pcode" aria-describedby="invalid-pcode" required>
                  <small id="invalid-pcode" class="form-text text-danger"></small>
                </div>
                <div class="form-group">
                  <label>Product Name</label>
                  <input type="text" id="pname" class="form-control" name="pname" aria-describedby="invalid-pname" required>
                  <small id="invalid-pname" class="form-text text-danger"></small>
                </div>
                <div class="form-group">
                  <label>Product Description</label>
                  <textarea id="pdes" class="form-control" name="pdes" aria-describedby="invalid-pdes" required></textarea>
                  <small id="invalid-pdes" class="form-text"></small>
                </div>
                <div class="form-group">
                  <label>Product Unit Price</label>
                  <input type="number" id="pcost" class="form-control" name="pcost" aria-describedby="invalid-pcost" required>
                  <small id="invalid-pcost" class="form-text text-danger"></small>
                </div>
                <div class="form-group">
                  <label>Product Sale Price</label>
                  <input type="number" id="psale" class="form-control" name="psale" aria-describedby="invalid-psale" required>
                  <small id="invalid-psale" class="form-text text-danger"></small>
                </div>
                <div class="form-group">
                  <label>Quantity/Measurement Name</label>
                  <select id="pmes" class="form-control" name="pmes" aria-describedby="invalid-pmes" required>
                    <option value="" selected>Select one</option>
                    <?php
                    $msql = "SELECT * FROM `measure` ";
                    $mrun = mysqli_query($conn, $msql);
                    while ($mfetch = mysqli_fetch_assoc($mrun)) {
                    ?>
                      <option value="<?php echo $mfetch['mid'] ?>">
                        <?php echo $mfetch['mname'] ?>
                      </option>
                    <?php
                    }
                    ?>
                  </select>
                  <small id="invalid-pmes" class="form-text text-danger"></small>
                </div>
                <div class="form-group">
                  <label>Product Stock</label>
                  <input type="number" id="pstock" class="form-control" name="pstock" aria-describedby="invalid-pstock" required>
                  <small id="invalid-pstock" class="form-text text-danger"></small>
                </div>
                <div class="form-group">
                  <label>Product Pic</label><br>
                  <span data-feather="image" width="70" height="70" style="cursor:pointer" onclick="$('#ppic').click()"></span>
                  <input type="file" multiple name="ppic[]" id="ppic" style="display:none">
                </div>
                <div class="form-group">
                  <label>Product Status</label><br>
                  <input type="radio" class="mx-2" name="status" value="online" required checked>Online
                  <input type="radio" class="mx-2" name="status" value="offline" required>Offline
                </div>
              </div>
              <div class="card-footer text-right">
                <button class="btn btn-primary" name="psub">Submit</button>
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
    $("#pcat").on("input", function() {
      if (!checkid("#pcat")) {
        $('#pcat').css("border", "1px solid red");
        $('#invalid-pcat').html("Please select a Category!");
      } else {
        $('#pcat').css("border", "");
        $('#invalid-pcat').html("");
      }
    });
    // Sub-Catgory ID
    $("#psubcat").on("input", function() {
      if (!checkid("#psubcat")) {
        $('#psubcat').css("border", "1px solid red");
        $('#invalid-psubcat').html("Please select a Sub Category!");
      } else {
        $('#psubcat').css("border", "");
        $('#invalid-psubcat').html("");
      }
    });
    // Supplier ID
    $("#psup").on("input", function() {
      if (!checkid("#psup")) {
        $('#psup').css("border", "1px solid red");
        $('#invalid-psup').html("Please select a Supplier!");
      } else {
        $('#psup').css("border", "");
        $('#invalid-psup').html("");
      }
    });
    // Quantity/Measurement ID
    $("#pmes").on("input", function() {
      if (!checkid("#pmes")) {
        $('#pmes').css("border", "1px solid red");
        $('#invalid-pmes').html("Please select a Quantity/Measurement!");
      } else {
        $('#pmes').css("border", "");
        $('#invalid-pmes').html("");
      }
    });
    // Product code
    $("#pcode").on("focus", function() {
      $('#pcode').css("border", "");
      $('#invalid-pcode').html("");
    });
    // Product name
    $("#pname").on("input", function() {
      if (!checkalpha("#pname")) {
        $('#pname').css("border", "1px solid red");
        $('#invalid-pname').html("Invalid! only alphabets allowed");
      } else {
        $('#pname').css("border", "");
        $('#invalid-pname').html("");
      }
    });
    //Product description
    $("#pdes").on("input", function() {
      let pdes = $('#pdes').val();
      if (pdes.length < 3) {
        $('#pdes').css("border", "1px solid rgb(219, 219, 92)");
        $('#invalid-pdes').html("Description is too small!");
        $('#invalid-pdes').css("color", "rgb(219, 219, 92)");
      } else if (!checkdesc("#pdes")) {
        $('#pdes').css("border", "1px solid red");
        $('#invalid-pdes').css("color", "red");
        $('#invalid-pdes').html("Invalid! Description can only include ' \" ? ! , & ( ) - @ _ symbols");
      } else {
        $('#pdes').css("border", "");
        $('#invalid-pdes').html("");
      }
    });
    // Product cost
    $("#pcost").on("input", function() {
      if (!checkcost("#pcost")) {
        $('#pcost').css("border", "1px solid red");
        $('#invalid-pcost').html("Invalid! Product cost can be upto 1000000000");
      } else {
        $('#pcost').css("border", "");
        $('#invalid-pcost').html("");
      }
    });
    // Product sale
    $("#psale").on("input", function() {
      if (!checkcost("#psale")) {
        $('#psale').css("border", "1px solid red");
        $('#invalid-psale').html("Invalid! Product sale price can be upto 1000000000");
      } else {
        $('#psale').css("border", "");
        $('#invalid-psale').html("");
      }
    });
    // Product stock
    $("#pstock").on("input", function() {
      if (!checkstock("#pstock")) {
        $('#pstock').css("border", "1px solid red");
        $('#invalid-pstock').html("Invalid! Product stock can be upto 1000");
      } else {
        $('#pstock').css("border", "");
        $('#invalid-pstock').html("");
      }
    });

    $('#form').on('submit', (e) => {
      e.preventDefault();
      if (!checkcode("#pcode")) {
        $('#pcode').css("border", "1px solid red");
        $('#invalid-pcode').html("Product code should be numeric and its length should be 12 characters");
      }

      if (checkid("#pcat") && checkid("#psubcat") && checkid("#psup") && checkid("#pmes") && checkcode("#pcode") && checkalpha("#pname") && checkdesc("#pdes") && checkcost("#pcost") && checkcost("#psale") && checkstock("#pstock")) {
        let formdata = new FormData(form);
        formdata.append("psub", true);
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
                title: 'Product already exists!'
              })
            } else if (res == 3) {
              Toast.fire({
                icon: 'warning',
                title: 'Product with this code already exists!'
              })
            } else if (res == 4) {
              $("#form").trigger("reset");
              Toast.fire({
                icon: 'success',
                title: 'Data inserted!'
              })
            } else if (res == 5) {
              Toast.fire({
                icon: 'error',
                title: 'Data not inserted!'
              })
            } else if (res == 6) {
              Toast.fire({
                icon: 'warning',
                title: 'Invalid Image!'
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