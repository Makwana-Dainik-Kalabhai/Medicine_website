<style>
    <?php include("similar_product.css"); ?>
</style>

<div id="similar_products">
    <p>Similar Products</p>
    
    <?php
    include("C:/xampp/htdocs/php/medicine_website/database.php");
    $sel_cat = $conn->prepare("SELECT * FROM `products` WHERE product_id='" . $_SESSION["product_id"] . "'");
    $sel_cat->execute();
    $sel_cat = $sel_cat->fetchAll();

    foreach ($sel_cat as $row_cat) {
        $sel_rel = $conn->prepare("SELECT * FROM `products` WHERE `category`='".$row_cat["category"]."' AND `product_id`!='".$_SESSION["product_id"]."'");
        $sel_rel->execute();
        $sel_rel = $sel_rel->fetchAll();
        ?>
        <div id="products">
            <?php foreach ($sel_rel as $row_rel) { ?>
                <div class="similar-box">
                    <a href="http://localhost/php/medicine_website/user_panel/shop/product_details/product_details.php?product_id=<?php echo $row_rel["product_id"]; ?>">
                        <div id="product_img">
                            <img src="http://localhost/php/medicine_website/user_panel/shop/imgs/<?php echo unserialize($row_rel["item_img"])[0]; ?>" />
                        </div>
                        <div id="details">
                            <span id="name"><?php echo $row_rel["name"]; ?></span>
                            <span id="off_price">&#8377;<?php echo $row_rel["offer_price"]; ?></span>
                            <?php if ($row_rel["discount"] != 0) { ?>
                                <span id="price">&#8377;<?php echo $row_rel["price"]; ?></span>
                                <span id="save">GET <?php echo $row_rel["discount"]; ?>% off</span>
                            <?php } ?>
                        </div>
                    </a>
                </div>
            <?php } ?>
        </div>
    <?php } ?>
</div>