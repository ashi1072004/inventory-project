<?php
$roleid = $_SESSION['roleid'];
$rsql = "SELECT * FROM `role` WHERE `rid`='$roleid' ";
$rrun = mysqli_query($conn, $rsql);
$rfetch = mysqli_fetch_assoc($rrun);
// print_r($rfetch);
if ($rfetch['raccess'] == 'all') {
    $sidebar = '
    <li class="dropdown">
        <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="user-check"></i><span>Staff Management</span></a>
        <ul class="dropdown-menu">
            <li><a class="nav-link" href="./add-role.php">Add a Role</a></li>
            <li><a class="nav-link" href="./view-role.php">View User Roles</a></li>
            <li><a class="nav-link" href="./add-staff.php">Add Staff</a></li>
            <li><a class="nav-link" href="./view-staff.php">View Staff</a></li>
        </ul>
    </li>
    <li class="dropdown">
        <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="folder"></i><span>Category</span></a>
        <ul class="dropdown-menu">
            <li><a class="nav-link" href="./add-category.php">Add Category</a></li>
            <li><a class="nav-link" href="./view-category.php">View Category</a></li>
        </ul>
    </li>
    <li class="dropdown">
        <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="grid"></i><span>SubCategory</span></a>
        <ul class="dropdown-menu">
            <li><a class="nav-link" href="./add-subcategory.php">Add Sub-Category</a></li>
            <li><a class="nav-link" href="./view-subcategory.php">View Sub-Category</a></li>
        </ul>
    </li>
    <li class="dropdown">
        <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="user"></i><span>Supplier</span></a>
        <ul class="dropdown-menu">
            <li><a class="nav-link" href="./add-supplier.php">Add Supplier</a></li>
            <li><a class="nav-link" href="./view-supplier.php">View Supplier</a></li>
        </ul>
    </li>
    <li class="dropdown">
        <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="bar-chart-2"></i><span>Quantity/Measurement</span></a>
        <ul class="dropdown-menu">
            <li><a class="nav-link" href="./add-measure.php">Add Quantity/Measurement</a></li>
            <li><a class="nav-link" href="./view-measure.php">View Quantity/Measurement</a></li>
        </ul>
    </li>
    <li class="dropdown">
        <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="tag"></i><span>Product</span></a>
        <ul class="dropdown-menu">
            <li><a class="nav-link" href="./add-product.php">Add Product</a></li>
            <li><a class="nav-link" href="./view-product.php">View Product</a></li>
        </ul>
    </li>
    <li class="dropdown">
        <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="user"></i><span>User Registeration</span></a>
        <ul class="dropdown-menu">
            <li><a class="nav-link" href="./add-user.php">Add User</a></li>
            <li><a class="nav-link" href="./view-user.php">View User</a></li>
        </ul>
    </li>
    <li class="dropdown">
        <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="shopping-cart"></i><span>POS</span></a>
        <ul class="dropdown-menu">
            <li><a class="nav-link" href="./pos.php">POS</a></li>
            <li><a class="nav-link" href="./view-pos.php">View Checkout</a></li>
        </ul>
    </li>
    <li><a class="nav-link" href="./view-orders.php"><i data-feather="truck"></i><span>Online Orders</span></a></li>';
}
?>
<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html"> <img alt="image" src="assets/img/logo.png" class="header-logo" /> <span class="logo-name">Dashboard</span>
            </a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Main</li>
            <li class="dropdown">
                <a href="index.php" class="nav-link"><i data-feather="monitor"></i><span>Dashboard</span></a>
            </li>
            <?php
            if ($rfetch['raccess'] == 'custom') {
                $ac_array = unserialize($rfetch['ac_array']);
                foreach ($ac_array as $key => $val) {
                    if ($val == 'Staff' || $val == 'Roles') {
            ?>
                        <li class="dropdown">
                            <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="user-check"></i><span>Staff Management</span></a>
                            <ul class="dropdown-menu">
                                <?php
                                if ($val == 'Roles') {
                                ?>
                                    <li><a class="nav-link" href="./add-role.php">Add a Role</a></li>
                                    <li><a class="nav-link" href="./view-role.php">View User Roles</a></li>
                                <?php }
                                if ($val == 'Staff') {
                                ?>
                                    <li><a class="nav-link" href="./add-staff.php">Add Staff</a></li>
                                    <li><a class="nav-link" href="./view-staff.php">View Staff</a></li>
                                <?php } ?>
                            </ul>
                        </li>
                    <?php
                    }
                    if ($val == 'Category') {
                    ?>
                        <li class="dropdown">
                            <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="folder"></i><span>Category</span></a>
                            <ul class="dropdown-menu">
                                <li><a class="nav-link" href="./add-category.php">Add Category</a></li>
                                <li><a class="nav-link" href="./view-category.php">View Category</a></li>
                            </ul>
                        </li>
                    <?php
                    }
                    if ($val == 'Sub-Category') {
                    ?>
                        <li class="dropdown">
                            <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="grid"></i><span>SubCategory</span></a>
                            <ul class="dropdown-menu">
                                <li><a class="nav-link" href="./add-subcategory.php">Add Sub-Category</a></li>
                                <li><a class="nav-link" href="./view-subcategory.php">View Sub-Category</a></li>
                            </ul>
                        </li>
                    <?php
                    }
                    if ($val == 'Supplier') {
                    ?>
                        <li class="dropdown">
                            <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="user"></i><span>Supplier</span></a>
                            <ul class="dropdown-menu">
                                <li><a class="nav-link" href="./add-supplier.php">Add Supplier</a></li>
                                <li><a class="nav-link" href="./view-supplier.php">View Supplier</a></li>
                            </ul>
                        </li>
                    <?php
                    }
                    if ($val == 'Quantity/Measurement') {
                    ?>
                        <li class="dropdown">
                            <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="bar-chart-2"></i><span>Quantity/Measurement</span></a>
                            <ul class="dropdown-menu">
                                <li><a class="nav-link" href="./add-measure.php">Add Quantity/Measurement</a></li>
                                <li><a class="nav-link" href="./view-measure.php">View Quantity/Measurement</a></li>
                            </ul>
                        </li>
                    <?php
                    }
                    if ($val == 'Product') {
                    ?>
                        <li class="dropdown">
                            <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="tag"></i><span>Product</span></a>
                            <ul class="dropdown-menu">
                                <li><a class="nav-link" href="./add-product.php">Add Product</a></li>
                                <li><a class="nav-link" href="./view-product.php">View Product</a></li>
                            </ul>
                        </li>
                    <?php
                    }
                    if ($val == 'Register User') {
                    ?>
                        <li class="dropdown">
                            <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="user"></i><span>User Registeration</span></a>
                            <ul class="dropdown-menu">
                                <li><a class="nav-link" href="./add-user.php">Add User</a></li>
                                <li><a class="nav-link" href="./view-user.php">View User</a></li>
                            </ul>
                        </li>
                    <?php
                    }
                    if ($val == 'POS') {
                    ?>
                        <li class="dropdown">
                            <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="shopping-cart"></i><span>POS</span></a>
                            <ul class="dropdown-menu">
                                <li><a class="nav-link" href="./pos.php">POS</a></li>
                                <li><a class="nav-link" href="./view-pos.php">View Checkout</a></li>
                            </ul>
                        </li>
                    <?php
                    }
                    if ($val == 'Online Orders') {
                    ?>
                        <li><a class="nav-link" href="./view-orders.php"><i data-feather="truck"></i><span>Online Orders</span></a></li>
            <?php
                    }
                }
            } else {
                echo $sidebar;
            }
            ?>
            <li><a class="nav-link" href="./logout.php"><i data-feather="log-out"></i><span>Logout</span></a></li>
        </ul>
    </aside>
</div>