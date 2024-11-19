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
        if ($order_count != 0) { ?>

            <div id='order'>
                <div id='order_header'>
                    <?php
                    if (isset($order_count) && $order_count != 0) { ?>
                        <h1>My Orders <span><?php echo $order_count; ?></span></h1>
                    <?php } ?>
                </div>
                <div id="filters">
                    <div id="btns">
                        <button class="active">Processing</button>
                        <button>Shipped</button>
                        <button>Cancelled</button>
                    </div>
                    <select name="" id="">
                        <option value="all">All</option>
                        <option value="past week">Past Week</option>
                        <option value="past month">Past Month</option>
                        <option value="past 3 month">Past 3 Months</option>
                    </select>
                </div>

                <?php
                $sel = $conn->prepare("SELECT * FROM `orders` WHERE `email`='" . $_SESSION["email"] . "'");
                $sel->execute();
                $sel = $sel->fetchAll();

                foreach ($sel as $row) { ?>
                    <div id="orders">
                        <div id="order_details">
                            <div class="row">
                                <div class="col-md-2">
                                    <label for="">Order Placed</label>
                                </div>
                                <div class="col-md-2">
                                    <label for="">Total</label>
                                </div>
                                <div class="col-md-3">
                                    <label for="">Ship To</label>
                                </div>
                                <div class="col-md-5">
                                    <label for="">Order ID:&emsp;<span style="font-size: 1.05em;color:black;"><?php echo $row["order_id"]; ?></span></label>
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
                                <div class="col-md-4">
                                    <a href="">View Order Details</a>
                                    &ensp;<label for="">|</label>&ensp;
                                    <a href="">View Invoice</a>
                                </div>
                            </div>
                        </div>
                        <div id="items">
                            <?php displayItems($row); ?>
                        </div>
                    </div>
                <?php } ?>
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
        foreach (unserialize($row["items"]) as $item) { ?>
            <div class="box">
                <?php $sel = $conn->prepare("SELECT * FROM `products` WHERE `item_code`=$item");
                $sel->execute();
                $sel = $sel->fetchAll();

                foreach ($sel as $r) { ?>
                    <div class="item_img">
                        <img src="http://localhost/php/medicine_website/user_panel/shop/imgs/<?php echo unserialize($r["item_img"])[0]; ?>" />
                    </div>
                    <div class="item_details">
                        <span id="name"><?php echo $r["name"]; ?></span>
                    </div>
                <?php
                } ?>
            </div>
        <?php
        }
    } else { ?>
        <div class="box">
            <?php
            $sel = $conn->prepare("SELECT * FROM `products` WHERE `item_code`='" . $row["items"] . "'");
            $sel->execute();
            $sel = $sel->fetchAll();

            foreach ($sel as $r) { ?>
                <div class="item_img">
                    <img src="http://localhost/php/medicine_website/user_panel/shop/imgs/<?php echo unserialize($r["item_img"])[0]; ?>" />
                </div>
                <div class="item_details">
                    <span id="name"><?php echo $r["name"]; ?></span>
                </div>
            <?php
            } ?>
        </div>
<?php
    }
}
?>