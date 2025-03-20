<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />

    <title>Cancelled Orders List</title>
    <?php include("C:/xampp/htdocs/php/medicine_website/admin_panel/links.php"); ?>
</head>

<body class="">
    <div class="wrapper ">
        <!-- // Sidebar -->
        <?php include("C:/xampp/htdocs/php/medicine_website/admin_panel/sidenav.php"); ?>

        <div class="main-panel">
            <?php include("C:/xampp/htdocs/php/medicine_website/admin_panel/header/header.php"); ?>

            <div class="content">
                <div class="card">
                    <div class="row">
                        <span class="mx-5 py-3" style="color: gray;">
                            <h6>Cancelled Orders List</h6>
                        </span>
                    </div>
                </div>

                <?php
                $sel = $conn->prepare("SELECT * FROM `orders` WHERE `status`='Cancelled' ORDER BY `time` DESC");
                $sel->execute();
                $sel = $sel->fetchAll();
                $i = 1;

                foreach ($sel as $row) {

                    if ($row["description"] != "Your Order has been Cancelled now.") {
                        $up = $conn->prepare("UPDATE `orders` SET `description`='Your Order has been Cancelled now.' WHERE `order_id`='" . $row["order_id"] . "'");
                        $up->execute();
                    } ?>

                    <div class="card px-3 py-0 my-5 overflow-hidden">
                        <div class="row pt-4" style="background-color: #d9d9d9;">
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
                        <div class="row py-2 border-bottom">
                            <div class="col-md-3 py-4" style="color: gray;">
                                <h6>Order Cancellation Time:</h6>
                            </div>
                            <div class="col-md-2 py-4">
                                <h6><?php $date = strtotime($row["time"]);
                                    echo date("d M, Y  h:ma", $date); ?></h6>
                            </div>
                            <div class="col-md-6"></div>
                            <div class="col-md-1"><a href="http://localhost/php/medicine_website/admin_panel/orders/order_details/cancelled.php?order_id=<?php echo $row["order_id"]; ?>" class="btn btn-secondary">View</a></div>
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