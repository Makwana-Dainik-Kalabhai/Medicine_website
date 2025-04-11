<?php
session_start();
if (!isset($_SESSION["email"])) { ?>
    <script>
        window.history.go(-2);
    </script>
<?php } ?>

<style>
    * {
        background-color: #f2f2f2;
    }

    #pay_now {
        position: absolute;
        top: 15%;
        left: 35%;
        width: 350px;
        padding: 2% 3%;
        background-color: white;
        box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
        border-radius: 5px;
    }

    h1 {
        background-color: transparent;
        line-height: 3 !important;
    }

    #rzp-button1 {
        padding: 2% 7%;
        font-size: 16px;
        font-weight: 600;
        color: white;
        background-color: red;
        border: none;
        border-radius: 3px;
        cursor: pointer;
        margin-right: 5%;
    }

    #rzp-button1:hover {
        background-color: #e60000;
    }
</style>

<?php
include("C:/xampp/htdocs/php/medicine_website/database.php");

require "./payment/vendor/autoload.php";

use Razorpay\Api\Api;

use function PHPSTORM_META\map;

$api_key = "rzp_test_omt6wXyJiqN0lX";
$api_secret = "7e63a7DNPonx2Rh3WoDMR3fj";

$api = new Api($api_key, $api_secret);

class Data
{
    public $order_id;
    public $name;
    public $email;
    public $phone;
    public $items;
    public $off_price;
    public $price;
    public $quantity;
    public $payment_type;
    public $payment_status;
    public $status;
    public $total;
    public $del_address;
    public $del_date;

    function setValues()
    {
        $this->order_id = $_POST["form_order_id"];
        $this->name = $_POST["form_name"];
        $this->email = $_POST["form_email"];
        $this->phone = $_POST["form_phone"];

        $this->items = serialize($_POST["form_items"]);
        $this->off_price = serialize($_POST["form_off_price"]);
        $this->price = serialize($_POST["form_price"]);
        $this->quantity = serialize($_POST["form_quantity"]);

        $this->payment_type = $_POST["form_pay_type"];
        $this->payment_status = $_POST["form_pay_status"];
        $this->status = "Processing";
        $this->total = $_POST["form_total"];

        $this->del_address = array(
            "house_no" => $_POST["form_house_no"],
            "street" => $_POST["form_street"],
            "suite" => $_POST["form_suite"],
            "city" => $_POST["form_city"],
            "state" => $_POST["form_state"],
            "pincode" => $_POST["form_pincode"]
        );

        $this->del_date = date("Y-m-d 00:00:00.000000", $_POST["form_del_date"]);

        //! Sessions
        $_SESSION["order_id"] = $_POST["form_order_id"];
        $_SESSION["name"] = $_POST["form_name"];
        $_SESSION["email"] = $_POST["form_email"];
        $_SESSION["phone"] = $_POST["form_phone"];
        $_SESSION["items"] = serialize($_POST["form_items"]);
        $_SESSION["off_price"] = serialize($_POST["form_off_price"]);
        $_SESSION["price"] = serialize($_POST["form_price"]);
        $_SESSION["quantity"] = serialize($_POST["form_quantity"]);
        $_SESSION["payment_type"] = $_POST["form_pay_type"];
        $_SESSION["payment_status"] = $_POST["form_pay_status"];
        $_SESSION["status"] = "Processing";
        $_SESSION["total"] = $_POST["form_total"];
        $_SESSION["del_address"] = array(
            "house_no" => $_POST["form_house_no"],
            "street" => $_POST["form_street"],
            "suite" => $_POST["form_suite"],
            "city" => $_POST["form_city"],
            "state" => $_POST["form_state"],
            "pincode" => $_POST["form_pincode"]
        );
        $_SESSION["del_date"] = date("Y-m-d 00:00:00.000000", $_POST["form_del_date"]);
    }

    function insertValues()
    {
        global $conn;
        $in = $conn->prepare("INSERT INTO `orders` VALUES('" . $this->order_id . "','" . $this->name . "','" . $this->email . "','" . $this->phone . "','" . $this->items . "','" . $this->off_price . "','" . $this->price . "','" . $this->quantity . "',NOW(),'" . $this->payment_type . "','" . $this->payment_status . "','" . $this->status . "','" . $this->total . "','" . serialize($this->del_address) . "','" . $this->del_date . "','Your Order is Processing for Shipping')");
        $in->execute();
    }

    function updateValues()
    {
        global $conn;
        $sel = $conn->prepare("SELECT * FROM `products`");
        $sel->execute();
        $sel = $sel->fetchAll();

        foreach ($sel as $row) {
            if (isset($_POST["form_items"][1])) {
                for ($i = 0; $i < count($_POST["form_items"]); $i++) {
                    if ($row["product_id"] == $_POST["form_items"][$i]) {
                        $upQua = $row["quantity"] - $_POST["form_quantity"][$i];

                        $up = $conn->prepare("UPDATE `products` SET `quantity`=$upQua WHERE `product_id`='" . $row["product_id"] . "'");
                        $up->execute();
                    }
                }
            } else {
                if ($row["product_id"] == implode(",", $_POST["form_items"])) {
                    $upQua = $row["quantity"] - implode(",", $_POST["form_quantity"]);

                    $up = $conn->prepare("UPDATE `products` SET `quantity`=$upQua WHERE `product_id`='" . $row["product_id"] . "'");
                    $up->execute();
                }
            }
        }
    }
    function deleteValues()
    {
        global $conn;
        $del = $conn->prepare("DELETE FROM `cart` WHERE `email`='" . $_SESSION["email"] . "'");
        $del->execute();
    }
}

if (isset($_POST["pay_now"]) && $_POST["pay_now"] == "purchase") {
    $data = new Data();
    $data->setValues();
    $data->insertValues();
    $data->updateValues();
    if (isset($_SESSION["cart"])) $data->deleteValues();
?>
    <script>
        window.location.href = "http://localhost/php/medicine_website/user_panel/orders/orders.php";
        alert("Order Placed Successfully");
    </script>
    <?php
}

if (isset($_POST["pay_now"]) && $_POST["pay_now"] == "razorpay") {
    global $api;
    $data = new Data();
    $data->setValues();

    $address = $_POST["form_house_no"] . " " . $_POST["form_street"] . "near " . $_POST["form_suite"] . " " . $_POST["form_city"] . ", " . $_POST["form_state"] . " - " . $_POST["form_pincode"];

    $res = $api->order->create(array(
        'receipt' => '123',
        'amount' => $data->total * 100,
        'currency' => 'INR'
    ));
    if (!empty($res["id"])) { ?>
        <script src="https://checkout.razorpay.com/v1/checkout.js"></script>

        <script>
            var options = {
                "key": "rzp_test_omt6wXyJiqN0lX",
                "amount": <?php echo $data->total * 100; ?>,
                "currency": "INR",
                "name": "healthGroup Pvt. Ltd.",
                "description": "healthGroup.com is one of the best company that provides best services. We provide best medicines, medical products and healthy life.",
                "image": "http://localhost/php/medicine_website/user_panel/header/logo1.png",
                "order_id": "<?php echo $res["id"]; ?>",
                "handler": function(response) {
                    window.location.href = "insert.php";
                },
                "prefill": {
                    "name": "<?php echo $data->name; ?>",
                    "email": "<?php echo $data->email; ?>",
                    "contact": <?php echo $data->phone; ?>,
                },
                "notes": {
                    "address": "<?php echo $address; ?>"
                },
                "theme": {
                    "color": "#30819c"
                }
            };
            var rzp1 = new Razorpay(options);
            rzp1.open();
            rzp1.on('payment.failed', function(response) {
                alert("Transaction Failed");
            });
        </script>
<?php
    }
} ?>