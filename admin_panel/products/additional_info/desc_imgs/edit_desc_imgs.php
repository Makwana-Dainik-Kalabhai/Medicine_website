<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />

    <title>Edit Description Images</title>
    <?php include("C:/xampp/htdocs/php/medicine_website/admin_panel/links.php"); ?>
</head>

<style>
    .card img {
        display: block;
        margin: auto;
    }
</style>

<script>
    <?php include("C:/xampp/htdocs/php/medicine_website/admin_panel/products/additional_info/desc_imgs/edit_desc_imgs.js"); ?>
</script>

<body class="">
    <div class="wrapper ">
        <!-- // Sidebar -->
        <?php include("C:/xampp/htdocs/php/medicine_website/admin_panel/sidenav.php"); ?>

        <div class="main-panel">
            <?php include("C:/xampp/htdocs/php/medicine_website/admin_panel/header/header.php"); ?>

            <div class="content">
                <div class="card p-5">
                    <?php if (isset($_SESSION["error"])) { ?>
                        <div class="alert" style="background-color: #ff1a1a;" role="alert">
                            <?php echo $_SESSION["error"]; ?>
                            <script>
                                $(document).ready(function() {
                                    $(".alert").fadeOut(15000);
                                    <?php unset($_SESSION["error"]); ?>
                                });
                            </script>
                        </div>
                    <?php } ?>

                    <?php
                    $sel = $conn->prepare("SELECT * FROM `products` WHERE `product_id`='" . $_SESSION["product_id"] . "'");
                    $sel->execute();
                    $sel = $sel->fetchAll();

                    foreach ($sel as $row) {
                        $count_img = 0;
                        $i = 1;
                        
                        foreach (unserialize($row["item_img"]) as $img) {
                            $count_img++;
                        } ?>

                        <!-- //! Description Images -->
                        <h5 class="text-danger">Description Images</h5>
                        <b style="color: red;">* Required Fields</b>
                        <div class="row border-bottom py-3">
                            <div class="col-md-1">Sr. no.</div>
                            <div class="col-md-4">Images</div>
                            <div class="col-md-4">Select Image <b style="color: red;">*</b></div>
                            <div class="col-md-2">Change</div>
                            <div class="col-md-1">Delete</div>
                        </div>

                        <form action="http://localhost/php/medicine_website/admin_panel/products/additional_info/desc_imgs/update.php" class="desc-imgs-form" method="post" enctype="multipart/form-data">
                            <?php if (isset(unserialize($row["desc_img"])[0])) {
                                foreach (unserialize($row["desc_img"]) as $desc_img) { ?>
                                    <div class="row border-bottom py-4">
                                        <div class="col-md-1"><?php echo $i . ")"; ?></div>
                                        <div class="col-md-4">
                                            <img class="desc-img" src="http://localhost/php/medicine_website/user_panel/shop/desc_imgs/<?php echo $desc_img; ?>" />
                                        </div>
                                        <div class="col-md-4">
                                            <p class="text-danger mb-1">File Name:</p>
                                            <?php echo $desc_img; ?>
                                            <input type="file" name="desc-img" class="form-control mt-4" disabled="true" value="<?php echo $desc_img; ?>" required />
                                            <input type="checkbox" class="mt-3 mx-2" /> Are you want to change the image?
                                        </div>
                                        <div class="col-md-2">
                                            <button class="btn btn-light change-btn" disabled="true" name="change" value="<?php echo $i; ?>">Change</button>
                                        </div>
                                        <div class="col-md-1">
                                            <button class="btn btn-danger" name="delete" value="<?php echo $i; ?>">Delete</button>
                                        </div>
                                    </div>
                            <?php $i++;
                                }
                            } ?>
                        </form>
                        <button class="btn btn-danger add-desc-img" value="<?php echo $i; ?>">ADD More Image</button>
                    <?php } ?>
                </div>
            </div>

            <footer class="footer footer-black  footer-white ">
                <?php include("C:/xampp/htdocs/php/medicine_website/admin_panel/footer/footer.php"); ?>
            </footer>
        </div>
</body>

</html>