<style></style>
<?php
session_start();
include("C:/xampp/htdocs/php/medicine_website/database.php"); ?>

<form action="" method="post">
    <input type="hidden" name="order_id" value="<?php echo $_GET["order_id"]; ?>" />
    <h1>Are you sure to Cancel the Order?</h1>
    <button name="yes">Yes</button>
    <button name="no">No</button>
</form>

<?php
if (isset($_POST["yes"])) {
    $cancel = $conn->prepare("UPDATE `order` SET `status`='Cancelled' WHERE `order_id`='".$_POST["order_id"]."'");
    $cancel->execute(); ?>
    <script>alert("Order Cancelled Successfully");</script>
    <?php header("Refresh:0; url=http://localhost/php/medicine_website/user_panel/orders/orders.php");
}

if (isset($_POST["no"])) {
    header("Refresh:0; url=http://localhost/php/medicine_website/user_panel/orders/orders.php");
}
?>