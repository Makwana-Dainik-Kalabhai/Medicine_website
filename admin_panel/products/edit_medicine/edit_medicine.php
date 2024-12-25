<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />

    <title>Edit Medicine</title>
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
    <?php include("C:/xampp/htdocs/php/medicine_website/admin_panel/products/edit_medicine/edit_medicine.js"); ?>
</script>

<body class="">
    <div class="wrapper ">
        <!-- // Sidebar -->
        <?php include("C:/xampp/htdocs/php/medicine_website/admin_panel/sidenav.php"); ?>

        <div class="main-panel">
            <?php include("C:/xampp/htdocs/php/medicine_website/admin_panel/topnav.php"); ?>

            <div class="content">
                <?php
                $sel = $conn->prepare("SELECT * FROM `products` WHERE `product_id`='" . $_GET["product_id"] . "'");
                $sel->execute();
                $sel = $sel->fetchAll();

                foreach ($sel as $row) {
                    $count_img = 0;
                    foreach (unserialize($row["item_img"]) as $img) {
                        $count_img++;
                    } ?>

                    <!-- //! Category Details -->
                    <div class="card px-5 py-4 mb-5">
                        <h5 class="text-danger">Category Details</h5>
                        <div class="row">
                            <div class="col-md-4 border pb-3 p-2">Category Image</div>
                            <div class="col-md-4 border pb-3 p-2">Category Name</div>
                            <div class="col-md-4 border pb-3 p-2">Change Category Image</div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 border p-2">
                                <img class="category-img" src="http://localhost/php/medicine_website/user_panel/shop/category_img/<?php echo $row["cat_img"]; ?>" />
                            </div>
                            <div class="col-md-4 border p-2">
                                <input type="text" class="form-control category" value="<?php echo $row["category"]; ?>" />
                            </div>
                            <div class="col-md-4 border p-2">
                                <input type="checkbox" class="mb-4" />&ensp;Are you want to change category image?
                                <input type="file" class="form-control cat-img" disabled="true" accept="image/png, image/jpeg, image/jpg" />
                            </div>
                        </div>
                        <button class="btn btn-light m-0 mt-3 update-category">Update Category Details</button>
                    </div>


                    <!-- //! Product Details -->
                    <div class="card p-5 mt-5">
                        <h5 class="text-dark">Product Details</h5>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <div id="carouselExampleIndicators" class="carousel slide border">

                                    <!-- //! Change Product Images btn -->
                                    <p class="text-danger fs-3 mx-3 m-0 d-inline">Change Product Images</p>
                                    <button class="btn btn-light">Change</button>

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
                                    <p class="text-danger fs-3 my-2">Product Name</p>
                                    <input type="text" class="name" class="form-control" value="<?php echo $row["name"]; ?>" />
                                </div>
                                <div class="row">
                                    <p class="text-danger fs-3 mt-4 mb-2">Definition</p>
                                    <textarea class="definition border p-2" value="<?php echo $row["definition"]; ?>" rows="8" cols="100"><?php echo $row["definition"]; ?></textarea>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-md-5">
                                        <p class="text-danger fs-3 m-0">Discount</p>
                                        <input type="number" class="discount form-control" value="<?php echo $row["discount"]; ?>">
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-md-5">
                                        <p class="text-danger fs-3 m-0">Offer Price</p>
                                        <input type="number" class="offer-price form-control" value="<?php echo $row["offer_price"]; ?>">
                                    </div>
                                    <div class="col-md-5">
                                        <p class="text-danger fs-3 m-0">Price</p>
                                        <input type="number" class="price form-control" value="<?php echo $row["price"]; ?>">
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-md-5">
                                        <p class="text-danger fs-3 m-0">Quantity</p>
                                        <input type="number" class="quantity form-control" value="<?php echo $row["quantity"]; ?>">
                                    </div>
                                    <div class="col-md-5">
                                        <p class="text-danger fs-3 m-0">Weight</p>
                                        <input type="text" class="weight form-control" value="<?php echo $row["weight"]; ?>">
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-md-5">
                                        <p class="text-danger fs-3 m-0">Expiry Date</p>
                                        <input type="text" class="expiry form-control" value="<?php echo $row["expiry"]; ?>">
                                    </div>
                                    <div class="col-md-5">
                                        <p class="text-danger fs-3 m-0">Delivery Date</p>
                                        <input type="text" class="delivery-date form-control" value="<?php echo $row["delivery_date"]; ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-light m-0 mt-5 update-product">Update Product Details</button>
                    </div>



                    <!-- //! Additional Information -->
                    <div class="card p-5 mt-5">
                        <h5 class="text-danger">Edit Additional Information</h5>
                        <div class="row">
                            <div class="col-md-2 border pb-3 py-2">Sr no.</div>
                            <div class="col-md-5 border pb-3 py-2">Information</div>
                            <div class="col-md-4 border pb-3 py-2">Change</div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 border py-2">1)</div>
                            <div class="col-md-5 border py-2">
                                Images for Description of the Product. Such as...
                                <?php if (isset(unserialize($row["desc_img"])[0])) { ?>
                                    <img class="desc-img mt-4" src="http://localhost/php/medicine_website/user_panel/shop/desc_imgs/<?php echo unserialize($row["desc_img"])[0]; ?>" />
                                <?php } ?>
                            </div>
                            <div class="col-md-4 border py-2"><button class="btn btn-light">Change</button></div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 border py-2">2)</div>
                            <div class="col-md-5 border py-2">Description of the Product</div>
                            <div class="col-md-4 border py-2"><button class="btn btn-light">Change</button></div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 border py-2">3)</div>
                            <div class="col-md-5 border py-2">Benefits of the Product</div>
                            <div class="col-md-4 border py-2"><button class="btn btn-light">Change</button></div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 border py-2">4)</div>
                            <div class="col-md-5 border py-2">How to use the Product</div>
                            <div class="col-md-4 border py-2"><button class="btn btn-light">Change</button></div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 border py-2">5)</div>
                            <div class="col-md-5 border py-2">Safety Information for the Product</div>
                            <div class="col-md-4 border py-2"><button class="btn btn-light">Change</button></div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 border py-2">6)</div>
                            <div class="col-md-5 border py-2">Other Information of the Product</div>
                            <div class="col-md-4 border py-2"><button class="btn btn-light">Change</button></div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 border py-2">7)</div>
                            <div class="col-md-5 border py-2">Frequently asked questions of the Product</div>
                            <div class="col-md-4 border py-2"><button class="btn btn-light">Change</button></div>
                        </div>
                    </div>
                <?php } ?>
            </div>

            <footer class="footer footer-black  footer-white ">
                <?php include("C:/xampp/htdocs/php/medicine_website/admin_panel/footer/footer.php"); ?>
            </footer>
        </div>
</body>

</html>