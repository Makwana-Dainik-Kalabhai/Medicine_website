<?php
session_start();
include("C:/xampp/htdocs/php/medicine_website/database.php");

require "./payment/vendor/autoload.php";

use Razorpay\Api\Api;

use function PHPSTORM_META\map;

$api_key = "rzp_test_omt6wXyJiqN0lX";
$api_secret = "7e63a7DNPonx2Rh3WoDMR3fj";

$api = new Api($api_key, $api_secret);
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
                    <input type="hidden" name="total" value="<?php echo $total; ?>" />
                    <input type="hidden" name="delivery_date" value="<?php echo $date; ?>" />

                    <div class="card">
                        <button value="<?php echo $row["item_code"]; ?>" class="remove_btn"><i class='fa-solid fa-trash'></i></button>

                        <a href="http://localhost/php/medicine_website/user_panel/shop/product_details/product_details.php?status=<?php echo $row["status"]; ?>&item_code=<?php echo $row['item_code']; ?>">
                            <img src="http://localhost/php/medicine_website/user_panel/shop/imgs/<?php echo unserialize($row["item_img"])[0]; ?>" alt="...">
                            <div class="card-body p-2">
                                <h5 class="card-title m-0"><?php echo $row["name"]; ?></h5>
                                <p class="card-text m-0"><span class="off_price">₹<?php echo $row["offer_price"]; ?></span> <span class="price"><?php if ($row["offer_price"] !== $row["price"]) echo "₹" . $row["price"]; ?></span></p>
                            </div>
                        </a>

                        <!-- //! Order_id -->
                        <input type="hidden" name="order_id" value="<?php echo $order_id; ?>" />

                        <!-- //! Quantity -->
                        <label class="form-label mx-2 mt-3">Quantity:</label>
                        <?php if (isset($_GET["product"]) && $_GET["product"] == "multiple") { ?>
                            <input type="number" id="<?php echo $count; ?>" name="quantity_arr[]" value="<?php echo $row["quantity"]; ?>" min="1" class="form-control mx-2 mb-3" />
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

                <h4 class="text-danger mt-5">All Fields are required*</h4>

                <p class="sub-head">Personal Details:</p>
                <hr />
                <div class="row mb-4">
                    <div class="col-md-6">
                        <label class="form-label">Name:</label>
                        <input type="text" name="name" pattern="[a-zA-Z ]*" id="name" value="<?php echo $row["name"]; ?>" class="form-control py-4" placeholder="User Name" required />
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Phone:</label>
                        <input type="number" name="phone" pattern="[0-9]{10}" value="<?php if ($row["phone"] != 0) {
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
                <div class="row mb-5">
                    <div class="col-md-6">
                        <label class="form-label">City:</label>
                        <input type="text" name="city" value="<?php echo unserialize($row["address"])["city"]; ?>" class="form-control py-4" placeholder="Ahmedabad" required />
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">State:</label>
                        <input type="text" name="state" value="<?php echo unserialize($row["address"])["state"]; ?>" class="form-control py-4" placeholder="Gujarat" required />
                    </div>
                </div>

                <p class="sub-head">Payment:</p>
                <hr />
                <div class="row mb-4">
                    <div class="col-md-12">
                        <label class="form-label">Payment Type:</label>
                        <select name="payment_type" id="payment_type" class="form-select py-3">
                            <option value="select"><--Select Payment Type--></option>
                            <option value="Razorpay">Razorpay</option>
                            <option value="Cash On Delivery">Cash On Delivery</option>
                        </select>
                    </div>
                </div>
                <button class="purchase px-5 py-3 mt-5"><i class="fa-solid fa-shopping-bag"></i>&ensp;Purchase</button>
                <?php
                if (isset($_GET["product"]) && $_GET["product"] == "multiple") {
                    $sel_items = $conn->prepare("SELECT item_code FROM `cart` WHERE `email`='" . $_SESSION["email"] . "'");
                    $sel_items->execute();
                    $sel_items = $sel_items->fetchAll(); ?>

                <?php }

                $res = $api->order->create(array(
                    'receipt' => '123',
                    'amount' => 100,
                    'currency' => 'INR'
                ));
                if (!empty($res["id"])) { ?>

                    <button id="rzp-button1" class="pay_btn px-5 py-3">Pay Now<br />₹</button>
                    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>

                    <script>
                        let hno = document.querySelector("input[name='house_no']").value;
                        let street = document.querySelector("input[name='street']").value;
                        let suite = document.querySelector("input[name='suite']").value;
                        let city = document.querySelector("input[name='city']").value;
                        let state = document.querySelector("input[name='state']").value;
                        let pin = document.querySelector("input[name='pincode']").value;

                        let add = [hno, street, suite, city, state, pin];

                        var options = {
                            "key": "rzp_test_omt6wXyJiqN0lX",
                            "amount": <?php echo $total * 100; ?>,
                            "currency": "INR",
                            "name": "healthGroup Pvt. Ltd.",
                            "description": "healthGroup.com is one of the best company that provides best services. We provide best medicines, medical products and healthy life.",
                            "image": "http://localhost/php/medicine_website/user_panel/header/logo1.png",
                            "order_id": "<?php echo $res["id"]; ?>",
                            "handler": function(response) {
                                $.ajax({
                                    type: "POST",
                                    url: "success.php",
                                    data: {
                                        order_id: document.querySelector("input[name='order_id']").value,
                                        name: document.querySelector("input[name='name']").value,
                                        email: document.querySelector("input[name='email']").value,
                                        phone: document.querySelector("input[name='phone']").value,
                                        item_code: document.querySelector("textarea[name='item_code']").value,
                                        payment_type: "Razorpay",
                                        payment_status: "Paid",
                                        total: document.querySelector("input[name='total']").value,
                                        delivery_address: add,
                                        delivery_date: document.querySelector("input[name='delivery_date']").value,
                                    },
                                    success: function() {
                                        alert("Order Placed Successfully");
                                    }
                                });
                            },
                            "callback_url": "http://localhost/php/medicine_website/user_panel/shop/product_details/product_details.php",
                            "prefill": {
                                "name": document.querySelector("input[name='name']").value,
                                "email": document.querySelector("input[name='email']").value,
                                "contact": document.querySelector("input[name='phone']").value
                            },
                            "notes": {
                                "address": add
                            },
                            "theme": {
                                "color": "#30819c"
                            }
                        };
                        var rzp1 = new Razorpay(options);
                        rzp1.on('payment.failed', function(response) {
                            alert("Transaction Failed");
                        });

                        document.getElementById('rzp-button1').onclick = function(e) {
                            rzp1.open();
                            e.preventDefault();
                        }
                    </script>
                <?php } ?>
            <?php } ?>
        </div>
    </main>

    <footer>
        <?php include("C:/xampp/htdocs/php/medicine_website/user_panel/footer/footer.php"); ?>
    </footer>
</body>

</html>