<?php session_start();
if (!isset($_SESSION["email"])) { ?>
    <script>
        window.history.go(-2);
    </script>
<?php } ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Cart</title>
    <?php include("C:/xampp/htdocs/php/medicine_website/user_panel/links.php"); ?>
</head>

<style>
    <?php include("cart.css"); ?>
</style>

<script>
    $(document).ready(function() {
        $("#products #product_details button").click(function() {
            alert("Please! Remove the not available Product");
            let bool = true,
                i = 0;
            setInterval(() => {
                if (i < 6) {
                    if (bool) {
                        $(this).parentsUntil("#product").css("background-color", "#ffcccc");
                        bool = false;
                    } else {
                        $(this).parentsUntil("#product").css("background-color", "white");
                        bool = true;
                    }
                    i++;
                }
            }, 200);
        });
    });
</script>

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
                        <span>You can Order maximum 5 Quantities.</span>
                    </div>

                    <?php
                    include("C:/xampp/htdocs/php/medicine_website/database.php");

                    $sel = $conn->prepare("SELECT *,cart.quantity FROM `cart` INNER JOIN `products` ON products.product_id=cart.product_id WHERE email='" . $_SESSION["email"] . "'");
                    $sel->execute();
                    $sel = $sel->fetchAll();

                    foreach ($sel as $row) {
                        $sel_qua = $conn->prepare("SELECT * FROM `products` WHERE product_id='" . $row["product_id"] . "'");
                        $sel_qua->execute();
                        $sel_qua = $sel_qua->fetchAll();
                        $prod_qua = $sel_qua[0]["quantity"];

                        if ($row["quantity"] > $prod_qua) {
                            $up = $conn->prepare("UPDATE `cart` SET `quantity`=$prod_qua WHERE product_id='" . $row["product_id"] . "' AND email='" . $_SESSION["email"] . "'");
                            $up->execute();
                        }
                    ?>
                        <div id="products" class="<?php if ($prod_qua <= 0) {
                                                        echo "disable";
                                                    } ?>">
                            <div id='product_img'>
                                <img src='http://localhost/php/medicine_website/user_panel/shop/imgs/<?php echo unserialize($row["item_img"])[0]; ?>'>

                                <?php if ($prod_qua != 0) { ?>
                                    <form action='update_qua.php' method='post'>
                                        <input type="hidden" name="product_id" value="<?php echo $row["product_id"]; ?>" />
                                        <button id="minus" name="minus" <?php echo (!($row["quantity"] > 1)) ? "disabled" : ""; ?>>-</button>

                                        <input type="number" value="<?php echo ($row["quantity"] < $prod_qua) ? $row["quantity"] : $prod_qua; ?>" name="quantity" id="quantity" readonly />

                                        <button id="plus" name="plus" <?php echo (!($row["quantity"] < $prod_qua && $row["quantity"] < 5)) ? "disabled" : ""; ?>>+</button>
                                    </form>
                                <?php }

                                if ($prod_qua > 4) { ?>
                                    <p class="available">Available</p>
                                <?php } else if ($prod_qua < 5 && $prod_qua > 0) { ?>
                                    <p class="not-available">Only <?php echo $prod_qua; ?> Quantity Available</p>
                                <?php } else { ?>
                                    <p class="not-available">Not Available</p>
                                <?php } ?>
                            </div>

                            <a href='http://localhost/php/medicine_website/user_panel/shop/product_details/product_details.php?status=<?php echo $row["status"]; ?>&product_id=<?php echo $row['product_id']; ?>' id='box'>
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
                                        $date = strtotime($row["delivery_date"]);

                                        echo "Delivery by " . date("D, M d", $date); ?></span>

                                    <!-- //Remove Btn -->
                                    <a href="http://localhost/php/medicine_website/user_panel/cart/remove.php?product_id=<?php echo $row["product_id"]; ?>" id="remove_btn"><i class='fa-solid fa-trash'></i></a>

                                    <!-- //Buy Btn -->
                                    <?php if ($prod_qua <= 0) {
                                        $notAv = $row["product_id"];
                                    } else { ?>
                                        <a href="http://localhost/php/medicine_website/user_panel/shop/buy_now/buy_now.php?product_id=<?php echo $row["product_id"]; ?>&product=one" id="buy_btn"><i class='fa-solid fa-bag-shopping'></i> Buy Now</a>
                                    <?php } ?>
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

                                if ($row["quantity"] != 0) { ?>
                                    <!-- Multiply quantity with price for every item -->
                                    <tr>
                                        <th><?php echo $row["name"]; ?><span> (<?php echo $row["quantity"]; ?>* &#8377;<?php echo $row["offer_price"]; ?>)</span></th>
                                        <td>&#8377;<?php echo $mul_qua_price; ?></td>
                                    </tr>
                            <?php }
                            } ?>
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
                            <?php if ($total_val < 1000) { ?>
                                <tr>
                                    <th>+Delivery Charges</th>
                                    <td>&#8377;50</td>
                                </tr>
                            <?php } ?>
                        </table>
                    </div>
                    <div id='total_payble_value'>
                        <table>
                            <tr>
                                <th>Total Payble Value</th>
                                <td>&#8377;<?php if ($total_val < 1000) {
                                                echo $total_val + 50;
                                            } else {
                                                echo $total_val;
                                            }; ?></td>
                            </tr>
                        </table>
                    </div>
                    <div id='btns'>
                        <?php if (isset($notAv)) { ?>
                            <a href="#" onclick="alert('Please! Remove Not Available Product First');"><i class='fa-solid fa-bag-shopping'></i> Buy Now</a>
                        <?php } else { ?>
                            <a href="http://localhost/php/medicine_website/user_panel/shop/buy_now/buy_now.php?product=multiple"><i class='fa-solid fa-bag-shopping'></i> Buy Now</a>
                        <?php } ?>
                        <a href='empty_cart.php'><i class="fa-solid fa-trash"></i> Empty Cart</a>
                    </div>
                    <hr>
                    <span id="total_save">You Total save &#8377;<?php echo $total_save; ?></span>
                </div>
            </div>
        <?php } ?>


        <?php if ($cart_count == 0) { ?>
            <div id='empty'>
                <img src="empty.png" alt="" />
                <div id="links">
                    <a href="http://localhost/php/medicine_website/user_panel/shop/pr_main_page/pr_main_page.php?status=medicine">Add Medicines</a>
                    <a href="http://localhost/php/medicine_website/user_panel/shop/pr_main_page/pr_main_page.php?status=device">Add Medical Deices</a>
                </div>
            </div>
        <?php } ?>
    </main>

    <footer>
        <?php include("C:/xampp/htdocs/php/medicine_website/user_panel/footer/footer.php"); ?>
    </footer>
</body>

</html>