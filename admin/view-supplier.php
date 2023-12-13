<?php
include("./include/connect.php");
session_start();
if (empty($_SESSION['email'])) {
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
              <h4>View Supplier</h4>
              <a class="btn btn-primary text-right" href="./add-supplier.php">Add Supplier</a>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-striped table-hover" id="tableExport" style="width:100%;">
                  <thead>
                    <tr>
                      <th>Supplier Name</th>
                      <th>Supplier Email</th>
                      <th>Supplier Mobile #</th>
                      <th>Date</th>
                      <th colspan='2'>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $sup = "SELECT * FROM `supplier`";
                    $run = mysqli_query($conn, $sup);
                    while ($fetch = mysqli_fetch_assoc($run)) {
                    ?>
                      <tr>
                        <td>
                          <?php echo $fetch['supname'] ?>
                        </td>
                        <td>
                          <?php echo $fetch['supemail'] ?>
                        </td>
                        <td>
                          <?php echo $fetch['supmob'] ?>
                        </td>
                        <td>
                          <?php echo $fetch['supdate'] ?>
                        </td>
                        <td><a href="./update-supplier.php?supid=<?php echo $fetch['supid'] ?>"><span data-feather="edit" data-toggle="tooltip" title="Update"></span></a></td>
                        <td><button data-id="<?php echo $fetch['supid'] ?>" class="del"><span data-feather="trash-2" data-toggle="tooltip" title="Delete"></span></button></td>
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
  $(document).ready(function() {
    $(document).on("click", ".del", function() {
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
          let supid = $(this).data("id");
          // alert(supid);
          let btn = this;
          $.ajax({
            method: "GET",
            url: "./ajax/delete.php",
            data: {
              "delsupid": supid
            },
            success: function(res) {
              if (res == 1) {
                Swal.fire({
                  title: "Deleted!",
                  text: "Data has been deleted.",
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