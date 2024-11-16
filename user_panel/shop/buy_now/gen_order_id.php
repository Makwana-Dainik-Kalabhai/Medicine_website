<?php
include("C:/xampp/htdocs/php/medicine_website/database.php");

$order_id = "";
function genOrderId()
{
    global $order_id;

    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $order_id .= (string)rand(1, 10);

    $order_id .= $chars[rand(0, strlen($chars)-1)];
    $order_id .= (string)rand(100, 1000);
    
    for($i=0; $i<2; $i++) {
        $order_id .= $chars[rand(0, strlen($chars)-1)];
    }
    $order_id .= (string)rand(10, 100);
    
    for($i=0; $i<2; $i++) {
        $order_id .= $chars[rand(0, strlen($chars)-1)];
    }
}
genOrderId();

$sel = $conn->prepare("SELECT * FROM `orders` WHERE `email`='" . $_SESSION["email"] . "'");
$sel->execute();
$sel = $sel->fetchAll();

start:
foreach ($sel as $row) {
    if ($row["order_id"] != null && $row["order_id"] == $order_id) {
        echo "<h1>" . $row["order_id"] . "</h1>";
        genOrderId();
        goto start;
    }
}
