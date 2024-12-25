<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />

    <title>Edit Medical Device</title>
    <?php include("C:/xampp/htdocs/php/medicine_website/admin_panel/links.php"); ?>
</head>

<style>
    .carousel-control-prev span {
        color: black !important;
        font-weight: 800;
    }

    .category-img {
        display: block;
        width: 60%;
        margin: auto;
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
            <?php include("C:/xampp/htdocs/php/medicine_website/admin_panel/topnav.php"); ?>

            <div class="content">
                <div class="card p-5">
                    <?php
                    $sel = $conn->prepare("SELECT * FROM `products` WHERE `product_id`='" . $_GET["product_id"] . "'");
                    $sel->execute();
                    $sel = $sel->fetchAll();

                    foreach ($sel as $row) {
                        $count_img = 0;
                        foreach (unserialize($row["item_img"]) as $img) {
                            $count_img++;
                        } ?>
                        <div class="row">
                            <div class="col-md-6">
                                <div id="carouselExampleIndicators" class="carousel slide border">
                                    <p class="text-danger fs-3 mx-3 m-0 d-inline">Change Product Images</p>

                                    <button class="btn btn-danger">Change</button>
                                    <div class="carousel-indicators">
                                        <?php for ($i = 0; $i < $count_img; $i++) { ?>
                                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="<?php echo $i; ?>" class="active border-0" aria-current="true" aria-label="Slide 1"></button>
                                        <?php } ?>
                                    </div>
                                    <div class="carousel-inner">
                                        <?php $i = 0;
                                        foreach (unserialize($row["item_img"]) as $img) {
                                            if ($i == 0) { ?>
                                                <div class="carousel-item active">
                                                    <img src="http://localhost/php/medicine_website/user_panel/shop/imgs/<?php echo $img; ?>" />
                                                </div>
                                            <?php $i++;
                                            } //
                                            else { ?>
                                                <div class="carousel-item">
                                                    <img src="http://localhost/php/medicine_website/user_panel/shop/imgs/<?php echo $img; ?>" />
                                                </div>
                                        <?php }
                                        } ?>
                                    </div>
                                    <button class="carousel-control-prev border-0 bg-transparent" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon bg-dark" aria-hidden="true"></span>
                                    </button>
                                    <button class="carousel-control-next border-0 bg-transparent" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                                        <span class="carousel-control-next-icon bg-dark" aria-hidden="true"></span>
                                    </button>

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <p class="text-danger fs-3 my-2">Category Image</p>
                                    <img class="category-img" src="http://localhost/php/medicine_website/user_panel/shop/category_img/<?php echo $row["cat_img"]; ?>" />
                                </div>
                                <div class="row">
                                    <p class="text-danger fs-3 my-2">Product Name</p>
                                    <input type="text" name="name" class="form-control" value="<?php echo $row["name"]; ?>" />
                                </div>
                                <div class="row">
                                    <p class="text-danger fs-3 mt-4 mb-2">Definition</p>
                                    <textarea name="definition" class="border" value="<?php echo $row["definition"]; ?>" rows="8" cols="100"><?php echo $row["definition"]; ?></textarea>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-md-5">
                                        <p class="text-danger fs-3 m-0">Discount</p>
                                        <input type="number" class="form-control" value="<?php echo $row["discount"]; ?>">
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-md-5">
                                        <p class="text-danger fs-3 m-0">Offer Price</p>
                                        <input type="number" class="form-control" value="<?php echo $row["offer_price"]; ?>">
                                    </div>
                                    <div class="col-md-5">
                                        <p class="text-danger fs-3 m-0">Price</p>
                                        <input type="number" class="form-control" value="<?php echo $row["price"]; ?>">
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-md-5">
                                        <p class="text-danger fs-3 m-0">Quantity</p>
                                        <input type="number" class="form-control" value="<?php echo $row["quantity"]; ?>">
                                    </div>
                                </div>
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