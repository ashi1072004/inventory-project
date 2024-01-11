<?php
include("../include/connect.php");
// ----------------------------- Staff --------------------------------
if (isset($_POST['adid'])) {
  $adid = mysqli_real_escape_string($conn, $_POST['adid']);
  $aname = mysqli_real_escape_string($conn, $_POST['aname']);
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $password = mysqli_real_escape_string($conn, $_POST['password']);
  $cpass = mysqli_real_escape_string($conn, $_POST['cpass']);
  $roleid = mysqli_real_escape_string($conn, $_POST['roleid']);
  // print_r($_POST);
  if ($aname == "" || $email == "" || $password == "" || $cpass == "" || empty($roleid)) {
    echo 1; //fields cannot be empty
  } else {
    if ($password == $cpass) {
      $insert = "UPDATE `admin` SET `roleid`='$roleid', `aname`='$aname', `email`='$email', `password`='$password' WHERE `adid`='$adid' ";
      $run = mysqli_query($conn, $insert);
      if ($run) {
        echo 2; //updated
      } else {
        echo 3; // not updated
      }
    } else {
      echo 4; // Passwords don't match
    }
  }
}
// --------------------------- Role --------------------------------
if (isset($_POST['rid'])) {
  $rid = mysqli_real_escape_string($conn, $_POST['rid']);
  $rname = mysqli_real_escape_string($conn, $_POST['rname']);
  $raccess = mysqli_real_escape_string($conn, $_POST['raccess']);

  if ($rname == "" || $raccess == "none") {
    echo 1; //fields cannot be empty
  } else {
    if ($raccess == 'custom') {
      $ac_array = serialize($_POST['ac_array']);
    } else {
      $ac_array = '';
    }
    $update = "UPDATE `role` SET `rname`='$rname', `raccess`='$raccess', `ac_array`='$ac_array' WHERE `rid`='$rid' ";
    $run = mysqli_query($conn, $update);
    if ($run) {
      echo 2;
    } else {
      echo 3;
    }
  }
}
// --------------------------- User --------------------------------
if (isset($_POST['uid'])) {
  $uid = mysqli_real_escape_string($conn, $_POST['uid']);
  $ufname = mysqli_real_escape_string($conn, $_POST['ufname']);
  $ulname = mysqli_real_escape_string($conn, $_POST['ulname']);
  $uemail = mysqli_real_escape_string($conn, $_POST['uemail']);
  $umob = mysqli_real_escape_string($conn, $_POST['umob']);
  $country = mysqli_real_escape_string($conn, $_POST['country']);
  $state = mysqli_real_escape_string($conn, $_POST['state']);
  $city = mysqli_real_escape_string($conn, $_POST['city']);
  $add1 = mysqli_real_escape_string($conn, $_POST['add1']);
  $add2 = mysqli_real_escape_string($conn, $_POST['add2']);
  $pt_code = mysqli_real_escape_string($conn, $_POST['pt_code']);
  $upass = mysqli_real_escape_string($conn, $_POST['upass']);
  $udate = date("Y/m/d");

  if ($ufname == "" || $ulname == "" || $uemail == "" || $umob == "" || $country == "" || $state == "" || $city == "" || $add1 == "" || $pt_code == "" || $upass == "") {
    echo 1; //fields cannot be empty
  } else {
    $upsql = "UPDATE `user` SET `ufname`='$ufname', `ulname`='$ulname', `uemail`='$uemail', `umob`='$umob', `country`='$country', `state`='$state', `city`='$city', `add1`='$add1', `add2`='$add2', `pt_code`='$pt_code', `upass`='$upass', `udate`='$udate' WHERE `uid`='$uid' ";
    $run = mysqli_query($conn, $upsql);
    if ($run) {
      echo 2; //updated
    } else {
      echo 3; // not updated
    }
  }
}
// --------------------------- Category --------------------------------
if (isset($_POST['cid'])) {
  $cid = mysqli_real_escape_string($conn, $_POST['cid']);
  $cname = mysqli_real_escape_string($conn, $_POST['cname']);
  $cdes = mysqli_real_escape_string($conn, $_POST['cdes']);
  $cdate = date("Y/m/d");
  if ($cname == "" || $cdes == "") {
    echo 1;
  } else {
    $update = "UPDATE `category` SET `cname`='$cname', `cdes`='$cdes', `cdate`='$cdate' WHERE `cid`='$cid' ";
    $run = mysqli_query($conn, $update);
    if ($run) {
      echo 2;
    } else {
      echo 3;
    }
  }
}
// --------------------------- Quantity/Measurement --------------------------------
if (isset($_POST['mid'])) {
  $mid = mysqli_real_escape_string($conn, $_POST['mid']);
  $mname = mysqli_real_escape_string($conn, $_POST['mname']);
  $mdes = mysqli_real_escape_string($conn, $_POST['mdes']);
  $mdate = date("Y/m/d");
  if ($mname == "") {
    echo 1;
  } else {
    $update = "UPDATE `measure` SET `mname`='$mname', `mdes`='$mdes', `mdate`='$mdate' WHERE `mid`='$mid' ";
    $run = mysqli_query($conn, $update);
    if ($run) {
      echo 2;
    } else {
      echo 3;
    }
  }
}
// ---------------------------------- Sub-category -------------------------------------
if (isset($_POST['subid'])) {
  $subid = mysqli_real_escape_string($conn, $_POST['subid']);
  $catid = mysqli_real_escape_string($conn, $_POST['catid']);
  $subname = mysqli_real_escape_string($conn, $_POST['subname']);
  $subdes = mysqli_real_escape_string($conn, $_POST['subdes']);
  $subdate = date("Y/m/d");

  if ($catid == "" || $subname == "" || $subdes == "") {
    echo 1;
  } else {
    $update = "UPDATE `subcategory` SET `catid`='$catid', `subname`='$subname', `subdes`='$subdes', `subdate`='$subdate' WHERE `subid`='$subid' ";
    $run = mysqli_query($conn, $update);
    if ($run) {
      echo 2;
    } else {
      echo 3;
    }
  }
}
// ---------------------------------- Supplier -------------------------------------
if (isset($_POST['supid'])) {
  $supid = mysqli_real_escape_string($conn, $_POST['supid']);
  $supname = mysqli_real_escape_string($conn, $_POST['supname']);
  $supemail = mysqli_real_escape_string($conn, $_POST['supemail']);
  $supmob = mysqli_real_escape_string($conn, $_POST['supmob']);
  $supdate = date("Y/m/d");

  if ($supname == "" || $supemail == "" || $supmob == "") {
    echo 1;
  } else {
    $update = "UPDATE `supplier` SET `supname`='$supname', `supemail`='$supemail', `supmob`='$supmob', `supdate`='$supdate' WHERE `supid`='$supid' ";
    $run = mysqli_query($conn, $update);
    if ($run) {
      echo 2;
    } else {
      echo 3;
    }
  }
}
// ---------------------------------- Product -------------------------------------
if (isset($_POST['pid'])) {
  $pid = mysqli_real_escape_string($conn, $_POST['pid']);
  $psql = "SELECT * FROM `product` WHERE `pid` = '$pid' ";
  $prun = mysqli_query($conn, $psql);
  $fetch = mysqli_fetch_assoc($prun);

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

  if ($pcat == "" || $psubcat == "" || $psup == "" || $pmes == "" || $pcode == "" || $pname == "" || $pdes == "" || $pcost == "" || $psale == "" || $pstock == "" || empty($status)) {
    echo 1;
  } else {
    if (!empty($ppic[0])) {
      // if new pic inserted
      $extn = array('jpg', 'png', 'jpeg', 'jfif', 'JFIF', 'JPG', 'PNG', 'JPEG');
      $p = array();
      foreach ($ppic as $val) {
        $exe = pathinfo($val, PATHINFO_EXTENSION);
        if (in_array($exe, $extn)) {
          $p[] = rand(10000, 99999) . "." . $exe;
          $msg = 'right';
        } else {
          $msg = 'not right';
          break;
        }
      }
      if ($msg == 'right') {
        // Delete old pics
        $pics = unserialize($fetch['ppic']);
        foreach ($pics as $i) {
          unlink('../assets/img/products/' . $i);
        }
        // Update record
        $ps = serialize($p);
        $update = "UPDATE `product` SET `pcat`='$pcat', `psubcat`='$psubcat', `psup`='$psup', `pmes`='$pmes', `pcode`='$pcode', `pname`='$pname', `pdes`='$pdes', `pcost`='$pcost', `psale`='$psale', `pstock`='$pstock', `ppic`='$ps', `status`='$status', `pdate`='$pdate' WHERE `pid` = '$pid'";
        $run = mysqli_query($conn, $update);
        if ($run) {
          foreach ($p as $key => $i) {
            move_uploaded_file($_FILES['ppic']['tmp_name'][$key], '../assets/img/products/' . $i);
          }
          // echo "<script> alert('Product Updated with New Pics!')</script>";
          echo 2;
        } else {
          // echo "<script> alert('Product Not Updated!')</script>";
          echo 3;
        }
      } else {
        // echo "<script> alert('Invalid Image!')</script>";
        echo 4;
      }
    } else {
      // if new pics not inserted
      $update = "UPDATE `product` SET `pcat`='$pcat', `psubcat`='$psubcat', `psup`='$psup', `pmes`='$pmes', `pcode`='$pcode', `pname`='$pname', `pdes`='$pdes', `pcost`='$pcost', `psale`='$psale', `pstock`='$pstock', `status`='$status', `pdate`='$pdate' WHERE `pid` = '$pid'";
      $run = mysqli_query($conn, $update);
      if ($run) {
        // echo "<script> alert('Product Updated with Old Pics!')</script>";
        echo 5;
      } else {
        // echo "<script> alert('Product Not Updated!')</script>";
        echo 3;
      }
    }
  }
}
