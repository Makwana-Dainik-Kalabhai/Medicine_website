<?php
session_start();

include("C:/xampp/htdocs/php/medicine_website/database.php");


if (isset($_POST["quantity"]) && isset($_POST["item_code"])) {
    $sel = $conn->prepare("SELECT * FROM `products` WHERE `item_code` = ".$_POST["item_code"]."");
    $sel->execute();
    $sel = $sel->fetchAll();

    foreach($sel as $row) {
        $avQuantity = $row["quantity"];
    }

    $quantity = $_POST["quantity"];
    if (isset($_POST["minus"])) {
        if ($_POST["quantity"] > 1) {
            $quantity = $_POST["quantity"] - 1;
        }
    }
    if (isset($_POST["plus"])) {
        if ($_POST["quantity"] < 5 && $_POST["quantity"]<=$avQuantity) {
            $quantity = $_POST["quantity"] + 1;
        }
    }
    $item_code = $_POST["item_code"];

    $update = $conn->prepare("UPDATE `cart` SET `quantity`='$quantity' WHERE email='" . $_SESSION["email"] . "' AND item_code='$item_code'");
    $update->execute();

    header("Refresh:0; url=http://localhost/php/medicine_website/user_panel/cart/cart.php");

    if (isset($_POST["plus"])) {
        if ($_POST["quantity"] == 10) { ?>
            <script>
                alert("You can order maximum 10 quantity");
            </script>
<?php }
    }
}
?>