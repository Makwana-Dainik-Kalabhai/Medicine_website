<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<style>
    <?php include("C:/xampp/htdocs/php/medicine_website/user_panel/home_page_items/products/products.css"); ?>
</style>

<h1 id="heading">Order Medical Devices</h1>
<hr>

<!-- //! Product shop category -->
<div id="product_shop_category">
    <p>Shop By Category</p>

    <div>
        <img src="http://localhost/php/medicine_website/user_panel/home_page_items/products/medical_devices.png" alt="" />
        <div id="products">
            <?php
            include("C:/xampp/htdocs/php/medicine_website/database.php");

            $sel = $conn->prepare("SELECT * FROM `products` WHERE `status`='device' GROUP BY `category` LIMIT 8");
            $sel->execute();
            $sel = $sel->fetchAll();

            foreach ($sel as $row) { ?>
                <a href="http://localhost/php/medicine_website/user_panel/shop/pr_main_page/pr_main_page.php?status=device&category=<?php echo $row["category"]; ?>" class="box">
                    <img src="http://localhost/php/medicine_website/user_panel/shop/category_img/<?php echo $row["cat_img"]; ?>" alt="Img not Found" />
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
            $sel = $conn->prepare("SELECT * FROM `products` WHERE `status`='device' ORDER BY `time` DESC LIMIT 8");
            $sel->execute();
            $sel = $sel->fetchAll();

            foreach ($sel as $row) { ?>
                <div class="box">
                    <?php if ($row["discount"] != 0) { ?>
                        <span id="discount">-<?php echo $row["discount"]; ?>%</span>
                    <?php } ?>
                    <a href="http://localhost/php/medicine_website/user_panel/shop/product_details/product_details.php?product_id=<?php echo $row["product_id"]; ?>&status=device">
                        <img src="http://localhost/php/medicine_website/user_panel/shop/imgs/<?php echo unserialize($row["item_img"])[0]; ?>" />
                        <div>
                            <span id="name"><?php echo $row["name"]; ?></span>
                            <span id="off_price">&#8377;<?php echo $row["offer_price"]; ?></span>
                            <?php if ($row["discount"] != 0) { ?>
                                <span id="price">&#8377;<?php echo $row["price"]; ?></span>
                            <?php } ?>
                        </div>
                    </a>
                    <!-- //! Add to Cart button -->
                    <?php if (!isset($_SESSION["email"])) { ?>
                        <a href="http://localhost/php/medicine_website/user_panel/form/login_form.php" id="add_cart"><i class="fa-solid fa-cart-plus"></i>&ensp;Add to Cart</a>
                    <?php } ?>
                    <?php if (isset($_SESSION["email"])) { ?>
                        <a href="http://localhost/php/medicine_website/user_panel/shop/product_details/verify_cart.php?product_id=<?php echo $row["product_id"]; ?>" id="add_cart"><i class="fa-solid fa-cart-plus"></i>&ensp;Add to Cart</a>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>
        <img src="http://localhost/php/medicine_website/user_panel/home_page_items/products/hottest.jpg" alt="" />
    </div>
</div>