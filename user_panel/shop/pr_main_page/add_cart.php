<?php
session_start();
include("C:/xampp/htdocs/php/medicine_website/database.php");

if (isset($_POST["add_cart"])) {
    $sel = $conn->prepare("SELECT * FROM `cart` WHERE `email`='" . $_SESSION["email"] . "'");
    $sel->execute();

    $sel = $sel->fetchAll();

    foreach ($sel as $row) {
        if ($_POST["add_cart"] == $row["product_id"]) {
            header("Refresh:0; url=http://localhost/php/medicine_website/user_panel/cart/cart.php");
            return;
        }
    }

    $insert = $conn->prepare("INSERT INTO `cart` VALUES('" . $_SESSION["email"] . "','" . $_POST["add_cart"] . "','1')");
    $insert->execute();
    header("Refresh:0; url=http://localhost/php/medicine_website/user_panel/cart/cart.php");
}
?>