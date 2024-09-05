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


                // Select wishlist items
                $sel_wish = $conn->prepare("SELECT * FROM `wishlist` WHERE email='" . $_SESSION["email"] . "'");
                $sel_wish->execute();
                $sel_wish = $sel_wish->fetchAll();

                foreach ($sel_wish as $row_wish) {
                    $sel_item = $conn->prepare("SELECT * FROM `products` WHERE `item_code`='" . $row_wish["item_code"] . "'");
                    $sel_item->execute();
                    $sel_item = $sel_item->fetchAll();

                    foreach ($sel_item as $row_item) { ?>

                        <div id='wishlist_products'>

                            <div id='products'>
                                <a href='http://localhost/php/medicine_website/user_panel/shop/product_details/product_details.php?item_code=<?php echo $row_item['item_code']; ?>' id='box'>
                                    <div id='product_img'>
                                        <img src='http://localhost/php/medicine_website/user_panel/shop/imgs/products/product_imgs/<?php echo unserialize($row_item['item_img'])[0]; ?>' />
                                    </div>

                                    <div id='product_details'>
                                        <span id="name"><?php echo $row_item["name"]; ?> (<?php echo $row_item["weight"]; ?>)</span>

                                        <!-- Price -->
                                        <?php if ($row_item["discount"] != 0) { ?>
                                            <span id="price">&#8377;<?php echo $row_item["price"]; ?></span>
                                        <?php } ?>
                                        <span id="off_price">&#8377;<?php echo $row_item["offer_price"]; ?></span>

                                        <!-- Discount -->
                                        <?php if ($row_item["discount"] != 0) { ?>
                                            <span id="dis">GET <?php echo $row_item["discount"]; ?>% off</span>
                                        <?php } ?>
                                        <span id="def"><?php echo $row_item["definition"]; ?></span>
                                    </div>
                                </a>
                                <a href='remove.php?remove_item=<?php echo $row_item['item_code']; ?>' id='remove_btn'><i class='fa-solid fa-trash'></i></a>
                            </div>

                    <?php }
                } ?>
                        </div>
            </div>
        <?php }


        if ($like_count == 0) { ?>

            <div id='empty_wishlist'>
                <h1>Your wishlist is empty, so add your favourites</h1>
                <a href="http://localhost/php/medicine_website/user_panel/shop/pr_main_page/pr_main_page.php">Add Now</a>
            </div>
        <?php } ?>
    </main>

    <footer>
        <?php include("C:/xampp/htdocs/php/medicine_website/user_panel/footer/footer.php"); ?>
    </footer>
</body>

</html>