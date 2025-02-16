<?php
session_start();
include("C:/xampp/htdocs/php/medicine_website/database.php");

$sel = $conn->prepare("SELECT * FROM `products` WHERE `product_id`='" . $_SESSION["product_id"] . "'");
$sel->execute();
$sel = $sel->fetchAll();


//! Update benefits
if (isset($_POST["update-benefits"])) {
    $ben = array();

    $i = 0;
    foreach ($sel as $row) {
        if ($row["benefits"] != null) {

            foreach (unserialize($row["benefits"]) as $b) {
                if (($i + 1) == $_POST["update-benefits"]) {
                    //* Push only Value on particular index
                    if ($_POST["key"][$i] == null && $_POST["value"][$i] != null) {

                        if (str_contains($_POST["value"][$i], "'")) {
                            $_POST["value"][$i] = explode("'", $_POST["value"][$i]);
                            $_POST["value"][$i] = $_POST["value"][$i][0] . $_POST["value"][$i][1];
                        }
                        array_push($ben, array($_POST["value"][$i]));
                    }

                    //* Push Key & Value on particular index
                    if ($_POST["key"][$i] != null && $_POST["value"][$i] != null) {
                        if (str_contains($_POST["key"][$i], "'")) {
                            $_POST["key"][$i] = explode("'", $_POST["key"][$i]);
                            $_POST["key"][$i] = $_POST["key"][$i][0] . $_POST["key"][$i][1];
                        }
                        if (str_contains($_POST["value"][$i], "'")) {
                            $_POST["value"][$i] = explode("'", $_POST["value"][$i]);
                            $_POST["value"][$i] = $_POST["value"][$i][0] . $_POST["value"][$i][1];
                        }
                        array_push($ben, array($_POST["key"][$i], $_POST["value"][$i]));
                    }
                    $key = $_POST["key"][$i];
                }



                //* Push Value from database
                else if ($_POST["key"][$i] == null && $_POST["value"][$i] != null) {
                    array_push($ben, array($b[0]));
                } //
                else if ($_POST["key"][$i] != null && $_POST["value"][$i] != null) {
                    array_push($ben, array($b[0], $b[1]));
                }
                $i++;
            }
        }
    }

    $up = $conn->prepare("UPDATE `products` SET `benefits`='" . serialize($ben) . "' WHERE `product_id`='" . $_SESSION["product_id"] . "'");
    $up->execute();

    $_SESSION["success"] = "Key \"" . $key . "\" updated successfully";

    header("Location: http://localhost/php/medicine_website/admin_panel/products/additional_info/benefits/benefits.php");
}




//! Add benefits
if (isset($_POST["add-benefits"])) {
    $ben = array();

    foreach ($sel as $row) {
        if ($row["benefits"] != null) {
            foreach (unserialize($row["benefits"]) as $b) {

                if (isset($b[0]) && isset($b[1])) {
                    array_push($ben, array($b[0], $b[1]));
                } else if (isset($b[0])) {
                    array_push($ben, array($b[0]));
                }
            }
        }
    }

    if ($_POST["add-key"] != null && $_POST["add-value"] != null) {
        if (str_contains($_POST["add-key"], "'")) {
            $_POST["add-key"] = explode("'", $_POST["add-key"]);
            $_POST["add-key"] = $_POST["add-key"][0] . $_POST["add-key"][1];
        }
        if (str_contains($_POST["add-value"], "'")) {
            $_POST["add-value"] = explode("'", $_POST["add-value"]);
            $_POST["add-value"] = $_POST["add-value"][0] . $_POST["add-value"][1];
        }
        array_push($ben, array($_POST["add-key"], $_POST["add-value"]));
    } //

    else if ($_POST["add-value"] != null) {
        if (str_contains($_POST["add-value"], "'")) {
            $_POST["add-value"] = explode("'", $_POST["add-value"]);
            $_POST["add-value"] = $_POST["add-value"][0] . $_POST["add-value"][1];
        }
        array_push($ben, array($_POST["add-value"]));
    }

    $up = $conn->prepare("UPDATE `products` SET `benefits`='" . serialize($ben) . "' WHERE `product_id`='" . $_SESSION["product_id"] . "'");
    $up->execute();

    $_SESSION["success"] = "Data no. " . $_POST["add-benefits"] . " added successfully";

    header("Location: http://localhost/php/medicine_website/admin_panel/products/additional_info/benefits/benefits.php");
}



// ! Delete benefits
if (isset($_POST["delete-benefits"])) {
    $ben = array();

    $i = 0;
    foreach ($sel as $row) {
        if ($row["benefits"] != null) {

            foreach (unserialize($row["benefits"]) as $b) {
                if (isset($b[0]) && isset($b[1])) {
                    if (($i + 1) != $_POST["delete-benefits"]) {
                        array_push($ben, array($b[0], $b[1]));
                    }
                } else {
                    if (($i + 1) != $_POST["delete-benefits"]) {
                        array_push($ben, array($b[0]));
                    }
                }
                //
                if (($i + 1) == $_POST["delete-benefits"]) {
                    $key = $_POST["key"][$i];
                }
                $i++;
            }
        }
    }

    $up = $conn->prepare("UPDATE `products` SET `benefits`='" . serialize($ben) . "' WHERE `product_id`='" . $_SESSION["product_id"] . "'");
    $up->execute();

    $_SESSION["success"] = "Key \"" . $key . "\" deleted successfully";

    header("Location: http://localhost/php/medicine_website/admin_panel/products/additional_info/benefits/benefits.php");
}
