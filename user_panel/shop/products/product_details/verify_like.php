<?php
session_start();
include("C:/xampp/htdocs/php/medicine_website/database.php");

if ($_GET["type"]=="delete") {
    $del = $conn->prepare("DELETE FROM `wishlist` WHERE `email`='".$_SESSION["email"]."' AND `item_code`='" . $_SESSION["item_code"] . "'");
    $del->execute();

    header("Refresh:0; url=http://localhost/php/medicine_website/user_panel/shop/products/product_details/product_details.php");
}

if($_GET["type"]=="insert") {
    $insert = $conn->prepare("INSERT INTO `wishlist` VALUES('".$_SESSION["email"]."','".$_SESSION["item_code"]."')");
    $insert->execute();

    header("Refresh:0; url=http://localhost/php/medicine_website/user_panel/shop/products/product_details/product_details.php");
}
