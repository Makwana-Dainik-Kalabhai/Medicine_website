<?php
session_start();
include("C:/xampp/htdocs/php/medicine_website/database.php");
?>
<script>
    <?php include("orders.js"); ?>
</script>

<?php
if (isset($_POST["filterBtn"])) {
    $_SESSION["filterBtn"] = $_POST["filterBtn"];
}
if (!isset($_SESSION["filterBtn"])) {
    $_SESSION["filterBtn"] = "Processing";
}

$before = 0;
date_default_timezone_set('Asia/Calcutta');

if ($_POST["timePeriod"] == "past week") {
    $before = strtotime("-7 days");
}
if ($_POST["timePeriod"] == "past month") {
    $before = strtotime("-1 month");
}
if ($_POST["timePeriod"] == "past 3 month") {
    $before = strtotime("-3 month");
}
if ($_POST["timePeriod"] == "past 6 month") {
    $before = strtotime("-6 month");
}
if ($_POST["timePeriod"] == "past year") {
    $before = strtotime("-12 month");
}

$sel = $conn->prepare("SELECT * FROM `orders` WHERE `email`='" . $_SESSION["email"] . "' ORDER BY `time` DESC");
$sel->execute();
$sel = $sel->fetchAll();
$i = 1;

foreach ($sel as $row) {
    $time = strtotime($row["time"]);

    if (($row["status"] == $_SESSION["filterBtn"]) && ($time >= $before)) { ?>
        <!-- //! Cancel Order Form -->
        <form id="cancel_form" action="http://localhost/php/medicine_website/user_panel/orders/cancel.php" method="post">
            <h2 class="mb-5">Are You sure to Cancel the Order?</h2>
            <input type="hidden" name="order_id" value="<?php echo $row["order_id"]; ?>" />
            <button name="cancel_yes">Yes</button>
            <button name="cancel_no">No</button>
        </form>

        <div id="orders">
            <div id="order_details">
                <?php if ($row["status"] == "Cancelled") { ?>
                    <h5 class="ps-4 pb-3" style="color: red;">Your Order is cancelled now. If you paid for this, then money will be refund in 2-4 days to your mobile number</h5>
                <?php } ?>

                <span id="order_no"><?php echo $i; ?></span>

                <table>
                    <tr>
                        <td><label>Order Placed</label>
                            <span>
                                <?php date_default_timezone_set("Asia/Kolkata");
                                $date = strtotime($row["time"]);
                                echo date("M d, Y", $date); ?>
                                (<?php echo date("h:i a", $date); ?>)
                            </span>
                        </td>

                        <td><label>Total</label>
                            <span>₹<?php echo $row["total_price"]; ?></span>
                        </td>
                        <td><label>Ship To</label>
                            <span><?php echo $row["name"]; ?></span>
                        </td>
                        <td><label>Order ID</label>
                            <span><?php echo $row["order_id"]; ?></span>
                        </td>
                        <td><label>Payment&ensp;<span style="font-size:1em;font-weight: 600;color: <?php echo ($row["payment_status"] == "Paid") ? "green" : "red"; ?>;">(<?php echo $row["payment_status"]; ?>)</span></label>
                            <span><?php echo $row["payment_type"]; ?></span>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><?php if ($row["status"] != "Cancelled") { ?>
                                <a href="http://localhost/php/medicine_website/user_panel/orders/PDF/genInvoice.php?order_id=<?php echo $row["order_id"]; ?>" id="invoice">View Invoice</a>
                            <?php } ?>
                        </td>
                        <td></td>
                    </tr>
                </table>

                <table>
                    <tr id="mt-4">
                        <?php if ($_SESSION["filterBtn"] == "Processing") { ?>
                            <th colspan="+3" class="delivery">Expected Delivery:&ensp;
                                <?php $date = strtotime($row["delivery_date"]);
                                echo date("M d, Y", $date); ?>
                            </th>
                        <?php }

                        if ($_SESSION["filterBtn"] == "Shipped") { ?>
                            <th colspan="+3" class="delivery">Delivered:&ensp;
                                <?php $date = strtotime($row["delivery_date"]);
                                echo date("M d, Y", $date); ?>
                            </th>
                        <?php } ?>

                        <td colspan="2" class="text-right cancel">
                            <?php if ($row["status"] == "Processing") { ?>
                                Cancel Order?&ensp;<button class="cancel_btn"><i class="fa-solid fa-xmark"></i> Cancel</button>
                            <?php } ?>
                        </td>
                    </tr>
                </table>
            </div>
            <div id="items">
                <?php displayItems($row); ?>
            </div>
        </div>
    <?php $i++;
    }
}

function displayItems($row)
{ ?>
    <?php
    global $conn;

    for ($i = 0; $i < count(unserialize($row["items"])); $i++) { ?>
        <div class="box <?php if ($_SESSION["filterBtn"] == "Cancelled") {
                            echo "disabled";
                        } ?>">
            <?php $sel = $conn->prepare("SELECT * FROM `products` WHERE `product_id`='" . unserialize($row["items"])[$i] . "'");
            $sel->execute();
            $sel = $sel->fetchAll();

            foreach ($sel as $r) {
                itemDetails($row, $r, unserialize($row["quantity"])[$i]);
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
            <?php if ($_SESSION["filterBtn"] == "Cancelled") { ?>
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
<?php } ?>