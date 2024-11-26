<?php
session_start();
include("C:/xampp/htdocs/php/medicine_website/database.php");

// ! Unset searched_data & category
if (isset($_SESSION["category"])) {
    unset($_SESSION["category"]);
}
if (isset($_SESSION["status"])) {
    unset($_SESSION["status"]);
}
if (isset($_SESSION["search_input"])) {
    unset($_SESSION["search_input"]);
}

// ! Set Data
if (isset($_POST["search_input"])) {
    $_SESSION["search_input"] = $_POST["search_input"];

    $sel = $conn->prepare("SELECT * FROM `products`");
    $sel->execute();
    $sel = $sel->fetchAll();

    foreach ($sel as $row) {
        if (isset($_SESSION["search_input"][0]))
            $firstChar = $_SESSION["search_input"][0] == $row["category"][0];
        if (isset($_SESSION["search_input"][1]))
            $secChar = $_SESSION["search_input"][1] == $row["category"][1];
        if (isset($_SESSION["search_input"][2]))
            $thirdChar = $_SESSION["search_input"][2] == $row["category"][2];

        if ($firstChar && $secChar && $thirdChar) {
            $_SESSION["category"] = $row["category"];
            $_SESSION["status"] = $row["status"];
            unset($_SESSION["search_input"]);
            break;
        }
    }
}
if (isset($_GET["category"])) {
    $_SESSION["category"] = $_GET["category"];
}
if (isset($_GET["status"])) {
    $_SESSION["status"] = $_GET["status"];
}

if (isset($_GET["category"]) && isset($_GET["status"])) {
    $_SESSION["category"] = $_GET["category"];
    $_SESSION["status"] = $_GET["status"];
}

?>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Choose One Now</title>
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
                <a href="#main_products">Shop Now</a>
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
                    <span>No Returns</span>
                    <span>No Returns are Allowed</span>
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
                        $sel_cat = $conn->prepare("SELECT * FROM `products` GROUP BY `category`");
                        if (isset($_SESSION["status"])) {
                            $sel_cat = $conn->prepare("SELECT * FROM `products` WHERE `status`='" . $_SESSION["status"] . "' GROUP BY `category`");
                        }
                        $sel_cat->execute();
                        $sel_cat = $sel_cat->fetchAll(); ?>

                        <div>
                            <?php if (!isset($_SESSION["search_input"])) {
                                foreach ($sel_cat as $row_cat) {
                                    if (isset($_SESSION["category"]) && $_SESSION["category"] == $row_cat["category"]) { ?>
                                        <button value="<?php echo $row_cat["category"]; ?>" style="background-color:#ffcccc;"><?php echo $row_cat["category"]; ?></button>
                                    <?php }

                                    //
                                    else { ?>
                                        <button value="<?php echo $row_cat["category"]; ?>" style="background-color:transparent;"><?php echo $row_cat["category"]; ?></button>

                            <?php }
                                }
                            } ?>
                        </div>

                        <?php
                        $max_price = 0;
                        $min_price = 5000;
                        $max_discount = 0;
                        $min_discount = 50;

                        $sel = $conn->prepare("SELECT * FROM `products`");
                        if (isset($_SESSION["status"])) {
                            $sel = $conn->prepare("SELECT * FROM `products` WHERE `status`='" . $_SESSION["status"] . "'");
                        }
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
                            <input type="range" min="<?php echo $min_price; ?>" value="<?php echo $max_price; ?>" max="<?php echo $max_price; ?>" oninput="document.getElementById('max_price').value = '&#8377;'+this.value">
                            <output id="min_price">&#8377;<?php echo $min_price; ?></output>
                            <output id="max_price"></output>
                        </div>
                        <div id="discount_range">
                            <span>Discount</span>
                            <input type="range" min="<?php echo $min_discount; ?>" value="<?php echo $min_discount; ?>" max="<?php echo $max_discount; ?>" oninput="document.getElementById('max_discount').value = this.value+'%'">
                            <output id="min_discount"><?php echo $min_discount; ?></output>
                            <output id="max_discount"></output>
                        </div>
                    </div>
                </div>
                <div id="products">
                    <?php
                    $query = "SELECT * FROM `products` WHERE `discount`<=$min_discount";
                    if (isset($_SESSION["category"])) {
                        $query = "SELECT * FROM `products` WHERE `category`='" . $_SESSION["category"] . "' AND `discount`<=$min_discount";
                    }
                    if (isset($_SESSION["status"])) {
                        $query = "SELECT * FROM `products` WHERE `status`='" . $_SESSION["status"] . "' AND `discount`<=$min_discount";
                    }
                    if (isset($_SESSION["category"]) && isset($_SESSION["status"])) {
                        $query = "SELECT * FROM `products` WHERE `category` = '" . $_SESSION["category"] . "' AND `status`='" . $_SESSION["status"] . "' AND `discount`<=$min_discount";
                    }
                    if (isset($_SESSION["search_input"])) {
                        $query = "SELECT * FROM `products` WHERE `name` LIKE '%" . $_SESSION["search_input"] . "%' AND `discount`<=$min_discount";
                    }

                    $sel = $conn->prepare($query);
                    $sel->execute();
                    $sel = $sel->fetchAll();
                    $pr_not_found = true;

                    foreach ($sel as $row) {
                        $contain_data = true;
                        unset($pr_not_found); ?>

                        <div id="box">
                            <a href="http://localhost/php/medicine_website/user_panel/shop/product_details/product_details.php?item_code=<?php echo $row["item_code"]; ?>">
                                <div id="product_img">
                                    <?php
                                    if ($row["discount"] != 0) { ?>
                                        <span>&ensp;-<?php echo $row["discount"]; ?>%</span>
                                    <?php } ?>
                                    <img src="http://localhost/php/medicine_website/user_panel/shop/imgs/<?php echo unserialize($row["item_img"])[0]; ?>" alt="" />
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
                                <form action="http://localhost/php/medicine_website/user_panel/shop/pr_main_page/add_cart.php" method="post">
                                    <button name="add_cart" value="<?php echo $row["item_code"]; ?>" id="add_cart"><i class="fa-solid fa-cart-plus"></i>&ensp;Add to Cart</button>
                                </form>
                            <?php } ?>
                        </div>
                    <?php }
                    //
                    if (isset($pr_not_found)) { ?>
                        <img id="pr_not_found" src="http://localhost/php/medicine_website/user_panel/shop/pr_main_page/pr_not_found.png" alt="Items not Found" />
                    <?php
                    } ?>
                </div>
            </div>
        </div>
    </main>

    <footer>
        <?php include("C:/xampp/htdocs/php/medicine_website/user_panel/footer/footer.php"); ?>
    </footer>
</body>

</html>