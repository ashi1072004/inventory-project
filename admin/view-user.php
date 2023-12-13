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
                                            <th>Registered</th>
                                            <th>Status</th>
                                            <th colspan='3'>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody">
                                        <?php
                                        $sup = "SELECT * FROM `user`";
                                        $run = mysqli_query($conn, $sup);
                                        while ($fetch = mysqli_fetch_assoc($run)) {
                                        ?>
                                            <tr>
                                                <td><?php echo $fetch['ufname']
                                                    ?></td>
                                                <td><?php echo $fetch['ulname']
                                                    ?></td>
                                                <td><?php echo $fetch['uemail']
                                                    ?></td>
                                                <td><?php echo $fetch['umob']
                                                    ?></td>
                                                <td><?php echo $fetch['country']
                                                    ?></td>
                                                <td><?php echo $fetch['state']
                                                    ?></td>
                                                <td><?php echo $fetch['city']
                                                    ?></td>
                                                <td><?php echo $fetch['add1']
                                                    ?></td>
                                                <td><?php echo $fetch['add2']
                                                    ?></td>
                                                <td><?php echo $fetch['pt_code']
                                                    ?></td>
                                                <td><?php echo $fetch['upass']
                                                    ?></td>
                                                <td><?php echo $fetch['ucpass']
                                                    ?></td>
                                                <td><?php echo $fetch['udate']
                                                    ?></td>
                                                <?php
                                                if ($fetch['ustatus'] == 'Confirmed') {
                                                ?>
                                                    <td class="text-success"><?php echo $fetch['ustatus'] ?></td>
                                                    <td><button data-con="<?php echo $fetch['uid'] ?>" class="confirm"><span data-feather="user-x" data-toggle="tooltip" title="Block"></span></button></td>
                                                <?php
                                                } else {
                                                ?>
                                                    <td class="text-danger"><?php echo $fetch['ustatus'] ?></td>
                                                    <td><button data-con="<?php echo $fetch['uid'] ?>" class="confirm"><span data-feather="user-check" data-toggle="tooltip" title="Confirm"></span></button></td>
                                                <?php
                                                }
                                                ?>
                                                <td><a href="./update-user.php?uid=<?php echo $fetch['uid'] ?>"><span data-feather="edit" data-toggle="tooltip" title="Update"></span></a></td>
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
        // showData();
        // feather.replace();

        // function showData() {
        //     $.ajax({
        //         method: 'GET',
        //         url: './ajax/view.php',
        //         data: {
        //             'load': 'user'
        //         },
        //         success: function(res) {
        // alert(res);
        // $("#tbody").html(res);
        // res = JSON.parse(res);
        // if (!(res.status == false)) {
        //     $.each(res, function(key, val) {
        //         var output = `<tr>
        //                 <td>${val.ufname}</td>
        //                 <td>${val.ulname}</td>
        //                 <td>${val.uemail}</td>
        //                 <td>${val.umob}</td>
        //                 <td>${val.country}</td>
        //                 <td>${val.state}</td>
        //                 <td>${val.city}</td>
        //                 <td>${val.add1}</td>
        //                 <td>${val.add2}</td>
        //                 <td>${val.pt_code}</td>
        //                 <td>${val.upass}</td>
        //                 <td>${val.ucpass}</td>
        //                 <td>${val.udate}</td>`;
        //         if (val.ustatus == 'Confirmed') {
        //             output += `
        //                 <td class="text-success">${val.ustatus}</td>
        //                 <td><button data-con="${val.uid}" class="confirm"><span data-feather="user-x" data-toggle="tooltip" title="Pending"></span></button></td>`;
        //         } else {
        //             output += `
        //                 <td class="text-danger">${val.ustatus}</td>
        //                 <td><button data-con="${val.ustatus}" class="confirm"><span data-feather="user-check" data-toggle="tooltip" title="Confirm"></span></button></td>`;
        //         }
        //         output += `
        //                 <td><a href="./update-user.php?uid=${val.uid}"><span data-feather="edit" data-toggle="tooltip" title="Update"></span></a></td>
        //                 <td><button data-id="${val.uid}" class="del"><span data-feather="trash-2" data-toggle="tooltip" title="Delete"></span></button></td>
        //             </tr>`;
        //         $("#tbody").append(output);
        //     });
        // }
        // }
        // });
        // }

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
                    let uid = $(this).data("id");
                    // alert(uid);
                    let btn = this;
                    $.ajax({
                        method: "GET",
                        url: "./ajax/delete.php",
                        data: {
                            "deluid": uid
                        },
                        success: function(res) {
                            if (res == 1) {
                                Swal.fire({
                                    title: "Deleted!",
                                    text: "User has been deleted.",
                                    icon: "success"
                                });
                                $(btn).closest("tr").fadeOut();
                                // showData();
                            } else {
                                alert("Data couldn't be deleted.");
                            }
                        }
                    });
                }
            });
        });
        // Confirm User
        $(document).on("click", ".confirm", function() {
            let uid = $(this).data("con");
            // alert(uid);
            let btn = this;
            $.ajax({
                method: "GET",
                url: "./ajax/user-confirm.php",
                data: {
                    "conid": uid
                },
                success: function(res) {
                    if (res == 1) {
                        Toast.fire({
                            icon: 'success',
                            title: 'User status changed successfully!'
                        });
                        // showData();
                        // location.reload();
                    } else {
                        Toast.fire({
                            icon: 'error',
                            title: 'User status not changed!'
                        });
                    }
                }
            });
        });
    });
</script>