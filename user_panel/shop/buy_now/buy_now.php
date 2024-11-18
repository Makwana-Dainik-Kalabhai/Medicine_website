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
if (isset($_POST["remove_item"])) {
    $up = $conn->prepare("DELETE FROM `cart` WHERE `item_code`='" . $_POST["item_code"] . "'");
    $up->execute();
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
            <h4 class="text-danger">You can Order Maximum 5 quantities.</h4>
            <div class="products">
                <?php
                if (isset($_GET["product"]) && $_GET["product"] == "multiple") {
                    $select = $conn->prepare("SELECT *, cart.quantity FROM cart, products WHERE products.item_code=cart.item_code AND email='" . $_SESSION["email"] . "'");
                    $select->execute();
                    $select = $select->fetchAll();
                } else {
                    $select = $conn->prepare("SELECT * FROM `products` WHERE item_code='" . $_GET["item_code"] . "'");
                    $select->execute();
                    $select = $select->fetchAll();
                }

                include("gen_order_id.php");
                $count = 0;
                foreach ($select as $row) {
                    $prod_qua = $row["quantity"];
                    $date = strtotime($row["delivery_date"]);
                    $delivery = date("d M, Y", $date);
                ?>

                    <!-- //! All Fields related to Product -->
                    <input type="hidden" name="item_arr[]" value="<?php echo $row["item_code"]; ?>" />
                    <input type="hidden" name="off_price_arr[]" value="<?php echo $row["offer_price"]; ?>" />
                    <input type="hidden" name="price_arr[]" value="<?php echo $row["price"]; ?>" />
                    <input type="hidden" name="total" />

                    <div class="card">
                        <button value="<?php echo $row["item_code"]; ?>" class="remove_btn"><i class='fa-solid fa-trash'></i></button>

                        <a href="http://localhost/php/medicine_website/user_panel/shop/product_details/product_details.php?status=<?php echo $row["status"]; ?>&item_code=<?php echo $row['item_code']; ?>">
                            <img src="http://localhost/php/medicine_website/user_panel/shop/imgs/<?php echo unserialize($row["item_img"])[0]; ?>" alt="...">
                            <div class="card-body p-2">
                                <h5 class="card-title m-0"><?php echo $row["name"]; ?></h5>
                                <p class="card-text m-0"><span class="off_price">₹<?php echo $row["offer_price"]; ?></span> <span class="price"><?php if ($row["offer_price"] !== $row["price"]) echo "₹" . $row["price"]; ?></span></p>
                            </div>
                        </a>

                        <!-- //! Quantity -->
                        <label class="form-label mx-2 mt-3">Quantity:</label>
                        <?php if (isset($_GET["product"]) && $_GET["product"] == "multiple") { ?>
                            <input type="number" id="<?php echo $count; ?>" name="quantity_arr[]" value="<?php echo $row["quantity"]; ?>" min="1" max="<?php if ($row["quantity"] < 5) {
                                                                                                                                                            echo $row["quantity"];
                                                                                                                                                        } else {
                                                                                                                                                            echo 5;
                                                                                                                                                        } ?>" class="form-control mx-2 mb-3" />
                        <?php } else { ?>
                            <input type="number" id="<?php echo $count; ?>" value="1" name="quantity_arr[]" min="1" max="<?php if ($row["quantity"] < 5) {
                                                                                                                                echo $row["quantity"];
                                                                                                                            } else {
                                                                                                                                echo 5;
                                                                                                                            } ?>" class="form-control mx-2 mb-3" />
                        <?php }


                        if (isset($_GET["product"]) && $_GET["product"] == "multiple") {
                            $sel = $conn->prepare("SELECT * FROM `products` WHERE item_code='" . $row["item_code"] . "'");
                            $sel->execute();
                            $sel = $sel->fetchAll();

                            $prod_qua = $sel[0]["quantity"];

                            //! Delivery Date
                            date_default_timezone_set('Asia/Calcutta');
                            $date = strtotime("+4 days");

                            $delivery = date("d M, Y", $date);
                        }
                        if ($prod_qua < 5 && $prod_qua > 0) { ?>
                            <p class="not-available">Only <?php echo $prod_qua; ?> Quantity Available</p>
                        <?php } ?>
                    </div>
                <?php $count++;
                } ?>
            </div>
            <h4 class="text-success mt-4">Expected Delivery:&emsp;<?php echo $delivery; ?></h4>

            <?php
            $select = $conn->prepare("SELECT * FROM `user_login_data` WHERE email='" . $_SESSION["email"] . "'");
            $select->execute();
            $select = $select->fetchAll();

            foreach ($select as $row) { ?>
                <form action="http://localhost/php/medicine_website/user_panel/shop/buy_now/success.php" method="post">
                    <!-- //! Order_id -->
                    <input type="hidden" name="form_order_id" value="<?php echo $order_id; ?>" />

                    <?php for ($i = 0; $i < $count; $i++) { ?>
                        <input type="hidden" id="<?php echo "form_items$i"; ?>" name="form_items[]" />
                        <input type="hidden" id="<?php echo "form_off_price$i"; ?>" name="form_off_price[]" />
                        <input type="hidden" id="<?php echo "form_price$i"; ?>" name="form_price[]" />
                        <input type="hidden" id="<?php echo "form_quantity$i"; ?>" name="form_quantity[]" />
                    <?php } ?>
                    <input type="hidden" name="form_total" />
                    <!-- <input type="hidden" name="form_pay_type" /> -->
                    <input type="hidden" name="form_pay_status" />
                    <input type="hidden" name="form_del_date" value="<?php echo $date; ?>" />

                    <div class="user-details">
                        <h4 class="text-danger mt-5">All Fields are required*</h4>
                        <p class="sub-head">Personal Details:</p>
                        <hr />
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label class="form-label">Name:</label>
                                <input type="text" name="form_name" pattern="[a-zA-Z ]*" title="Please! ENter name" id="name" value="<?php echo $row["name"]; ?>" class="form-control py-4" placeholder="User Name" required />
                                <b></b>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Phone:</label>
                                <input type="number" name="form_phone" minlength="10" maxlength="10" title="Please! Enter 10 digits Phone" value="<?php if ($row["phone"] != 0) {
                                                                                                                                                        echo $row["phone"];
                                                                                                                                                    } ?>" class="form-control py-4" maxlength="14" placeholder="0123456789" required />
                                <b></b>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-md-12">
                                <label class="form-label">Email ID:</label>
                                <input type="email" name="form_email" value="<?php echo $row["email"]; ?>" title="Enter valid Email" class="form-control py-4" placeholder="Email ID" required />
                                <b></b>
                            </div>
                        </div>

                        <p class="sub-head">Address:</p>
                        <hr />
                        <div class="row mb-4">
                            <div class="col-md-8">
                                <label class="form-label">Street:</label>
                                <input type="text" name="form_street" value="<?php echo unserialize($row["address"])["street"]; ?>" class="form-control py-4" placeholder="Apartment Name" required />
                                <b></b>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">House no.:</label>
                                <input type="text" name="form_house_no" value="<?php echo unserialize($row["address"])["house_no"]; ?>" class="form-control py-4" placeholder="D/302" required />
                                <b></b>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-md-8">
                                <label class="form-label">Apartment suite:</label>
                                <input type="text" name="form_suite" value="<?php echo unserialize($row["address"])["suite"]; ?>" class="form-control py-4" placeholder="near by Apartment Name" required />
                                <b></b>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Pincode:</label>
                                <input type="number" name="form_pincode" pattern="[0-9]{6}" value="<?php echo unserialize($row["address"])["pincode"]; ?>" class="form-control py-4" placeholder="382480" required />
                                <b></b>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-md-6">
                                <label class="form-label">City:</label>
                                <input type="text" name="form_city" pattern="[a-zA-Z ]*" value="<?php echo unserialize($row["address"])["city"]; ?>" class="form-control py-4" placeholder="Ahmedabad" required />
                                <b></b>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">State:</label>
                                <input type="text" name="form_state" pattern="[a-zA-Z ]*" value="<?php echo unserialize($row["address"])["state"]; ?>" class="form-control py-4" placeholder="Gujarat" required />
                                <b></b>
                            </div>
                        </div>
                    </div>

                    <p class="sub-head">Payment:</p>
                    <hr />
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <label class="form-label">Payment Type:</label>
                            <select name="form_pay_type" id="payment_type" class="form-select py-3">
                                <option value="select"><--Select Payment Type--></option>
                                <option value="Razorpay">Razorpay</option>
                                <option value="Cash On Delivery">Cash On Delivery</option>
                            </select>
                        </div>
                    </div>
                    <button id="rzp-button1" name="pay_now" value="razorpay" class="pay_btn px-5 py-3">Pay Now<br />₹</button>
                    <button name="pay_now" value="purchase" class="purchase px-5 py-3 mt-5"><i class="fa-solid fa-shopping-bag"></i>&ensp;Purchase</button>
                </form>
            <?php } ?>
        </div>
    </main>

    <footer>
        <?php include("C:/xampp/htdocs/php/medicine_website/user_panel/footer/footer.php"); ?>
    </footer>
</body>

</html>