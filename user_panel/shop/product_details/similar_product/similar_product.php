<style>
    #related_Product_main {
        position: relative;
        width: 100%;
        height: 480px;
        margin-top: 5%;
        margin-bottom: 2%;
        background-color: rgba(243, 247, 251, 0.5);
    }

    #related_Product_main p {
        color: white;
        font-weight: 500;
        line-height: 2;
        margin-left: 1.5%;
    }

    #related_Product_main>div {
        height: 200px;
        padding-bottom: 10%;
        background-color: #ffc107;
    }

    #related_Product_main #products {
        position: absolute;
        top: 15%;
        width: 100%;
        display: flex;
        overflow: auto;
    }

    #products::-webkit-scrollbar {
        display: none;
    }

    #related_Product_main #box {
        width: 230px;
        margin: 0 1%;
        padding: 1%;
        background-color: white;
        border-radius: 5px;
    }

    #related_Product_main #product_img {
        width: 200px;
    }

    #related_Product_main img {
        width: 100%;
    }

    #related_Product_main a {
        text-decoration: none;
    }


    /* //! Product Details */
    #related_Product_main #name {
        display: block;
        color: black;
        font-size: 0.6em;
        line-height: 1.25;
    }

    #related_Product_main #off_price {
        color: red;
        font-size: 0.65em;
    }

    #related_Product_main #price {
        color: gray;
        font-size: 0.6em;
        text-decoration: line-through;
    }

    #related_Product_main #save {
        display: block;
        color: green;
        font-size: 0.6em;
    }
</style>

<div id="related_Product_main">
    <div>
        <p>Similar Products</p>
        <?php

        include("C:/xampp/htdocs/php/medicine_website/database.php");

        $sel_cat = $conn->prepare("SELECT * FROM `products` WHERE product_id='" . $_SESSION["product_id"] . "'");
        $sel_cat->execute();
        $sel_cat = $sel_cat->fetchAll();

        foreach ($sel_cat as $row_cat) {
            $sel_rel = $conn->prepare("SELECT * FROM `products` WHERE `category`='".$row_cat["category"]."' AND `product_id`!='".$_SESSION["product_id"]."'");
            $sel_rel->execute();
            $sel_rel = $sel_rel->fetchAll(); ?>

            <div id="products">
                <?php foreach ($sel_rel as $row_rel) { ?>
                    <div id="box">
                        <a href="http://localhost/php/medicine_website/user_panel/shop/product_details/product_details.php?product_id=<?php echo $row_rel["product_id"]; ?>">
                            <div id="product_img">
                                <img src="http://localhost/php/medicine_website/user_panel/shop/imgs/<?php echo unserialize($row_rel["item_img"])[0]; ?>" />
                            </div>
                            <div id="details">
                                <span id="name"><?php echo $row_rel["name"]; ?></span>
                                <span id="off_price">&#8377;<?php echo $row_rel["offer_price"]; ?></span>
                                <?php if ($row_rel["discount"] != 0) { ?>
                                    <span id="price">&#8377;<?php echo $row_rel["price"]; ?></span>
                                <?php } ?>
                                <span id="save">GET <?php echo $row_rel["discount"]; ?>% off</span>
                            </div>
                        </a>
                    </div>
                <?php } ?>
            </div>
        <?php } ?>
    </div>
</div>