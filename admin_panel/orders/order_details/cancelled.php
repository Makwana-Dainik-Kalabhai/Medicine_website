<?php
session_start();

if (isset($_GET["order_id"])) {
    $_SESSION["order_id"] = $_GET["order_id"];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />

    <title>Cancelled Order</title>
    <?php include("C:/xampp/htdocs/php/medicine_website/admin_panel/links.php"); ?>
</head>

<style>
    .order {
        position: relative;
    }

    .order::before {
        width: 100%;
        height: 100%;
        position: absolute;
        top: 0;
        left: 0;
        background-color: black;
        opacity: 0.55;
        content: "This Order is Cancelled";
        display: grid;
        place-items: center;
        font-size: 50px;
        color: red;
        z-index: 2;
    }
</style>

<body class="">
    <div class="wrapper ">
        <!-- // Sidebar -->
        <?php include("C:/xampp/htdocs/php/medicine_website/admin_panel/sidenav.php"); ?>

        <div class="main-panel">
            <?php include("C:/xampp/htdocs/php/medicine_website/admin_panel/header/header.php"); ?>

            <div class="content">
                <div class="card">
                    <div class="row">
                        <span class="mx-5 py-3" style="color: red;">
                            <h6>Order Status - Cancelled</h6>
                        </span>
                    </div>
                </div>

                <?php
                $sel = $conn->prepare("SELECT * FROM `orders` WHERE `order_id`='" . $_SESSION["order_id"] . "'");
                $sel->execute();
                $sel = $sel->fetchAll();

                foreach ($sel as $row) { ?>
                    <div class="card px-3 py-0 my-5 overflow-hidden order">

                        <div class="row bg-danger text-light pt-4">
                            <div class="col-md-2">
                                <h6>Order ID</h6>
                            </div>
                            <div class="col-md-2">
                                <h6>Name</h6>
                            </div>
                            <div class="col-md-2">
                                <h6>Email</h6>
                            </div>
                            <div class="col-md-2">
                                <h6>Phone</h6>
                            </div>
                            <div class="col-md-3">
                                <h6>Address</h6>
                            </div>
                        </div>
                        <div class="row py-3 border-bottom">
                            <div class="col-md-2"><?php echo $row["order_id"]; ?></div>
                            <div class="col-md-2"><?php echo $row["name"]; ?></div>
                            <div class="col-md-2"><?php echo $row["email"]; ?></div>
                            <div class="col-md-2"><?php echo $row["phone"]; ?></div>
                            <div class="col-md-3">
                                <?php if ($row["delivery_address"] != null) {
                                    $add = unserialize($row["delivery_address"])["house_no"] . ", " . unserialize($row["delivery_address"])["street"] . " near " . unserialize($row["delivery_address"])["suite"] . ", " . unserialize($row["delivery_address"])["city"] . ", " . unserialize($row["delivery_address"])["state"] . " - " . unserialize($row["delivery_address"])["pincode"];
                                    echo $add;
                                } ?>
                            </div>
                        </div>

                        <!-- //! All Products -->
                        <div class="pb-5 px-3">
                            <div class="row py-4 mt-4">
                                <div class="col-md-12 text-center">
                                    <h6 class="text-danger">Product Details</h6>
                                </div>
                            </div>

                            <div class="row py-0" style="color: #30819c;background-color: #f2f2f2;">
                                <div class="col-md-1 border p-3">Sr. No</div>
                                <div class="col-md-2 border p-3">Product</div>
                                <div class="col-md-3 border p-3">Product Name</div>
                                <div class="col-md-2 border p-3">Offer Price</div>
                                <div class="col-md-1 border p-3">Price</div>
                                <div class="col-md-1 border p-3">Quantity</div>
                                <div class="col-md-2 border p-3">Total</div>
                            </div>
                            <?php
                            $pr = 1;
                            foreach (unserialize($row["items"]) as $item) {
                                $selPr = $conn->prepare("SELECT * FROM `products` WHERE `product_id`='$item'");
                                $selPr->execute();
                                $selPr = $selPr->fetchAll();

                                foreach ($selPr as $rPr) {
                            ?>
                                    <div class="row">
                                        <div class="col-md-1 border pt-3"><?php echo $pr . ")"; ?></div>
                                        <div class="col-md-2 border">
                                            <img src="http://localhost/php/medicine_website/user_panel/shop/imgs/<?php echo unserialize($rPr["item_img"])[0]; ?>" />
                                        </div>
                                        <div class="col-md-3 border pt-3"><?php echo $rPr["name"]; ?></div>

                                        <div class="col-md-2 border pt-3">&#8377; <?php echo unserialize($row["offer_price"])[$pr - 1]; ?></div>
                                        <div class="col-md-1 border pt-3">&#8377; <?php echo unserialize($row["price"])[$pr - 1]; ?></div>
                                        <div class="col-md-1 border pt-3"><?php echo unserialize($row["quantity"])[$pr - 1]; ?></div>
                                        <div class="col-md-2 border pt-3">&#8377; <?php echo (unserialize($row["offer_price"])[$pr - 1]) * (unserialize($row["quantity"])[$pr - 1]); ?></div>
                                    </div>
                            <?php
                                }
                                $pr++;
                            } ?>
                            <div class="row">
                                <div class="col-md-10 border p-3 text-center" style="color: #30819c;">Total Payment</div>
                                <div class="col-md-2 border p-3">
                                    <h6>&#8377; <?php echo $row["total_price"]; ?></h6>
                                </div>
                            </div>

                            <!-- //! Order Details -->
                            <div class="row py-4 mt-5">
                                <div class="col-md-12 text-center">
                                    <h6 class="text-danger">Order Details</h6>
                                </div>
                            </div>
                            <div class="row" style="color: #30819c;background-color: #f2f2f2;">
                                <div class="col-md-2 border py-3">Order Placing</div>
                                <div class="col-md-2 border py-3">Payment Type</div>
                                <div class="col-md-1 border py-3">Payment Status</div>
                                <div class="col-md-2 border py-3">Delivery Date</div>
                                <div class="col-md-2 border py-3">Order Status</div>
                                <div class="col-md-3 border py-3">Description</div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 border py-3">
                                    <?php $date = strtotime($row["time"]);
                                    echo date("M Y, d  h:m a", $date); ?>
                                </div>
                                <div class="col-md-2 border py-3"><?php echo $row["payment_type"]; ?></div>

                                <div class="col-md-1 border py-3"><?php echo $row["payment_status"]; ?></div>
                                <div class="col-md-2 border py-3">
                                    <?php $date = strtotime($row["delivery_date"]);
                                    echo date("M Y, d", $date); ?>
                                </div>
                                <div class="col-md-2 border py-3"><?php echo $row["status"]; ?></div>
                                <div class="col-md-3 border py-3"><?php echo $row["description"]; ?></div>
                            </div>
                        </div>

                    </div>
                <?php
                } ?>
            </div>

            <footer class="footer footer-black  footer-white ">
                <?php include("C:/xampp/htdocs/php/medicine_website/admin_panel/footer/footer.php"); ?>
            </footer>
        </div>
</body>

</html>