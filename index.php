<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>healthGroup.com</title>
    <?php include("C:/xampp/htdocs/php/medicine_website/user_panel/links.php"); ?>
</head>

<style>
    <?php include("C:/xampp/htdocs/php/medicine_website/index.css"); ?>
</style>

<body>
    <?php if (!isset($_SESSION["intro_loaded"])) { ?>
        <div class="intro" id="intro">
            <div id="logo">
                <img src="http://localhost/php/medicine_website/user_panel/header/logo1.png" alt="img not found">
            </div>
        </div>
    <?php $_SESSION["intro_loaded"] = true;
    } ?>

    <header>
        <?php include("C:/xampp/htdocs/php/medicine_website/user_panel/header/header.php"); ?>
    </header>

    <main>
        <div id="img_slider">
            <?php include("C:/xampp/htdocs/php/medicine_website/user_panel/home_page_items/img_slider/img_slider.php"); ?>
        </div>

        <!-- //! 3 categories -->
        <div id="home_categories">
            <?php include("C:/xampp/htdocs/php/medicine_website/user_panel/home_page_items/category/categories.php"); ?>
        </div>

        <!-- //! Order Medicines Online -->
        <div id="medicines">
            <?php include("C:/xampp/htdocs/php/medicine_website/user_panel/home_page_items/medicines/medicines.php"); ?>
        </div>

        <!-- //! Order Products Online -->
        <div id="products">
            <?php include("C:/xampp/htdocs/php/medicine_website/user_panel/home_page_items/products/products.php"); ?>
        </div>
    </main>

    <footer>
        <?php include("C:/xampp/htdocs/php/medicine_website/user_panel/footer/footer.php"); ?>
    </footer>
</body>

</html>

<?php
if (isset($_SESSION["email"])) {
    $sel = $conn->prepare("SELECT *,cart.quantity FROM `cart` INNER JOIN `products` ON products.product_id=cart.product_id WHERE email='" . $_SESSION["email"] . "'");
    $sel->execute();
    $sel = $sel->fetchAll();

    foreach ($sel as $row) {
        $sel_qua = $conn->prepare("SELECT * FROM `products` WHERE product_id='" . $row["product_id"] . "'");
        $sel_qua->execute();
        $sel_qua = $sel_qua->fetchAll();
        $prod_qua = $sel_qua[0]["quantity"];

        if ($row["quantity"] > $prod_qua) {
            $up = $conn->prepare("UPDATE `cart` SET `quantity`=$prod_qua WHERE product_id='" . $row["product_id"] . "' AND email='" . $_SESSION["email"] . "'");
            $up->execute();
        }
        if ($prod_qua == 0) {
            $up = $conn->prepare("UPDATE `cart` SET `quantity`=0 WHERE product_id='" . $row["product_id"] . "' AND email='" . $_SESSION["email"] . "'");
            $up->execute();
        }
    }
}

if (isset($_SESSION["filter"])) {
    unset($_SESSION["filter"]);
}
if (isset($_SESSION["category"])) {
    unset($_SESSION["category"]);
}
if (isset($_SESSION["condition"])) {
    unset($_SESSION["condition"]);
}
if (isset($_SESSION["price_range"])) {
    unset($_SESSION["price_range"]);
}
if (isset($_SESSION["discount_range"])) {
    unset($_SESSION["discount_range"]);
}
if (isset($_SESSION["search_input"])) {
    unset($_SESSION["search_input"]);
}
?>

<?php
deliveryDate();

function deliveryDate()
{
    date_default_timezone_set('Asia/Calcutta');
    $today = strtotime("today");

    date_default_timezone_set('Asia/Calcutta');
    $date = strtotime("+4 days");

    global $conn, $today;
    $sel = $conn->prepare("SELECT * FROM `products`");
    $sel->execute();
    $sel = $sel->fetchAll();

    foreach ($sel as $row) {
        if ($row["delivery_date"] == $today) {
            $up = $conn->prepare("UPDATE `products` SET `delivery_date`='$date'");
            $up->execute();
        }
    }
}
?>