<?php
session_start();

if(isset($_GET["item_code"]))
{
    $_SESSION["item_code"] = $_GET["item_code"];
}

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

    header("Refresh:0; url=http://localhost/php/medicine_website/user_panel/cart/cart.php");
}

if (!isset($conn_item)) {
    $insert = $conn->prepare("INSERT INTO `cart` VALUES('" . $_SESSION["email"] . "','" . $_SESSION["item_code"] . "','1','')");
    $insert->execute();

    header("Refresh:0; url=http://localhost/php/medicine_website/user_panel/cart/cart.php");
}
