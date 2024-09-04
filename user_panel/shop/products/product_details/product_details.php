<?php session_start();

if (isset($_GET["item_code"])) {
    $_SESSION["item_code"] = $_GET["item_code"];
}
?>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Order Products Now</title>
<?php include("C:/xampp/htdocs/php/medicine_website/user_panel/links.php"); ?>

<style>
    <?php include("C:/xampp/htdocs/php/medicine_website/user_panel/shop/products/product_details/product_details.css"); ?>
</style>

<script>
    <?php include("C:/xampp/htdocs/php/medicine_website/user_panel/shop/products/product_details/product_details.js"); ?>
</script>

<body>
    <header>
        <?php include("C:/xampp/htdocs/php/medicine_website/user_panel/header/header.php"); ?>
    </header>

    <main>
        <?php if (isset($_SESSION["task_fail"])) { ?>
            <div id="task" style="background-color: red;">
                <?php echo $_SESSION["task_fail"];
                unset($_SESSION["task_fail"]); ?>
            </div>
        <?php }
        //
        if (isset($_SESSION["task_success"])) { ?>
            <div id="task" style="background-color: #00b300;">
                <?php echo $_SESSION["task_success"];
                unset($_SESSION["task_success"]); ?>
                <script>
                    setTimeout(() => {
                        location.href = "http://localhost/php/medicine_website/user_panel/cart/products.php"
                        return;

                    }, 2000);
                </script>
            </div>
        <?php } ?>

        <div id="product_container">
            <?php
            include("C:/xampp/htdocs/php/medicine_website/database.php");

            $sel = $conn->prepare("SELECT * FROM `products` WHERE item_code='" . $_SESSION["item_code"] . "'");
            $sel->execute();
            $sel = $sel->fetchAll();

            $count_img = 0;


            foreach ($sel as $row) { ?>
                <div id="product_img">
                    <div id="sub_imgs">
                        <button id="prev"><i class="fa-solid fa-angle-up"></i></button>
                        <div id="imgs">
                            <figure class="fig">
                                <?php foreach (unserialize($row["item_img"]) as $img) { ?>
                                    <div id="img">
                                        <img src="http://localhost/php/medicine_website/user_panel/shop/products/product_imgs/<?php echo $img; ?>" />
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
                        <div id="img">
                            <?php foreach (unserialize($row["item_img"]) as $img) { ?>
                                <img id="full" src="http://localhost/php/medicine_website/user_panel/shop/products/product_imgs/<?php echo $img; ?>" />
                            <?php } ?>
                        </div>

                        <!-- //! Discount btn -->
                        <?php if ($row["discount"] != 0) { ?>
                            <span id="discount">-<?php echo $row["discount"]; ?>%</span>
                        <?php } ?>

                        <!-- //! Like btn -->
                        <?php if (!isset($_SESSION["email"])) { ?>
                            <a href="http://localhost/php/medicine_website/user_panel/form/login_form.php" id="like"><i class="fa-solid fa-heart"></i></a>
                        <?php } ?>
                        <?php if (isset($_SESSION["email"])) {
                            $sel_item = $conn->prepare("SELECT * FROM `wishlist`");
                            $sel_item->execute();
                            $sel_item = $sel_item->fetchAll();

                            foreach ($sel_item as $row_item) {
                                if ($_SESSION["item_code"] == $row_item["item_code"]) {
                                    $con_item = $row_item["item_code"];
                                }
                            }

                            if (isset($con_item)) { ?>
                                <a href="http://localhost/php/medicine_website/user_panel/shop/products/product_details/verify_like.php?type=delete" id="like" style="color:red;"><i class="fa-solid fa-heart"></i></a>
                            <?php }
                            //
                            if (!isset($con_item)) { ?>
                                <a href="http://localhost/php/medicine_website/user_panel/shop/products/product_details/verify_like.php?type=insert" id="like" style="color:gray;"><i class="fa-solid fa-heart"></i></a>
                            <?php } ?>
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
                    <?php if ($row["quantity"] > 0) { ?>
                        <span id="available">Available in Stock</span>
                    <?php } else { ?>
                        <span id="not_available">Out of Stock</span>
                    <?php } ?>

                    <div id="btns">
                        <!-- //* Buy btns -->
                        <?php if (!isset($_SESSION["email"])) { ?>
                            <a href="http://localhost/php/medicine_website/user_panel/form/login_form.php" id="buy_btn"><i class="fa-solid fa-shopping-bag"></i>&ensp;Buy Now</a>
                        <?php } ?>
                        <?php if (isset($_SESSION["email"])) { ?>
                            <a href="http://localhost/php/medicine_website/user_panel/shop/products/product_details/verify_cart.php" id="buy_btn"><i class="fa-solid fa-shopping-bag"></i>&ensp;Buy Now</a>
                        <?php } ?>

                        <!-- //* Add to Cart button -->
                        <?php if (!isset($_SESSION["email"])) { ?>
                            <a href="http://localhost/php/medicine_website/user_panel/form/login_form.php" id="add_cart"><i class="fa-solid fa-cart-plus"></i>&ensp;Add to Cart</a>
                        <?php } ?>
                        <?php if (isset($_SESSION["email"])) { ?>
                            <a href="http://localhost/php/medicine_website/user_panel/shop/products/product_details/verify_cart.php" id="add_cart"><i class="fa-solid fa-cart-plus"></i>&ensp;Add to Cart</a>
                        <?php } ?>
                    </div>
                </div>
        </div>
    <?php } ?>


    <div id="advance_details">
        <div>
            <div id="btns">
                <button value="description" class="clicked_btn">Description</button>
                <button value="features">Features</button>
                <button value="specification">Specification</button>
            </div>


            <?php
            foreach ($sel as $row) {
                $_GET["des"] = true; ?>
                <div id="details">

                    <div id="description">
                        <?php foreach (unserialize($row["description"]) as $des) { ?>
                            <li><?php echo $des; ?></li>
                        <?php }

                        if ($row["link"] != null) { ?>
                            <iframe width="560" height="315" src="<?php echo $row["link"]; ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                        <?php } ?>
                    </div>

                    <div id="features">
                        <ol>
                            <?php foreach (unserialize($row["features"]) as $fea) { ?>
                                <li><?php echo $fea; ?></li>
                            <?php } ?>
                        </ol>
                    </div>

                    <div id="specification">
                        <table>
                            <tr>
                                <th>Weight</th>
                                <td><?php echo $row["weight"]; ?></td>
                            </tr>
                            <?php
                            for ($i = 0; $i < sizeof(unserialize($row["specification"])); $i++) { ?>
                                <tr>
                                    <th><?php echo unserialize($row["specification"])[$i][0]; ?></th>
                                    <td><?php echo unserialize($row["specification"])[$i][1]; ?></td>
                                </tr>
                            <?php }
                            ?>
                        </table>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
    <?php include("./related_product/related_product.php"); ?>
    </main>

    <footer>
        <?php include("C:/xampp/htdocs/php/medicine_website/user_panel/footer/footer.php"); ?>
    </footer>
</body>

</html>