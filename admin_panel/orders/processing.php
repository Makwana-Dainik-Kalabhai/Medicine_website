<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />

    <title>Processing Orders List</title>
    <?php include("C:/xampp/htdocs/php/medicine_website/admin_panel/links.php"); ?>
</head>

<script>
    // setInterval(() => {
    //     window.location.reload();
    // }, 1000);
</script>

<body class="">
    <div class="wrapper ">
        <!-- // Sidebar -->
        <?php include("C:/xampp/htdocs/php/medicine_website/admin_panel/sidenav.php"); ?>

        <div class="main-panel">
            <?php include("C:/xampp/htdocs/php/medicine_website/admin_panel/header/header.php"); ?>

            <div class="content">
                <div class="card">
                    <h6 class="mx-5 py-3" style="color: gray;">Processing Orders List</h6>
                </div>

                <?php
                $sel = $conn->prepare("SELECT * FROM `orders` WHERE `status`='Processing'");
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

                        <div class="row py-2">
                            <div class="col-md-2 py-4 text-danger">
                                <h6>When Order Placed?</h6>
                            </div>
                            <div class="col-md-2 py-4">
                                <h6><?php $date = strtotime($row["time"]);
                                    echo date("d M, Y  h:ma", $date); ?></h6>
                            </div>
                            <div class="col-md-7"></div>
                            <div class="col-md-1"><a href="http://localhost/php/medicine_website/admin_panel/orders/order_details/processing.php?order_id=<?php echo $row["order_id"]; ?>" class="btn btn-secondary">View</a></div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>

        <footer class="footer footer-black  footer-white ">
            <?php include("C:/xampp/htdocs/php/medicine_website/admin_panel/footer/footer.php"); ?>
        </footer>
    </div>
</body>

</html>