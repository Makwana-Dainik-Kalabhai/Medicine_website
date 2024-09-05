<style>
    @import url('https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100..700;1,100..700&family=Rubik:ital,wght@0,300..900;1,300..900&display=swap');

    #pr_not_available {
        width: fit-content;
        padding: 3% 0 0 5%;
        font-size: 25px;
        font-family: "Rubik", sans-serif;
    }

    #pr_not_available p {
        line-height: 1.2;
        font-weight: 400;
    }

    #pr_not_available span {
        font-weight: 500;
    }
</style>

<?php
session_start();

include("C:/xampp/htdocs/php/medicine_website/database.php");

$query = "";
//!Sort using filtering methods giving on top-right(products main page) in website

if (isset($_POST["filter"])) {
    if ($_POST["filter"] == "latest") {
        $_SESSION["condition"] = "sr_no DESC";
    }
    if ($_POST["filter"] == "high to low") {
        $_SESSION["condition"] = "offer_price DESC";
    }
    if ($_POST["filter"] == "low to high") {
        $_SESSION["condition"] = "offer_price";
    }
    if ($_POST["filter"] == "discount") {
        $_SESSION["condition"] = "discount DESC";
    }
}
if (isset($_POST["category"])) {
    $_SESSION["category"] = $_POST["category"];
}
if(isset($_POST["price_range"]) && isset($_POST["discount_range"]))
{
    $_SESSION["price_range"] = $_POST["price_range"];
    $_SESSION["discount_range"] = $_POST["discount_range"];
}

$query = "SELECT * FROM `".$_SESSION["database"]."` WHERE `offer_price`<=" . $_SESSION["price_range"] . " AND `discount`<=" . $_POST["discount_range"] . "";

if (isset($_SESSION["category"])) {
    $query = "SELECT * FROM `".$_SESSION["database"]."` WHERE `offer_price`<=" . $_SESSION["price_range"] . " AND `discount`<=" . $_POST["discount_range"] . " AND `category`='" . $_SESSION["category"] . "'";
}
if (isset($_SESSION["condition"])) {
    $query = "SELECT * FROM `".$_SESSION["database"]."` WHERE `offer_price`<=" . $_SESSION["price_range"] . " AND `discount`<=" . $_POST["discount_range"] . " ORDER BY ".$_SESSION["condition"]."";
}
if (isset($_SESSION["condition"]) && isset($_SESSION["category"])) {
    $query = "SELECT * FROM `".$_SESSION["database"]."` WHERE `offer_price`<=" . $_SESSION["price_range"] . " AND `discount`<=" . $_POST["discount_range"] . " AND `category`='" . $_SESSION["category"] . "' ORDER BY ".$_SESSION["condition"]."";
}


//* Variable to count the products
$product_count = 0;

$sel = $conn->prepare($query);
$sel->execute();
$sel = $sel->fetchAll();

foreach ($sel as $row) {
    $product_count++; ?>
    <div id="box">
        <a href="http://localhost/php/medicine_website/user_panel/shop/product_details/product_details.php?item_code=<?php echo $row["item_code"]; ?>">
            <div id="product_img">
                <?php
                if ($row["discount"] != 0) { ?>
                    <span>&ensp;-<?php echo $row["discount"]; ?>%</span>
                <?php } ?>
                <img src="<?php echo $_SESSION["img_path"].unserialize($row["item_img"])[0]; ?>" alt="" />
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
        <!-- //! Add to Cart btn -->
        <?php if (!isset($_SESSION["email"])) { ?>
            <a href="http://localhost/php/medicine_website/user_panel/form/login_form.php" id="add_cart"><i class="fa-solid fa-cart-plus"></i>&ensp;Add to Cart</a>
        <?php } ?>
        <?php if (isset($_SESSION["email"])) { ?>
            <a href="http://localhost/php/medicine_website/user_panel/shop/product_details/verify_cart.php" id="add_cart"><i class="fa-solid fa-cart-plus"></i>&ensp;Add to Cart</a>
        <?php } ?>
    </div>
<?php }

if (isset($product_count) && $product_count == 0) { ?>
    <div id="pr_not_available">
        <p>Products are not available <?php if(isset($_SESSION["category"])) { ?>in the category of <span><?php echo $_SESSION["category"]; ?></span><?php } ?></p>
        <p> with &#8377;<span><?php echo $_POST["price_range"]; ?></span> price and <span><?php echo $_POST["discount_range"]; ?></span>% discount.</p>
    </div>
<?php }
?>