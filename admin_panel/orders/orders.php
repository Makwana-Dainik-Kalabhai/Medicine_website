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
    $(document).ready(() => {
        $(".product-list").DataTable();
    });
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

                <div class="card p-3">
                    <div class="row px-3 pb-2">
                        <div class="col-md-6 py-3"></div>
                        <div class="col-md-1 py-3">Filters:</div>
                        <div class="col-md-5">
                            <button class="btn btn-outline-success">Processings
                                <span class="p-1 px-2 rounded ml-1 bg-dark text-light">5</span>
                            </button>
                            <button class="btn btn-outline-success">Shipped
                                <span class="p-1 px-2 rounded ml-1 bg-dark text-light">5</span>
                            </button>
                            <button class="btn btn-outline-success">Cancelled
                                <span class="p-1 px-2 rounded ml-1 bg-dark text-light">5</span>
                            </button>
                        </div>
                    </div>
                    <hr />
                    <table class="product-list">
                        <thead class="bg-danger text-light">
                            <tr>
                                <!-- <th class="col-md-1">Product</th> -->
                                <th class="col-md-1">Order ID</th>
                                <th class="col-md-1">Name</th>
                                <th class="col-md-1">Email</th>
                                <th class="col-md-1">Offer Price</th>
                                <th class="col-md-1">Price</th>
                                <th class="col-md-1">Discount</th>
                                <th class="col-md-1">Quantity</th>
                                <th class="col-md-1">Delivery Date</th>
                                <th class="col-md-1">Edit</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            $sel = $conn->prepare("SELECT * FROM `orders` WHERE `status`='processing'");
                            $sel->execute();
                            $sel = $sel->fetchAll();

                            foreach ($sel as $row) { ?>
                                <tr class="border-bottom">
                                    <!-- <td class="col-md-1"><img src="http://localhost/php/medicine_website/user_panel/shop/imgs/<?php echo unserialize($row["item_img"])[0]; ?>" /></td> -->
                                    <td class="col-md-1"><?php echo $row["order_id"]; ?></td>
                                    <td class="col-md-1"><?php echo $row["name"]; ?></td>
                                    <td class="col-md-1">₹<?php echo $row["email"]; ?></td>
                                    <td class="col-md-1">₹<?php echo $row["offer_price"]; ?></td>
                                    <td class="col-md-1">₹<?php echo $row["price"]; ?></td>
                                    <td class="col-md-1"><?php if ($row["discount"] != 0) echo $row["discount"] . "%";
                                                            else echo "-";  ?></td>
                                    <td class="col-md-1"><?php echo $row["quantity"]; ?></td>
                                    <td class="col-md-1">
                                        <?php $date = strtotime($row["delivery_date"]);
                                        echo date("M d, Y", $date); ?>
                                    </td>
                                    <td class="col-md-1">
                                        <a href="http://localhost/php/medicine_website/admin_panel/products/edit_device/edit_device.php?product_id=<?php echo $row["product_id"]; ?>" class="btn btn-dark text-light">Edit</a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <footer class="footer footer-black  footer-white ">
                <?php include("C:/xampp/htdocs/php/medicine_website/admin_panel/footer/footer.php"); ?>
            </footer>
        </div>
</body>

</html>