<?php
  include("./include/connect.php");
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
                      <h4>Add Sub-Category</h4>
                      <a class="btn btn-primary text-right" href="./view-subcategory.php">View Sub-Category</a>
                    </div>
                    <div class="card-body">
                      <div class="form-group">
                        <label>Category Name</label>
                        <select id="catid" class="form-control" name="catid" aria-describedby="invalid-ctg" required="">
                            <option value="" selected>Select one</option>
                            <?php
                            $catsql = "SELECT * FROM `category` ";
                            $catrun = mysqli_query($conn, $catsql);
                            while($fetch = mysqli_fetch_assoc($catrun)){
                            ?>                                
                                <option value="<?php echo $fetch['cid']?>"><?php echo $fetch['cname']?></option>
                                <?php
                            }
                            ?>
                        </select>
                        <small id="invalid-ctg" class="form-text text-danger"></small>
                      </div>
                      <div class="form-group">
                        <label>Sub-Category Name</label>
                        <input id="subname" type="text" class="form-control" name="subname" aria-describedby="invalid-name" required="">
                        <small id="invalid-name" class="form-text text-danger"></small>
                      </div>
                      <div class="form-group mb-0">
                        <label>Sub-Category Description</label>
                        <textarea id="subdes" class="form-control" name="subdes" aria-describedby="invalid-des" required=""></textarea>
                        <small id="invalid-des" class="form-text"></small>
                      </div>
                    </div>
                    <div class="card-footer text-right">
                      <button class="btn btn-primary" name="subsub" >Submit</button>
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
  $(document).ready(function(){
    // Catgory ID
    $("#catid").on("input", function(){
      if(!checkid("#catid")){
        $('#catid').css("border", "1px solid red");
        $('#invalid-ctg').html("Please select a Category!");
      } else{
        $('#catid').css("border", "");
        $('#invalid-ctg').html("");
      }
    });
    // Sub-category name
    $("#subname").on("input", function(){
      if (!checkalpha("#subname")) {
        $('#subname').css("border", "1px solid red");
        $('#invalid-name').html("Invalid! only alphabets allowed");
      } else {
        $('#subname').css("border", "");
        $('#invalid-name').html("");
      }
    });
    //Sub-Catgory description
    $("#subdes").on("input", function () {
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
        formdata.append("subsub", true);
        $.ajax({
          method: "POST",
          url: "./ajax/insert.php",
          data: formdata,
          contentType: false,
          processData: false,
          success: function (res) {
            if (res == 1) {
              Toast.fire({
                icon: 'warning',
                title: 'Please fill all the fields!'
              })
            } else if (res == 2) {
              Toast.fire({
                icon: 'warning',
                title: 'Sub-category already exists!'
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
