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
                            <h4>View User</h4>
                            <a class="btn btn-primary text-right" href="./add-user.php">Add User</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover" id="tableExport" style="width:100%;">
                                    <thead>
                                        <tr>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>User Email</th>
                                            <th>User Mobile #</th>
                                            <th>Country</th>
                                            <th>State</th>
                                            <th>City</th>
                                            <th>Address 1</th>
                                            <th>Address 2</th>
                                            <th>Postal Code</th>
                                            <th>Password</th>
                                            <th>Confirm Password</th>
                                            <th>Status</th>
                                            <th>Date</th>
                                            <th colspan='2'>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sup = "SELECT * FROM `user`";
                                        $run = mysqli_query($conn, $sup);
                                        while ($fetch = mysqli_fetch_assoc($run)) {
                                        ?>
                                            <tr>
                                                <td>
                                                    <?php echo $fetch['ufname'] ?>
                                                </td>
                                                <td>
                                                    <?php echo $fetch['ulname'] ?>
                                                </td>
                                                <td>
                                                    <?php echo $fetch['uemail'] ?>
                                                </td>
                                                <td>
                                                    <?php echo $fetch['umob'] ?>
                                                </td>
                                                <td>
                                                    <?php echo $fetch['country'] ?>
                                                </td>
                                                <td>
                                                    <?php echo $fetch['state'] ?>
                                                </td>
                                                <td>
                                                    <?php echo $fetch['city'] ?>
                                                </td>
                                                <td>
                                                    <?php echo $fetch['add1'] ?>
                                                </td>
                                                <td>
                                                    <?php echo $fetch['add2'] ?>
                                                </td>
                                                <td>
                                                    <?php echo $fetch['pt_code'] ?>
                                                </td>
                                                <td>
                                                    <?php echo $fetch['upass'] ?>
                                                </td>
                                                <td>
                                                    <?php echo $fetch['ucpass'] ?>
                                                </td>
                                                <?php
                                                if ($fetch['ustatus'] == 'Confirmed') {
                                                ?>
                                                    <td class="text-success">
                                                    <?php
                                                } else {
                                                    ?>
                                                    <td class="text-danger">
                                                    <?php
                                                }
                                                    ?>
                                                    <?php echo $fetch['ustatus'] ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $fetch['udate'] ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        if ($fetch['ustatus'] == 'Confirmed') {
                                                        ?>
                                                            <a href="./update-supplier.php?uid=<?php echo $fetch['uid'] ?>"><span data-feather="edit" data-toggle="tooltip" title="Pending"></span></a>
                                                        <?php
                                                        } else {
                                                        ?>
                                                            <a href="./update-supplier.php?uid=<?php echo $fetch['uid'] ?>"><span data-feather="edit" data-toggle="tooltip" title="Confirm"></span></a>
                                                        <?php
                                                        }
                                                        ?>
                                                    </td>
                                                    <td><button data-id="<?php echo $fetch['uid'] ?>" class="del"><span data-feather="trash-2" data-toggle="tooltip" title="Delete"></span></button></td>
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