<?php
  include("./include/connect.php");
  session_start();
  if(empty($_SESSION['email'])){
    header('Location: ./login.php');
  }
  include("./include/header.php");
  include("./include/sidebar.php");
?>
<style>
  td>button,
  td>button:focus {
    border: none;
    outline: none;
    background: none;
    color: #6777ef;
  }
</style>
<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-body">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>View Sub-Category</h4>
              <a class="btn btn-primary text-right" href="./add-subcategory.php">Add Sub-Category</a>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-striped table-hover" id="tableExport" style="width:100%;">
                  <thead>
                    <tr>
                      <th>Category Name</th>
                      <th>Sub-Category Name</th>
                      <th>Sub-Category Description</th>
                      <th>Date</th>
                      <th colspan='2'>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                            $subcat = "SELECT * FROM `subcategory` sub INNER JOIN `category` ctg ON sub.catid=ctg.cid ORDER BY `cname` ";
                            $run = mysqli_query($conn, $subcat);
                            while($fetch = mysqli_fetch_assoc($run)){
                            ?>
                    <tr>
                      <td>
                        <?php echo $fetch['cname']?>
                      </td>
                      <td>
                        <?php echo $fetch['subname']?>
                      </td>
                      <td>
                        <?php echo $fetch['subdes']?>
                      </td>
                      <td>
                        <?php echo $fetch['subdate']?>
                      </td>
                      <td><a href="./update-subcategory.php?subid=<?php echo $fetch['subid']?>"><span
                            data-feather="edit" data-toggle="tooltip" title="Update"></span></a></td>
                      <td><button data-id="<?php echo $fetch['subid']?>" class="del"><span data-feather="trash-2"
                            data-toggle="tooltip" title="Delete"></span></button></td>
                    </tr>
                    <?php
                            }
                        ?>
                  </tbody>
                </table>
              </div>
            </div>
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
    $(document).on("click", ".del", function () {
      Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "btn btn-success",
        cancelButtonColor: "btn btn-danger",
        confirmButtonText: "Yes"
      }).then((result) => {
        if (result.isConfirmed) {
          let subid = $(this).data("id");
          // alert(subid);
          let btn = this;
          $.ajax({
            method: "GET",
            url: "./ajax/delete.php",
            data: { "delsubid": subid },
            success: function (res) {
              if (res == 1) {
                Swal.fire({
                  title: "Deleted!",
                  text: "Your file has been deleted.",
                  icon: "success"
                });
                $(btn).closest("tr").fadeOut();
              } else {
                alert("Data couldn't be deleted.");
              }
            }
          });
        }
      });
    });
  });
</script>