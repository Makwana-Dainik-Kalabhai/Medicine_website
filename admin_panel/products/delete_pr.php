<?php
session_start();
include("C:/xampp/htdocs/php/medicine_website/database.php");

if (isset($_SESSION["product_id"])) {
    $product_id = $_SESSION["product_id"];
    //
} else {
    $product_id = $_GET["product_id"];
}

$sel = $conn->prepare("SELECT * FROM `products` WHERE `product_id`=$product_id");
$sel->execute();
$sel = $sel->fetchAll();
$sel = $sel[0];

if ($sel["item_img"] != "") {
    foreach (unserialize($sel["item_img"]) as $img) {
        unlink("C:/xampp/htdocs/php/medicine_website/user_panel/shop/imgs/$img");
    }
}
if ($sel["desc_img"] != "") {
    foreach (unserialize($sel["desc_img"]) as $img) {
        unlink("C:/xampp/htdocs/php/medicine_website/user_panel/shop/desc_imgs/$img");
    }
}
$status = $sel["status"];

$del = $conn->prepare("DELETE FROM `products` WHERE `product_id`=$product_id");
$del->execute();

if ($status == "medicine") {
    header("Location: http://localhost/php/medicine_website/admin_panel/products/medicine_list.php");
} //
else {
    header("Location: http://localhost/php/medicine_website/admin_panel/products/device_list.php");
}
?>