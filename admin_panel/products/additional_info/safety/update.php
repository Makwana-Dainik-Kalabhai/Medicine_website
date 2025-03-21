<?php
session_start();
include("C:/xampp/htdocs/php/medicine_website/database.php");

$sel = $conn->prepare("SELECT * FROM `products` WHERE `product_id`='" . $_SESSION["product_id"] . "'");
$sel->execute();
$sel = $sel->fetchAll();

//! Update safety
if (isset($_POST["update-safety"])) {
    $saf = array();

    $i = 0;
    foreach ($sel as $row) {
        if ($row["safety"] != null) {

            foreach (unserialize($row["safety"]) as $s) {
                if ($i == $_POST["update-safety"]) {

                    //* Push only Value on particular index
                    if ($_POST["key"][$i] == null && $_POST["value"][$i] != null) {
                        if (str_contains($_POST["value"][$i], "'")) {
                            $_POST["value"][$i] = explode("'", $_POST["value"][$i]);
                            $_POST["value"][$i] = $_POST["value"][$i][0] . $_POST["value"][$i][1];
                        }
                        array_push($saf, array($_POST["value"][$i]));
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
                        array_push($saf, array($_POST["key"][$i], $_POST["value"][$i]));
                    }
                    $key = $_POST["key"][$i];

                    //
                } else if ($_POST["key"][$i] == null && $_POST["value"][$i] != null) {
                    array_push($saf, array($s[0]));
                } //
                else if ($_POST["key"][$i] != null && $_POST["value"][$i] != null) {
                    array_push($saf, array($s[0], $s[1]));
                }
                $i++;
            }
        }
    }

    $up = $conn->prepare("UPDATE `products` SET `safety`='" . serialize($saf) . "' WHERE `product_id`='" . $_SESSION["product_id"] . "'");
    $up->execute();

    $_SESSION["success"] = "Data No. ".$_POST["update-safety"]+1 . ") " . " Updated Successfully";
    header("Location: http://localhost/php/medicine_website/admin_panel/products/additional_info/safety/safety.php");
}




//! Add safety
if (isset($_POST["add-safety"])) {
    $saf = array();

    foreach ($sel as $row) {
        if ($row["safety"] != null) {
            foreach (unserialize($row["safety"]) as $s) {

                if (isset($s[0]) && isset($s[1])) {
                    array_push($saf, array($s[0], $s[1]));
                } //
                else if (isset($s[0])) {
                    array_push($saf, array($s[0]));
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
        array_push($saf, array($_POST["add-key"], $_POST["add-value"]));
    }
    //
    else if ($_POST["add-value"] != null) {
        if (str_contains($_POST["add-value"], "'")) {
            $_POST["add-value"] = explode("'", $_POST["add-value"]);
            $_POST["add-value"] = $_POST["add-value"][0] . $_POST["add-value"][1];
        }
        array_push($saf, array($_POST["add-value"]));
    }

    $up = $conn->prepare("UPDATE `products` SET `safety`='" . serialize($saf) . "' WHERE `product_id`='" . $_SESSION["product_id"] . "'");
    $up->execute();

    $_SESSION["success"] = "Data no. " . $_POST["add-safety"] . " added successfully";
    header("Location: http://localhost/php/medicine_website/admin_panel/products/additional_info/safety/safety.php");
}


// ! Delete safety
if (isset($_POST["delete-safety"])) {
    $saf = array();

    $i = 0;
    foreach ($sel as $row) {
        if ($row["safety"] != null) {

            foreach (unserialize($row["safety"]) as $s) {
                if ($i != $_POST["delete-safety"]) {
                    if (isset($s[0]) && isset($s[1])) {
                        array_push($saf, array($s[0], $s[1]));
                    } //
                    else {
                        array_push($saf, array($s[0]));
                    }
                }
                //
                if ($i == $_POST["delete-safety"]) {
                    $key = $_POST["key"][$i];
                }
                $i++;
            }
        }
    }

    $up = $conn->prepare("UPDATE `products` SET `safety`='" . serialize($saf) . "' WHERE `product_id`='" . $_SESSION["product_id"] . "'");
    $up->execute();

    $_SESSION["success"] = "Data No. ".$_POST["delete-safety"]+1 . ") " . " Deleted Successfully";
    header("Location: http://localhost/php/medicine_website/admin_panel/products/additional_info/safety/safety.php");
}
