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
    <header>
        <?php include("C:/xampp/htdocs/php/medicine_website/user_panel/header/header.php"); ?>
    </header>

    <?php if (isset($_GET["all_medicines"])) {
        include("C:/xampp/htdocs/php/medicine_website/user_panel/header/medicines/all_medicines.php");
    } ?>


    <main>
        <div id="img_slider">
            <?php include("C:/xampp/htdocs/php/medicine_website/user_panel/home_page_items/img_slider/img_slider.php"); ?>
        </div>

        <!-- //! 3 categories -->
        <div id="home_categories">
            <?php include("C:/xampp/htdocs/php/medicine_website/user_panel/home_page_items/category/categories.php"); ?>
        </div>

        <!-- Order Medicines Online -->
        <div id="medicines">
            <?php include("C:/xampp/htdocs/php/medicine_website/user_panel/home_page_items/medicines/medicines.php"); ?>
        </div>

        <!-- Order Products Online -->
        <div id="products">
            <?php include("C:/xampp/htdocs/php/medicine_website/user_panel/home_page_items/products/products.php"); ?>
        </div>

        <div id="health_tips">
            <?php //include("C:/xampp/htdocs/php/medicine_website/user_panel/home_page_items/health_tips/health_tips.php"); 
            ?>
        </div>
    </main>

    <footer>
        <?php include("C:/xampp/htdocs/php/medicine_website/user_panel/footer/footer.php"); ?>
    </footer>
</body>

</html>

<?php
if(isset($_SESSION["filter"])) {
    unset($_SESSION["filter"]);
}
if(isset($_SESSION["category"])) {
    unset($_SESSION["category"]);
}
if(isset($_SESSION["condition"])) {
    unset($_SESSION["condition"]);
}
if(isset($_SESSION["price_range"])) {
    unset($_SESSION["price_range"]);
}
if(isset($_SESSION["discount_range"])) {
    unset($_SESSION["discount_range"]);
}
?>