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
                if ($i == $_POST["update-how-use"]) {

                    //* Push only Value on particular index
                    if ($_POST["key"][$i] == null && $_POST["value"][$i] != null) {
                        if (str_contains($_POST["value"][$i], "'")) {
                            $_POST["value"][$i] = explode("'", $_POST["value"][$i]);
                            $_POST["value"][$i] = $_POST["value"][$i][0] . $_POST["value"][$i][1];
                        }
                        array_push($how, array($_POST["value"][$i]));
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

    $_SESSION["success"] = "Data No. ".$_POST["update-how-use"]+1 . ") " . " Updated Successfully";

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
        if (str_contains($_POST["add-key"], "'")) {
            $_POST["add-key"] = explode("'", $_POST["add-key"]);
            $_POST["add-key"] = $_POST["add-key"][0] . $_POST["add-key"][1];
        }
        if (str_contains($_POST["add-value"], "'")) {
            $_POST["add-value"] = explode("'", $_POST["add-value"]);
            $_POST["add-value"] = $_POST["add-value"][0] . $_POST["add-value"][1];
        }

        array_push($how, array($_POST["add-key"], $_POST["add-value"]));
    }
    //
    else if ($_POST["add-value"] != null) {
        if (str_contains($_POST["add-value"], "'")) {
            $_POST["add-value"] = explode("'", $_POST["add-value"]);
            $_POST["add-value"] = $_POST["add-value"][0] . $_POST["add-value"][1];
        }

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
                    if ($i != $_POST["delete-how-use"]) {
                        array_push($how, array($h[0], $h[1]));
                    }
                } else {
                    if ($i != $_POST["delete-how-use"]) {
                        array_push($how, array($h[0]));
                    }
                }
                //
                if ($i == $_POST["delete-how-use"]) {
                    $key = $_POST["key"][$i];
                }
                $i++;
            }
        }
    }

    $up = $conn->prepare("UPDATE `products` SET `how_use`='" . serialize($how) . "' WHERE `product_id`='" . $_SESSION["product_id"] . "'");
    $up->execute();

    $_SESSION["success"] = "Data No. ".$_POST["delete-how-use"]+1 . ") " . " Deleted Successfully";
    header("Location: http://localhost/php/medicine_website/admin_panel/products/additional_info/how_use/how_use.php");
}
