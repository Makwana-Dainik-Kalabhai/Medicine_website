<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
    <?php include("medicines.css"); ?>
</style>

<h1 id="heading">Order Medicines</h1>
<hr>

<div id="medicine_shop_category">
    <p>Shop By Category</p>
    <div>
        <?php
        include("C:/xampp/htdocs/php/medicine_website/database.php");

        $sel = $conn->prepare("SELECT * FROM `products` WHERE `status`='medicine' GROUP BY `category`");
        $sel->execute();
        $sel = $sel->fetchAll();

        foreach ($sel as $row) { ?>
            <a href="http://localhost/php/medicine_website/user_panel/shop/pr_main_page/pr_main_page.php?category=<?php echo $row["category"]; ?>&status=medicine"><img src="<?php echo (str_contains($row["cat_img"], "https")) ? $row["cat_img"] : "http://localhost/php/medicine_website/user_panel/shop/category_img/" . $row["cat_img"] . ""; ?>" /></a>
        <?php } ?>
    </div>
</div>

<div id="popular_picks">
    <p>Popular Picks</p>
    <div id="picks">
        <?php
        $sel = $conn->prepare("SELECT * FROM `products` WHERE `status`='medicine' ORDER BY `time` DESC LIMIT 6");
        $sel->execute();
        $sel = $sel->fetchAll();

        foreach ($sel as $row) { ?>
            <div id="box">
                <a href="http://localhost/php/medicine_website/user_panel/shop/product_details/product_details.php?product_id=<?php echo $row["product_id"]; ?>&status=medicine">
                    <div id="product_img">
                        <img src="<?php echo (str_contains(unserialize($row["item_img"])[0], "https")) ? unserialize($row["item_img"])[0] : "http://localhost/php/medicine_website/user_panel/shop/imgs/" . unserialize($row["item_img"])[0] . ""; ?>" />

                        <?php if (!isset($_SESSION["email"])) { ?>
                            <a href="http://localhost/php/medicine_website/user_panel/form/login_form.php"><i class="fa-solid fa-heart"></i></a>
                        <?php } ?>

                        <?php if (isset($_SESSION["email"])) {
                            $sel_item = $conn->prepare("SELECT * FROM `wishlist` WHERE `email`='" . $_SESSION["email"] . "'");
                            $sel_item->execute();
                            $sel_item = $sel_item->fetchAll();

                            foreach ($sel_item as $row_item) {
                                if ($row["product_id"] == $row_item["product_id"] && $_SESSION["email"] == $row_item["email"]) {
                                    $con_item = $row_item["product_id"];
                                }
                            }

                            if (isset($con_item)) { ?>
                                <a href="http://localhost/php/medicine_website/user_panel/home_page_items/medicines/verify_like.php?type=delete&product_id=<?php echo $row["product_id"]; ?>" id="like"><i class="fa-solid fa-heart" style="color:red;"></i></a>
                            <?php }
                            //
                            if (!isset($con_item)) { ?>
                                <a href="http://localhost/php/medicine_website/user_panel/home_page_items/medicines/verify_like.php?type=insert&product_id=<?php echo $row["product_id"]; ?>" id="like"><i class="fa-solid fa-heart" style="color:gray;"></i></a>
                            <?php }
                            unset($con_item); ?>
                        <?php } ?>
                    </div>
                    <div id="details">
                        <span id="name"><?php echo $row["name"]; ?></span>
                        <span id="offer_price">&#8377;<?php echo $row["offer_price"]; ?></span>
                        <span id="price">&#8377;<?php echo $row["price"]; ?></span>
                        <span id="save">GET <?php if ($row["discount"] != 0) {
                                                echo $row["discount"];
                                            } ?>% off</span>
                    </div>
                    <!-- //* Add to Cart button -->
                    <?php if (!isset($_SESSION["email"])) { ?>
                        <a href="http://localhost/php/medicine_website/user_panel/form/login_form.php" id="add_cart"><i class="fa-solid fa-cart-plus"></i>&ensp;Add to Cart</a>
                    <?php } ?>
                    <?php if (isset($_SESSION["email"])) { ?>
                        <a href="http://localhost/php/medicine_website/user_panel/shop/product_details/verify_cart.php?product_id=<?php echo $row["product_id"]; ?>" id="add_cart"><i class="fa-solid fa-cart-plus"></i>&ensp;Add to Cart</a>
                    <?php } ?>
                </a>
            </div>
        <?php } ?>
    </div>
</div>