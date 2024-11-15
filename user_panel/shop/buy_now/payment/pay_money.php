<style>
    script {
        background-color: red;
    }
</style>

<script>

</script>
<?php
require "./vendor/autoload.php";

use Razorpay\Api\Api;

use function PHPSTORM_META\map;

$api_key = "rzp_test_omt6wXyJiqN0lX";
$api_secret = "7e63a7DNPonx2Rh3WoDMR3fj";

    global $api_key, $api_secret;

    $api = new Api($api_key, $api_secret);

    $res = $api->order->create(
        array(
            "amount"=>$_POST["total"]*100,
            "currency"=>"INR"
        )
    );

    if (!empty($res["id"])) { ?>
        <form action="http://localhost/php/payment/vendor/success.php" method="POST">
            <script
                src="https://checkout.razorpay.com/v1/checkout.js"
                data-key="rzp_test_omt6wXyJiqN0lX"
                data-amount="<?php echo $_POST["total"];?>"
                data-currency="INR"
                data-order_id="<?php echo $res["id"]; ?>"
                data-buttontext="Pay Now"
                data-name="healthGroup Pvt. Ltd."
                data-description="healthGroup.com is one of the best company that provides best services. We provide best medicines, medical products and healthy life."
                data-image="http://localhost/php/medicine_website/user_panel/header/logo1.png"
                data-prefill.name="<?php echo $_POST["name"]; ?>"
                data-prefill.email="<?php echo $_POST["email"]; ?>"
                data-theme.color="#30819c"></script>
            <input type="hidden" custom="Hidden Element" name="hidden" />
        </form>
<?php }
?>