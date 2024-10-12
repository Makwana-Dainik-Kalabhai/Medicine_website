<style>
    <?php include("C:/xampp/htdocs/php/medicine_website/user_panel/home_page_items/medicines/medicines.css"); ?>
</style>

<div id="medicine_shop_category">
    <p>Shop By Category</p>

    <?php
    include("C:/xampp/htdocs/php/medicine_website/database.php");

    $sel = $conn->prepare("SELECT * FROM `medicines` GROUP BY `category`");
    $sel->execute();
    $sel = $sel->fetchAll();

    foreach ($sel as $row) { ?>
        <a href="http://localhost/php/medicine_website/user_panel/shop/pr_main_page/pr_main_page.php?category=<?php echo $row["category"]; ?>&database=medicines"><img src="http://localhost/php/medicine_website/user_panel/shop/imgs/medicines/category_img/<?php echo $row["category"]; ?>.png" /></a>
    <?php } ?>
</div>

<div id="popular_picks">
    <div>
        <p>Popular Picks</p>
        <div id="picks">
            <?php
            $sel = $conn->prepare("SELECT * FROM `medicines` ORDER BY `time` DESC LIMIT 6");
            $sel->execute();
            $sel = $sel->fetchAll();

            foreach ($sel as $row) { ?>
                <div id="box">
                    <a href="http://localhost/php/medicine_website/user_panel/shop/product_details/product_details.php?database=medicines&item_code=<?php echo $row["item_code"]; ?>">
                        <div id="product_img">
                            <img src="http://localhost/php/medicine_website/user_panel/shop/imgs/medicines/medicine_imgs/<?php echo unserialize($row["item_img"])[0]; ?>" />

                            <?php if (!isset($_SESSION["email"])) { ?>
                                <a href="http://localhost/php/medicine_website/user_panel/form/login_form.php"><i class="fa-solid fa-heart"></i></a>
                            <?php } ?>

                            <?php if (isset($_SESSION["email"])) {
                                $sel_item = $conn->prepare("SELECT * FROM `wishlist`");
                                $sel_item->execute();
                                $sel_item = $sel_item->fetchAll();

                                foreach ($sel_item as $row_item) {
                                    if ($row["item_code"] == $row_item["item_code"]) {
                                        $con_item = $row_item["item_code"];
                                    }
                                }
                                
                                if (isset($con_item)) { ?>
                                    <a href="http://localhost/php/medicine_website/user_panel/home_page_items/medicines/verify_like.php?type=delete&item_code=<?php echo $row["item_code"]; ?>" id="like"><i class="fa-solid fa-heart" style="color:red;"></i></a>
                                <?php }
                                //
                                if (!isset($con_item)) { ?>
                                    <a href="http://localhost/php/medicine_website/user_panel/home_page_items/medicines/verify_like.php?type=insert&item_code=<?php echo $row["item_code"]; ?>" id="like"><i class="fa-solid fa-heart" style="color:gray;"></i></a>
                                <?php } unset($con_item); ?>
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
                        <a href="" id="add_cart"><i class="fa-solid fa-cart-plus"></i> Add to cart</a>
                    </a>
                </div>
            <?php } ?>
        </div>
    </div>
</div>

<!-- <div id="order_description">
    <?php //include("C:/xampp/htdocs/php/medicine_website/user_panel/shop/medicines/medicines_cat_des.php"); 
    ?>
</div> -->