<?php
session_start();
include("C:/xampp/htdocs/php/medicine_website/database.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Orders</title>
    <?php include("C:/xampp/htdocs/php/medicine_website/user_panel/links.php"); ?>
</head>

<style>
    <?php include("orders.css"); ?>
</style>

<script>
    <?php include("orders.js"); ?>
</script>

<body>
    <header>
        <?php include("C:/xampp/htdocs/php/medicine_website/user_panel/header/header.php"); ?>
    </header>

    <main>
        <?php
        if ($order_exist) { ?>

            <div id='order'>
                <div id='order_header'>
                    <?php
                    if (isset($order_count) && $order_count != 0) { ?>
                        <h1>My Orders <span><?php echo $order_count; ?></span></h1>
                    <?php } ?>
                </div>
                <div id="filters">
                    <div id="btns">
                        <?php
                        $processing = 0;
                        $shipped = 0;
                        $cancelled = 0;

                        $sel = $conn->prepare("SELECT * FROM `orders` WHERE `email`='" . $_SESSION["email"] . "'");
                        $sel->execute();
                        $sel = $sel->fetchAll();

                        foreach ($sel as $row) {
                            if ($row["status"] == "Processing")
                                $processing++;
                            if ($row["status"] == "Shipped")
                                $shipped++;
                            if ($row["status"] == "Cancelled")
                                $cancelled++;
                        }
                        ?>
                        <button class="active" value="Processing">Processing&ensp;<?php if ($processing > 0) {
                                                                                        echo "<span>$processing</span>";
                                                                                    } ?></button>
                        <button value="Shipped">Shipped&ensp;<?php if ($shipped > 0) {
                                                                    echo "<span>$shipped</span>";
                                                                } ?></button>
                        <button value="Cancelled">Cancelled&ensp;<?php if ($cancelled > 0) {
                                                                        echo "<span>$cancelled</span>";
                                                                    } ?></button>
                    </div>
                    <select id="time_period">
                        <option value="all">All</option>
                        <option value="past week">Past Week</option>
                        <option value="past month">Past Month</option>
                        <option value="past 3 month">Past 3 Months</option>
                        <option value="past 6 month">Past 6 Months</option>
                        <option value="past year">Past Year</option>
                    </select>
                </div>
                <hr />

                <div id="all_orders">
                    <?php
                    $sel = $conn->prepare("SELECT * FROM `orders` WHERE `email`='" . $_SESSION["email"] . "' ORDER BY `time`");
                    $sel->execute();
                    $sel = $sel->fetchAll();
                    $i = 1;

                    foreach ($sel as $row) {
                        if ($row["status"] == "Processing") { ?>
                            <!-- //! Cancel Order Form -->
                            <form id="cancel_form" action="http://localhost/php/medicine_website/user_panel/orders/cancel.php" method="post">
                                <h2 class="mb-5">Are You sure to Cancel the Order?</h2>
                                <input type="hidden" name="order_id" value="<?php echo $row["order_id"]; ?>" />
                                <button name="cancel_yes">Yes</button>
                                <button name="cancel_no">No</button>
                            </form>

                            <div id="orders">
                                <div id="order_details">
                                    <span id="order_no"><?php echo $i; ?></span>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label>Order Placed</label>
                                        </div>
                                        <div class="col-md-2">
                                            <label>Total</label>
                                        </div>
                                        <div class="col-md-3">
                                            <label>Ship To</label>
                                        </div>
                                        <div class="col-md-3">
                                            <label>Order ID:&emsp;<span style="font-size: 1.05em;color:black;"><?php echo $row["order_id"]; ?></span></label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <span><?php
                                                    $date = strtotime($row["time"]);
                                                    echo date("M d, Y", $date); ?>
                                            </span>
                                        </div>
                                        <div class="col-md-2">
                                            <span>₹<?php echo $row["total_price"]; ?></span>
                                        </div>
                                        <div class="col-md-3">
                                            <span><?php echo $row["name"]; ?></span>
                                        </div>
                                        <?php if ($row["status"] != "Cancelled") { ?>
                                            <div class="col-md-3">
                                                <a href="http://localhost/php/medicine_website/user_panel/orders/PDF/genInvoice.php?order_id=<?php echo $row["order_id"]; ?>" id="invoice">View Invoice</a>
                                            </div>
                                        <?php } ?>
                                    </div>
                                    <div class="row mt-5">
                                        <div class="col-md-9 delivery">
                                            Expected Delivery:&ensp;<?php
                                                                    $date = strtotime($row["delivery_date"]);
                                                                    echo date("M d, Y", $date); ?>
                                        </div>
                                        <div class="col-md-3 cancel">
                                            <?php if ($row["status"] == "Processing") { ?>
                                                Cancel Order?&ensp;<button class="cancel_btn"><i class="fa-solid fa-xmark"></i> Cancel</button>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                <div id="items">
                                    <?php displayItems($row); ?>
                                </div>
                            </div>
                    <?php $i++;
                        }
                    } ?>
                </div>
            </div>
        <?php } ?>
    </main>

    <footer>
        <?php include("C:/xampp/htdocs/php/medicine_website/user_panel/footer/footer.php"); ?>
    </footer>
</body>

</html>

<?php
function displayItems($row)
{ ?>
    <?php
    global $conn;
    if (str_contains($row["items"], "{") && str_contains($row["items"], ":") && str_contains($row["items"], '"') && str_contains($row["items"], "}")) { ?>
        <?php
        for ($i=0; $i<count(unserialize($row["items"])); $i++) { ?>
            <div class="box">
                <?php $sel = $conn->prepare("SELECT * FROM `products` WHERE `product_id`='".unserialize($row["items"])[$i]."'");
                $sel->execute();
                $sel = $sel->fetchAll();

                foreach ($sel as $r) {
                    itemDetails($row, $r, unserialize($row["quantity"])[$i]);
                } ?>
            </div>
        <?php
        }
    } else { ?>
        <div class="box">
            <?php
            $sel = $conn->prepare("SELECT * FROM `products` WHERE `product_id`='" . $row["items"] . "'");
            $sel->execute();
            $sel = $sel->fetchAll();

            foreach ($sel as $r) {
                itemDetails($row, $r, $row["quantity"]);
            } ?>
        </div>
    <?php
    }
}

function itemDetails($row, $r, $quantity)
{ ?>
    <div class="item_img">
        <?php if ($r["discount"] > 0) { ?>
            <span id="discount">-<?php echo $r["discount"]; ?></span>
        <?php } ?>
        <img src="http://localhost/php/medicine_website/user_panel/shop/imgs/<?php echo unserialize($r["item_img"])[0]; ?>" />
    </div>
    <div class="item_details">
        <span class="name"><?php echo $r["name"]; ?></span>
        <span class="off_price">₹<?php echo $r["offer_price"]; ?></span>&nbsp;
        <span class="price">₹<?php echo $r["price"]; ?></span>
        <p class="description"><?php echo $row["description"]; ?></p>
        <div class="btns">
            <?php if ($row["status"] == "Cancelled") { ?>
                <a href="http://localhost/php/medicine_website/user_panel/shop/buy_now/buy_now.php?product_id=<?php echo $r["product_id"]; ?>&product=one"><i class="fa-solid fa-arrows-rotate"></i> Buy</a>
            <?php } else { ?>
                <a href="http://localhost/php/medicine_website/user_panel/shop/buy_now/buy_now.php?product_id=<?php echo $r["product_id"]; ?>&product=one"><i class="fa-solid fa-arrows-rotate"></i> Buy it Again</a>
            <?php } ?>
            <a href="http://localhost/php/medicine_website/user_panel/shop/product_details/product_details.php?product_id=<?php echo $r["product_id"]; ?>&status=<?php echo $r["status"]; ?>"><i class="fa-solid fa-eye"></i> View Item</a>
        </div>
    </div>
    <table>
        <tr>
            <th>Price</th>
            <td class="text-right">₹<?php echo $r["offer_price"]; ?></td>
        </tr>
        <tr>
            <th>Quantity</th>
            <td class="text-right"><?php echo $quantity; ?></td>
        </tr>
        <tr class="border-top">
            <th>Sub Total</th>
            <td class="text-right">₹<?php echo $r["offer_price"] * $quantity; ?></td>
        </tr>
    </table>
<?php }
?>