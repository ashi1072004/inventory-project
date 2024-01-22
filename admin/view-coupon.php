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
                            <h4>View Coupons</h4>
                            <a class="btn btn-primary text-right" href="./add-coupon.php">Add Coupons</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover" id="tableExport" style="width:100%;">
                                    <thead>
                                        <tr>
                                            <th>Coupon Name</th>
                                            <th>Discount</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            <th>Admin Email</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $ctg = "SELECT * FROM `coupon` ";
                                        $run = mysqli_query($conn, $ctg);
                                        while ($fetch = mysqli_fetch_assoc($run)) {
                                        ?>
                                            <tr>
                                                <td>
                                                    <?php echo $fetch['cuname'] ?>
                                                </td>
                                                <td>
                                                    <?php echo $fetch['discount'] ?>%
                                                </td>
                                                <td>
                                                    <?php echo $fetch['startd'] ?>
                                                </td>
                                                <td>
                                                    <?php echo $fetch['endd'] ?>
                                                </td>
                                                <td>
                                                    <?php echo $fetch['aemail'] ?>
                                                </td>
                                                <td><button data-id="<?php echo $fetch['cuid'] ?>" class="del"><span data-feather="trash-2" data-toggle="tooltip" title="Delete"></span></button></td>
                                                <!-- <script>
                                                    feather.replace()
                                                </script> -->
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
                    let cuid = $(this).data("id");
                    // alert(cuid);
                    let btn = this;
                    $.ajax({
                        method: "GET",
                        url: "./ajax/delete.php",
                        data: {
                            "delcuid": cuid
                        },
                        success: function(res) {
                            // alert(res);
                            if (res == 1) {
                                Swal.fire({
                                    title: "Deleted!",
                                    text: "Data has been deleted.",
                                    icon: "success"
                                });
                                $(btn).closest("tr").fadeOut();
                            } else {
                                Swal.fire({
                                    title: "Not Deleted!",
                                    icon: "error"
                                });
                            }
                        }
                    });
                }
            });
        });
    });
</script>