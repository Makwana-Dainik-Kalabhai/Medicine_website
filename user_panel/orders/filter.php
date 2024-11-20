<?php
session_start();
include("C:/xampp/htdocs/php/medicine_website/database.php");

if (isset($_POST["filterBtn"])) {
    $_SESSION["filterBtn"] = $_POST["filterBtn"];
} else {
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

$sel = $conn->prepare("SELECT * FROM `orders` WHERE `email`='" . $_SESSION["email"] . "'");
$sel->execute();
$sel = $sel->fetchAll();
$i = 1;

foreach ($sel as $row) {
    $time = strtotime($row["time"]);

    if (($row["status"] == $_SESSION["filterBtn"]) && ($time >= $before)) { ?>
        <div id="orders">
            <div id="order_details">
                <span><?php echo $i; ?></span>
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
                                echo date("M d, Y", $date); ?></span>
                    </div>
                    <div class="col-md-2">
                        <span>₹<?php echo $row["total_price"]; ?></span>
                    </div>
                    <div class="col-md-3">
                        <span><?php echo $row["name"]; ?></span>
                    </div>
                    <div class="col-md-3">
                        <a href="">View Invoice</a>
                    </div>
                </div>
                <?php if ($_SESSION["filterBtn"] == "Processing") { ?>
                    <div class="row delivery">
                        Expected Delivery:&ensp;<?php
                                                $date = strtotime($row["delivery_date"]);
                                                echo date("M d, Y", $date); ?>
                    </div>
                <?php }
                if ($_SESSION["filterBtn"] == "Shipped") { ?>
                    <div class="row delivery">
                        Delivered:&ensp;<?php
                                        $date = strtotime($row["delivery_date"]);
                                        echo date("M d, Y", $date); ?>
                    </div>
                <?php } ?>
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
    if (str_contains($row["items"], "{") && str_contains($row["items"], ":") && str_contains($row["items"], '"') && str_contains($row["items"], "}")) { ?>
        <?php
        foreach (unserialize($row["items"]) as $item) { ?>
            <div class="box <?php if($_SESSION["filterBtn"] == "Cancelled") { echo "disabled";} ?>">
                <?php $sel = $conn->prepare("SELECT * FROM `products` WHERE `item_code`=$item");
                $sel->execute();
                $sel = $sel->fetchAll();

                foreach ($sel as $r) {
                    itemDetails($row, $r);
                } ?>
            </div>
        <?php
        }
    } else { ?>
        <div class="box <?php if($_SESSION["filterBtn"] == "Cancelled") { echo "disabled";} ?>">
            <?php
            $sel = $conn->prepare("SELECT * FROM `products` WHERE `item_code`='" . $row["items"] . "'");
            $sel->execute();
            $sel = $sel->fetchAll();

            foreach ($sel as $r) {
                itemDetails($row, $r);
            } ?>
        </div>
    <?php
    }
}

function itemDetails($row, $r)
{ ?>
    <div class="item_img">
        <img src="http://localhost/php/medicine_website/user_panel/shop/imgs/<?php echo unserialize($r["item_img"])[0]; ?>" />
    </div>
    <div class="item_details">
        <span class="name"><?php echo $r["name"]; ?></span>
        <span class="off_price">₹<?php echo $r["offer_price"]; ?></span>
        <span class="price">₹<?php echo $r["price"]; ?></span>
        <p class="description"><?php echo $row["description"]; ?></p>
        <div class="btns">
            <?php if ($_SESSION["filterBtn"] == "Cancelled") { ?>
                <a href="http://localhost/php/medicine_website/user_panel/shop/buy_now/buy_now.php?item_code=<?php echo $r["item_code"]; ?>&product=one"><i class="fa-solid fa-arrows-rotate"></i> Buy</a>
            <?php } else { ?>
                <a href="http://localhost/php/medicine_website/user_panel/shop/buy_now/buy_now.php?item_code=<?php echo $r["item_code"]; ?>&product=one"><i class="fa-solid fa-arrows-rotate"></i> Buy it Again</a>
            <?php } ?>
            <a href="http://localhost/php/medicine_website/user_panel/shop/product_details/product_details.php?item_code=<?php echo $r["item_code"]; ?>&status=<?php echo $r["status"];?>"><i class="fa-solid fa-eye"></i> View Item</a>
            <?php if ($_SESSION["filterBtn"] != "Cancelled") { ?>
                <a href="http://localhost/php/medicine_website/user_panel/orders/cancel.php?item_code=<?php $r["item_code"]; ?>"><i class="fa-solid fa-xmark"></i> Cancel</a>
            <?php } ?>
        </div>
    </div>
<?php }
?>