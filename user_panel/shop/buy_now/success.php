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
    }

    #rzp-button1:hover {
        background-color: #e60000;
    }
</style>
<?php
session_start();
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
    public $del_address = array();
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

        array_push($this->del_address, $_POST["form_house_no"]);
        array_push($this->del_address, $_POST["form_street"]);
        array_push($this->del_address, $_POST["form_suite"]);
        array_push($this->del_address, $_POST["form_city"]);
        array_push($this->del_address, $_POST["form_state"]);
        array_push($this->del_address, $_POST["form_pincode"]);

        $this->del_date = date("Y-m-d 00:00:00.000000", $_POST["form_del_date"]);
    }

    function insertValues()
    {
        global $conn;

        if (isset($_POST["items"][2])) {
            $in = $conn->prepare("INSERT INTO `orders` VALUES('" . $this->order_id . "','" . $this->name . "','" . $this->email . "','" . $this->phone . "','" . serialize($this->items) . "','" . serialize($this->off_price) . "','" . serialize($this->price) . "','" . serialize($this->quantity) . "',NOW(),'" . $this->payment_type . "','" . $this->payment_status . "','" . $this->status . "','" . $this->total . "','" . serialize($this->del_address) . "','" . $this->del_date . "')");
            $in->execute();
        } else {
            $in = $conn->prepare("INSERT INTO `orders` VALUES('" . $this->order_id . "','" . $this->name . "','" . $this->email . "','" . $this->phone . "','" . serialize($this->items) . "','" . serialize($this->off_price) . "','" . serialize($this->price) . "','" . serialize($this->quantity) . "',NOW(),'" . $this->payment_type . "','" . $this->payment_status . "','" . $this->status . "','" . $this->total . "','" . serialize($this->del_address) . "','" . $this->del_date . "')");
            $in->execute();
        }
        header("Refresh:0; url=http://localhost/php/medicine_website/user_panel/orders/orders.php");
    }
}

if (isset($_POST["pay_now"]) && $_POST["pay_now"]=="purchase") {
    $data = new Data();
    $data->setValues();
    $data->insertValues();
}

if (isset($_POST["pay_now"]) && $_POST["pay_now"]=="razorpay") {
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
        <div id="pay_now">
            <h1>Confirm Payment?</h1>
            <button id="rzp-button1" class="pay_btn px-5 py-3">Pay Now<br />₹<?php echo $data->total; ?></button>
        </div>
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
                    alert("Order Placed Successfully");
                    <?php $data->insertValues(); ?>
                },
                "callback_url": "http://localhost/php/medicine_website/user_panel/shop/product_details/product_details.php",
                "prefill": {
                    "name": "<?php echo $_POST["form_name"]; ?>",
                    "email": "<?php echo $_POST["form_email"]; ?>",
                    "contact": "<?php echo $_POST["form_phone"]; ?>",
                },
                "notes": {
                    "address": "<?php echo $address; ?>"
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
<?php
    }
} ?>