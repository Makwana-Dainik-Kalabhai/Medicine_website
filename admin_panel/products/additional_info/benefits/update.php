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
                    if ($_POST["key"][$i] == null && $_POST["value"][$i] != null) {
                        array_push($ben, array($_POST["value"][$i]));
                    }
                    if ($_POST["key"][$i] != null && $_POST["value"][$i] != null) {
                        array_push($ben, array($_POST["key"][$i], $_POST["value"][$i]));
                    }
                    $key = $_POST["key"][$i];

                    //
                } else if ($_POST["key"][$i] == null && $_POST["value"][$i] != null) {
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
?>
    <script>
        window.history.back();
    </script>
<?php }




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
        array_push($ben, array($_POST["add-key"], $_POST["add-value"]));
    }
    //
    else if ($_POST["add-value"] != null) {
        array_push($ben, array($_POST["add-value"]));
    }

    $up = $conn->prepare("UPDATE `products` SET `benefits`='" . serialize($ben) . "' WHERE `product_id`='" . $_SESSION["product_id"] . "'");
    $up->execute();

    $_SESSION["success"] = "Data no. " . $_POST["add-benefits"] . " added successfully";
?>
    <script>
        window.history.back();
    </script>
<?php }



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
?>
    <script>
        window.history.back();
    </script>
<?php }
?>