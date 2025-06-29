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
if (isset($_SESSION["filter"])) {
    unset($_SESSION["filter"]);
}


// ! If User send GET request
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



//! If user Search the value
if (isset($_POST["search_input"]) || isset($_POST["search-btn"]) || isset($_SESSION["search_input"])) {
    if (isset($_POST["search_input"])) $_SESSION["search_input"] = $_POST["search_input"];

    $sel = $conn->prepare("SELECT * FROM `products` GROUP BY `category`");
    $sel->execute();
    $sel = $sel->fetchAll();
    $category = false;

    $_SESSION["search_input"] = strtolower($_SESSION["search_input"]);

    foreach ($sel as $row) {
        if (isset($_SESSION["search_input"][0]) && isset($_SESSION["search_input"][1]) && isset($_SESSION["search_input"][2])) {
            $category = strtolower($row["category"]);

            if ($_SESSION["search_input"][0] == $category[0] && $_SESSION["search_input"][1] == $category[1] && $_SESSION["search_input"][2] == $category[2]) {
                $_SESSION["category"] = $row["category"];
                $_SESSION["status"] = $row["status"];
                break;
            }
        }
    }
}
?>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Choose One Now</title>

<head></head>
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
        <div id="main_products">
            <div id="heading">
                <h1>Our Products</h1>
                <p>Try out the Products to Fulfill your Requirements</p>
            </div>
            <?php
            $sel_cat = $conn->prepare("SELECT * FROM `products` GROUP BY `category`");

            if (isset($_SESSION["status"])) {
                $sel_cat = $conn->prepare("SELECT * FROM `products` WHERE `status`='" . $_SESSION["status"] . "' GROUP BY `category`");
            }
            $sel_cat->execute();
            $sel_cat = $sel_cat->fetchAll(); ?>

            <div id="sort_products">
                <div>
                    <span>Sort By: </span>
                    <button value="latest">Latest</button>
                    <button value="high to low">High to Low</button>
                    <button value="low to high">Low to High</button>
                    <button value="discount">Discount</button>
                </div>
                <select class="select-category">
                    <option value=""><-- Select Category --></option>
                    <option value="All">All</option>
                    <option disabled style="background-color: #f2f2f2;">Medicines</option>
                    <?php
                    foreach ($sel_cat as $row_cat) {
                        if (isset($_GET["category"]) && str_contains($row_cat["category"], '&') && str_contains($row_cat["category"], $_GET["category"])) {
                            $_SESSION["category"] = $row_cat["category"];
                        }
                        if ($row_cat["status"] == "medicine") { ?>
                            <option value="<?php echo $row_cat["category"]; ?>"><?php echo $row_cat["category"]; ?></option>
                    <?php }
                    } ?>
                    <option disabled style="background-color: #f2f2f2;">Medical Devices</option>
                    <?php foreach ($sel_cat as $row_cat) {
                        if ($row_cat["status"] == "device") { ?>
                            <option value="<?php echo $row_cat["category"]; ?>"><?php echo $row_cat["category"]; ?></option>
                    <?php }
                    } ?>
                </select>
            </div>

            <hr>

            <div id="cat_products">
                <div id="category_main">
                    <div id="cat_head">
                        <h1>Categories</h1>
                    </div>
                    <div id="categories">
                        <div>
                            <?php
                            foreach ($sel_cat as $row_cat) {
                                if (isset($_SESSION["category"]) && $_SESSION["category"] == $row_cat["category"]) { ?>
                                    <button value="<?php echo $row_cat["category"]; ?>" style="background-color:#ffcccc;"><?php echo $row_cat["category"]; ?></button>
                                <?php }

                                //
                                else { ?>
                                    <button value="<?php echo $row_cat["category"]; ?>" style="background-color:transparent;"><?php echo $row_cat["category"]; ?></button>

                            <?php }
                            }
                            ?>
                        </div>

                        <?php
                        $max_price = 0;
                        $min_price = 500000;

                        $sel = $conn->prepare("SELECT * FROM `products`");
                        if (isset($_SESSION["status"])) {
                            $sel = $conn->prepare("SELECT * FROM `products` WHERE `status`='" . $_SESSION["status"] . "'");
                        }
                        $sel->execute();
                        $sel = $sel->fetchAll();

                        foreach ($sel as $row_cat) {
                            // ! Get Max price
                            if ($row_cat["offer_price"] > $max_price) {
                                $max_price = $row_cat["offer_price"];
                            }
                            // ! Get Min price
                            if ($row_cat["offer_price"] <= $min_price) {
                                $min_price = $row_cat["offer_price"];
                            }
                        } ?>

                        <div id="price_range">
                            <span>Price Range</span>
                            <input type="range" min="<?php echo $min_price; ?>" value="<?php echo $max_price; ?>" max="<?php echo $max_price; ?>" oninput="document.getElementById('max_price').value = '&#8377;'+this.value" />
                            <output id="min_price">&#8377;<?php echo $min_price; ?></output>
                            <output id="max_price">&#8377;<?php echo $max_price; ?></output>
                        </div>
                    </div>
                </div>
                <?php
                $query = "SELECT * FROM `products`";
                if (isset($_SESSION["category"])) {
                    $query = "SELECT * FROM `products` WHERE `category`='" . $_SESSION["category"] . "'";
                }
                if (isset($_SESSION["status"])) {
                    $query = "SELECT * FROM `products` WHERE `status`='" . $_SESSION["status"] . "'";
                }
                if (isset($_SESSION["category"]) && isset($_SESSION["status"])) {
                    $query = "SELECT * FROM `products` WHERE `category` = '" . $_SESSION["category"] . "' AND `status`='" . $_SESSION["status"] . "'";
                }
                if (isset($_SESSION["search_input"])) {
                    $query = "SELECT * FROM `products` WHERE `name` LIKE '%" . $_SESSION["search_input"] . "%'";
                }

                $sel = $conn->prepare($query);
                $sel->execute();
                $sel = $sel->fetchAll();
                $pr_not_found = true; ?>

                <div id="products">
                    <?php
                    foreach ($sel as $row) {
                        $contain_data = true;
                        unset($pr_not_found); ?>

                        <div class="box" style="background-color: <?php echo ($row["quantity"] <= 0) ? "#f2f2f2" : ""; ?>">
                            <a href="http://localhost/php/medicine_website/user_panel/shop/product_details/product_details.php?product_id=<?php echo $row["product_id"]; ?>">
                                <div id="product_img">
                                    <?php if ($row["discount"] != 0) { ?>
                                        <span id="discount">&ensp;-<?php echo $row["discount"]; ?>%</span>
                                    <?php } ?>
                                    <img src="<?php echo (str_contains(unserialize($row["item_img"])[0], "https")) ? unserialize($row["item_img"])[0] : "http://localhost/php/medicine_website/user_panel/shop/imgs/" . unserialize($row["item_img"])[0] . ""; ?>" alt="" />
                                </div>

                                <div id="product_details">
                                    <span id="name"><?php echo $row["name"]; ?></span>

                                    <span id="off_price"><?php echo ($row["offer_price"] > 0) ? "&#8377;" . $row["offer_price"] : ""; ?></span>
                                    <?php
                                    if ($row["discount"] != 0) { ?>
                                        <span id="price"><?php echo ($row["price"] > 0) ? "&#8377;" . $row["price"] : ""; ?></span>
                                    <?php }
                                    if ($row["quantity"] <= 0) { ?>
                                        <h5 id='out_stock'>Out Of Stock</h5>
                                    <?php } ?>
                                </div>
                            </a>


                            <!-- //! Add to Cart button -->
                            <?php if ($row["quantity"] > 0) {
                                if (!isset($_SESSION["email"])) { ?>
                                    <a href="http://localhost/php/medicine_website/user_panel/form/login_form.php" id="add_cart"><i class="fa-solid fa-cart-plus"></i>&ensp;Add to Cart</a>
                                <?php } ?>
                                <?php if (isset($_SESSION["email"])) { ?>
                                    <form action="http://localhost/php/medicine_website/user_panel/shop/pr_main_page/add_cart.php" method="post">
                                        <button name="add_cart" value="<?php echo $row["product_id"]; ?>" id="add_cart"><i class="fa-solid fa-cart-plus"></i>&ensp;Add to Cart</button>
                                    </form>
                            <?php }
                            } ?>
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

        <div class="company-features">
            <?php include("C:/xampp/htdocs/php/medicine_website/user_panel/shop/pr_main_page/description.php"); ?>
        </div>

    </main>

    <footer>
        <?php include("C:/xampp/htdocs/php/medicine_website/user_panel/footer/footer.php"); ?>
    </footer>
</body>

</html>

<?php
if (isset($_SESSION["price_range"])) {
    unset($_SESSION["price_range"]); ?>
    <script>
        location.reload();
    </script>
<?php } ?>