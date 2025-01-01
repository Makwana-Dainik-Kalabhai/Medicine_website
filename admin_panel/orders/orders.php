<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />

    <title>Orders List</title>
    <?php include("C:/xampp/htdocs/php/medicine_website/admin_panel/links.php"); ?>
</head>

<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>

<body class="">
    <div class="wrapper ">
        <!-- // Sidebar -->
        <?php include("C:/xampp/htdocs/php/medicine_website/admin_panel/sidenav.php"); ?>

        <div class="main-panel">
            <?php include("C:/xampp/htdocs/php/medicine_website/admin_panel/header/header.php"); ?>

            <div class="content">
                <div class="card">
                    <div class="row">
                        <span class="mx-5 py-3 text-danger">Orders List</span>
                    </div>
                </div>

                <?php
                $sel = $conn->prepare("SELECT * FROM `orders` WHERE `status`='processing'");
                $sel->execute();
                $sel = $sel->fetchAll();
                $i = 1;

                foreach ($sel as $row) { ?>
                    <div class="card px-3 py-0 my-5 overflow-hidden">
                        <div class="row bg-danger text-light pt-4">
                            <h5 class="ml-3 px-2 bg-light text-dark rounded"><?php echo $i; ?></h5>
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
                            <h5 class="ml-3 px-2"></h5>
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
                        <div class="row py-4">
                            <div class="col-md-12 text-center">
                                <h6>Order Details&emsp;(
                                    <?php $date = strtotime($row["time"]);
                                    echo date("d M, Y  h:ma", $date); ?>
                                    )</h6>
                            </div>
                        </div>

                        <!-- //! All Products -->
                        <div class="pb-5 px-3">
                            <div class="row py-0" style="color: #30819c;background-color: #f2f2f2;">
                                <div class="col-md-1 border p-3">Sr. No</div>
                                <div class="col-md-2 border p-3">Product</div>
                                <div class="col-md-1 border p-3">Offer Price</div>
                                <div class="col-md-1 border p-3">Price</div>
                                <div class="col-md-1 border p-3">Quantity</div>
                                <div class="col-md-1 border p-3">Payment Type</div>
                                <div class="col-md-1 border p-3">Payment Status</div>
                                <div class="col-md-2 border p-3">Delivery Date</div>
                                <div class="col-md-2 border p-3">Status</div>
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
                                        <div class="col-md-1 border pt-3">&#8377; <?php echo unserialize($row["offer_price"])[$pr - 1]; ?></div>
                                        <div class="col-md-1 border pt-3">&#8377; <?php echo unserialize($row["price"])[$pr - 1]; ?></div>
                                        <div class="col-md-1 border pt-3"><?php echo unserialize($row["quantity"])[$pr - 1]; ?></div>
                                        <div class="col-md-1 border pt-3"><?php echo $row["payment_type"]; ?></div>

                                        <!-- //* Payment Status -->
                                        <div class="col-md-1 border pt-3" style="color: <?php if ($row["payment_status"] == "Paid") {
                                                                                            echo "green";
                                                                                        } else {
                                                                                            echo "red";
                                                                                        } ?>;">
                                            <?php echo $row["payment_status"]; ?>
                                        </div>

                                        <div class="col-md-2 border pt-3">
                                            <?php $date = strtotime($row["delivery_date"]);
                                            echo date("M Y, d", $date); ?>
                                        </div>
                                        <div class="col-md-2 border pt-3">
                                            <form action="" method="post">
                                                <input type="hidden" name="order_id" value="<?php echo $row["order_id"]; ?>" />
                                                <select name="order_status" class="form-control">
                                                    <option value="<?php echo $row["status"]; ?>"><?php echo $row["status"]; ?></option>
                                                    <option value="Shipped">Shipped</option>
                                                    <option value="Cancelled">Cancelled</option>
                                                </select>
                                                <button class="btn btn-danger">Update</button>
                                            </form>
                                        </div>
                                    </div>
                            <?php
                                }
                                $pr++;
                            } ?>
                        </div>
                    </div>
                <?php $i++;
                } ?>
            </div>

            <footer class="footer footer-black  footer-white ">
                <?php include("C:/xampp/htdocs/php/medicine_website/admin_panel/footer/footer.php"); ?>
            </footer>
        </div>
</body>
</html>

<?php
if (isset($_POST["order_status"])) {
    $up = $conn->prepare("UPDATE `orders` SET `status`='" . $_POST["order_status"] . "' WHERE `order_id`='" . $_POST["order_id"] . "'");
    $up->execute(); ?>

    <script>
        window.location.reload();
    </script>
<?php } ?>