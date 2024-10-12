<?php
include("C:/xampp/htdocs/php/medicine_website/database.php");

$select = $conn->prepare("SELECT * FROM `ratings` WHERE `item_code`='" . $_SESSION["item_code"] . "'");
$select->execute();
$select = $select->fetchAll();

$total_rate = 0;

$one_star = 0;
$two_star = 0;
$three_star = 0;
$four_star = 0;
$five_star = 0;

foreach ($select as $row) {
    if ($row["rate"] == 1) {
        $one_star++;
    }
    if ($row["rate"] == 2) {
        $two_star++;
    }
    if ($row["rate"] == 3) {
        $three_star++;
    }
    if ($row["rate"] == 4) {
        $four_star++;
    }
    if ($row["rate"] == 5) {
        $five_star++;
    }
    $total_rate++;
}

$avg_one_star = 0;
$avg_two_star = 0;
$avg_three_star = 0;
$avg_four_star = 0;
$avg_five_star = 0;

if ($total_rate != 0) {
    $avg_one_star = ($one_star / $total_rate) * 100;
    $avg_two_star = ($two_star / $total_rate) * 100;
    $avg_three_star = ($three_star / $total_rate) * 100;
    $avg_four_star = ($four_star / $total_rate) * 100;
    $avg_five_star = ($five_star / $total_rate) * 100;
}

$avg_rate = $total_rate / 5;
