<?php
include('../admin/include/connect.php');
session_start();
?>
<!DOCTYPE html>
<html lang="zxx">

<head>
	<!-- Meta Tag -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name='copyright' content=''>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- Title Tag  -->
	<title>Eshop</title>
	<!-- Favicon -->
	<link rel="icon" type="image/png" href="images/favicon.png">
	<!-- Web Font -->
	<link href="https://fonts.googleapis.com/css?family=Poppins:200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">

	<!-- StyleSheet -->

	<!-- Bootstrap -->
	<link rel="stylesheet" href="css/bootstrap.css">
	<!-- Magnific Popup -->
	<link rel="stylesheet" href="css/magnific-popup.min.css">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="css/font-awesome.css">
	<!-- Fancybox -->
	<link rel="stylesheet" href="css/jquery.fancybox.min.css">
	<!-- Themify Icons -->
	<link rel="stylesheet" href="css/themify-icons.css">
	<!-- Jquery Ui -->
	<link rel="stylesheet" href="css/jquery-ui.css">
	<!-- Nice Select CSS -->
	<link rel="stylesheet" href="css/niceselect.css">
	<!-- Animate CSS -->
	<link rel="stylesheet" href="css/animate.css">
	<!-- Flex Slider CSS -->
	<link rel="stylesheet" href="css/flex-slider.min.css">
	<!-- Owl Carousel -->
	<link rel="stylesheet" href="css/owl-carousel.css">
	<!-- Slicknav -->
	<link rel="stylesheet" href="css/slicknav.min.css">

	<!-- Eshop StyleSheet -->
	<link rel="stylesheet" href="css/reset.css">
	<link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="css/responsive.css">
	<style>
		.dropdown>button {
			background: none;
			outline: none;
			border: none;
		}
	</style>

</head>

<body class="js">

	<!-- Preloader -->
	<div class="preloader">
		<div class="preloader-inner">
			<div class="preloader-icon">
				<span></span>
				<span></span>
			</div>
		</div>
	</div>
	<!-- End Preloader -->

	<!-- Header -->
	<header class="header shop">
		<!-- Topbar -->
		<div class="topbar">
			<div class="container">
				<div class="row">
					<div class="col-lg-4 col-md-12 col-12">
						<!-- Top Left -->
						<div class="top-left">
							<ul class="list-main">
								<li><i class="ti-headphone-alt"></i> +060 (800) 801-582</li>
								<li><i class="ti-email"></i> support@shophub.com</li>
							</ul>
						</div>
						<!--/ End Top Left -->
					</div>
					<div class="col-lg-8 col-md-12 col-12">
						<!-- Top Right -->
						<div class="right-content">
							<ul class="list-main">
								<li><i class="ti-location-pin"></i> Store location</li>
								<li><i class="ti-alarm-clock"></i> <a href="#">Daily deal</a></li>
								<?php
								if (!empty($_SESSION['uemail'])) {
								?>
									<li><i class="ti-user"></i> <a href="./profile.php">My account</a></li>
									<li><i class="ti-power-off"></i><a href="./logout.php">Logout</a></li>
								<?php
								} else {
								?>
									<li><i class="ti-power-off"></i><a href="./login.php">Login</a></li>
								<?php
								}
								?>
							</ul>
						</div>
						<!-- End Top Right -->
					</div>
				</div>
			</div>
		</div>
		<!-- End Topbar -->
		<div class="middle-inner">
			<div class="container">
				<div class="row">
					<div class="col-lg-2 col-md-2 col-12">
						<!-- Logo -->
						<div class="logo">
							<a href="./index.php"><img src="images/logo.png" alt="logo"></a>
						</div>
						<!--/ End Logo -->
						<!-- Search Form -->
						<div class="search-top">
							<div class="top-search"><a href="#0"><i class="ti-search"></i></a></div>
							<!-- Search Form -->
							<div class="search-top">
								<form class="search-form">
									<input type="text" placeholder="Search here..." name="search">
									<button value="search" type="submit"><i class="ti-search"></i></button>
								</form>
							</div>
							<!--/ End Search Form -->
						</div>
						<!--/ End Search Form -->
						<div class="mobile-nav"></div>
					</div>
					<div class="col-lg-8 col-md-7 col-12">
						<div class="search-bar-top">
							<div class="search-bar">
								<select>
									<option selected="selected">All Category</option>
									<?php
									$csql = "SELECT * FROM `category` ";
									$crun = mysqli_query($conn, $csql);
									while ($cfetch = mysqli_fetch_assoc($crun)) {
									?>
										<option><?= $cfetch['cname'] ?></option>
									<?php
									} ?>
								</select>
								<form>
									<input name="search" placeholder="Search Products Here....." type="search">
									<button class="btnn"><i class="ti-search"></i></button>
								</form>
							</div>
						</div>
					</div>
					<div class="col-lg-2 col-md-3 col-12">
						<div class="right-bar">
							<!-- Search Form -->
							<div class="sinlge-bar">
								<a href="#" class="single-icon"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
							</div>
							<div class="sinlge-bar">
								<a href="#" class="single-icon"><i class="fa fa-user-circle-o" aria-hidden="true"></i></a>
							</div>
							<div class="sinlge-bar shopping">
								<a href="#" class="single-icon"><i class="ti-bag"></i> <span class="total-count">2</span></a>
								<!-- Shopping Item -->
								<div class="shopping-item">
									<!-- <div class="dropdown-cart-header">
										<span>2 Items</span>
										<a href="#">View Cart</a>
									</div> -->
									<ul class="shopping-list">
										<?php
										if (!empty($_SESSION['uemail'])) {
											$uemail = $_SESSION['uemail'];
											$psql = "SELECT * FROM `add_to_cart` WHERE `aemail`='$uemail' ";
											$prun = mysqli_query($conn, $psql);
											$tcash = 0;
											while ($pfetch = mysqli_fetch_assoc($prun)) {
										?>
												<li>
													<a href="./cart.php" class="remove" title="Remove this item"><i class="fa fa-remove"></i></a>
													<a class="cart-img" href="#"><img src="../admin/assets/img/products/'<?= $pfetch['ppic'] ?>'" alt="#"></a>
													<h4><a href="#"><?= $pfetch['pname'] ?></a></h4>
													<p class="quantity"><?= $pfetch['pqty'] ?>x - <span class="amount">$<?= $pfetch['ptprice'] ?></span></p>
												</li>
											<?php
												$tcash += $pfetch['ptprice'];
											}
										} else {
											$tcash = 0;
											?>
											<li>Cart is Empty</li>
										<?php
										}
										?>
									</ul>
									<div class="bottom">
										<div class="total">
											<span>Total</span>
											<span class="total-amount">$<?= $tcash ?></span>
										</div>
										<a href="checkout.php" class="btn animate">Checkout</a>
									</div>
								</div>
								<!--/ End Shopping Item -->
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Header Inner -->
		<div class="header-inner">
			<div class="container">
				<div class="cat-nav-head">
					<div class="row">
						<div class="col-12">
							<div class="menu-area">
								<!-- Main Menu -->
								<nav class="navbar navbar-expand-lg">
									<div class="navbar-collapse">
										<div class="nav-inner">
											<ul class="nav main-menu menu navbar-nav">
												<li class="active"><a href="./index.php">Home</a></li>
												<li><a href="./shop.php">Shop</a></li>
												<li><a href="./blog.php">Blog</a></li>
												<?php
												if (!empty($_SESSION['uemail'])) {
												?>
													<li><a href="./cart.php">Cart</a></li>
													<li><a href="./orders.php">Orders</a></li>
												<?php
												}
												?>
												<li><a href="./contact.php">Contact Us</a></li>
											</ul>
										</div>
									</div>
								</nav>
								<!--/ End Main Menu -->
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--/ End Header Inner -->
	</header>
	<!--/ End Header -->