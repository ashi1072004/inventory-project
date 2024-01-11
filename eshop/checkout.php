<?php
include('./include/all-header.php');
if (empty($_SESSION['uemail'])) {
	echo '<script>window.location.href="./login.php"</script>';
}
$uemail = $_SESSION['uemail'];

$sql = "SELECT * FROM `user` WHERE `uemail`='$uemail' ";
$run = mysqli_query($conn, $sql);
$fetch = mysqli_fetch_assoc($run);
$invoice = rand(100000, 999999);
?>
<!-- Breadcrumbs -->
<div class="breadcrumbs">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="bread-inner">
					<ul class="bread-list">
						<li><a href="./index.php">Home<i class="ti-arrow-right"></i></a></li>
						<li class="active"><a href="./checkout.php">Checkout</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- End Breadcrumbs -->

<!-- Start Checkout -->
<section class="shop checkout section">
	<div class="container">
		<div class="row">
			<div class="col-lg-8 col-12">
				<div class="checkout-form">
					<h2>Make Your Checkout Here</h2>
					<!-- <p>Please register in order to checkout more quickly</p> -->
					<!-- Form -->
					<form class="form">
						<div class="row">
							<div class="col-lg-6 col-md-6 col-12">
								<div class="form-group">
									<input type="hidden" id="inv" name="invoice" value="<?= $invoice ?>" required>
									<label>First Name<span>*</span></label>
									<input type="text" name="ufname" value="<?= $fetch['ufname'] ?>" readonly>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-12">
								<div class="form-group">
									<label>Last Name<span>*</span></label>
									<input type="text" name="ulname" value="<?= $fetch['ulname'] ?>" readonly>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-12">
								<div class="form-group">
									<label>Email<span>*</span></label>
									<input type="email" name="uemail" value="<?= $fetch['uemail'] ?>" readonly>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-12">
								<div class="form-group">
									<label>Phone Number<span>*</span></label>
									<input type="tel" name="umob" value="<?= $fetch['umob'] ?>" readonly>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-12">
								<div class="form-group">
									<label>Country<span>*</span></label>
									<input type="text" name="country" value="<?= $fetch['country'] ?>" readonly>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-12">
								<div class="form-group">
									<label>State / Divition<span>*</span></label>
									<input type="text" name="state" value="<?= $fetch['state'] ?>" readonly>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-12">
								<div class="form-group">
									<label>City<span>*</span></label>
									<input type="text" name="city" value="<?= $fetch['city'] ?>" readonly>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-12">
								<div class="form-group">
									<label>Address Line 1<span>*</span></label>
									<input type="text" name="add1" value="<?= $fetch['add1'] ?>" readonly>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-12">
								<div class="form-group">
									<label>Address Line 2<span>*</span></label>
									<input type="text" name="add2" value="<?= $fetch['add2'] ?>" readonly>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-12">
								<div class="form-group">
									<label>Postal Code<span>*</span></label>
									<input type="text" name="pt_code" value="<?= $fetch['pt_code'] ?>" readonly>
								</div>
							</div>
							<!-- <div class="col-12">
								<div class="form-group create-account">
									<input id="cbox" type="checkbox">
									<label>Create an account?</label>
								</div>
							</div> -->
						</div>
					</form>
					<!--/ End Form -->
				</div>
			</div>
			<div class="col-lg-4 col-12">
				<div id="checkout" class="order-details">
				</div>
			</div>
		</div>
	</div>
</section>
<!--/ End Checkout -->

<!-- Start Shop Services Area  -->
<section class="shop-services section home">
	<div class="container">
		<div class="row">
			<div class="col-lg-3 col-md-6 col-12">
				<!-- Start Single Service -->
				<div class="single-service">
					<i class="ti-rocket"></i>
					<h4>Free shiping</h4>
					<p>Orders over $100</p>
				</div>
				<!-- End Single Service -->
			</div>
			<div class="col-lg-3 col-md-6 col-12">
				<!-- Start Single Service -->
				<div class="single-service">
					<i class="ti-reload"></i>
					<h4>Free Return</h4>
					<p>Within 30 days returns</p>
				</div>
				<!-- End Single Service -->
			</div>
			<div class="col-lg-3 col-md-6 col-12">
				<!-- Start Single Service -->
				<div class="single-service">
					<i class="ti-lock"></i>
					<h4>Sucure Payment</h4>
					<p>100% secure payment</p>
				</div>
				<!-- End Single Service -->
			</div>
			<div class="col-lg-3 col-md-6 col-12">
				<!-- Start Single Service -->
				<div class="single-service">
					<i class="ti-tag"></i>
					<h4>Best Peice</h4>
					<p>Guaranteed price</p>
				</div>
				<!-- End Single Service -->
			</div>
		</div>
	</div>
</section>
<!-- End Shop Services -->

<!-- Start Shop Newsletter  -->
<section class="shop-newsletter section">
	<div class="container">
		<div class="inner-top">
			<div class="row">
				<div class="col-lg-8 offset-lg-2 col-12">
					<!-- Start Newsletter Inner -->
					<div class="inner">
						<h4>Newsletter</h4>
						<p> Subscribe to our newsletter and get <span>10%</span> off your first purchase</p>
						<form action="mail/mail.php" method="get" target="_blank" class="newsletter-inner">
							<input name="EMAIL" placeholder="Your email address" required readonly="" type="email">
							<button class="btn">Subscribe</button>
						</form>
					</div>
					<!-- End Newsletter Inner -->
				</div>
			</div>
		</div>
	</div>
</section>
<!-- End Shop Newsletter -->
<?php
include('./include/footer.php');
?>
<script>
	$(document).ready(function() {
		// checkout
		$("#checkout").on("click", "#proceed", function() {
			var invoice = $("input[name=invoice]").val();
			var tcash = $("#tcash").text();
			// alert(invoice);
			$.ajax({
				method: "POST",
				url: "./ajax/add-to-cart.php",
				data: {
					"invoice": invoice,
					"tcash": tcash,
					"action": "checkout"
				},
				success: function(res) {
					// alert(res);
					if (res == 1) {
						Toast.fire({
							icon: 'warning',
							title: 'Invoice Already Exists! Try Again'
						});
					} else if (res == 2) {
						Toast.fire({
							icon: 'warning',
							title: 'One of the products out of stock!'
						});
						showCheckout();
					} else if (res == 3) {
						Toast.fire({
							icon: 'success',
							title: 'Your Order Has Been Processed! You will shortly receive an email.'
						});
						showCheckout();
					} else if (res == 4) {
						Toast.fire({
							icon: 'success',
							title: 'There was an error sending Email! Your Order Has Been Processed.'
						});
						showCheckout();
					} else {
						Toast.fire({
							icon: 'error',
							title: 'Error Occured! Could not Proceed'
						});
						showCheckout();
					}
				}
			});
		});
		// show checkout
		showCheckout();

		function showCheckout() {
			$.ajax({
				method: "GET",
				url: "./ajax/add-to-cart.php",
				data: {
					'action': 'checkout-show'
				},
				success: function(res) {
					// console.log(res);
					$("#checkout").html(res);
				}
			});
		}
	});
</script>