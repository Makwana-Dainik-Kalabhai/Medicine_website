<?php
session_start();

include("C:/xampp/htdocs/php/medicine_website/database.php");

$delete = $conn->prepare("DELETE FROM `cart` WHERE `email`='" . $_SESSION["email"] . "' AND `item_code`='" . $_GET["item_code"] . "'");
$delete->execute();

header("Refresh:0; url=http://localhost/php/medicine_website/user_panel/cart/cart.php")

?>