<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />

    <title>Medical Device List</title>
    <?php include("C:/xampp/htdocs/php/medicine_website/admin_panel/links.php"); ?>
</head>

<style>
    tbody tr .edit-delete-btn a {
        display: none;
    }

    tbody tr:hover td {
        background-color: antiquewhite;
    }

    tbody tr:hover .edit-delete-btn a {
        display: block;
    }
</style>

<?php
if (isset($_SESSION["product_id"])) {
    unset($_SESSION["product_id"]);
}
if (isset($_SESSION["cat_success"])) {
    unset($_SESSION["cat_success"]);
}
if (isset($_SESSION["pr_img_suc"])) {
    unset($_SESSION["pr_img_suc"]);
}
if (isset($_SESSION["pr_details_suc"])) {
    unset($_SESSION["pr_details_suc"]);
}
?>

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
                        <div class="col-md-10">
                            <h6 class="mx-5 py-4 text-danger">Medical Devices List</h6>
                        </div>
                        <div class="col-md-2 pt-2">
                            <a href="http://localhost/php/medicine_website/admin_panel/products/add_product/add_product.php?status=device" class="btn btn-primary">Add Device</a>
                        </div>
                    </div>
                </div>
                <hr />

                <div class="card p-3">
                    <table class="product-list">
                        <thead class="bg-danger text-light">
                            <tr>
                                <th class="col-md-1 text-center">Product</th>
                                <th class="col-md-1 text-center">Category</th>
                                <th class="col-md-3 text-center">Name</th>
                                <th class="col-md-1 text-center">Price</th>
                                <th class="col-md-1 text-center">Discount</th>
                                <th class="col-md-1 text-center">Quantity</th>
                                <th class="col-md-1">Delivery Date</th>
                                <th class="col-md-1 text-center">Edit</th>
                                <th class="col-md-1 text-center">Delete</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            $sel = $conn->prepare("SELECT * FROM `products` WHERE `status`='device'");
                            $sel->execute();
                            $sel = $sel->fetchAll();

                            foreach ($sel as $row) { ?>
                                <tr class="border-bottom">
                                    <td class="col-md-1 text-center"><img src="http://localhost/php/medicine_website/user_panel/shop/imgs/<?php echo unserialize($row["item_img"])[0]; ?>" /></td>
                                    <td class="col-md-1"><?php echo $row["category"]; ?></td>
                                    <td class="col-md-3"><?php echo $row["name"]; ?></td>
                                    <td class="col-md-1 text-center">
                                        ₹<?php echo $row["offer_price"]; ?><br />
                                        <span style="color:gray; text-decoration: line-through;">₹<?php echo $row["price"]; ?></span>
                                    </td>
                                    <td class="col-md-1 text-center"><?php if ($row["discount"] != 0) echo $row["discount"] . "%";
                                                                        else echo "-";  ?></td>
                                    <td class="col-md-1 text-center"><?php echo $row["quantity"]; ?></td>
                                    <td class="col-md-1">
                                        <?php $date = strtotime($row["delivery_date"]);
                                        echo date("M d, Y", $date); ?>
                                    </td>
                                    <td class="col-md-1 text-center edit-delete-btn">
                                        <a href="http://localhost/php/medicine_website/admin_panel/products/edit_device/edit_device.php?product_id=<?php echo $row["product_id"]; ?>" style="color: #3333ff;" class="edit-btn"><i class="fa-solid fa-edit"></i> Edit</a>
                                    </td>
                                    <td class="col-md-1 text-center edit-delete-btn">
                                        <a href="http://localhost/php/medicine_website/admin_panel/products/delete_pr.php?product_id=<?php echo $row["product_id"]; ?>" style="color: #3333ff;" class="delete-btn"><i class="fa-solid fa-trash"></i> Delete</a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>


                <!-- //* Categories -->
                <div class="card p-3 mt-5">
                    <h6>Categories</h6>
                </div>
                <div class="card p-3">
                    <div class="row">
                        <?php
                        $sel = $conn->prepare("SELECT * FROM `products` WHERE `status`='device' GROUP BY `category`");
                        $sel->execute();
                        $sel = $sel->fetchAll();

                        foreach ($sel as $row) { ?>
                            <div class="col-2 bg-light m-2"><img src="http://localhost/php/medicine_website/user_panel/shop/category_img/<?php echo $row["cat_img"]; ?>" alt="">
                                <h6 class="text-center"><?php echo $row["category"]; ?></h6>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>

            <footer class="footer footer-black  footer-white ">
                <?php include("C:/xampp/htdocs/php/medicine_website/admin_panel/footer/footer.php"); ?>
            </footer>
        </div>
</body>

</html>

<?php
if (isset($_SESSION["product_id"])) {
    unset($_SESSION["product_id"]);
}
if (isset($_SESSION["cat_success"])) {
    unset($_SESSION["cat_success"]);
}
if (isset($_SESSION["product_success"])) {
    unset($_SESSION["product_success"]);
}
?>