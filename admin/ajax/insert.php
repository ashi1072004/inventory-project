<?php
    include("../include/connect.php");
    // ----------------------------- Category --------------------------------
    if(isset($_POST['catsub'])){
        $cname = mysqli_real_escape_string($conn, $_POST['cname']);
        $cdes = mysqli_real_escape_string($conn, $_POST['cdes']);
        $cdate = date("Y/m/d");
        if($cname == "" || $cdes == ""){
            echo 1;
        }else{
            $select = "SELECT * FROM `category` WHERE `cname`='$cname'";
            $crun = mysqli_query($conn, $select);
            if(mysqli_num_rows($crun)>0){
                // echo "<script> alert('Already Exists!')</script>";
                echo 2;
            }
            else{
                $insert = "INSERT INTO `category`(`cname`, `cdes`, `cdate`)VALUES('$cname', '$cdes', '$cdate')";
                $run = mysqli_query($conn,$insert);
                if($run){
                //   echo "<script> alert('Data Inserted!')</script>";
                echo 3;
                }
                else{
                //   echo "<script> alert('Data Not Inserted!')</script>";
                echo 4;
                }
            }
        }
    }
    // ----------------------------- Supplier --------------------------------
    if(isset($_POST['supsub'])){
        $supname = mysqli_real_escape_string($conn ,$_POST['supname']);
        $supemail = mysqli_real_escape_string($conn ,$_POST['supemail']);
        $supmob = mysqli_real_escape_string($conn, $_POST['supmob']);
        $supdate = date("Y/m/d");
        
        if($supname == "" || $supemail == "" || $supmob == ""){
            echo 1;
        }else{
            $insert = "INSERT INTO `supplier`(`supname`, `supemail`, `supmob`, `supdate`)VALUES('$supname', '$supemail', '$supmob', '$supdate')";
            $run = mysqli_query($conn,$insert);
            if($run){
                // echo "<script> alert('Data Inserted!')</script>";
                echo 2;
            }
            else{
                // echo "<script> alert('Data Not Inserted!')</script>";
                echo 3;
            }
        }
    }
    // ----------------------------- Sub Category --------------------------------
    if(isset($_POST['subsub'])){
        $catid = mysqli_real_escape_string($conn, $_POST['catid']);
        $subname = mysqli_real_escape_string($conn, $_POST['subname']);
        $subdes = mysqli_real_escape_string($conn, $_POST['subdes']);
        $subdate = date("Y/m/d");
        
        if($catid == "" || $subname == "" || $subdes == ""){
            echo 1;
        }else{
            $select = "SELECT * FROM `subcategory` WHERE `subname`='$subname' AND `catid`='$catid' ";
            $crun = mysqli_query($conn, $select);
            if(mysqli_num_rows($crun)>0){
                // echo "<script> alert('Already Exists!')</script>";
                echo 2;
            }
            else{
                $insert = "INSERT INTO `subcategory`(`catid`, `subname`, `subdes`, `subdate`)VALUES('$catid', '$subname', '$subdes', '$subdate')";
                $run = mysqli_query($conn,$insert);
                if($run){
                    // echo "<script> alert('Data Inserted!')</script>";
                    echo 3;
                }
                else{
                    // echo "<script> alert('Data Not Inserted!')</script>";
                    echo 4;
                }
            }
        }
    }
    // -------------------------- Quantity/Measurement -----------------------------
    if(isset($_POST['msub'])){
        $mname = mysqli_real_escape_string($conn, $_POST['mname']);
        $mdes = mysqli_real_escape_string($conn, $_POST['mdes']);
        $mdate = date("Y/m/d");
        
        if($mname == ""){
            echo 1;
        } else {
            $insert = "INSERT INTO `measure`(`mname`, `mdes`, `mdate`)VALUES('$mname', '$mdes', '$mdate')";
            $run = mysqli_query($conn,$insert);
            if($run){
                // echo "<script> alert('Data Inserted!')</script>";
                echo 2;
            }
            else{
                // echo "<script> alert('Data Not Inserted!')</script>";
                echo 3;
            }
        }
    }
    // -------------------------- Product -----------------------------
    if(isset($_POST['psub'])){
        $pcat = mysqli_real_escape_string($conn, $_POST['pcat']);
        $psubcat = mysqli_real_escape_string($conn, $_POST['psubcat']);
        $psup = mysqli_real_escape_string($conn, $_POST['psup']);
        $pmes = mysqli_real_escape_string($conn, $_POST['pmes']);
        $pcode = mysqli_real_escape_string($conn, $_POST['pcode']);
        $pname = mysqli_real_escape_string($conn, $_POST['pname']);
        $pdes = mysqli_real_escape_string($conn, $_POST['pdes']);
        $pcost = mysqli_real_escape_string($conn, $_POST['pcost']);
        $psale = mysqli_real_escape_string($conn, $_POST['psale']);
        $pstock = mysqli_real_escape_string($conn, $_POST['pstock']);
        $ppic = $_FILES['ppic']['name'];
        $status = mysqli_real_escape_string($conn, @$_POST['status']);
        $pdate = date("Y/m/d");
        // echo $status;
        if($pcat == "" || $psubcat == "" || $psup == "" || $pmes == "" || $pcode == "" || $pname == "" || $pdes == "" || $pcost == "" || $psale == "" || $pstock == "" || empty($ppic) || empty($status)){
            echo 1;
        } else {
            $cselect = "SELECT * FROM `product` WHERE `pcat`='$pcat' AND `psubcat`='$psubcat' AND `pname`='$pname' ";
            $crun = mysqli_query($conn, $cselect);
            if(mysqli_num_rows($crun)>0){
                // echo "<script> alert('Already Exists!')</script>";
                echo 2;
            }
            else{
            $pselect = "SELECT * FROM `product` WHERE `pcode`='$pcode' ";
            $prun = mysqli_query($conn, $pselect);
                if(mysqli_num_rows($prun)>0){
                    // echo "<script> alert('Product with this code already exists!')</script>";
                    echo 3;
                }
                else{
                    $extn = array('jpg','png','jpeg','jfif','JFIF','JPG','PNG','JPEG');
                    $p = array();
                    foreach($ppic as $val){
                        $exe = pathinfo($val, PATHINFO_EXTENSION);
                        if(in_array($exe, $extn)){
                            $p[] = rand(10000, 99999).".".$exe;
                            $msg = 'right';
                        }else{
                            $msg = 'not right';
                            break;
                        }
                    }
                    if($msg=='right'){
                    $ps = serialize($p);
                    $insert = "INSERT INTO `product`(`pcat`, `psubcat`, `psup`, `pmes`, `pcode`, `pname`, `pdes`, `pcost`, `psale`, `pstock`, `ppic`, `status`, `pdate`)VALUES('$pcat', '$psubcat', '$psup', '$pmes', '$pcode', '$pname', '$pdes', '$pcost', '$psale', '$pstock', '$ps', '$status', '$pdate')";
                    $run = mysqli_query($conn,$insert);
                    if($run){
                        foreach($p as $key=>$i){
                            move_uploaded_file($_FILES['ppic']['tmp_name'][$key], '../assets/img/products/'.$i);
                        }
                        // echo "<script> alert('Product Inserted!')</script>";
                        echo 4;
                    }
                    else{
                        // echo "<script> alert('Product Not Inserted!')</script>";
                        echo 5;
                    }
                    }
                    else{
                        // echo "<script> alert('Invalid Image!')</script>";
                        echo 6;
                    }
                }
            }
        }
    }
?>