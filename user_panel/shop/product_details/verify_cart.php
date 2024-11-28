<?php
session_start();

if(isset($_GET["product_id"]))
{
    $_SESSION["product_id"] = $_GET["product_id"];
}

include("C:/xampp/htdocs/php/medicine_website/database.php");

$sel = $conn->prepare("SELECT * FROM `cart`");
$sel->execute();

$sel = $sel->fetchAll();

foreach ($sel as $row) {
    if ($_SESSION["product_id"] == $row["product_id"]) {
        $conn_item = $row["product_id"];
    }
}

if (isset($conn_item)) {

    header("Refresh:0; url=http://localhost/php/medicine_website/user_panel/cart/cart.php");
}

if (!isset($conn_item)) {
    $insert = $conn->prepare("INSERT INTO `cart` VALUES('" . $_SESSION["email"] . "','" . $_SESSION["product_id"] . "','1')");
    $insert->execute();

    header("Refresh:0; url=http://localhost/php/medicine_website/user_panel/cart/cart.php");
}
