<?php
session_start();
include("C:/xampp/htdocs/php/medicine_website/database.php");

$sel = $conn->prepare("SELECT * FROM `products` WHERE `product_id`='" . $_SESSION["product_id"] . "'");
$sel->execute();
$sel = $sel->fetchAll();


//! Update how_use
if (isset($_POST["update-how-use"])) {
    $how = array();

    $i = 0;
    foreach ($sel as $row) {
        if ($row["how_use"] != null) {

            foreach (unserialize($row["how_use"]) as $h) {
                if (($i + 1) == $_POST["update-how-use"]) {
                    if ($_POST["key"][$i] == null && $_POST["value"][$i] != null) {
                        array_push($how, array($_POST["value"][$i]));
                    }
                    if ($_POST["key"][$i] != null && $_POST["value"][$i] != null) {
                        array_push($how, array($_POST["key"][$i], $_POST["value"][$i]));
                    }
                    $key = $_POST["key"][$i];

                    //
                } else if ($_POST["key"][$i] == null && $_POST["value"][$i] != null) {
                    array_push($how, array($h[0]));
                } //
                else if ($_POST["key"][$i] != null && $_POST["value"][$i] != null) {
                    array_push($how, array($h[0], $h[1]));
                }
                $i++;
            }
        }
    }

    $up = $conn->prepare("UPDATE `products` SET `how_use`='" . serialize($how) . "' WHERE `product_id`='" . $_SESSION["product_id"] . "'");
    $up->execute();

    $_SESSION["success"] = "Key \"" . $key . "\" updated successfully";

    header("Location: http://localhost/php/medicine_website/admin_panel/products/additional_info/how_use/how_use.php");
}




//! Add how_use
if (isset($_POST["add-how-use"])) {
    $how = array();

    foreach ($sel as $row) {
        if ($row["how_use"] != null) {
            foreach (unserialize($row["how_use"]) as $h) {

                if (isset($h[0]) && isset($h[1])) {
                    array_push($how, array($h[0], $h[1]));
                } else if (isset($h[0])) {
                    array_push($how, array($h[0]));
                }
            }
        }
    }

    if ($_POST["add-key"] != null && $_POST["add-value"] != null) {
        array_push($how, array($_POST["add-key"], $_POST["add-value"]));
    }
    //
    else if ($_POST["add-value"] != null) {
        array_push($how, array($_POST["add-value"]));
    }

    $up = $conn->prepare("UPDATE `products` SET `how_use`='" . serialize($how) . "' WHERE `product_id`='" . $_SESSION["product_id"] . "'");
    $up->execute();

    $_SESSION["success"] = "Data no. " . $_POST["add-how-use"] . " added successfully";
    header("Location: http://localhost/php/medicine_website/admin_panel/products/additional_info/how_use/how_use.php");
}



//! Delete how-use
if (isset($_POST["delete-how-use"])) {
    $how = array();

    $i = 0;
    foreach ($sel as $row) {
        if ($row["how_use"] != null) {

            foreach (unserialize($row["how_use"]) as $h) {
                if (isset($h[0]) && isset($h[1])) {
                    if (($i + 1) != $_POST["delete-how-use"]) {
                        array_push($how, array($h[0], $h[1]));
                    }
                } else {
                    if (($i + 1) != $_POST["delete-how-use"]) {
                        array_push($how, array($h[0]));
                    }
                }
                //
                if (($i + 1) == $_POST["delete-how-use"]) {
                    $key = $_POST["key"][$i];
                }
                $i++;
            }
        }
    }

    $up = $conn->prepare("UPDATE `products` SET `how_use`='" . serialize($how) . "' WHERE `product_id`='" . $_SESSION["product_id"] . "'");
    $up->execute();

    $_SESSION["success"] = "Key \"" . $key . "\" deleted successfully";
    header("Location: http://localhost/php/medicine_website/admin_panel/products/additional_info/how_use/how_use.php");
}
?>