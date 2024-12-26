<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />

    <title>Medical Devices List</title>
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
                        <span class="mx-5 py-3 text-danger">Medical Device List</span>
                    </div>
                </div>
                <hr />

                <div class="card p-3">
                    <table class="product-list">
                        <thead class="bg-danger text-light">
                            <tr>
                                <th class="col-md-1">Product</th>
                                <th class="col-md-1">Category</th>
                                <th class="col-md-2">Name</th>
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
                            $sel = $conn->prepare("SELECT * FROM `products` WHERE `status`='device'");
                            $sel->execute();
                            $sel = $sel->fetchAll();

                            foreach ($sel as $row) { ?>
                                <tr class="border-bottom">
                                    <td class="col-md-1"><img src="http://localhost/php/medicine_website/user_panel/shop/imgs/<?php echo unserialize($row["item_img"])[0]; ?>" /></td>
                                    <td class="col-md-1"><?php echo $row["category"]; ?></td>
                                    <td class="col-md-2"><?php echo $row["name"]; ?></td>
                                    <td class="col-md-1">₹<?php echo $row["offer_price"]; ?></td>
                                    <td class="col-md-1">₹<?php echo $row["price"]; ?></td>
                                    <td class="col-md-1"><?php echo $row["discount"]; ?>%</td>
                                    <td class="col-md-1"><?php echo $row["quantity"]; ?></td>
                                    <td class="col-md-1">
                                        <?php $date = strtotime($row["delivery_date"]);
                                    echo date("M d, Y", $date); ?>
                                    </td>

                                    <td class="col-md-1">
                                        <a href="http://localhost/php/medicine_website/admin_panel/products/edit_device/edit_device.php?product_id=<?php echo $row["product_id"]; ?>" class="btn btn-secondary text-light">Edit</a>
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