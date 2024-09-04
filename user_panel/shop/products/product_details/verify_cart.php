<?php
session_start();
include("C:/xampp/htdocs/php/medicine_website/database.php");

$sel = $conn->prepare("SELECT * FROM `cart`");
$sel->execute();

$sel = $sel->fetchAll();

foreach ($sel as $row) {
    if ($_SESSION["item_code"] == $row["item_code"]) {
        $conn_item = $row["item_code"];
    }
}

if (isset($conn_item)) {
    $_SESSION["task_fail"] = "Product is already added into the cart";

    header("Refresh:0; url=http://localhost/php/medicine_website/user_panel/shop/products/product_details/product_details.php");
}

if (!isset($conn_item)) {
    $insert = $conn->prepare("INSERT INTO `cart` VALUES('" . $_SESSION["email"] . "','" . $_SESSION["item_code"] . "','1','')");
    $insert->execute();

    $_SESSION["task_success"] = "Product is successfully added into the cart";

    header("Refresh:0; url=http://localhost/php/medicine_website/user_panel/cart/cart.php");
}
