<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<style>
    <?php include("C:/xampp/htdocs/php/medicine_website/user_panel/home_page_items/products/products.css"); ?>
</style>

<h1 id="heading">Order Products Online</h1>
<hr>

<!-- //! Product shop category -->
<div id="product_shop_category">
    <p>Shop By Category</p>

    <div>
        <img src="http://localhost/php/medicine_website/user_panel/home_page_items/products/medical_devices.png" alt="" />
        <div id="products">
            <?php
            include("C:/xampp/htdocs/php/medicine_website/database.php");

            $sel = $conn->prepare("SELECT * FROM `products` GROUP BY `category`");
            $sel->execute();
            $sel = $sel->fetchAll();

            foreach ($sel as $row) { ?>
                    <a href="http://localhost/php/medicine_website/user_panel/shop/pr_main_page/pr_main_page.php?category=<?php echo $row["category"]; ?>&database=products" class="box">
                        <img src="http://localhost/php/medicine_website/user_panel/shop/imgs/products/product_imgs/<?php echo unserialize($row["item_img"])[0]; ?>" />
                        <span class="category"><?php echo $row["category"]; ?></span>
                    </a>
            <?php } ?>
        </div>
    </div>
</div>



<!-- //! Popular Products -->
<div id="popular_product">
    <p>Popular Products</p>

    <div>
        <div id="products">
            <?php
            $sel = $conn->prepare("SELECT * FROM `products` ORDER BY `time` DESC LIMIT 10");
            $sel->execute();
            $sel = $sel->fetchAll();
            
            foreach ($sel as $row) { ?>
                <div class="box">
                    <a href="http://localhost/php/medicine_website/user_panel/shop/product_details/product_details.php?item_code=<?php echo $row["item_code"]; ?>">
                        <img src="http://localhost/php/medicine_website/user_panel/shop/imgs/products/product_imgs/<?php echo unserialize($row["item_img"])[0]; ?>" />
                        <span id="name"><?php echo $row["name"]; ?></span>
                        <div>
                            <?php if ($row["discount"] != 0) { ?>
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
                        <a href="http://localhost/php/medicine_website/user_panel/shop/product_details/verify_cart.php?item_code=<?php echo $row["item_code"]; ?>" id="add_cart"><i class="fa-solid fa-cart-plus"></i>&ensp;Add to Cart</a>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>
        <img src="http://localhost/php/medicine_website/user_panel/home_page_items/products/hottest.jpg" alt="" />
    </div>
</div>