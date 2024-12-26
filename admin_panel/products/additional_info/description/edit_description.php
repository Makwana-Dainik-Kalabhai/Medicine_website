<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />

    <title>Edit Description</title>
    <?php include("C:/xampp/htdocs/php/medicine_website/admin_panel/links.php"); ?>
</head>

<script>
    <?php include("C:/xampp/htdocs/php/medicine_website/admin_panel/products/additional_info/description/edit_description.js"); ?>
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
                        <div class="alert alert-danger" role="alert">
                            <?php echo $_SESSION["error"]; ?>
                            <script>
                                $(document).ready(function() {
                                    $(".alert").fadeOut(15000);
                                    <?php unset($_SESSION["error"]); ?>
                                });
                            </script>
                        </div>
                    <?php } ?>

                    <form action="" method="post" enctype="multipart/form-data">
                        <?php
                        $sel = $conn->prepare("SELECT * FROM `products` WHERE `product_id`='" . $_SESSION["product_id"] . "'");
                        $sel->execute();
                        $sel = $sel->fetchAll();

                        $i = 1;

                        foreach ($sel as $row) { ?>
                            <h5 class="text-danger">Description Details</h5>
                            <hr>
                            <div class="row p-0">
                                <div class="col-md-1 border p-3">
                                    <p>Sr. no.</p>
                                </div>
                                <div class="col-md-3 border p-3">
                                    <p>Key</p>
                                </div>
                                <div class="col-md-8 border p-3">
                                    <p>Value</p>
                                </div>
                            </div>

                            <?php
                            if ($row["description"] != null) {
                                foreach (unserialize($row["description"]) as $des) {
                            ?>
                                    <div class="row">
                                        <div class="col-md-1 border p-3">
                                            <p><?php echo $i; ?>)</p>
                                        </div>
                                        <?php if (isset($des[0]) && isset($des[1])) { ?>
                                            <div class="col-md-3 border p-3">
                                                <input type="text" class="form-control" value="<?php echo $des[0]; ?>" placeholder="Key<?php echo $i; ?>" />
                                            </div>
                                            <div class="col-md-8 border p-3">
                                                <textarea class="form-control py-1 px-2" value="<?php echo $des[1]; ?>"><?php echo $des[1]; ?></textarea>
                                            </div>
                                        <?php } //
                                        else { ?>
                                            <div class="col-md-3 border p-3">
                                                <input type="text" class="form-control" value="" placeholder="Key<?php echo $i; ?>" />
                                            </div>
                                            <div class="col-md-8 border p-3">
                                                <textarea class="form-control py-1 px-2" value="<?php echo $des[1]; ?>"><?php echo $des[0]; ?></textarea>
                                            </div>
                                        <?php } ?>
                                    </div>
                            <?php $i++;
                                }
                            } ?>
                        <?php
                        } ?>
                    </form>
                </div>
            </div>

            <footer class="footer footer-black  footer-white ">
                <?php include("C:/xampp/htdocs/php/medicine_website/admin_panel/footer/footer.php"); ?>
            </footer>
        </div>
</body>

</html>