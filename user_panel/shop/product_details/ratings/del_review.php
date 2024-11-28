<?php
session_start();
include("C:/xampp/htdocs/php/medicine_website/database.php");

$del = $conn->prepare("DELETE FROM `ratings` WHERE `email`='".$_SESSION["email"]."' AND `product_id`='".$_SESSION["product_id"]."'");
$del->execute();

header("Refresh:0; url=http://localhost/php/medicine_website/user_panel/shop/product_details/product_details.php");
?>