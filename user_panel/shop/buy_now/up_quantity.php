<?php
session_start();
include("C:/xampp/htdocs/php/medicine_website/database.php");

if(isset($_POST["quantity"]) && isset($_POST["item_code"])) {
    // $up = $conn->prepare("UPDATE `cart` SET `quantity`=".$_POST["quantity"]." WHERE `email`='".$_SESSION["email"]."' AND `item_code`='".$_POST["item_code"]."'");
    $up = $conn->prepare("UPDATE `cart` SET `quantity`='".$_POST["quantity"]."' WHERE `email`='".$_SESSION["email"]."' AND `item_code`='".$_POST["item_code"]."'");
    $up->execute();
} ?>