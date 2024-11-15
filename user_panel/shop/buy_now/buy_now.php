<?php
session_start();
include("C:/xampp/htdocs/php/medicine_website/database.php");
?>
<!DOCTYPE html>
<html lang="en">

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Purchase Now</title>
<?php include("C:/xampp/htdocs/php/medicine_website/user_panel/links.php"); ?>

<style>
    <?php include("buy_now.css"); ?>
</style>

<script>
    <?php include("buy_now.js"); ?>
</script>

<?php
if (isset($_POST["item_code"])) {
    $up = $conn->prepare("DELETE FROM `cart` WHERE `item_code`='" . $_POST["item_code"] . "'");
    $up->execute();
}
if (isset($_POST["quantity"]) && isset($_POST["item_code"])) {
    $sel = $conn->prepare("SELECT * FROM `products` WHERE item_code='" . $_POST["item_code"] . "'");
    $sel->execute();
    $sel = $sel->fetchAll();

    $sel = $sel[0];
    if ($_POST["quantity"] < 6 && $_POST["quantity"] < $sel["quantity"]) {
        $up = $conn->prepare("UPDATE `cart` SET `quantity`='" . $_POST["quantity"] . "' WHERE `email`='" . $_SESSION["email"] . "' AND `item_code`='" . $_POST["item_code"] . "'");
        $up->execute();
    }
}
?>

<body>
    <header>
        <?php include("C:/xampp/htdocs/php/medicine_website/user_panel/header/header.php"); ?>
    </header>

    <main>
        <div class="buy_now_main">
            <h1>Order Product Now</h1>
            <p style="color:gray; font-size: 0.5em;">Please make sure to fill in the required fields and submit this form to complete your order.</p>

            <h3 style="margin-top: 6%;">My Products</h3>
            <div class="products">
                <?php
                if (isset($_GET["product"]) && $_GET["product"] == "multiple") {
                    $select = $conn->prepare("SELECT *, cart.quantity FROM `cart` INNER JOIN `products` ON products.item_code=cart.item_code WHERE `email`='" . $_SESSION["email"] . "'");
                    $select->execute();
                    $select = $select->fetchAll();
                } else {
                    $select = $conn->prepare("SELECT * FROM `products` WHERE item_code='" . $_GET["item_code"] . "'");
                    $select->execute();
                    $select = $select->fetchAll();
                }

                foreach ($select as $row) { ?>
                    <div class="card">
                        <button value="<?php echo $row["item_code"]; ?>" class="remove_btn"><i class='fa-solid fa-trash'></i></button>

                        <a href="http://localhost/php/medicine_website/user_panel/shop/product_details/product_details.php?status=<?php echo $row["status"]; ?>&item_code=<?php echo $row['item_code']; ?>">
                            <img src="http://localhost/php/medicine_website/user_panel/shop/imgs/<?php echo unserialize($row["item_img"])[0]; ?>" alt="...">
                            <div class="card-body p-2">
                                <h5 class="card-title m-0"><?php echo $row["name"]; ?></h5>
                                <p class="card-text m-0"><span class="off_price">₹<?php echo $row["offer_price"]; ?></span> <span class="price"><?php if ($row["offer_price"] !== $row["price"]) echo "₹" . $row["price"]; ?></span></p>
                            </div>
                        </a>
                        <label class="form-label mx-2 mt-3">Quantity:</label>
                        <input type="hidden" id="item_code" value="<?php echo $row["item_code"]; ?>" />
                        <input id="quantity" type="number" name="quantity" value="<?php echo $row["quantity"]; ?>" min="1" class="form-control mx-2 mb-3" />
                    </div>
                <?php } ?>
            </div>

            <?php
            $select = $conn->prepare("SELECT * FROM `user_login_data` WHERE email='" . $_SESSION["email"] . "'");
            $select->execute();
            $select = $select->fetchAll();

            foreach ($select as $row) { ?>
                <form action="verify.php" method="post" enctype="multipart/form-data" novalidate>
                    <p class="head">All Fields are required*</p>

                    <p class="sub-head">Personal Details:</p>
                    <hr />
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label class="form-label">Name:</label>
                            <input type="text" name="name" value="<?php echo $row["name"]; ?>" class="form-control py-4" placeholder="User Name" required />
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Phone:</label>
                            <input type="text" name="phone" value="<?php if ($row["phone"] != 0) {
                                                                        echo $row["phone"];
                                                                    } ?>" class="form-control py-4" maxlength="14" placeholder="0123456789" required />
                        </div>
                    </div>
                    <div class="row mb-5">
                        <div class="col-md-12">
                            <label class="form-label">Email ID:</label>
                            <input type="email" name="email" value="<?php echo $row["email"]; ?>" class="form-control py-4" placeholder="Email ID" required />
                        </div>
                    </div>
                    <p class="sub-head">Address:</p>
                    <hr />
                    <div class="row mb-4">
                        <div class="col-md-8">
                            <label class="form-label">Street:</label>
                            <input type="text" name="street" value="<?php echo unserialize($row["address"])["street"]; ?>" class="form-control py-4" placeholder="Apartment Name" required />
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">House no.:</label>
                            <input type="text" name="house_no" value="<?php echo unserialize($row["address"])["house_no"]; ?>" class="form-control py-4" placeholder="D/302" required />
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-md-8">
                            <label class="form-label">Apartment suite:</label>
                            <input type="text" name="suite" value="<?php echo unserialize($row["address"])["suite"]; ?>" class="form-control py-4" placeholder="near by Apartment Name" required />
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Pincode:</label>
                            <input type="number" name="pincode" value="<?php echo unserialize($row["address"])["pincode"]; ?>" class="form-control py-4" placeholder="382480" required />
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label class="form-label">City:</label>
                            <input type="text" name="city" value="<?php echo unserialize($row["address"])["city"]; ?>" class="form-control py-4" placeholder="Ahmedabad" required />
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">State:</label>
                            <input type="text" name="state" value="<?php echo unserialize($row["address"])["state"]; ?>" class="form-control py-4" placeholder="Gujarat" required />
                        </div>
                    </div>
                    <div class="btns mt-5">
                        <hr />
                        <button class="py-4 px-5" name="purchase">Purchase<br />₹5000</button>
                    </div>
                </form>
            <?php } ?>
        </div>
    </main>

    <footer>
        <?php include("C:/xampp/htdocs/php/medicine_website/user_panel/footer/footer.php"); ?>
    </footer>
</body>

</html>