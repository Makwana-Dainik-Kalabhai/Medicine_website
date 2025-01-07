<?php
session_start();

include("C:/xampp/htdocs/php/medicine_website/database.php");

$query = "";
//!Sort using filtering methods giving on top-right(products main page) in website

if (isset($_POST["filter"])) {
    if ($_POST["filter"] == "latest") {
        $_SESSION["filter"] = "time DESC";
    }
    if ($_POST["filter"] == "high to low") {
        $_SESSION["filter"] = "offer_price DESC";
    }
    if ($_POST["filter"] == "low to high") {
        $_SESSION["filter"] = "offer_price";
    }
    if ($_POST["filter"] == "discount") {
        $_SESSION["filter"] = "discount DESC";
    }
}
if (isset($_POST["category"])) {
    $_SESSION["category"] = $_POST["category"];
}

if (isset($_POST["price_range"]) && isset($_POST["discount_range"])) {
    $_SESSION["price_range"] = $_POST["price_range"];
    $_SESSION["discount_range"] = $_POST["discount_range"];
}

$query = "SELECT * FROM `products` WHERE `offer_price`<=" . $_SESSION["price_range"] . " AND `discount`<=" . $_POST["discount_range"] . "";
if (isset($_SESSION["category"])) {
    $query = "SELECT * FROM `products` WHERE `offer_price`<=" . $_SESSION["price_range"] . " AND `discount`<=" . $_POST["discount_range"] . " AND `category`='" . $_SESSION["category"] . "'";
}
if (isset($_SESSION["status"])) {
    $query = "SELECT * FROM `products` WHERE `offer_price`<=" . $_SESSION["price_range"] . " AND `discount`<=" . $_POST["discount_range"] . " AND `status`='" . $_SESSION["status"] . "'";
}
if (isset($_SESSION["category"]) && isset($_SESSION["status"])) {
    $query = "SELECT * FROM `products` WHERE `offer_price`<=" . $_SESSION["price_range"] . " AND `discount`<=" . $_POST["discount_range"] . " AND `category`='" . $_SESSION["category"] . "' AND `status`='" . $_SESSION["status"] . "'";
}
if (isset($_SESSION["filter"]) && isset($_SESSION["status"])) {
    $query = "SELECT * FROM `products` WHERE `offer_price`<=" . $_SESSION["price_range"] . " AND `discount`<=" . $_POST["discount_range"] . " AND `status`='" . $_SESSION["status"] . "' ORDER BY " . $_SESSION["filter"] . "";
}
if (isset($_SESSION["filter"]) && isset($_SESSION["category"])) {
    $query = "SELECT * FROM `products` WHERE `offer_price`<=" . $_SESSION["price_range"] . " AND `discount`<=" . $_POST["discount_range"] . " AND `category`='" . $_SESSION["category"] . "' ORDER BY " . $_SESSION["filter"] . "";
}
if (isset($_SESSION["filter"]) && isset($_SESSION["status"]) && isset($_SESSION["category"])) {
    $query = "SELECT * FROM `products` WHERE `offer_price`<=" . $_SESSION["price_range"] . " AND `discount`<=" . $_POST["discount_range"] . " AND `category`='" . $_SESSION["category"] . "' AND `status`='" . $_SESSION["status"] . "' ORDER BY " . $_SESSION["filter"] . "";
}


//* Variable to count the products
$product_count = 0;

$sel = $conn->prepare($query);
$sel->execute();
$sel = $sel->fetchAll();

foreach ($sel as $row) {
    $product_count++; ?>
    <div id="box">
        <a href="http://localhost/php/medicine_website/user_panel/shop/product_details/product_details.php?product_id=<?php echo $row["product_id"]; ?>">
            <div id="product_img">
                <?php
                if ($row["discount"] != 0) { ?>
                    <span>&ensp;-<?php echo $row["discount"]; ?>%</span>
                <?php } ?>
                <img src="http://localhost/php/medicine_website/user_panel/shop/imgs/<?php echo unserialize($row["item_img"])[0]; ?>" alt="" />
            </div>
            <div id="product_details">
                <span id="name"><?php echo $row["name"]; ?></span>

                <span id="off_price">&#8377;<?php echo $row["offer_price"]; ?></span>
                <?php
                if ($row["discount"] != 0) { ?>
                    <span id="price">&#8377;<?php echo $row["price"]; ?></span>
                <?php } ?>
            </div>
        </a>
        <!-- //! Add to Cart btn -->
        <?php if (!isset($_SESSION["email"])) { ?>
            <a href="http://localhost/php/medicine_website/user_panel/form/login_form.php" id="add_cart"><i class="fa-solid fa-cart-plus"></i>&ensp;Add to Cart</a>
        <?php } ?>
        <?php if (isset($_SESSION["email"])) { ?>
            <form action="http://localhost/php/medicine_website/user_panel/shop/pr_main_page/add_cart.php" method="post">
                <button name="add_cart" value="<?php echo $row["product_id"]; ?>" id="add_cart"><i class="fa-solid fa-cart-plus"></i>&ensp;Add to Cart</button>
            </form>
        <?php } ?>
    </div>
<?php }

if (isset($product_count) && $product_count == 0) { ?>
    <img id="pr_not_found" src="http://localhost/php/medicine_website/user_panel/shop/pr_main_page/pr_not_found.png" alt="Items not Found" />
<?php }
?>