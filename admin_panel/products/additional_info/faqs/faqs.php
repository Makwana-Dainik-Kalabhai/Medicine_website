<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />

    <title>Edit FAQS</title>
    <?php include("C:/xampp/htdocs/php/medicine_website/admin_panel/links.php"); ?>
</head>

<script>
    <?php include("C:/xampp/htdocs/php/medicine_website/admin_panel/products/additional_info/faqs/faqs.js"); ?>
</script>

<body class="">
    <div class="wrapper ">
        <!-- // Sidebar -->
        <?php include("C:/xampp/htdocs/php/medicine_website/admin_panel/sidenav.php"); ?>

        <div class="main-panel">
            <?php include("C:/xampp/htdocs/php/medicine_website/admin_panel/header/header.php"); ?>

            <div class="content">
                <div class="card p-5">
                    <!-- //** faqs updated successfully -->
                    <?php if (isset($_SESSION["success"])) { ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo $_SESSION["success"]; ?>
                            <script>
                                $(document).ready(function() {
                                    window.location.reload();
                                    $(".alert").fadeOut(10000);
                                    <?php unset($_SESSION["success"]); ?>
                                });
                            </script>
                        </div>
                    <?php }


                    $sel = $conn->prepare("SELECT * FROM `products` WHERE `product_id`='" . $_SESSION["product_id"] . "'");
                    $sel->execute();
                    $sel = $sel->fetchAll();

                    foreach ($sel as $row) {
                        $count_img = 0;
                        $i = 1;

                        foreach (unserialize($row["item_img"]) as $img) {
                            $count_img++;
                        } ?>
                        <div class="row mb-5">
                            <div class="col-md-5">
                                <div id="carouselExampleIndicators" class="carousel slide border">

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

                            <div class="col-md-7">
                                <div class="row">
                                    <p class="text-danger fs-3 my-2">Category Name</p>
                                    <input type="text" name="name" class="form-control" value="<?php echo $row["category"]; ?>" readonly />
                                </div>
                                <div class="row mt-4">
                                    <p class="text-danger fs-3 my-2">Product Name</p>
                                    <input type="text" name="name" class="form-control" value="<?php echo $row["name"]; ?>" readonly />
                                </div>
                            </div>
                        </div>


                        <h5 class="text-danger mt-5">Frequently Asked Questions (FAQS)</h5>
                        <div class="row p-0">
                            <div class="col-md-1 border p-3">
                                <p>Sr. no.</p>
                            </div>
                            <div class="col-md-3 border p-3">
                                <p>Question</p>
                            </div>
                            <div class="col-md-6 border p-3">
                                <p>Answer</p>
                            </div>
                            <div class="col-md-2 border p-3">
                                <p>Delete / Update</p>
                            </div>
                        </div>


                        <form class="faqs-form" action="http://localhost/php/medicine_website/admin_panel/products/additional_info/faqs/update.php" method="post" enctype="multipart/form-data">
                            <?php
                            if ($row["faqs"] != null) {
                                foreach (unserialize($row["faqs"]) as $ben) {
                            ?>
                                    <div class="row">
                                        <div class="col-md-1 border p-3">
                                            <p><?php echo $i; ?>)</p>
                                        </div>
                                        <?php if (isset($ben[0]) && isset($ben[1])) { ?>
                                            <div class="col-md-3 border p-3">
                                                <input type="text" class="form-control" name="key[]" value="<?php echo $ben[0]; ?>" />
                                            </div>
                                            <div class="col-md-6 border p-3">
                                                <textarea class="border w-100 text-secondary py-1 px-2" name="value[]" value="<?php echo $ben[1]; ?>" rows="5"><?php echo $ben[1]; ?></textarea>
                                            </div>
                                        <?php } //
                                        else { ?>
                                            <div class="col-md-3 border p-3">
                                                <input type="text" class="form-control" name="key[]" />
                                            </div>
                                            <div class="col-md-6 border p-3">
                                                <textarea class="border w-100 text-secondary py-1 px-2" name="value[]" value="<?php echo $ben[1]; ?>" rows="5"><?php echo $ben[0]; ?></textarea>
                                            </div>
                                        <?php } ?>
                                        <div class="col-md-2 border p-3">
                                            <button class="btn btn-light" name="delete-faqs" value="<?php echo $i; ?>">Delete</button>
                                            <button class="btn btn-danger" name="update-faqs" value="<?php echo $i; ?>">Update</button>
                                        </div>
                                    </div>
                        <?php $i++;
                                }
                            }
                        } ?>
                        </form>

                        <button style="width: fit-content;" class="btn btn-light add-faqs mt-3" value="<?php echo $i; ?>">Add More Rows</button>
                </div>
            </div>
        </div>

        <footer class="footer footer-black  footer-white ">
            <?php include("C:/xampp/htdocs/php/medicine_website/admin_panel/footer/footer.php"); ?>
        </footer>
    </div>
</body>

</html>