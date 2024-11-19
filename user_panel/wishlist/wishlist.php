<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Wishlist</title>
    <?php include("C:/xampp/htdocs/php/medicine_website/user_panel/links.php"); ?>
</head>

<style>
    <?php include("wishlist.css"); ?>
</style>

<body>
    <header>
        <?php include("C:/xampp/htdocs/php/medicine_website/user_panel/header/header.php"); ?>
    </header>

    <main>
        <?php
        if ($like_count != 0) { ?>

            <div id='wishlist'>
                <div id='wishlist_header'>

                    <?php
                    if (isset($like_count) && $like_count != 0) { ?>
                        <h1>My Wishlist(<?php echo $like_count; ?>)</h1>

                    <?php } ?>

                </div>

                <?php
                // Database
                include("C:/xampp/htdocs/php/medicine_website/database.php");

                $sel = $conn->prepare("SELECT * FROM `wishlist` INNER JOIN `products` ON wishlist.item_code=products.item_code");
                $sel->execute();
                $sel = $sel->fetchAll();

                foreach ($sel as $row) {
                    displayItems($row);
                } ?>
            </div>
        <?php }


        if ($like_count == 0) { ?>

            <div id='empty_wishlist'>
                <img src="empty.png" alt="">
                <div id="links">
                    <a href="http://localhost/php/medicine_website/user_panel/shop/pr_main_page/pr_main_page.php?status=medicine">Add Medicines</a>
                    <a href="http://localhost/php/medicine_website/user_panel/shop/pr_main_page/pr_main_page.php?status=device">Add Medical Devices</a>
                </div>
            </div>
        <?php } ?>
    </main>

    <footer>
        <?php include("C:/xampp/htdocs/php/medicine_website/user_panel/footer/footer.php"); ?>
    </footer>
</body>

</html>

<?php
function displayItems($row)
{ ?>

    <div id='wishlist_products'>

        <div id='products'>
            <a href='http://localhost/php/medicine_website/user_panel/shop/product_details/product_details.php?status=<?php echo $row["status"]; ?>&item_code=<?php echo $row['item_code']; ?>' id='box'>
                <div id='product_img'>
                    <img src='http://localhost/php/medicine_website/user_panel/shop/imgs/<?php echo unserialize($row['item_img'])[0]; ?>' />
                </div>

                <div id='product_details'>
                    <span id="name"><?php echo $row["name"]; ?> (<?php echo $row["weight"]; ?>)</span>

                    <!-- Price -->
                    <?php if ($row["discount"] != 0) { ?>
                        <span id="price">&#8377;<?php echo $row["price"]; ?></span>
                    <?php } ?>
                    <span id="off_price">&#8377;<?php echo $row["offer_price"]; ?></span>

                    <!-- Discount -->
                    <?php if ($row["discount"] != 0) { ?>
                        <span id="dis">GET <?php echo $row["discount"]; ?>% off</span>
                    <?php } ?>
                    <span id="def"><?php echo $row["definition"]; ?></span>
                </div>
            </a>
            <a href='remove.php?remove_item=<?php echo $row['item_code']; ?>' id='remove_btn'><i class='fa-solid fa-trash'></i></a>
        </div>
    <?php
}
    ?>