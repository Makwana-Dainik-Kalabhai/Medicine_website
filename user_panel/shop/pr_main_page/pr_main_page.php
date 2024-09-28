<?php
session_start();

// ! Unset searched_data & category
if (isset($_SESSION["category"])) {
    unset($_SESSION["category"]);
}

if (isset($_GET["category"])) {
    $_SESSION["category"] = $_GET["category"];
}
if (isset($_GET["database"])) {
    $_SESSION["database"] = $_GET["database"];

    if ($_SESSION["database"] == "medicines") {
        $_SESSION["img_path"] = "http://localhost/php/medicine_website/user_panel/shop/imgs/medicines/medicine_imgs/";
    } else {
        $_SESSION["img_path"] = "http://localhost/php/medicine_website/user_panel/shop/imgs/products/product_imgs/";
    }
}
?>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Buy Now</title>
<?php include("C:/xampp/htdocs/php/medicine_website/user_panel/links.php"); ?>

<style>
    <?php include("pr_main_page.css"); ?>
</style>

<script>
    <?php include("pr_main_page.js"); ?>
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

                        $sel_cat = $conn->prepare("SELECT * FROM `" . $_SESSION["database"] . "` GROUP BY `category`");
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
                        $min_price = 5000;
                        $max_discount = 0;
                        $min_discount = 50;

                        $sel = $conn->prepare("SELECT * FROM `" . $_SESSION["database"] . "`");
                        $sel->execute();
                        $sel = $sel->fetchAll();

                        foreach ($sel as $row_cat) {
                            // ! Get Max Discount
                            if ($row_cat["discount"] > $max_discount) {
                                $max_discount = $row_cat["discount"];
                            }
                            // ! Get Min Discount
                            if ($row_cat["discount"] <= $min_discount) {
                                $min_discount = $row_cat["discount"];
                            }
                            // ! Get Max product
                            if ($row_cat["offer_price"] > $max_price) {
                                $max_price = $row_cat["offer_price"];
                            }
                            // ! Get Min product
                            if ($row_cat["offer_price"] <= $min_price) {
                                $min_price = $row_cat["offer_price"];
                            }
                        } ?>

                        <div id="price_range">
                            <span>Price range</span>
                            <input type="range" name="" min="<?php echo $min_price; ?>" value="<?php echo $max_price; ?>" max="<?php echo $max_price; ?>" oninput="document.getElementById('max_price').value = '&#8377;'+this.value">
                            <output id="min_price">&#8377;<?php echo $min_price; ?></output>
                            <output id="max_price"></output>
                        </div>
                        <div id="discount_range">
                            <span>Discount</span>
                            <input type="range" name="" min="<?php echo $min_discount; ?>" value="<?php echo $max_discount; ?>" max="<?php echo $max_discount; ?>" oninput="document.getElementById('max_discount').value = this.value+'%'">
                            <output id="min_discount"><?php echo $min_discount; ?></output>
                            <output id="max_discount"></output>
                        </div>
                    </div>
                </div>
                <div id="products">
                    <?php
                    $query = "SELECT * FROM `" . $_SESSION["database"] . "`";
                    if (isset($_GET["category"])) {
                        $query = "SELECT * FROM `" . $_SESSION["database"] . "` WHERE `category` = '" . $_GET["category"] . "'";
                    }

                    $sel = $conn->prepare($query);
                    $sel->execute();
                    $sel = $sel->fetchAll();

                    foreach ($sel as $row) {
                        $contain_data = true; ?>

                        <div id="box">
                            <a href="http://localhost/php/medicine_website/user_panel/shop/product_details/product_details.php?database=<?php echo $_SESSION["database"]; ?>&item_code=<?php echo $row["item_code"]; ?>">
                                <div id="product_img">
                                    <?php
                                    if ($row["discount"] != 0) { ?>
                                        <span>&ensp;-<?php echo $row["discount"]; ?>%</span>
                                    <?php } ?>
                                    <img src="<?php echo $_SESSION["img_path"] . unserialize($row["item_img"])[0]; ?>" alt="" />
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
                                <a href="http://localhost/php/medicine_website/user_panel/shop/product_details/verify_cart.php" id="add_cart"><i class="fa-solid fa-cart-plus"></i>&ensp;Add to Cart</a>
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