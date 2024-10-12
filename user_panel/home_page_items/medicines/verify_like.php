<?php
session_start();
include("C:/xampp/htdocs/php/medicine_website/database.php");

if ($_GET["type"]=="delete") {
    $del = $conn->prepare("DELETE FROM `wishlist` WHERE `email`='".$_SESSION["email"]."' AND `item_code`='" . $_GET["item_code"] . "'");
    $del->execute();

    header("Refresh:0; url=http://localhost/php/medicine_website/index.php");
}

if($_GET["type"]=="insert") {
    $insert = $conn->prepare("INSERT INTO `wishlist` VALUES('".$_SESSION["email"]."','".$_GET["item_code"]."')");
    $insert->execute();

    header("Refresh:0; url=http://localhost/php/medicine_website/index.php");
}
?>