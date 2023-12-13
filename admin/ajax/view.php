<?php
include("../include/connect.php");
// view user
if (isset($_GET['load']) && $_GET['load'] == 'user') {
    $sql = "SELECT * FROM `user` ";
    $run = mysqli_query($conn, $sql);
    // $fetch = mysqli_fetch_all($run, MYSQLI_ASSOC);
    if (mysqli_num_rows($run) > 0) {
        // echo json_encode($fetch);
        while ($fetch = mysqli_fetch_assoc($run)) {
            $output = '<tr>
                <td>' . $fetch['ufname'] . '</td>
                <td>' . $fetch['ulname'] . '</td>
                <td>' . $fetch['uemail'] . '</td>
                <td>' . $fetch['umob'] . '</td>
                <td>' . $fetch['country'] . '</td>
                <td>' . $fetch['state'] . '</td>
                <td>' . $fetch['city'] . '</td>
                <td>' . $fetch['add1'] . '</td>
                <td>' . $fetch['add2'] . '</td>
                <td>' . $fetch['pt_code'] . '</td>
                <td>' . $fetch['upass'] . '</td>
                <td>' . $fetch['ucpass'] . '</td>
                <td>' . $fetch['udate'] . '</td>';
            if ($fetch['ustatus'] == 'Confirmed') {
                $output .= '<td class="text-success">' . $fetch['ustatus'] . '</td>
                    <td><button data-con="' . $fetch['uid'] . '" class="confirm"><span data-feather="user-x" data-toggle="tooltip" title="Pending"></span></button></td>';
            } else {
                $output .= '<td class="text-danger">' . $fetch['ustatus'] . '</td>
                    <td><button data-con="' . $fetch['uid'] . '" class="confirm"><span data-feather="user-check" data-toggle="tooltip" title="Confirm"></span></button></td>';
            }
            $output .= '<td><a href="./update-user.php?uid=' . $fetch['uid'] . '"><span data-feather="edit" data-toggle="tooltip" title="Update"></span></a></td>
                <td><button data-id="' . $fetch['uid'] . '" class="del"><span data-feather="trash-2" data-toggle="tooltip" title="Delete"></span></button></td>
            </tr>';
            echo $output;
        }
    } else {
        echo "No Record Found";
        // echo json_encode(array("message" => "No Record Found", "status" => false));
    }
}
// view cart
if (isset($_GET['load']) && $_GET['load'] == 'cart') {
    $sql = "SELECT * FROM `add_to_cart` ";
    $run = mysqli_query($conn, $sql);
    // $fetch = mysqli_fetch_all($run, MYSQLI_ASSOC);
    if (mysqli_num_rows($run) > 0) {
        // echo json_encode($fetch);
        $tcash = 0;
        $output = "";
        while ($fetch = mysqli_fetch_assoc($run)) {
            $output .= '<tr>
                <td id="acode">' . $fetch['pcode'] . '</td>
                <td id="aname">' . $fetch['pname'] . '</td>
                <td>' . $fetch['pprice'] . '</td>
                <td>' . $fetch['ptprice'] . '</td>
                <td>' . $fetch['pstock'] . '</td>
                <td><input type="number" min="1" name="aqty" class="aqty" value="' . $fetch['pqty'] . '" style="width: 50px; outline: none;"></td>
                <td><button data-id="' . $fetch['aid'] . '" class="btn btn-sm btn-danger del">Delete</button></td>
                </tr>';
            $tcash = $tcash + $fetch['ptprice'];
        }
        $output .= '<tr><td colspan="7"><h3>Total Cash: ' . $tcash . '</h3></td></tr>';
        echo json_encode(array('output' => $output, 'tcash' => $tcash));
    } else {
        echo "<tr class='text-center'><td colspan='7'>No Record Found</td></tr>";
        // echo json_encode(array("message" => "No Record Found", "status" => false));
    }
}
