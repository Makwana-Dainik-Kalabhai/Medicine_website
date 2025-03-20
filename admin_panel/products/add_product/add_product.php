<?php
session_start();
if (isset($_GET["status"])) {
    $_SESSION["status"] = $_GET["status"];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />

    <?php echo (isset($_SESSION["status"]) && $_SESSION["status"] == "medicine") ? "<title>Add New Medicine</title>" : "<title>Add New Medicine</title>"; ?>
    <?php include("C:/xampp/htdocs/php/medicine_website/admin_panel/links.php"); ?>
</head>

<script>
    <?php include("C:/xampp/htdocs/php/medicine_website/admin_panel/products/add_product/add_product.js"); ?>
</script>

<body class="">
    <div class="wrapper ">
        <!-- // Sidebar -->
        <?php include("C:/xampp/htdocs/php/medicine_website/admin_panel/sidenav.php"); ?>

        <div class="main-panel">
            <?php include("C:/xampp/htdocs/php/medicine_website/admin_panel/header/header.php"); ?>

            <div class="content">
                <?php
                $product_id = $conn->prepare("SELECT * FROM `products` ORDER BY `product_id` DESC LIMIT 1");
                $product_id->execute();
                $product_id = $product_id->fetchAll();
                $product_id = $product_id[0]["product_id"] + 1;

                if (isset($_SESSION["product_id"])) {
                    $sel = $conn->prepare("SELECT * FROM `products` WHERE `product_id`='" . $_SESSION["product_id"] . "'");
                    $sel->execute();
                    $sel = $sel->fetchAll();
                    $count_img = 0;

                    foreach ($sel as $r) {
                        $category = $r["category"];
                        $cat_img = $r["cat_img"];

                        if ($r["item_img"] != null) {
                            foreach (unserialize($r["item_img"]) as $img) {
                                $count_img++;
                            }
                        }
                    }
                } ?>


                <!-- //! Category Details -->
                <div class="card px-5 py-4 mb-5">
                    <!-- //** Error -->
                    <?php if (isset($_SESSION["cat_error"])) { ?>
                        <div class="alert" style="background-color: #ff1a1a;" role="alert">
                            <?php echo $_SESSION["cat_error"];
                            if (isset($_SESSION["cat_success"])) {
                                unset($_SESSION["cat_success"]);
                            } ?>
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

                    <!-- //** Category details Added successfully -->
                    <?php if (isset($_SESSION["cat_success"])) { ?>
                        <div class="alert" style="background-color: #00b300;" role="alert">
                            <?php echo $_SESSION["cat_success"]; ?>
                            <script>
                                $(document).ready(function() {
                                    $('html, body').animate({
                                        scrollTop: $(".category-form").parent(".card").offset().top
                                    }, 100);
                                });
                            </script>
                        </div>
                    <?php } ?>



                    <!-- //! Category Details -->
                    <form action="http://localhost/php/medicine_website/admin_panel/products/add_product/update.php" class="category-form" method="post" enctype="multipart/form-data">
                        <h5 class="text-danger">Category Details</h5>
                        <b style="color: red;">* Required Fields</b>

                        <div class="row">
                            <div class="col-md-3 border pb-3 p-2 text-center">Category Image</div>
                            <div class="col-md-3 border pb-3 p-2">Change Category Image <b style="color: red;">*</b></div>
                            <div class="col-md-3 border pb-3 p-2">Category Name <b style="color: red;">*</b></div>
                            <div class="col-md-3 border pb-3 p-2">Product ID <b style="color: red;">*</b></div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 border p-3 pb-5">
                                <img src="http://localhost/php/medicine_website/user_panel/shop/category_img/<?php echo isset($cat_img) ? $cat_img : ""; ?>" alt="">
                            </div>

                            <div class="col-md-3 border p-3 pb-5">
                                <input type="file" name="cat-img" class="form-control" accept="image/*" />
                                <input type="checkbox" class="mt-3 cat-img-check" />&ensp;Are you want to change Category Image?
                            </div>

                            <div class="col-md-3 border p-3 pb-5">
                                <p class="text-danger mb-1">Existing Categories</p>
                                <?php
                                $category = $conn->prepare("SELECT * FROM `products` WHERE `status`='" . $_SESSION["status"] . "' GROUP BY `category`");
                                $category->execute();
                                $category = $category->fetchAll(); ?>

                                <select class="form-control old-cat" name="old-category" disabled="true">
                                    <?php foreach ($category as $cat) { ?>
                                        <option value="<?php echo $cat["category"]; ?>"><?php echo $cat["category"]; ?></option>
                                    <?php } ?>
                                </select>

                                <input type="text" class="form-control my-3 new-cat" name="new-category" placeholder="Enter Category" />

                                <input type="checkbox" class="sel-cat-check" />&ensp;Are you want to select existing category?
                            </div>

                            <div class="col-md-3">
                                <input type="text" class="form-control my-3" name="product_id" value="<?php echo $product_id; ?>" placeholder="Enter Product ID" />
                            </div>
                        </div>
                        <?php if (!isset($_SESSION["cat_success"])) { ?>
                            <button class="btn btn-danger w-100 mt-4" name="add_category">Add Category & product ID</button>
                        <?php } ?>
                    </form>
                </div>



                <!-- //! Product Images -->
                <div class="card p-5 mt-5">
                    <!-- //** Error -->
                    <?php if (isset($_SESSION["pr_img_error"])) { ?>
                        <div class="alert" style="background-color: #ff1a1a;" role="alert">
                            <?php echo $_SESSION["pr_img_error"];
                            if (isset($_SESSION["pr_img_suc"])) {
                                unset($_SESSION["pr_img_suc"]);
                            } ?>
                            <script>
                                $(document).ready(function() {
                                    $('html, body').animate({
                                        scrollTop: $(".item-imgs-form").parent(".card").offset().top
                                    }, 100);
                                    $(".alert").fadeOut(10000);
                                    <?php unset($_SESSION["pr_img_error"]); ?>
                                });
                            </script>
                        </div>
                    <?php } ?>

                    <!-- //** Success -->
                    <?php if (isset($_SESSION["pr_img_suc"])) { ?>
                        <div class="alert" style="background-color: #00b300;" role="alert">
                            <?php echo $_SESSION["pr_img_suc"]; ?>
                            <script>
                                $(document).ready(function() {
                                    $('html, body').animate({
                                        scrollTop: $(".item-imgs-form").parent(".card").offset().top
                                    }, 100);
                                });
                            </script>
                        </div>
                    <?php } ?>
                    <h5 class="text-danger">Product Images</h5>
                    <hr>
                    <div class="row border-bottom py-3">
                        <div class="col-md-1">Sr. no.</div>
                        <div class="col-md-3 text-center">Images</div>
                        <div class="col-md-4">Select Image</div>
                        <div class="col-md-2">Add / Update</div>
                        <div class="col-md-2">Delete</div>
                    </div>

                    <form action="http://localhost/php/medicine_website/admin_panel/products/add_product/item_img.php" class="item-imgs-form" method="post" enctype="multipart/form-data">
                        <?php if (isset($sel)) {
                            $i = 1;
                            foreach ($sel as $r) {
                                if ($r["item_img"] != null) {

                                    foreach (unserialize($r["item_img"]) as $img) { ?>
                                        <div class='row border-bottom py-4'>
                                            <div class='col-md-1'><?php echo $i ?>)</div>
                                            <div class='col-md-3'><img src="http://localhost/php/medicine_website/user_panel/shop/imgs/<?php echo $img; ?>" /></div>
                                            <div class='col-md-4'>
                                                <p class="text-danger mb-1">File Name:</p>
                                                <?php echo $img; ?>
                                                <input type="file" name="item-img" class="form-control mt-4" accept="image/*" disabled="true" />
                                                <input type="checkbox" class="mt-3 mx-2" /> Are you want to change the image?
                                            </div>
                                            <div class='col-md-2'>
                                                <button class='btn btn-light' name='update-item-img' value="<?php echo $i; ?>">Update</button>
                                            </div>
                                            <div class='col-md-2'>
                                                <button class='btn btn-light bg-danger' name='delete-item-img' value="<?php echo $i; ?>">Delete</button>
                                            </div>
                                        </div>
                        <?php
                                        $i++;
                                    }
                                }
                            }
                        } ?>
                    </form>
                    <?php if (isset($_SESSION["cat_success"])) { ?>
                        <button class="btn btn-danger add-item-img" value="<?php echo $i; ?>">ADD Product Image</button>
                    <?php } //
                    else { ?>
                        <div class="px-3 py-3 text-light rounded mt-3" style="background-color: #ff1a1a;">Please! Enter Category Details First</div>
                    <?php } ?>
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
                                });
                            </script>
                        </div>
                    <?php } ?>

                    <h5 class="text-danger">Product Details</h5>
                    <hr>
                    <?php if (isset($_SESSION["pr_img_suc"])) { ?>
                        <div class="row product-details">
                            <div class="col-md-6">
                                <div id="carouselExampleIndicators" class="carousel slide border">

                                    <div class="carousel-indicators">
                                        <?php for ($i = 0; $i < $count_img; $i++) { ?>
                                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="<?php echo $i; ?>" class="active border-0" aria-current="true" aria-label="Slide 1"></button>
                                        <?php } ?>
                                    </div>
                                    <div class="carousel-inner">
                                        <?php $i = 0;
                                        foreach (unserialize($r["item_img"]) as $img) {
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
                                        <span class="carousel-control-prev-icon bg-dark rounded" aria-hidden="true"></span>
                                    </button>
                                    <button class="carousel-control-next border-0 bg-transparent" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                                        <span class="carousel-control-next-icon bg-dark rounded" aria-hidden="true"></span>
                                    </button>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <form action="http://localhost/php/medicine_website/admin_panel/products/add_product/update.php" method="post" enctype="multipart/form-data">
                                    <b style="color: red;">* Required Fields</b>
                                    <div class="row">
                                        <p class="text-danger fs-3 my-2">Product Name <b style="color: red;">*</b></p>
                                        <input type="text" name="name" class="form-control" value="<?php echo $r["name"]; ?>" />
                                    </div>
                                    <div class="row">
                                        <p class="text-danger fs-3 mt-4 mb-2">Definition</p>
                                        <textarea name="definition" class="border p-2" value="<?php echo $r["definition"]; ?>" rows="8" cols="100"><?php echo $r["definition"]; ?></textarea>
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col-md-5">
                                            <p class="text-danger fs-3 m-0">Discount <b style="color: red;">*</b></p>
                                            <input type="number" name="discount" class="form-control" step="0.01" value="<?php echo $r["discount"]; ?>">
                                        </div>
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col-md-5">
                                            <p class="text-danger fs-3 m-0">Offer Price <b style="color: red;">*</b></p>
                                            <input type="number" name="offer-price" class="form-control" step="0.01" value="<?php echo $r["offer_price"]; ?>">
                                        </div>
                                        <div class="col-md-5">
                                            <p class="text-danger fs-3 m-0">Price <b style="color: red;">*</b></p>
                                            <input type="number" name="price" class="form-control" step="0.01" value="<?php echo $r["price"]; ?>">
                                        </div>
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col-md-5">
                                            <p class="text-danger fs-3 m-0">Quantity <b style="color: red;">*</b></p>
                                            <input type="number" name="quantity" class="form-control" value="<?php echo $r["quantity"]; ?>">
                                        </div>
                                        <div class="col-md-5">
                                            <p class="text-danger fs-3 m-0">Weight</p>
                                            <input type="text" name="weight" class="form-control" value="<?php echo $r["weight"]; ?>">
                                        </div>
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col-md-5">
                                            <p class="text-danger fs-3 m-0">Expiry Date <b style="color: red;">*</b></p>
                                            <input type="text" name="expiry" class="form-control" placeholder="Nov 2024">
                                        </div>
                                        <div class="col-md-5">
                                            <p class="text-danger fs-3 m-0">Delivery Date <b style="color: red;">*</b></p>
                                            <?php if (!isset($_SESSION["product_success"])) { ?>
                                                <input type="date" name="delivery-date" class="form-control" />
                                            <?php } //
                                            else { ?>
                                                <input type="text" name="delivery-date" value="<?php echo $r["delivery_date"]; ?>" class="form-control" />
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col-md-12">
                                            <p class="text-danger fs-3 m-0">External link(video) that describes the Product:</p>
                                            <a href="<?php echo $r["link"]; ?>" style="color: blue;"><?php echo $r["link"]; ?></a>
                                            <input type="text" name="link" class="form-control mt-2" value="<?php echo $r["link"]; ?>">
                                        </div>
                                    </div>
                                    <button class="btn btn-danger m-0 mt-4 w-100" name="add-product-details">Add Product Details</button>
                                </form>
                            </div>
                        </div>
                    <?php } //
                    else { ?>
                        <div class="px-3 py-3 text-light rounded mt-3" style="background-color: #ff1a1a;">Please! Upload Product Images First</div>
                    <?php } ?>
                </div>



                <!-- //! Additional Information -->
                <?php $i = 1; ?>
                <div class="card p-5 mt-5">
                    <h5 class="text-danger">Edit Additional Information</h5>
                    <hr>
                    <div class="row">
                        <div class="col-md-2 border pb-3 py-2">Sr no.</div>
                        <div class="col-md-5 border pb-3 py-2">Information</div>
                        <div class="col-md-4 border pb-3 py-2">Change</div>
                    </div>


                    <!-- //! Description Images -->
                    <?php if (isset($_SESSION["pr_details_suc"])) { ?>
                        <div class="row">
                            <div class="col-md-2 border py-2"><?php echo $i;
                                                                $i++; ?>)</div>
                            <div class="col-md-5 border py-2">
                                Images that describes Product.
                                <?php if (isset(unserialize($r["desc_img"])[0])) { ?>
                                    <img class="desc-img mt-4" src="http://localhost/php/medicine_website/user_panel/shop/desc_imgs/<?php echo unserialize($r["desc_img"])[0]; ?>" />
                                <?php } ?>
                            </div>
                            <?php if ($r["desc_img"] != null) { ?>
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
                            <?php if ($r["description"] != null) { ?>
                                <div class="col-md-4 border py-2"><a href="http://localhost/php/medicine_website/admin_panel/products/additional_info/description/description.php" class="btn btn-light">Change</a></div>
                            <?php } else { ?>
                                <div class="col-md-4 border py-2"><a href="http://localhost/php/medicine_website/admin_panel/products/additional_info/description/description.php" class="btn btn-danger">Add</a></div>
                            <?php } ?>
                        </div>


                        <!-- //! Features -->
                        <?php if ($_SESSION["status"] == "device") { ?>
                            <div class="row">
                                <div class="col-md-2 border py-2"><?php echo $i;
                                                                    $i++; ?>)</div>
                                <div class="col-md-5 border py-2">Features of the Product</div>
                                <?php if ($r["features"] != null) { ?>
                                    <div class="col-md-4 border py-2"><a href="http://localhost/php/medicine_website/admin_panel/products/additional_info/features/features.php" class="btn btn-light">Change</a></div>
                                <?php } else { ?>
                                    <div class="col-md-4 border py-2"><a href="http://localhost/php/medicine_website/admin_panel/products/additional_info/features/features.php" class="btn btn-danger">Add</a></div>
                                <?php } ?>
                            </div>
                        <?php } ?>

                        <!-- //! Specification -->
                        <?php if ($_SESSION["status"] == "device") { ?>
                            <div class="row">
                                <div class="col-md-2 border py-2"><?php echo $i;
                                                                    $i++; ?>)</div>
                                <div class="col-md-5 border py-2">Specification of the Product</div>
                                <?php if ($r["specification"] != null) { ?>
                                    <div class="col-md-4 border py-2"><a href="http://localhost/php/medicine_website/admin_panel/products/additional_info/specification/specification.php" class="btn btn-light">Change</a></div>
                                <?php } else { ?>
                                    <div class="col-md-4 border py-2"><a href="http://localhost/php/medicine_website/admin_panel/products/additional_info/specification/specification.php" class="btn btn-danger">Add</a></div>
                                <?php } ?>
                            </div>
                        <?php } ?>


                        <!-- //! Benefits -->
                        <?php if ($_SESSION["status"] == "medicine") { ?>
                            <div class="row">
                                <div class="col-md-2 border py-2"><?php echo $i;
                                                                    $i++; ?>)</div>
                                <div class="col-md-5 border py-2">Benefits of the Product</div>
                                <?php if ($r["benefits"] != null) { ?>
                                    <div class="col-md-4 border py-2"><a href="http://localhost/php/medicine_website/admin_panel/products/additional_info/benefits/benefits.php" class="btn btn-light">Change</a></div>
                                <?php } else { ?>
                                    <div class="col-md-4 border py-2"><a href="http://localhost/php/medicine_website/admin_panel/products/additional_info/benefits/benefits.php" class="btn btn-danger">Add</a></div>
                                <?php } ?>
                            </div>
                        <?php } ?>

                        <!-- //! How to Use -->
                        <?php if ($_SESSION["status"] == "medicine") { ?>
                            <div class="row">
                                <div class="col-md-2 border py-2"><?php echo $i;
                                                                    $i++; ?>)</div>
                                <div class="col-md-5 border py-2">How to use the Product</div>
                                <?php if ($r["how_use"] != null) { ?>
                                    <div class="col-md-4 border py-2"><a href="http://localhost/php/medicine_website/admin_panel/products/additional_info/how_use/how_use.php" class="btn btn-light">Change</a></div>
                                <?php } else { ?>
                                    <div class="col-md-4 border py-2"><a href="http://localhost/php/medicine_website/admin_panel/products/additional_info/how_use/how_use.php" class="btn btn-danger">Add</a></div>
                                <?php } ?>
                            </div>
                        <?php } ?>

                        <!-- //! Safety -->
                        <?php if ($_SESSION["status"] == "medicine") { ?>
                            <div class="row">
                                <div class="col-md-2 border py-2"><?php echo $i;
                                                                    $i++; ?>)</div>
                                <div class="col-md-5 border py-2">Safety Information for the Product</div>
                                <?php if ($r["safety"] != null) { ?>
                                    <div class="col-md-4 border py-2"><a href="http://localhost/php/medicine_website/admin_panel/products/additional_info/safety/safety.php" class="btn btn-light">Change</a></div>
                                <?php } else { ?>
                                    <div class="col-md-4 border py-2"><a href="http://localhost/php/medicine_website/admin_panel/products/additional_info/safety/safety.php" class="btn btn-danger">Add</a></div>
                                <?php } ?>
                            </div>
                        <?php } ?>

                        <!-- //! Other Information -->
                        <?php if ($_SESSION["status"] == "medicine") { ?>
                            <div class="row">
                                <div class="col-md-2 border py-2"><?php echo $i;
                                                                    $i++; ?>)</div>
                                <div class="col-md-5 border py-2">Other Information of the Product</div>
                                <?php if ($r["other_info"] != null) { ?>
                                    <div class="col-md-4 border py-2"><a href="http://localhost/php/medicine_website/admin_panel/products/additional_info/other_info/other_info.php" class="btn btn-light">Change</a></div>
                                <?php } else { ?>
                                    <div class="col-md-4 border py-2"><a href="http://localhost/php/medicine_website/admin_panel/products/additional_info/other_info/other_info.php" class="btn btn-danger">Add</a></div>
                                <?php } ?>
                            </div>
                        <?php } ?>


                        <!-- //! FAQS -->
                        <div class="row">
                            <div class="col-md-2 border py-2"><?php echo $i;
                                                                $i++; ?>)</div>
                            <div class="col-md-5 border py-2">Frequently asked questions of the Product</div>
                            <?php if ($r["faqs"] != null) { ?>
                                <div class="col-md-4 border py-2"><a href="http://localhost/php/medicine_website/admin_panel/products/additional_info/faqs/faqs.php" class="btn btn-light">Change</a></div>
                            <?php } else { ?>
                                <div class="col-md-4 border py-2"><a href="http://localhost/php/medicine_website/admin_panel/products/additional_info/faqs/faqs.php" class="btn btn-danger">Add</a></div>
                            <?php } ?>
                        </div>
                    <?php } //
                    else { ?>
                        <div class="px-3 py-3 text-light rounded mt-3" style="background-color: #ff1a1a;">Please! Enter Product Details First</div>
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