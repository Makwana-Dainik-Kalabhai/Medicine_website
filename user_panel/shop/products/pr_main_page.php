<?php
session_start();
if (isset($_GET["category"])) {
    $_SESSION["category"] = $_GET["category"];
}
?>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Buy Now</title>
<?php include("C:/xampp/htdocs/php/medicine_website/user_panel/links.php"); ?>

<style>
    <?php include("C:/xampp/htdocs/php/medicine_website/user_panel/shop/products/pr_main_page.css"); ?>
</style>

<script>
    <?php include("C:/xampp/htdocs/php/medicine_website/user_panel/shop/products/pr_main_page.js"); ?>
</script>


<body>
    <header>
        <?php include("C:/xampp/htdocs/php/medicine_website/user_panel/header/header.php"); ?>
    </header>

    <main>
        <div id="top_img">
            <div id="left_img">
                <img src="left_img.jpg" alt="">
            </div>
            <div id="right_text">
                <p>GET maximum Discounts</p>
                <p>Try Our Best</p>
                <p>Join with healthGroup pvt. ltd. to get best deals. health.Group pvt. ltd. provides best products. </p>
                <button>Shop Now</button>
            </div>
        </div>

        <div id="define_policies">
            <div id="charges">
                <i>%</i>
                <div>
                    <span>Minimum charges</span>
                    <span>Take minimum charges</span>
                </div>
            </div>

            <div id="return">
                <i class="fa-solid fa-truck-fast"></i>
                <div>
                    <span>15 days Returns</span>
                    <span>Return within 15 days</span>
                </div>
            </div>

            <div id="secure_checkout">
                <i class="fa-solid fa-shield-halved"></i>
                <div>
                    <span>Secure Checkout</span>
                    <span>Provide Security</span>
                </div>
            </div>

            <div id="offers">
                <i class="fa-solid fa-gift"></i>
                <div>
                    <span>Big Offers</span>
                    <span>Get maximum discount</span>
                </div>
            </div>
        </div>

        <div id="main_products">
            <div id="heading">
                <h1>Our Products</h1>
                <p>Try out the Products to Fulfill your Requirements</p>
            </div>
            <div id="sort_products">
                <div>
                    <span>Sort By: </span>
                    <button value="latest">Latest</button>
                    <button value="high to low">High to Low</button>
                    <button value="low to high">Low to High</button>
                    <button value="discount">Discount</button>
                </div>
            </div>
            <hr>

            <div id="cat_products">

                <div id="category_main">
                    <div id="cat_head">
                        <h1>Categories</h1>
                    </div>
                    <div id="categories">
                        <?php
                        include("C:/xampp/htdocs/php/medicine_website/database.php");

                        $sel_cat = $conn->prepare("SELECT * FROM `products` GROUP BY `category`");
                        $sel_cat->execute();
                        $sel_cat = $sel_cat->fetchAll(); ?>

                        <div>
                            <?php
                            foreach ($sel_cat as $row_cat) {
                                if (isset($_GET["category"]) && $_GET["category"] == $row_cat["category"]) { ?>
                                    <button value="<?php echo $row_cat["category"]; ?>" style="background-color:#ffcccc;"><?php echo $row_cat["category"]; ?></button>
                                <?php }

                                //
                                else { ?>
                                    <button value="<?php echo $row_cat["category"]; ?>" style="background-color:transparent;"><?php echo $row_cat["category"]; ?></button>

                            <?php }
                            } ?>
                        </div>

                        <?php
                        $max_price = 0;
                        $max_discount = 0;

                        if (isset($_SESSION["category"])) {
                            $sel_cat = $conn->prepare("SELECT * FROM `products` WHERE `category` = '" . $_SESSION["category"] . "'");
                        } else {
                            $sel_cat = $conn->prepare("SELECT * FROM `products`");
                        }
                        $sel_cat->execute();
                        $sel_cat = $sel_cat->fetchAll();

                        foreach ($sel_cat as $row_cat) {
                            // ! Get Max Discount
                            if ($row_cat["discount"] > $max_discount) {
                                $max_discount = $row_cat["discount"];
                            }
                            // ! Get Max Expensive product
                            if ($row_cat["offer_price"] > $max_price) {
                                $max_price = $row_cat["offer_price"];
                            }
                        } ?>

                        <div id="price_range">
                            <span>Price range</span>
                            <input type="range" name="" min="5000" value="<?php echo $max_price; ?>" max="<?php echo $max_price; ?>" oninput="document.getElementById('max_price').value = '&#8377;'+this.value">
                            <output id="min_price">&#8377;5000</output>
                            <output id="max_price"></output>
                        </div>
                        <div id="discount_range">
                            <span>Discount</span>
                            <input type="range" name="" value="<?php echo $max_discount; ?>" min="0" max="<?php echo $max_discount; ?>" oninput="document.getElementById('max_discount').value = this.value+'%'">
                            <output id="min_discount">0</output>
                            <output id="max_discount"></output>
                        </div>
                    </div>
                </div>
                <div id="products">
                    <?php

                    $sel = $conn->prepare("SELECT * FROM `products`");
                    if (isset($_GET["category"])) {
                        $sel = $conn->prepare("SELECT * FROM `products` WHERE `category`='" . $_GET["category"] . "'");
                    }
                    if (isset($_SESSION["price_range"]) && isset($_SESSION["discount_range"])) {
                        $sel = $conn->prepare("SELECT * FROM `products` WHERE `offer_price`<=" . $_SESSION["price_range"] . " AND `discount`<=" . $_SESSION["discount_range"] . "");
                    }
                    if (isset($_GET["category"]) && isset($_SESSION["price_range"]) && isset($_SESSION["discount_range"])) {
                        $sel = $conn->prepare("SELECT * FROM `products` WHERE `offer_price`<=" . $_SESSION["price_range"] . " AND `discount`<=" . $_SESSION["discount_range"] . " AND `category`='" . $_GET["category"] . "'");
                    }
                    $sel->execute();
                    $sel = $sel->fetchAll();

                    foreach ($sel as $row) { ?>

                        <div id="box">
                            <a href="http://localhost/php/medicine_website/user_panel/shop/products/product_details/product_details.php?item_code=<?php echo $row["item_code"]; ?>">
                                <div id="product_img">
                                    <?php
                                    if ($row["discount"] != 0) { ?>
                                        <span>&ensp;-<?php echo $row["discount"]; ?>%</span>
                                    <?php } ?>
                                    <img src="http://localhost/php/medicine_website/user_panel/shop/products/product_imgs/<?php echo unserialize($row["item_img"])[0]; ?>" alt="" />
                                </div>
                                <div id="product_details">
                                    <span id="name"><?php echo $row["name"]; ?></span>

                                    <?php
                                    if ($row["discount"] != 0) { ?>
                                        <span id="price">&#8377;<?php echo $row["price"]; ?></span>
                                    <?php } ?>
                                    <span id="off_price">&#8377;<?php echo $row["offer_price"]; ?></span>
                                </div>
                            </a>


                            <!-- //! Add to Cart button -->
                            <?php if (!isset($_SESSION["email"])) { ?>
                                <a href="http://localhost/php/medicine_website/user_panel/form/login_form.php" id="add_cart"><i class="fa-solid fa-cart-plus"></i>&ensp;Add to Cart</a>
                            <?php } ?>
                            <?php if (isset($_SESSION["email"])) { ?>
                                <a href="http://localhost/php/medicine_website/user_panel/shop/products/product_details/verify_cart.php" id="add_cart"><i class="fa-solid fa-cart-plus"></i>&ensp;Add to Cart</a>
                            <?php } ?>
                        </div>
                    <?php }
                    ?>
                </div>
            </div>
        </div>
    </main>

    <footer>
        <?php include("C:/xampp/htdocs/php/medicine_website/user_panel/footer/footer.php"); ?>
    </footer>
</body>

</html>