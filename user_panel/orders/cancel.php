<?php
session_start();
include("C:/xampp/htdocs/php/medicine_website/database.php");

if (isset($_POST["cancel_yes"])) {
    $cancel = $conn->prepare("UPDATE `orders` SET `status`='Cancelled',`description`='This Order is Cancelled Now.' WHERE `order_id`='" . $_POST["order_id"] . "'");
    $cancel->execute();

    $sel = $conn->prepare("SELECT * FROM `orders` WHERE `order_id`='" . $_POST["order_id"] . "'");
    $sel->execute();
    $sel = $sel->fetchAll();

    foreach ($sel as $row) {
        for ($i = 0; $i < count(unserialize($row["items"])); $i++) {
            $selPro = $conn->prepare("SELECT * FROM `products` WHERE `product_id`='" . unserialize($row["items"])[$i] . "'");
            $selPro->execute();
            $selPro = $selPro->fetchAll();

            foreach ($selPro as $rPro) {
                $upQuan = $rPro["quantity"] + unserialize($row["quantity"])[$i];
            }
            $upPro = $conn->prepare("UPDATE `products` SET `quantity`=$upQuan WHERE `product_id`='" . unserialize($row["items"])[$i] . "'");
            $upPro->execute();
            

            $upTime = $conn->prepare("UPDATE `orders` SET `time`=NOW() WHERE `order_id`='" . $_POST["order_id"] . "'");
            $upTime->execute();
        }
    }
?>
    <script>
        alert("Order Cancelled Successfully");
    </script>
<?php header("Refresh:0; url=http://localhost/php/medicine_website/user_panel/orders/orders.php");
}

if (isset($_POST["cancel_no"])) {
    header("Refresh:0; url=http://localhost/php/medicine_website/user_panel/orders/orders.php");
}
?>