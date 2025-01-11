<?php
session_start();
include("C:/xampp/htdocs/php/medicine_website/database.php");

$sel = $conn->prepare("SELECT * FROM `products` WHERE `product_id`='" . $_SESSION["product_id"] . "'");
$sel->execute();
$sel = $sel->fetchAll();

//! Update other_info
if (isset($_POST["update-other-info"])) {
    $other = array();

    $i = 0;
    foreach ($sel as $row) {
        if ($row["other_info"] != null) {

            foreach (unserialize($row["other_info"]) as $o) {
                if (($i + 1) == $_POST["update-other-info"]) {
                    if ($_POST["key"][$i] == null && $_POST["value"][$i] != null) {
                        array_push($other, array($_POST["value"][$i]));
                    }
                    if ($_POST["key"][$i] != null && $_POST["value"][$i] != null) {
                        array_push($other, array($_POST["key"][$i], $_POST["value"][$i]));
                    }
                    $key = $_POST["key"][$i];

                    //
                } else if ($_POST["key"][$i] == null && $_POST["value"][$i] != null) {
                    array_push($other, array($o[0]));
                } //
                else if ($_POST["key"][$i] != null && $_POST["value"][$i] != null) {
                    array_push($other, array($o[0], $o[1]));
                }
                $i++;
            }
        }
    }

    $up = $conn->prepare("UPDATE `products` SET `other_info`='" . serialize($other) . "' WHERE `product_id`='" . $_SESSION["product_id"] . "'");
    $up->execute();

    $_SESSION["success"] = "Key \"" . $key . "\" updated successfully";
    header("Location: http://localhost/php/medicine_website/admin_panel/products/additional_info/other_info/other_info.php");
}




//! Add other_info
if (isset($_POST["add-other-info"])) {
    $other = array();

    foreach ($sel as $row) {
        if ($row["other_info"] != null) {
            foreach (unserialize($row["other_info"]) as $o) {

                if (isset($o[0]) && isset($o[1])) {
                    array_push($other, array($o[0], $o[1]));
                } //
                else if (isset($o[0])) {
                    array_push($other, array($o[0]));
                }
            }
        }
    }

    if ($_POST["add-key"] != null && $_POST["add-value"] != null) {
        array_push($other, array($_POST["add-key"], $_POST["add-value"]));
    }
    //
    else if ($_POST["add-value"] != null) {
        array_push($other, array($_POST["add-value"]));
    }

    $up = $conn->prepare("UPDATE `products` SET `other_info`='" . serialize($other) . "' WHERE `product_id`='" . $_SESSION["product_id"] . "'");
    $up->execute();

    $_SESSION["success"] = "Data no. " . $_POST["add-other-info"] . " added successfully";
    header("Location: http://localhost/php/medicine_website/admin_panel/products/additional_info/other_info/other_info.php");
}


// ! Delete other_info
if (isset($_POST["delete-other-info"])) {
    $other = array();

    $i = 0;
    foreach ($sel as $row) {
        if ($row["other_info"] != null) {

            foreach (unserialize($row["other_info"]) as $o) {
                if (isset($o[0]) && isset($o[1])) {
                    if (($i + 1) != $_POST["delete-other-info"]) {
                        array_push($other, array($o[0], $o[1]));
                    }
                } else {
                    if (($i + 1) != $_POST["delete-other-info"]) {
                        array_push($other, array($o[0]));
                    }
                }
                //
                if (($i + 1) == $_POST["delete-other-info"]) {
                    $key = $_POST["key"][$i];
                }
                $i++;
            }
        }
    }

    $up = $conn->prepare("UPDATE `products` SET `other_info`='" . serialize($other) . "' WHERE `product_id`='" . $_SESSION["product_id"] . "'");
    $up->execute();

    $_SESSION["success"] = "Key \"" . $key . "\" deleted successfully";
    header("Location: http://localhost/php/medicine_website/admin_panel/products/additional_info/other_info/other_info.php");
    } ?>