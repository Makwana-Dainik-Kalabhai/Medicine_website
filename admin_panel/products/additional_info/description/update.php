<?php
session_start();
include("C:/xampp/htdocs/php/medicine_website/database.php");

$sel = $conn->prepare("SELECT * FROM `products` WHERE `product_id`='" . $_SESSION["product_id"] . "'");
$sel->execute();
$sel = $sel->fetchAll();


//! Update Description
if (isset($_POST["update-description"])) {
    $desc = array();

    $i = 0;
    foreach ($sel as $row) {
        if ($row["description"] != null) {

            foreach (unserialize($row["description"]) as $d) {
                if (($i + 1) == $_POST["update-description"]) {

                    //* Push only Value on particular index
                    if ($_POST["key"][$i] == null && $_POST["value"][$i] != null) {
                        if (str_contains($_POST["value"][$i], "'")) {
                            $_POST["value"][$i] = explode("'", $_POST["value"][$i]);
                            $_POST["value"][$i] = $_POST["value"][$i][0] . $_POST["value"][$i][1];
                        }
                        array_push($desc, array($_POST["value"][$i]));
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
                        array_push($desc, array($_POST["key"][$i], $_POST["value"][$i]));
                    }
                    $key = $_POST["key"][$i];

                    //
                } else if ($_POST["key"][$i] == null && $_POST["value"][$i] != null) {
                    array_push($desc, array($d[0]));
                } //
                else if ($_POST["key"][$i] != null && $_POST["value"][$i] != null) {
                    array_push($desc, array($d[0], $d[1]));
                }
                $i++;
            }
        }
    }

    $up = $conn->prepare("UPDATE `products` SET `description`='" . serialize($desc) . "' WHERE `product_id`='" . $_SESSION["product_id"] . "'");
    $up->execute();

    $_SESSION["success"] = "Key \"" . $key . "\" updated successfully";

    header("Location: http://localhost/php/medicine_website/admin_panel/products/additional_info/description/description.php");
}




//! Add Description
if (isset($_POST["add-description"])) {
    $desc = array();

    foreach ($sel as $row) {
        if ($row["description"] != null) {
            foreach (unserialize($row["description"]) as $d) {

                if (isset($d[0]) && isset($d[1])) {
                    array_push($desc, array($d[0], $d[1]));
                } else if (isset($d[0])) {
                    array_push($desc, array($d[0]));
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
        array_push($desc, array($_POST["add-key"], $_POST["add-value"]));
    }
    //
    else if ($_POST["add-value"] != null) {
        if (str_contains($_POST["add-value"], "'")) {
            $_POST["add-value"] = explode("'", $_POST["add-value"]);
            $_POST["add-value"] = $_POST["add-value"][0] . $_POST["add-value"][1];
        }
        array_push($desc, array($_POST["add-value"]));
    }

    $up = $conn->prepare("UPDATE `products` SET `description`='" . serialize($desc) . "' WHERE `product_id`='" . $_SESSION["product_id"] . "'");
    $up->execute();

    $_SESSION["success"] = "Data no. " . $_POST["add-description"] . " added successfully";

    header("Location: http://localhost/php/medicine_website/admin_panel/products/additional_info/description/description.php");
}



// ! Delete Description
if (isset($_POST["delete-description"])) {
    $desc = array();

    $i = 0;
    foreach ($sel as $row) {
        if ($row["description"] != null) {

            foreach (unserialize($row["description"]) as $d) {
                if (isset($d[0]) && isset($d[1])) {
                    if (($i + 1) != $_POST["delete-description"]) {
                        array_push($desc, array($d[0], $d[1]));
                    }
                } else {
                    if (($i + 1) != $_POST["delete-description"]) {
                        array_push($desc, array($d[0]));
                    }
                }
                //
                if (($i + 1) == $_POST["delete-description"]) {
                    $key = $_POST["key"][$i];
                }
                $i++;
            }
        }
    }

    $up = $conn->prepare("UPDATE `products` SET `description`='" . serialize($desc) . "' WHERE `product_id`='" . $_SESSION["product_id"] . "'");
    $up->execute();

    $_SESSION["success"] = "Key \"" . $key . "\" deleted successfully";

    header("Location: http://localhost/php/medicine_website/admin_panel/products/additional_info/description/description.php");
}
