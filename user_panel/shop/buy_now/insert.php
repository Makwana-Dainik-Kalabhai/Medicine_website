<?php
session_start();

include("C:/xampp/htdocs/php/medicine_website/database.php");
class Data
{
    function insertValues()
    {
        global $conn;
        $in = $conn->prepare("INSERT INTO `orders` VALUES('" . $_SESSION["order_id"] . "','" . $_SESSION["name"] . "','" . $_SESSION["email"] . "','" . $_SESSION["phone"] . "','" . $_SESSION["items"] . "','" . $_SESSION["off_price"] . "','" . $_SESSION["price"] . "','" . $_SESSION["quantity"] . "',NOW(),'" . $_SESSION["payment_type"] . "','" . $_SESSION["payment_status"] . "','" . $_SESSION["status"] . "','" . $_SESSION["total"] . "','" . serialize($_SESSION["del_address"]) . "','" . $_SESSION["del_date"] . "','Your Order is Processing for Shipping')");
        $in->execute();
    }

    function updateValues()
    {
        global $conn;
        $sel = $conn->prepare("SELECT * FROM `products`");
        $sel->execute();
        $sel = $sel->fetchAll();

        foreach ($sel as $row) {
            foreach (unserialize($_SESSION["items"]) as $item) {
                if ($row["product_id"] == $item) {
                    $upQua = $row["quantity"] - $item;

                    $up = $conn->prepare("UPDATE `products` SET `quantity`=$upQua WHERE `product_id`='" . $row["product_id"] . "'");
                    $up->execute();
                }
            }
        }
    }
    function deleteValues()
    {
        global $conn;
        $del = $conn->prepare("DELETE FROM `cart` WHERE `email`='" . $_SESSION["email"] . "'");
        $del->execute();
    }
}

$data = new Data();
$data->insertValues();
$data->updateValues();
if (isset($_SESSION["cart"])) $data->deleteValues();

header("Location: http://localhost/php/medicine_website/user_panel/orders/orders.php");