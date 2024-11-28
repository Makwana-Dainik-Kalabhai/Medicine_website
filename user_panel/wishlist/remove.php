<?php
session_start();

include("C:/xampp/htdocs/php/medicine_website/database.php");

$delete = $conn->prepare("DELETE FROM `wishlist` WHERE `email`='" . $_SESSION["email"] . "' AND `product_id`='" . $_GET["remove_item"] . "'");
$delete->execute();

header("Refresh:0; url=http://localhost/php/medicine_website/user_panel/wishlist/wishlist.php")

?>