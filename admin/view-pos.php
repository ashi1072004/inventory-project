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
                    <!-- Button trigger modal -->
                    <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                        Launch static backdrop modal
                    </button> -->
                    <!-- Modal -->
                    <!-- <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    ...
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Understood</button>
                                </div>
                            </div>
                        </div>
                    </div> -->
                    <div class="card">
                        <div class="card-header">
                            <h4>View Checkout</h4>
                            <a class="btn btn-primary text-right" href="./pos.php">POS</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover" id="tableExport" style="width:100%;">
                                    <thead>
                                        <tr>
                                            <th>Invoice</th>
                                            <th>Customer Name</th>
                                            <th>Contact No.</th>
                                            <th>Total Cash</th>
                                            <th>Checkout Date</th>
                                            <th>Status</th>
                                            <th class="text-center" colspan='3'>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $psql = "SELECT * FROM `pos`";
                                        $run = mysqli_query($conn, $psql);
                                        while ($fetch = mysqli_fetch_assoc($run)) {
                                        ?>
                                            <tr>
                                                <td>
                                                    <?php echo $fetch['invoice'] ?>
                                                </td>
                                                <td>
                                                    <?php echo $fetch['csname'] ?>
                                                </td>
                                                <td>
                                                    <?php echo $fetch['cmob'] ?>
                                                </td>
                                                <td>
                                                    <?php echo $fetch['tprice'] ?>
                                                </td>
                                                <td>
                                                    <?php echo $fetch['posdate'] ?>
                                                </td>
                                                <td>
                                                    <?php echo $fetch['ostatus'] ?>
                                                </td>
                                                <td><a href="./invoice.php?invoice=<?php echo $fetch['invoice'] ?>" class="btn btn-warning text-white">Invoice</a></td>
                                                <td><a href="./update-pos.php?posid=<?php echo $fetch['posid'] ?>"><span data-feather="edit" data-toggle="tooltip" title="Update"></span></a></td>
                                                <td><button data-id="<?php echo $fetch['invoice'] ?>" class="del"><span data-feather="trash-2" data-toggle="tooltip" title="Cancel"></span></button></td>
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
                    let oid = $(this).data("id");
                    // alert(supid);
                    let btn = this;
                    $.ajax({
                        method: "GET",
                        url: "./ajax/delete.php",
                        data: {
                            "deloid": oid
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
                                alert("Data couldn't be deleted.");
                            }
                        }
                    });
                }
            });
        });
    });
</script>