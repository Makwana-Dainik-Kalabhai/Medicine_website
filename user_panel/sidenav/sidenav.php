<style>
    <?php include("C:/xampp/htdocs/php/medicine_website/user_panel/sidenav/sidenav.css"); ?>
</style>

<a href="http://localhost/php/medicine_website/index.php"><i class="fa-solid fa-house"></i>&ensp;Home</a>


<?php if (!isset($_SESSION["email"])) { ?>
    <a href="http://localhost/php/medicine_website/user_panel/form/sign_form.php"><i class="fa-solid fa-user-plus"></i>&ensp;Signup Now</a>
    <a href="http://localhost/php/medicine_website/user_panel/form/login_form.php"><i class="fa-solid fa-right-to-bracket"></i>&ensp;Login Now</a>
<?php } ?>


<!-- //! Profile Page -->
<?php
if (isset($_SESSION["email"])) { ?>
    <a href="http://localhost/php/medicine_website/user_panel/profile/profile.php"><i class="fa-solid fa-user"></i>&ensp;Account</a>
<?php }
?>
<a href="http://localhost/php/medicine_website/user_panel/shop/pr_main_page/pr_main_page.php?status=medicine"><i class="fa-solid fa-tablets"></i>&ensp;Medicines</a>
<a href="http://localhost/php/medicine_website/user_panel/shop/pr_main_page/pr_main_page.php?status=device"><i class="fa-solid fa-list"></i>&ensp;Medical Devices</a>
<a href="http://localhost/php/medicine_website/user_panel/shop/cleaning/cleaning_cat.php"><i class="fa-solid fa-pump-medical"></i>&ensp;Cleaning Products</a>



<!-- Counting likes and cart items -->
<?php
include("C:/xampp/htdocs/php/medicine_website/database.php");

if (isset($_SESSION["email"])) {
    $like_count = 0;
    $cart_count = 0;
    $order_count = 0;

    $sel_like = $conn->prepare("SELECT * FROM `wishlist` WHERE `email`='" . $_SESSION["email"] . "'");
    $sel_like->execute();

    foreach ($sel_like as $row) {
        $like_count++;
    }

    $sel_cart = $conn->prepare("SELECT * FROM `cart` WHERE `email`='" . $_SESSION["email"] . "'");
    $sel_cart->execute();

    foreach ($sel_cart as $row) {
        $cart_count++;
    }
} ?>


<!-- //! My Wishlist -->
<?php
if (!isset($_SESSION["email"])) { ?>
    <a href="http://localhost/php/medicine_website/user_panel/form/login_form.php"><i class="fa-solid fa-heart"></i>&ensp;My Wishlist</a>
<?php }

if (isset($_SESSION["email"])) { ?>
    <a href="http://localhost/php/medicine_website/user_panel/wishlist/wishlist.php"><i class="fa-solid fa-heart"></i>&ensp;My wishlist
        <?php if ($like_count != 0) { ?>
            <span class="count"><?php echo $like_count; ?></span>
        <?php } ?>
    </a>
<?php } ?>


<!-- //! My Cart -->
<?php
if (!isset($_SESSION["email"])) { ?>
    <a href="http://localhost/php/medicine_website/user_panel/form/login_form.php"><i class="fa-solid fa-cart-shopping"></i>&ensp;My Cart</a>
<?php }

if (isset($_SESSION["email"])) { ?>
    <a href="http://localhost/php/medicine_website/user_panel/cart/cart.php"><i class="fa-solid fa-cart-shopping"></i>&ensp;My Cart
        <?php if ($cart_count != 0) { ?>
            <span class="count"><?php echo $cart_count; ?></span>
        <?php } ?>
    </a>
<?php } ?>


<!-- //! My Orders -->
<?php
if (!isset($_SESSION["email"])) { ?>
    <a href="http://localhost/php/medicine_website/user_panel/form/login_form.php"><i class="fa-solid fa-bag-shopping"></i>&ensp;My Orders</a>
<?php }

if (isset($_SESSION["email"])) { ?>
    <a href=""><i class="fa-solid fa-bag-shopping"></i>&ensp;My Orders
        <?php if ($order_count != 0) { ?>
            <span class="count"><?php echo $order_count; ?></span>
        <?php } ?>
    </a>
<?php } ?>


<!-- //! Book Appoitment -->
<a href=""><i class="fa-solid fa-calendar-check"></i>&ensp;Book Appoitment</a>


<!-- //! Health Tips -->
<a href=""><i class="fa-solid fa-heart-pulse"></i>&ensp;Health Tips</a>

<a href="http://localhost/php/medicine_website/user_panel/about_us/about_us.php"><i class="fa-solid fa-address-card"></i>&ensp;About us</a>
<a href="http://localhost/php/medicine_website/user_panel/contact_us/contact_us.php"><i class="fa-solid fa-phone"></i>&ensp;Contact us</a>


<!-- //! Logout Button -->
<?php
if (isset($_SESSION["email"])) { ?>
    <a href="http://localhost/php/medicine_website/user_panel/form/logout.php">&ensp;Logout</a>
<?php } ?>