<?php
session_start();
include("C:/xampp/htdocs/php/medicine_website/database.php");

if (isset($_SESSION["product_id"])) {
    $status = $conn->prepare("SELECT `status` FROM `products` WHERE `product_id`=" . $_SESSION["product_id"] . "");
    $status->execute();
    $status = $status->fetchAll();
    $status = $status[0][0];

    $del = $conn->prepare("DELETE FROM `products` WHERE `product_id`=" . $_SESSION["product_id"] . "");
    $del->execute();

    if ($status == "medicine") {
        header("Location: http://localhost/php/medicine_website/admin_panel/products/edit_medicine/edit_medicine.php");
    } //
    else {
        header("Location: http://localhost/php/medicine_website/admin_panel/products/edit_device/edit_device.php");
    }
}
