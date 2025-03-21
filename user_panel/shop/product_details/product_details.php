<?php session_start();

if (isset($_GET["product_id"])) {
    $_SESSION["product_id"] = $_GET["product_id"];
}

if (isset($_GET["status"])) {
    $_SESSION["status"] = $_GET["status"];
}
?>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Order Products Now</title>
<?php include("C:/xampp/htdocs/php/medicine_website/user_panel/links.php"); ?>

<style>
    <?php include("product_details.css"); ?>
</style>

<script>
    <?php include("product_details.js"); ?>
</script>

<body>
    <div class="full-img"><img src="" alt="Img not Found"></div>
    <header>
        <?php include("C:/xampp/htdocs/php/medicine_website/user_panel/header/header.php"); ?>
    </header>

    <main>
        <div id="product_container">
            <?php
            include("C:/xampp/htdocs/php/medicine_website/database.php");

            $sel = $conn->prepare("SELECT * FROM `products` WHERE product_id='" . $_SESSION["product_id"] . "'");
            $sel->execute();
            $sel = $sel->fetchAll();
            $row = $sel[0];

            $count_img = 0;
            $category = $row["category"];
            ?>
            <div id="product_img">
                <div id="sub_imgs">
                    <button id="prev"><i class="fa-solid fa-angle-up"></i></button>
                    <div id="imgs">
                        <figure class="fig">
                            <?php foreach (unserialize($row["item_img"]) as $img) { ?>
                                <div id="img" class="<?php echo ($count_img == 0) ? "active-sub-img" : ""; ?>">
                                    <img src="http://localhost/php/medicine_website/user_panel/shop/imgs/<?php echo $img; ?>" />
                                </div>
                            <?php $count_img++;
                            } ?>
                        </figure>
                    </div>
                    <button id="next"><i class="fa-solid fa-angle-down"></i></button>
                </div>
                <script>
                    var martop = 0;
                    <?php $total_mar = - (($count_img / 2) * 100); ?>

                    $(document).ready(() => {
                        <?php
                        if ($count_img >= 4) { ?>
                            $("#prev").click(function() {
                                if (martop < 0) {
                                    martop = martop + 100;
                                    $("#sub_imgs figure").css("margin-top", martop + "%");
                                }
                            });
                            $("#next").click(function() {
                                if (martop > <?php echo $total_mar; ?>) {
                                    martop = martop - 100;
                                    $("#sub_imgs figure").css("margin-top", martop + "%");
                                }
                            });
                        <?php } ?>
                    });
                </script>

                <div id="main_imgs">
                    <?php foreach (unserialize($row["item_img"]) as $img) { ?>
                        <a id="full" href="http://localhost/php/medicine_website/user_panel/shop/imgs/<?php echo $img; ?>"><img src="http://localhost/php/medicine_website/user_panel/shop/imgs/<?php echo $img; ?>" /></a>
                    <?php } ?>

                    <!-- //! Discount btn -->
                    <?php if ($row["discount"] != 0) { ?>
                        <span id="discount">-<?php echo $row["discount"]; ?>%</span>
                    <?php } ?>

                    <!-- //! Like btn -->
                    <?php if (!isset($_SESSION["email"])) { ?>
                        <a href="http://localhost/php/medicine_website/user_panel/form/login_form.php" id="like"><i class="fa-solid fa-heart"></i></a>
                        <?php }

                    if (isset($_SESSION["email"])) {
                        $sel_item = $conn->prepare("SELECT * FROM `wishlist`");
                        $sel_item->execute();
                        $sel_item = $sel_item->fetchAll();

                        foreach ($sel_item as $row_item) {
                            if ($_SESSION["product_id"] == $row_item["product_id"]) {
                                $con_item = $row_item["product_id"];
                            }
                        }

                        if (isset($con_item)) { ?>
                            <a href="http://localhost/php/medicine_website/user_panel/shop/product_details/verify_like.php?type=delete" id="like" style="color:red;"><i class="fa-solid fa-heart"></i></a>
                        <?php }
                        //
                        if (!isset($con_item)) { ?>
                            <a href="http://localhost/php/medicine_website/user_panel/shop/product_details/verify_like.php?type=insert" id="like" style="color:gray;"><i class="fa-solid fa-heart"></i></a>
                        <?php }
                    }
                    if (isset($_SESSION["status"]) && $_SESSION["status"] == "medicine") { ?>
                        <span id="expiry">Expiry:&ensp;<?php echo $row["expiry"]; ?></span>
                    <?php } ?>
                </div>
            </div>

            <div id="product_details">
                <span id="name"><?php echo $row["name"]; ?></span>
                <hr>
                <span id="definition"><?php echo $row["definition"]; ?></span>
                <?php if ($row["discount"] != 0) { ?>
                    <span id="price">&#8377;<?php echo $row["price"]; ?></span>
                <?php } ?>
                <span id="off_price">&#8377;<?php echo $row["offer_price"]; ?></span>


                <!-- //* Check that available in stock or not -->
                <?php if ($row["quantity"] > 4) { ?>
                    <span id="available">Available in Stock</span>
                <?php } else if ($row["quantity"] > 0 && $row["quantity"] < 5) { ?>
                    <span id="not_available">Only <?php echo $row["quantity"]; ?> Quantity available</span>
                <?php } else { ?>
                    <span id="not_available">Out of Stock</span>
                <?php } ?>


                <?php if ($row["quantity"] > 0) { ?>
                    <div id="btns">
                        <!-- //* Buy btns -->
                        <?php if (!isset($_SESSION["email"])) { ?>
                            <a href="http://localhost/php/medicine_website/user_panel/form/login_form.php" id="buy_btn"><i class="fa-solid fa-shopping-bag"></i>&ensp;Buy Now</a>
                        <?php } ?>
                        <?php if (isset($_SESSION["email"])) { ?>
                            <a href="http://localhost/php/medicine_website/user_panel/shop/buy_now/buy_now.php?product_id=<?php echo $row["product_id"]; ?>&product=one" id="buy_btn"><i class="fa-solid fa-shopping-bag"></i>&ensp;Buy Now</a>
                        <?php } ?>

                        <!-- //* Add to Cart button -->
                        <?php if (!isset($_SESSION["email"])) { ?>
                            <a href="http://localhost/php/medicine_website/user_panel/form/login_form.php" id="add_cart"><i class="fa-solid fa-cart-plus"></i>&ensp;Add to Cart</a>
                        <?php } ?>
                        <?php if (isset($_SESSION["email"])) { ?>
                            <a href="http://localhost/php/medicine_website/user_panel/shop/product_details/verify_cart.php" id="add_cart"><i class="fa-solid fa-cart-plus"></i>&ensp;Add to Cart</a>
                        <?php } ?>
                    </div>
                <?php } ?>
            </div>
        </div>


        <div id="advance_details">
            <div>
                <div id="btns">
                    <button value="description" class="clicked_btn">Description</button>
                    <?php if ($_SESSION["status"] == "device") { ?>
                        <button value="features">Features</button>
                        <button value="specification">Specification</button>
                    <?php } //
                    else { ?>
                        <button value="benefits">Benefits</button>
                        <button value="how_use">How to Use</button>
                        <button value="safety">Safety</button>
                        <button value="other_info">Other Info.</button>
                    <?php } ?>
                    <button value="faqs">FAQs</button>
                </div>


                <?php
                disProductDetalis();
                ?>
                <div id=description_img>
                    <?php if ($row["desc_img"] != "") {
                        foreach (unserialize($row["desc_img"]) as $img) { ?>
                            <img src="http://localhost/php/medicine_website/user_panel/shop/desc_imgs/<?php echo $img; ?>" alt="" />
                    <?php }
                    } ?>
                </div>
            </div>
        </div>

        <!-- //! Similar Products -->
        <?php
        foreach ($sel as $row) {
            $sel = $conn->prepare("SELECT * FROM `products` WHERE `category`='$category'");
            $sel->execute();
            $sel = $sel->fetchAll();

            $total_product = 0;

            foreach ($sel as $row) {
                $total_product++;
            }
            if ($total_product > 1) {
                include("./similar_product/similar_product.php");
            }
        } ?>

        <!-- //! Ratings & Reviews -->
        <div id="ratings_div">
            <?php include("C:/xampp/htdocs/php/medicine_website/user_panel/shop/product_details/ratings/ratings.php"); ?>
        </div>
    </main>

    <footer>
        <?php include("C:/xampp/htdocs/php/medicine_website/user_panel/footer/footer.php"); ?>
    </footer>
</body>

</html>

<?php
//* Display Product Details
function disProductDetalis()
{
    global $sel;

    foreach ($sel as $row) {
        $_GET["des"] = true; ?>
        <div id="details">
            <?php if ($row["description"] != null) { ?>
                <p class="responsive-head">Description</p>
                <hr>
                <div id="description">
                    <?php foreach (unserialize($row["description"]) as $des) {
                        if (isset($des[0]) && isset($des[1])) { ?>
                            <p>
                                <li style="display: inline;font-weight: 700;"><?php echo $des[0]; ?></li>
                                <span>: -&ensp;<?php echo $des[1]; ?></span>
                            </p>
                        <?php }
                        //
                        else if (isset($des[0])) { ?>
                            <li><?php echo $des[0]; ?></li>
                        <?php }
                    }
                    if ($row["link"] != null) { ?>
                        <iframe src="<?php echo $row["link"]; ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                    <?php } ?>
                </div>
            <?php } ?>

            <?php if ($row["features"] != null) { ?>
                <p class="responsive-head">Features</p>
                <hr>
                <div id="features">
                    <ol>
                        <?php foreach (unserialize($row["features"]) as $fea) {
                            if (isset($fea[0]) && isset($fea[1])) { ?>
                                <p>
                                    <li style="display: inline;font-weight: 700;"><?php echo $fea[0]; ?></li>
                                    <span>: -&ensp;<?php echo $fea[1]; ?></span>
                                </p>
                            <?php }
                            //
                            else if (isset($fea[0])) { ?>
                                <li><?php echo $fea[0]; ?></li>
                        <?php }
                        } ?>
                    </ol>
                </div>
            <?php } ?>

            <?php if ($row["specification"] != null) { ?>
                <p class="responsive-head">Specification</p>
                <hr>
                <div id="specification">
                    <table>
                        <?php if ($row["weight"] != null) { ?>
                            <tr>
                                <th>Weight</th>
                                <td><?php echo $row["weight"]; ?></td>
                            </tr>
                            <?php
                        }
                        foreach (unserialize($row["specification"]) as $spe) {
                            if (isset($spe[0]) && isset($spe[1])) { ?>
                                <tr>
                                    <th><?php echo $spe[0]; ?></th>
                                    <td><?php echo $spe[1]; ?></td>
                                </tr>
                            <?php } ?>
                        <?php } ?>
                    </table>
                </div>
            <?php } ?>

            <?php if ($row["benefits"] != null) { ?>
                <p class="responsive-head">Benefits</p>
                <hr>
                <div id="benefits">
                    <?php foreach (unserialize($row["benefits"]) as $ben) {
                        if (isset($ben[0]) && isset($ben[1])) { ?>
                            <p>
                                <li style="display: inline;font-weight: 700;"><?php echo $ben[0]; ?></li>
                                <span>: -&ensp;<?php echo $ben[1]; ?></span>
                            </p>
                        <?php }
                        //
                        else if (isset($ben[0])) { ?>
                            <li><?php echo $ben[0]; ?></li>
                    <?php }
                    } ?>
                </div>
            <?php } ?>


            <?php if ($row["how_use"] != null) { ?>
                <p class="responsive-head">How to Use</p>
                <hr>
                <div id="how_use">
                    <?php foreach (unserialize($row["how_use"]) as $how) {
                        if (isset($how[0]) && isset($how[1])) { ?>
                            <p>
                                <li style="display: inline;font-weight: 700;"><?php echo $how[0]; ?></li>
                                <span>: -&ensp;<?php echo $how[1]; ?></span>
                            </p>
                        <?php }
                        //
                        else if (isset($how[0])) { ?>
                            <li><?php echo $how[0]; ?></li>
                    <?php }
                    } ?>
                </div>
            <?php } ?>


            <?php if ($row["safety"] != null) { ?>
                <p class="responsive-head">Safety</p>
                <hr>
                <div id="safety">
                    <?php foreach (unserialize($row["safety"]) as $saf) {
                        if (isset($saf[0]) && isset($saf[1])) { ?>
                            <p>
                                <li style="display: inline;font-weight: 700;"><?php echo $saf[0]; ?></li>
                                <span>: -&ensp;<?php echo $saf[1]; ?></span>
                            </p>
                        <?php }
                        //
                        else if (isset($saf[0])) { ?>
                            <li><?php echo $saf[0]; ?></li>
                    <?php }
                    } ?>
                </div>
            <?php } ?>


            <?php if ($row["other_info"] != null) { ?>
                <p class="responsive-head">Other Information</p>
                <hr>
                <div id="other_info">
                    <?php foreach (unserialize($row["other_info"]) as $inf) {
                        if (isset($inf[0]) && isset($inf[1])) { ?>
                            <p>
                                <li style="display: inline;font-weight: 700;"><?php echo $inf[0]; ?></li>
                                <span>: -&ensp;<?php echo $inf[1]; ?></span>
                            </p>
                        <?php }
                        //
                        else if (isset($inf[0])) { ?>
                            <li><?php echo $inf[0]; ?></li>
                    <?php }
                    } ?>
                </div>
            <?php } ?>


            <?php if ($row["faqs"] != null) { ?>
                <p class="responsive-head">FAQS</p>
                <hr>
                <div id="faqs">
                    <?php foreach (unserialize($row["faqs"]) as $key => $faqs) { ?>
                        <?php if (isset($faqs[0]) && isset($faqs[1])) { ?>
                            <p style="margin-bottom:3%;">
                                <li style="display:block;font-weight: 700;">Que-<?php echo $key + 1; ?>)&ensp;<?php echo $faqs[0]; ?></li>
                                <hr />
                                <span>Ans.&ensp;<?php echo $faqs[1]; ?></span>
                            </p>
                        <?php } ?>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>
    <?php } ?>
<?php } ?>