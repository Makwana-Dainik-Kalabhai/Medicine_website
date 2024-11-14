<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="" method="post">
        <button name="submit">Submit</button>
    </form>
</body>

</html>

<?php
require "autoload.php";

use Razorpay\Api\Api;

use function PHPSTORM_META\map;

$api_key = "rzp_test_omt6wXyJiqN0lX";
$api_secret = "7e63a7DNPonx2Rh3WoDMR3fj";

if (isset($_POST["submit"])) {
    global $api_key, $api_secret;

    $api = new Api($api_key, $api_secret);

    $res = $api->order->create(
        array(
            'receipt' => '123',
            'amount' => 5000,
            'currency' => 'INR',
            'notes' => array('key1' => 'value3', 'key2' => 'value2')
        )
    );

    if (!empty($res["id"])) { ?>
        <form action="http://localhost/php/payment/vendor/success.php" method="POST">
            <script
                src="https://checkout.razorpay.com/v1/checkout.js"
                data-key="rzp_test_omt6wXyJiqN0lX"
                data-amount="5000"
                data-currency="INR"
                data-order_id="<?php echo $res["id"]; ?>"
                data-buttontext="Pay with Razorpay"
                data-name="Acme Corp"
                data-description="A Wild Sheep Chase is the third novel by Japanese author Haruki Murakami"
                data-image="https://example.com/your_logo.jpg"
                data-prefill.name="Makwana Dainik Kalabhai"
                data-prefill.email="dainikmakwana31@.com"
                data-theme.color="#F37254"></script>
            <input type="hidden" custom="Hidden Element" name="hidden" />
        </form>
<?php }
}
?>