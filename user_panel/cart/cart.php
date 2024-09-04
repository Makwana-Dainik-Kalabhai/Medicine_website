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
    <?php include("C:/xampp/htdocs/php/medicine_website/user_panel/cart/cart.css"); ?>
</style>

<body>
    <header>
        <?php include("C:/xampp/htdocs/php/medicine_website/user_panel/header/header.php"); ?>
    </header>

    <main>
        <?php

        if ($cart_count != 0) { ?>
            <div id='cart'>
                <div id="product">
                    <div id='cart_header'>
                        <h1>My Cart(<?php echo $cart_count; ?>)</h1>
                    </div>

                    <?php
                    include("C:/xampp/htdocs/php/medicine_website/database.php");

                    $sel_cart = $conn->prepare("SELECT * FROM `cart` WHERE email='" . $_SESSION["email"] . "'");
                    $sel_cart->execute();
                    $sel_cart = $sel_cart->fetchAll();

                    foreach ($sel_cart as $row_cart) {
                        $sel_item = $conn->prepare("SELECT * FROM `products` WHERE `item_code`='" . $row_cart["item_code"] . "'");
                        $sel_item->execute();
                        $sel_item = $sel_item->fetchAll();


                        foreach ($sel_item as $row_item) { ?>

                            <div id='products'>
                                <div id='product_img'>
                                    <img src='http://localhost/php/medicine_website/user_panel/shop/products/product_imgs/<?php echo unserialize($row_item["item_img"])[0]; ?>'>

                                    <form action='update_qua.php' method='post'>

                                        <input type="hidden" name="item_code" value="<?php echo $row_item["item_code"]; ?>" />
                                        <button id="minus" name="minus">-</button>
                                        <input type="number" value="<?php echo $row_cart["quantity"]; ?>" name="quantity" id="quantity" />
                                        <button id="plus" name="plus">+</button>
                                    </form>
                                </div>

                                <a href='http://localhost/php/medicine_website/user_panel/shop/products/product_details/product_details.php?item_code=<?php echo $row_item['item_code']; ?>' id='box'>
                                    <div id="product_details">
                                        <span id="name"><?php echo $row_item["name"]; ?></span>

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
                                        <span id="delivery">
                                            <?php
                                            date_default_timezone_set('Asia/Calcutta');
                                            $date = strtotime("+4 days");

                                            echo "Delivery by " . date("D, M d", $date); ?></span>
                                        <a href="http://localhost/php/medicine_website/user_panel/cart/remove.php?item_code=<?php echo $row_item["item_code"]; ?>" id="remove_btn">REMOVE</a>
                                    </div>
                                </a>
                            </div>
                    <?php }
                    } ?>
                </div>

                <div id='bill'>
                    <div id='bill_header'>
                        <h1>Total Bill Value</h1>
                    </div>
                    <div id='bill_values'>
                        <table>

                            <?php
                            $total_val = 0;
                            $total_save = 0;
                            foreach ($sel_cart as $row_cart) {
                                $sel_item = $conn->prepare("SELECT * FROM `products` WHERE `item_code`='" . $row_cart["item_code"] . "'");
                                $sel_item->execute();
                                $sel_item = $sel_item->fetchAll();


                                foreach ($sel_item as $row_item) {
                                    if ($row_item["discount"] != 0) {
                                        $save = (($row_item["price"] - $row_item["offer_price"]) * $row_cart["quantity"]);
                                    }
                                    $mul_qua_price = $row_cart["quantity"] * $row_item["price"];
                                    $total_val += $mul_qua_price;

                                    if (isset($save)) {
                                        $total_save += $save;
                                    }
                            ?>

                                    <!-- Multiply quantity with price for every item -->
                                    <tr>
                                        <th><?php echo $row_item["name"]; ?><span> (<?php echo $row_cart["quantity"]; ?>* &#8377;<?php echo $row_item["price"]; ?>)</span></th>
                                        <td>&#8377;<?php echo $mul_qua_price; ?></td>
                                    </tr>

                                <?php }

                                // Add Tax & Delivery charges into total value
                                $charges = ($total_val * 0.18);
                                $pay_val = ($total_val + $charges + 40); ?>
                            <?php } ?>
                        </table>
                    </div>
                    <div id='total_value'>
                        <table>
                            <tr>
                                <th>Total Value</th>
                                <td>&#8377;<?php echo $total_val; ?></td>
                            </tr>
                        </table>
                    </div>
                    <div id='charges'>
                        <table>
                            <tr>
                                <th>+TAX</th>
                                <td>&#8377;<?php echo $charges; ?></td>
                            </tr>
                            <tr>
                                <th>+Delivery Charges</th>
                                <td>&#8377;40</td>
                            </tr>
                        </table>
                    </div>
                    <div id='total_payble_value'>
                        <table>
                            <tr>
                                <th>Total Payble Value</th>
                                <td>&#8377;<?php echo $pay_val; ?></td>
                            </tr>
                        </table>
                    </div>
                    <div id='btns'>
                        <a href='http://localhost/php/mysql/icecream_website/user/order/buy_cart.php'><i class='fa-solid fa-bag-shopping'></i> Buy Now</a>
                        <a href='empty_cart.php'>Empty Cart</a>
                    </div>
                    <hr>
                    <span id="total_save">You Total save &#8377;<?php echo $total_save; ?></span>
                </div>
            </div>
        <?php } ?>

        
        <?php if ($cart_count == 0) { ?>
            <div id='empty'>
                <h1>Your Cart is empty, Add your choices</h1>
                <a href="http://localhost/php/medicine_website/user_panel/shop/products/pr_main_page.php">Add your choice</a>
            </div>
        <?php } ?>
    </main>




    <footer>
        <?php include("C:/xampp/htdocs/php/medicine_website/user_panel/footer/footer.php"); ?>
    </footer>
</body>

</html>