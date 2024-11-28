<?php
session_start();
include("C:/xampp/htdocs/php/medicine_website/database.php");

if ($_GET["type"]=="delete") {
    $del = $conn->prepare("DELETE FROM `wishlist` WHERE `email`='".$_SESSION["email"]."' AND `product_id`='" . $_SESSION["product_id"] . "'");
    $del->execute();

    header("Refresh:0; url=http://localhost/php/medicine_website/user_panel/shop/product_details/product_details.php");
}

if($_GET["type"]=="insert") {
    $insert = $conn->prepare("INSERT INTO `wishlist` VALUES('".$_SESSION["email"]."','".$_SESSION["product_id"]."')");
    $insert->execute();

    header("Refresh:0; url=http://localhost/php/medicine_website/user_panel/shop/product_details/product_details.php");
}
