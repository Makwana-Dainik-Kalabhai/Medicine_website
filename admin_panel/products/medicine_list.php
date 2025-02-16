<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />

    <title>Medicines List</title>
    <?php include("C:/xampp/htdocs/php/medicine_website/admin_panel/links.php"); ?>
</head>

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
                            <h6 class="mx-5 py-4 text-danger">Medicine List</h6>
                        </div>
                        <div class="col-md-2 pt-2">
                            <a href="http://localhost/php/medicine_website/admin_panel/products/add_product/add_product.php?status=medicine" class="btn btn-primary">Add Medicine</a>
                        </div>
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
                                <th class="col-md-1">Expiry</th>
                                <th class="col-md-1">Offer Price</th>
                                <th class="col-md-1">Price</th>
                                <th class="col-md-1">Discount</th>
                                <th class="col-md-1">Quantity</th>
                                <th class="col-md-1">Delivery Date</th>
                                <th class="col-md-1">Edit / Delete</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            $sel = $conn->prepare("SELECT * FROM `products` WHERE `status`='medicine'");
                            $sel->execute();
                            $sel = $sel->fetchAll();

                            foreach ($sel as $row) { ?>
                                <tr class="border-bottom">
                                    <td class="col-md-1"><img src="http://localhost/php/medicine_website/user_panel/shop/imgs/<?php echo unserialize($row["item_img"])[0]; ?>" /></td>
                                    <td class="col-md-1"><?php echo $row["category"]; ?></td>
                                    <td class="col-md-2"><?php echo $row["name"]; ?></td>
                                    <td class="col-md-1"><?php if ($row["expiry"] != null) echo $row["expiry"];
                                                            else echo "-"; ?></td>
                                    <td class="col-md-1">₹<?php echo $row["offer_price"]; ?></td>
                                    <td class="col-md-1">₹<?php echo $row["price"]; ?></td>
                                    <td class="col-md-1"><?php if ($row["discount"] != 0) echo $row["discount"] . "%";
                                                            else echo "-";  ?></td>
                                    <td class="col-md-1"><?php echo $row["quantity"]; ?></td>
                                    <td class="col-md-1">
                                        <?php $date = strtotime($row["delivery_date"]);
                                        echo date("M d, Y", $date); ?>
                                    </td>
                                    <td class="col-md-1 text-center edit-delete-btn">
                                        <a href="http://localhost/php/medicine_website/admin_panel/products/edit_medicine/edit_medicine.php?product_id=<?php echo $row["product_id"]; ?>" style="color: #3333ff;" class="pb-3 edit-btn"><i class="fa-solid fa-edit"></i> Edit</a>
                                        <a href="http://localhost/php/medicine_website/admin_panel/products/delete_pr.php?product_id=<?php echo $row["product_id"]; ?>" style="color: #3333ff;" class="delete-btn"><i class="fa-solid fa-trash"></i> Delete</a>
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