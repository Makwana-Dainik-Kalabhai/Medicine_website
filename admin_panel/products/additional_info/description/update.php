<?php
session_start();
include("C:/xampp/htdocs/php/medicine_website/database.php");

//! Update Description
if (isset($_POST["update-description"])) {
    $desc = array();

    for ($i = 0; $i < count($_POST["key"]); $i++) {
        if ($_POST["key"][$i] != null && $_POST["value"][$i] != null) {
            array_push($desc, array($_POST["key"][$i], $_POST["value"][$i]));
        }
        //
        if (($i + 1) == $_POST["update-description"]) {
            $key = $_POST["key"][$i];
        }
    }

    $up = $conn->prepare("UPDATE `products` SET `description`='" . serialize($desc) . "' WHERE `product_id`='" . $_SESSION["product_id"] . "'");
    $up->execute();

    $_SESSION["success"] = "Key \"" . $key . "\" updated successfully";

    header("Refresh:0; url=http://localhost/php/medicine_website/admin_panel/products/additional_info/description/edit_description.php");
}


// ! Delete Description
if (isset($_POST["delete-description"])) {
    $desc = array();

    for ($i = 0; $i < count($_POST["key"]); $i++) {
        if ($_POST["key"][$i] != null && $_POST["value"][$i] != null && ($i + 1) != $_POST["delete-description"]) {
            array_push($desc, array($_POST["key"][$i], $_POST["value"][$i]));
        }
        //
        if (($i + 1) == $_POST["delete-description"]) {
            $key = $_POST["key"][$i];
        }
    }

    $up = $conn->prepare("UPDATE `products` SET `description`='" . serialize($desc) . "' WHERE `product_id`='" . $_SESSION["product_id"] . "'");
    $up->execute();

    $_SESSION["success"] = "Key \"" . $key . "\" deleted successfully";

    header("Refresh:0; url=http://localhost/php/medicine_website/admin_panel/products/additional_info/description/edit_description.php");
}
