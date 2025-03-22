<?php
session_start();
if (isset($_GET["product_id"])) {
    $_SESSION["product_id"] = $_GET["product_id"];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />

    <title>Edit Medicine</title>
    <?php include("C:/xampp/htdocs/php/medicine_website/admin_panel/links.php"); ?>
</head>

<script>
    <?php include("C:/xampp/htdocs/php/medicine_website/admin_panel/products/edit_medicine/edit_medicine.js"); ?>
</script>

<body class="">
    <div class="wrapper ">
        <!-- // Sidebar -->
        <?php include("C:/xampp/htdocs/php/medicine_website/admin_panel/sidenav.php"); ?>

        <div class="main-panel">
            <?php include("C:/xampp/htdocs/php/medicine_website/admin_panel/header/header.php"); ?>

            <div class="content">
                <div class="card px-4 py-2">
                    <h6>Are You want to Delete this Product?&emsp;<a href="http://localhost/php/medicine_website/admin_panel/products/delete_pr.php?product_id=<?php echo $row["product_id"]; ?>" class="btn btn-secondary text-light">Delete</a></h6>
                </div>

                <?php
                $sel = $conn->prepare("SELECT * FROM `products` WHERE `product_id`='" . $_SESSION["product_id"] . "'");
                $sel->execute();
                $sel = $sel->fetchAll();

                foreach ($sel as $row) {
                    $count_img = 0;
                    if ($row["item_img"] != null) {
                        foreach (unserialize($row["item_img"]) as $img) {
                            $count_img++;
                        }
                    } ?>

                    <!-- //! Category Details -->
                    <div class="card px-5 py-4 mb-5">
                        <!-- //** Error -->
                        <?php if (isset($_SESSION["cat_error"])) { ?>
                            <div class="alert" style="background-color: #ff1a1a;" role="alert">
                                <?php echo $_SESSION["cat_error"]; ?>
                                <script>
                                    $(document).ready(function() {
                                        $('html, body').animate({
                                            scrollTop: $(".category-form").parent(".card").offset().top
                                        }, 100);
                                        $(".alert").fadeOut(10000);
                                        <?php unset($_SESSION["cat_error"]); ?>
                                    });
                                </script>
                            </div>
                        <?php } ?>


                        <form action="http://localhost/php/medicine_website/admin_panel/products/edit_medicine/update_data.php" class="category-form" method="post" enctype="multipart/form-data">
                            <h5 class="text-danger">Category Details</h5>
                            <b style="color: red;">* Required Fields</b>

                            <div class="row">
                                <div class="col-md-4 border pb-3 p-2">Category Image</div>
                                <div class="col-md-4 border pb-3 p-2">Category Name <b style="color: red;">*</b></div>
                                <div class="col-md-4 border pb-3 p-2">Change Category Image <b style="color: red;">*</b></div>
                            </div>
                            <div class="row">
                                <input type="hidden" name="product-id" value="<?php echo $row["product_id"]; ?>" />
                                <div class="col-md-4 border p-2 d-flex justify-content-center">
                                    <img class="category-img d-block w-50 m-auto" src="http://localhost/php/medicine_website/user_panel/shop/category_img/<?php echo $row["cat_img"]; ?>" />
                                </div>
                                <div class="col-md-4 border p-3 pb-5">
                                    <input type="hidden" class="old-cat" name="old-cat" value="<?php echo $row["category"]; ?>">
                                    <input type="text" class="new-cat form-control" name="category" value="<?php echo $row["category"]; ?>">
                                </div>
                                <div class="col-md-4 border p-3 pb-5">
                                    <input type="checkbox" class="mb-4" />&ensp;Are you want to change category image?
                                    <input type="hidden" class="form-control old-cat-img" value="<?php echo $row["cat_img"]; ?>" />
                                    <input type="file" name="cat-img" class="form-control cat-img" value="<?php echo $row["cat_img"]; ?>" disabled="true" accept="image/*" />
                                </div>
                            </div>
                            <button class="update-category btn btn-danger m-0 mt-3 w-100" name="update-category">Update Category Details</button>
                        </form>
                    </div>


                    <!-- //! Product Details -->
                    <div class="card p-5 mt-5">
                        <!-- //** Success -->
                        <?php if (isset($_SESSION["pr_details_suc"])) { ?>
                            <div class="alert" style="background-color: #00b300;" role="alert">
                                <?php echo $_SESSION["pr_details_suc"]; ?>
                                <script>
                                    $(document).ready(function() {
                                        $('html, body').animate({
                                            scrollTop: $(".product-details").parent(".card").offset().top
                                        }, 100);
                                        $(".alert").fadeOut(10000);
                                        <?php unset($_SESSION["pr_details_suc"]); ?>
                                    });
                                </script>
                            </div>
                        <?php } ?>

                        <h5 class="text-dark">Product Details</h5>
                        <hr>
                        <div class="row product-details">
                            <div class="col-md-6">
                                <div id="carouselExampleIndicators" class="carousel slide border">

                                    <!-- //! Change Product Images btn -->
                                    <p class="text-danger fs-3 mx-3 m-0 d-inline">Change Product Images</p>
                                    <a href="http://localhost/php/medicine_website/admin_panel/products/additional_info/item_imgs/item_imgs.php" class="btn btn-light">Change</a>

                                    <div class="carousel-indicators">
                                        <?php for ($i = 0; $i < $count_img; $i++) { ?>
                                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="<?php echo $i; ?>" class="active border-0" aria-current="true" aria-label="Slide 1"></button>
                                        <?php } ?>
                                    </div>
                                    <div class="carousel-inner">
                                        <?php $i = 0;
                                        if ($row["item_img"] != null) {
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
                                            }
                                        } ?>
                                    </div>
                                    <button class="carousel-control-prev border-0 bg-transparent" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon bg-dark rounded" aria-hidden="true"></span>
                                    </button>
                                    <button class="carousel-control-next border-0 bg-transparent" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                                        <span class="carousel-control-next-icon bg-dark rounded" aria-hidden="true"></span>
                                    </button>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <form action="http://localhost/php/medicine_website/admin_panel/products/edit_medicine/update_data.php" method="post" enctype="multipart/form-data">
                                    <b style="color: red;">* Required Fields</b>
                                    <div class="row">
                                        <p class="text-danger fs-3 my-2">Product Name <b style="color: red;">*</b></p>
                                        <input type="text" name="name" class="form-control" value="<?php echo $row["name"]; ?>" required />
                                    </div>
                                    <div class="row">
                                        <p class="text-danger fs-3 mt-4 mb-2">Definition</p>
                                        <textarea name="definition" class="border p-2" value="<?php echo $row["definition"]; ?>" rows="8" cols="100"><?php echo $row["definition"]; ?></textarea>
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col-md-5">
                                            <p class="text-danger fs-3 m-0">Discount <b style="color: red;">*</b></p>
                                            <input type="number" name="discount" class="form-control" value="<?php echo $row["discount"]; ?>" required />
                                        </div>
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col-md-5">
                                            <p class="text-danger fs-3 m-0">Offer Price <b style="color: red;">*</b></p>
                                            <input type="number" name="offer-price" class="form-control" value="<?php echo $row["offer_price"]; ?>" step="0.01" required />
                                        </div>
                                        <div class="col-md-5">
                                            <p class="text-danger fs-3 m-0">Price <b style="color: red;">*</b></p>
                                            <input type="number" name="price" class="form-control" value="<?php echo $row["price"]; ?>" step="0.01" required />
                                        </div>
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col-md-5">
                                            <p class="text-danger fs-3 m-0">Quantity <b style="color: red;">*</b></p>
                                            <input type="number" name="quantity" class="form-control" value="<?php echo $row["quantity"]; ?>" required />
                                        </div>
                                        <div class="col-md-5">
                                            <p class="text-danger fs-3 m-0">Weight</p>
                                            <input type="text" name="weight" class="form-control" value="<?php echo $row["weight"]; ?>">
                                        </div>
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col-md-5">
                                            <p class="text-danger fs-3 m-0">Expiry Date <b style="color: red;">*</b></p>
                                            <input type="text" name="expiry" class="form-control" value="<?php echo $row["expiry"]; ?>" required />
                                        </div>
                                        <div class="col-md-5">
                                            <p class="text-danger fs-3 m-0">Delivery Date <b style="color: red;">*</b></p>
                                            <?php if (strtotime($row["delivery_date"]) > 0) { ?>
                                                <input type="text" name="delivery-date" class="form-control" value="<?php $date = strtotime($row["delivery_date"]);
                                                                                                                    echo date("d-m-Y", $date); ?>" required />
                                            <?php } //
                                            else { ?>
                                                <input type="date" name="delivery-date" class="form-control" required />
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col-md-12">
                                            <p class="text-danger fs-3 m-0">External link(video) that describes the Product:</p>
                                            <a href="<?php echo $row["link"]; ?>" style="color: blue;"><?php echo $row["link"]; ?></a>
                                            <input type="text" name="link" class="form-control mt-2" value="<?php echo $row["link"]; ?>">
                                        </div>
                                    </div>
                                    <button class="btn btn-danger m-0 mt-4 w-100" name="update-product">Update Product Details</button>
                                </form>
                            </div>
                        </div>
                    </div>



                    <!-- //! Additional Information -->
                    <?php $i = 1; ?>
                    <div class="card p-5 mt-5">
                        <h5 class="text-danger">Edit Additional Information</h5>
                        <div class="row">
                            <div class="col-md-2 border pb-3 py-2">Sr no.</div>
                            <div class="col-md-5 border pb-3 py-2">Information</div>
                            <div class="col-md-4 border pb-3 py-2">Change</div>
                        </div>

                        <!-- //! Description Images -->
                        <div class="row">
                            <div class="col-md-2 border py-2"><?php echo $i;
                                                                $i++; ?>)</div>
                            <div class="col-md-5 border py-2">
                                Images for Description of the Product. Such as...
                                <?php if (isset(unserialize($row["desc_img"])[0])) { ?>
                                    <img class="desc-img mt-4" src="http://localhost/php/medicine_website/user_panel/shop/desc_imgs/<?php echo unserialize($row["desc_img"])[0]; ?>" />
                                <?php } ?>
                            </div>
                            <?php if ($row["desc_img"] != null) { ?>
                                <div class="col-md-4 border py-2"><a href="http://localhost/php/medicine_website/admin_panel/products/additional_info/desc_imgs/edit_desc_imgs.php" class="btn btn-light">Change</a></div>
                            <?php } //
                            else { ?>
                                <div class="col-md-4 border py-2"><a href="http://localhost/php/medicine_website/admin_panel/products/additional_info/desc_imgs/edit_desc_imgs.php" class="btn btn-danger">Add</a></div>
                            <?php } ?>
                        </div>

                        <!-- //! Description -->
                        <div class="row">
                            <div class="col-md-2 border py-2"><?php echo $i;
                                                                $i++; ?>)</div>
                            <div class="col-md-5 border py-2">Description of the Product</div>
                            <?php if ($row["description"] != null) { ?>
                                <div class="col-md-4 border py-2"><a href="http://localhost/php/medicine_website/admin_panel/products/additional_info/description/description.php" class="btn btn-light">Change</a></div>
                            <?php } else { ?>
                                <div class="col-md-4 border py-2"><a href="http://localhost/php/medicine_website/admin_panel/products/additional_info/description/description.php" class="btn btn-danger">Add</a></div>
                            <?php } ?>
                        </div>

                        <!-- //! Benefits -->
                        <div class="row">
                            <div class="col-md-2 border py-2"><?php echo $i;
                                                                $i++; ?>)</div>
                            <div class="col-md-5 border py-2">Benefits of the Product</div>
                            <?php if ($row["benefits"] != null) { ?>
                                <div class="col-md-4 border py-2"><a href="http://localhost/php/medicine_website/admin_panel/products/additional_info/benefits/benefits.php" class="btn btn-light">Change</a></div>
                            <?php } else { ?>
                                <div class="col-md-4 border py-2"><a href="http://localhost/php/medicine_website/admin_panel/products/additional_info/benefits/benefits.php" class="btn btn-danger">Add</a></div>
                            <?php } ?>
                        </div>

                        <!-- //! How to Use -->
                        <div class="row">
                            <div class="col-md-2 border py-2"><?php echo $i;
                                                                $i++; ?>)</div>
                            <div class="col-md-5 border py-2">How to use the Product</div>
                            <?php if ($row["how_use"] != null) { ?>
                                <div class="col-md-4 border py-2"><a href="http://localhost/php/medicine_website/admin_panel/products/additional_info/how_use/how_use.php" class="btn btn-light">Change</a></div>
                            <?php } else { ?>
                                <div class="col-md-4 border py-2"><a href="http://localhost/php/medicine_website/admin_panel/products/additional_info/how_use/how_use.php" class="btn btn-danger">Add</a></div>
                            <?php } ?>
                        </div>

                        <!-- //! Safety -->
                        <div class="row">
                            <div class="col-md-2 border py-2"><?php echo $i;
                                                                $i++; ?>)</div>
                            <div class="col-md-5 border py-2">Safety Information for the Product</div>
                            <?php if ($row["safety"] != null) { ?>
                                <div class="col-md-4 border py-2"><a href="http://localhost/php/medicine_website/admin_panel/products/additional_info/safety/safety.php" class="btn btn-light">Change</a></div>
                            <?php } else { ?>
                                <div class="col-md-4 border py-2"><a href="http://localhost/php/medicine_website/admin_panel/products/additional_info/safety/safety.php" class="btn btn-danger">Add</a></div>
                            <?php } ?>
                        </div>

                        <!-- //! Other Information -->
                        <div class="row">
                            <div class="col-md-2 border py-2"><?php echo $i;
                                                                $i++; ?>)</div>
                            <div class="col-md-5 border py-2">Other Information of the Product</div>
                            <?php if ($row["other_info"] != null) { ?>
                                <div class="col-md-4 border py-2"><a href="http://localhost/php/medicine_website/admin_panel/products/additional_info/other_info/other_info.php" class="btn btn-light">Change</a></div>
                            <?php } else { ?>
                                <div class="col-md-4 border py-2"><a href="http://localhost/php/medicine_website/admin_panel/products/additional_info/other_info/other_info.php" class="btn btn-danger">Add</a></div>
                            <?php } ?>
                        </div>

                        <!-- //! FAQS -->
                        <div class="row">
                            <div class="col-md-2 border py-2"><?php echo $i;
                                                                $i++; ?>)</div>
                            <div class="col-md-5 border py-2">Frequently asked questions of the Product</div>
                            <?php if ($row["faqs"] != null) { ?>
                                <div class="col-md-4 border py-2"><a href="http://localhost/php/medicine_website/admin_panel/products/additional_info/faqs/faqs.php" class="btn btn-light">Change</a></div>
                            <?php } else { ?>
                                <div class="col-md-4 border py-2"><a href="http://localhost/php/medicine_website/admin_panel/products/additional_info/faqs/faqs.php" class="btn btn-danger">Add</a></div>
                            <?php } ?>
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