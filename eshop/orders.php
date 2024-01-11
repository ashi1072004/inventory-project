<?php
include('./include/all-header.php');
if (empty($_SESSION['uemail'])) {
    // header('Location: ./login.php');
    echo '<script>window.location.href="./login.php"</script>';
}
$uemail = $_SESSION['uemail'];
?>
<!-- Breadcrumbs -->
<div class="breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="bread-inner">
                    <ul class="bread-list">
                        <li><a href="./index.php">Home<i class="ti-arrow-right"></i></a></li>
                        <li class="active"><a href="orders.php">Orders</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Breadcrumbs -->

<!-- Shopping Cart -->
<div class="shopping-cart section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <!-- Shopping Summery -->
                <table class="table shopping-summery">
                    <thead>
                        <tr class="main-hading">
                            <th>PRODUCT</th>
                            <th>NAME</th>
                            <th class="text-center">UNIT PRICE</th>
                            <th class="text-center">QUANTITY</th>
                            <th class="text-center">TOTAL</th>
                            <th class="text-center">STATUS</th>
                            <th class="text-center"><i class="ti-trash remove-icon"></i></th>
                        </tr>
                    </thead>
                    <style>
                        input::-webkit-outer-spin-button,
                        input::-webkit-inner-spin-button {
                            -webkit-appearance: none;
                            margin: 0;
                        }
                    </style>
                    <tbody>
                        <?php
                        $psql = "SELECT * FROM `admin_order` ad INNER JOIN `checkout` ch ON ad.invoice=ch.invoice WHERE `aemail`='$uemail' ";
                        $prun = mysqli_query($conn, $psql);
                        $tcash = 0;
                        if (mysqli_num_rows($prun) > 0) {
                            while ($pfetch = mysqli_fetch_assoc($prun)) {
                                $pcode = $pfetch['pcode'];
                                $sql = "SELECT `ppic` FROM `product` WHERE `pcode`='$pcode' ";
                                $run = mysqli_query($conn, $sql);
                                $fetch = mysqli_fetch_assoc($run);
                                $ppic = unserialize($fetch['ppic']);
                                $ppic = $ppic[0];
                        ?>
                                <tr>
                                    <td class="image" data-title="No">
                                        <img src="../admin/assets/img/products/<?= $ppic ?>" alt="#">
                                    </td>
                                    <td id="invoice" class="d-none"><?= $pfetch['invoice'] ?></td>
                                    <td class="product-des" data-title="Description">
                                        <p class="product-name"><a href="#"><?= $pfetch['pname'] ?></a></p>
                                    </td>
                                    <td class="price" data-title="Price"><span><?= $pfetch['pprice'] ?></span></td>
                                    <td class="qty" data-title="Qty"><span><?= $pfetch['pqty'] ?></span></td>
                                    <td class="total-amount" data-title="Total"><span><?= $pfetch['ptprice'] ?></span></td>
                                    <td class="total-amount" data-title="Total"><span><?= $pfetch['o_status'] ?></span></td>
                                    <td>
                                        <?php
                                        if ($pfetch['o_status'] == "pending") {
                                        ?>
                                            <a class="pdel btn text-white" style="cursor: pointer;" data-del="<?= $pfetch['order_id'] ?>">Cancel</a>
                                        <?php
                                        }
                                        ?>
                                    </td>
                                </tr>
                            <?php
                            }
                        } else {
                            ?>
                            <tr>
                                <td colspan='7' class='text-center'>No Product in Cart</td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
                <!--/ End Shopping Summery -->
            </div>
        </div>
    </div>
</div>
<!--/ End Shopping Cart -->

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span class="ti-close" aria-hidden="true"></span></button>
            </div>
            <div class="modal-body">
                <div class="row no-gutters">
                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                        <!-- Product Slider -->
                        <div class="product-gallery">
                            <div class="quickview-slider-active">
                                <div class="single-slider">
                                    <img src="images/modal1.jpg" alt="#">
                                </div>
                                <div class="single-slider">
                                    <img src="images/modal2.jpg" alt="#">
                                </div>
                                <div class="single-slider">
                                    <img src="images/modal3.jpg" alt="#">
                                </div>
                                <div class="single-slider">
                                    <img src="images/modal4.jpg" alt="#">
                                </div>
                            </div>
                        </div>
                        <!-- End Product slider -->
                    </div>
                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                        <div class="quickview-content">
                            <h2>Flared Shift Dress</h2>
                            <div class="quickview-ratting-review">
                                <div class="quickview-ratting-wrap">
                                    <div class="quickview-ratting">
                                        <i class="yellow fa fa-star"></i>
                                        <i class="yellow fa fa-star"></i>
                                        <i class="yellow fa fa-star"></i>
                                        <i class="yellow fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                    <a href="#"> (1 customer review)</a>
                                </div>
                                <div class="quickview-stock">
                                    <span><i class="fa fa-check-circle-o"></i> in stock</span>
                                </div>
                            </div>
                            <h3>$29.00</h3>
                            <div class="quickview-peragraph">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia iste laborum ad impedit pariatur esse optio tempora sint ullam autem deleniti nam in quos qui nemo ipsum numquam.</p>
                            </div>
                            <div class="size">
                                <div class="row">
                                    <div class="col-lg-6 col-12">
                                        <h5 class="title">Size</h5>
                                        <select>
                                            <option selected="selected">s</option>
                                            <option>m</option>
                                            <option>l</option>
                                            <option>xl</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-6 col-12">
                                        <h5 class="title">Color</h5>
                                        <select>
                                            <option selected="selected">orange</option>
                                            <option>purple</option>
                                            <option>black</option>
                                            <option>pink</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="quantity">
                                <!-- Input Order -->
                                <div class="input-group">
                                    <div class="button minus">
                                        <button type="button" class="btn btn-primary btn-number" disabled="disabled" data-type="minus" data-field="quant[1]">
                                            <i class="ti-minus"></i>
                                        </button>
                                    </div>
                                    <input type="text" name="quant[1]" class="input-number" data-min="1" data-max="1000" value="1">
                                    <div class="button plus">
                                        <button type="button" class="btn btn-primary btn-number" data-type="plus" data-field="quant[1]">
                                            <i class="ti-plus"></i>
                                        </button>
                                    </div>
                                </div>
                                <!--/ End Input Order -->
                            </div>
                            <div class="add-to-cart">
                                <a href="#" class="btn">Add to cart</a>
                                <a href="#" class="btn min"><i class="ti-heart"></i></a>
                                <a href="#" class="btn min"><i class="fa fa-compress"></i></a>
                            </div>
                            <div class="default-social">
                                <h4 class="share-now">Share:</h4>
                                <ul>
                                    <li><a class="facebook" href="#"><i class="fa fa-facebook"></i></a></li>
                                    <li><a class="twitter" href="#"><i class="fa fa-twitter"></i></a></li>
                                    <li><a class="youtube" href="#"><i class="fa fa-pinterest-p"></i></a></li>
                                    <li><a class="dribbble" href="#"><i class="fa fa-google-plus"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal end -->
<?php
include('./include/footer.php');
?>
<script>
    $(document).ready(function() {
        // delete from cart
        $(document).on("click", ".pdel", function() {
            var oid = $(this).data("del");
            var invoice = $("#invoice").text();
            // alert(oid);
            var btn = this;
            $.ajax({
                method: "GET",
                url: "./ajax/add-to-cart.php",
                data: {
                    'oid': oid,
                    'invoice': invoice,
                    'action': 'order-del'
                },
                success: function(res) {
                    // alert(res);
                    if (res == 1) {
                        $(btn).closest("tr").fadeOut();
                    }
                }
            });
        });
    });
</script>