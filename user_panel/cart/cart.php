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
    <?php include("cart.css"); ?>
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

                    $sel = $conn->prepare("SELECT *,cart.quantity FROM `cart` INNER JOIN `products` ON products.item_code=cart.item_code WHERE email='" . $_SESSION["email"] . "'");
                    $sel->execute();
                    $sel = $sel->fetchAll();

                    foreach ($sel as $row) {
                    ?>

                        <div id='products'>
                            <div id='product_img'>
                                <img src='http://localhost/php/medicine_website/user_panel/shop/imgs/<?php echo unserialize($row["item_img"])[0]; ?>'>

                                <form action='update_qua.php' method='post'>

                                    <input type="hidden" name="item_code" value="<?php echo $row["item_code"]; ?>" />
                                    <button id="minus" name="minus">-</button>
                                    <input type="number" value="<?php echo $row["quantity"]; ?>" name="quantity" id="quantity" />
                                    <button id="plus" name="plus">+</button>
                                </form>
                                <?php if ($row["quantity"] > 5) { ?>
                                    <p class="available">Available</p>
                                <?php } else if ($row["quantity"] > 5) { ?>
                                    <p class="available">Only <?php echo $row["quantity"]; ?> Quantity available</p>
                                <?php } else { ?>
                                    <p class="not-available">Not Available</p>
                                <?php } ?>
                            </div>

                            <a href='http://localhost/php/medicine_website/user_panel/shop/product_details/product_details.php?item_code=<?php echo $row['item_code']; ?>' id='box'>
                                <div id="product_details">
                                    <span id="name"><?php echo $row["name"]; ?></span>

                                    <!-- Price -->
                                    <?php if ($row["discount"] != 0) { ?>
                                        <span id="price">&#8377;<?php echo $row["price"]; ?></span>
                                    <?php } ?>
                                    <span id="off_price">&#8377;<?php echo $row["offer_price"]; ?></span>

                                    <!-- Discount -->
                                    <?php if ($row["discount"] != 0) { ?>
                                        <span id="dis">GET <?php echo $row["discount"]; ?>% off</span>
                                    <?php } ?>
                                    <span id="def"><?php echo $row["definition"]; ?></span>
                                    <span id="delivery">
                                        <?php
                                        date_default_timezone_set('Asia/Calcutta');
                                        $date = strtotime("+4 days");

                                        echo "Delivery by " . date("D, M d", $date); ?></span>
                                    <a href="http://localhost/php/medicine_website/user_panel/cart/remove.php?item_code=<?php echo $row["item_code"]; ?>" id="remove_btn">REMOVE</a>
                                </div>
                            </a>
                        </div>
                    <?php
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
                            foreach ($sel as $row) {
                                if ($row["discount"] != 0) {
                                    $save = (($row["price"] - $row["offer_price"]) * $row["quantity"]);
                                }
                                $mul_qua_price = $row["quantity"] * $row["offer_price"];
                                $total_val += $mul_qua_price;

                                if (isset($save)) {
                                    $total_save += $save;
                                }
                            ?>

                                <!-- Multiply quantity with price for every item -->
                                <tr>
                                    <th><?php echo $row["name"]; ?><span> (<?php echo $row["quantity"]; ?>* &#8377;<?php echo $row["offer_price"]; ?>)</span></th>
                                    <td>&#8377;<?php echo $mul_qua_price; ?></td>
                                </tr>

                            <?php }

                            // Add Tax & Delivery charges into total value
                            $charges = ($total_val * 0.18);
                            $pay_val = ($total_val + $charges + 40); ?>
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
                <a href="http://localhost/php/medicine_website/user_panel/shop/pr_main_page/pr_main_page.php">Add your choice</a>
            </div>
        <?php } ?>
    </main>




    <footer>
        <?php include("C:/xampp/htdocs/php/medicine_website/user_panel/footer/footer.php"); ?>
    </footer>
</body>

</html>