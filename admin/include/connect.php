<?php
    $conn = mysqli_connect("localhost", "root", "", "project3");
    if($conn){
        // echo "connected";
    }
    else{
        echo "not connected";
    }
?>