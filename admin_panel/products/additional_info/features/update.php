<?php
session_start();
include("C:/xampp/htdocs/php/medicine_website/database.php");

$sel = $conn->prepare("SELECT * FROM `products` WHERE `product_id`='" . $_SESSION["product_id"] . "'");
$sel->execute();
$sel = $sel->fetchAll();


//! Update features
if (isset($_POST["update-features"])) {
    $fea = array();

    $i = 0;
    foreach ($sel as $row) {
        if ($row["features"] != null) {

            foreach (unserialize($row["features"]) as $f) {
                if (($i + 1) == $_POST["update-features"]) {
                    if ($_POST["key"][$i] == null && $_POST["value"][$i] != null) {
                        array_push($fea, array($_POST["value"][$i]));
                    }
                    if ($_POST["key"][$i] != null && $_POST["value"][$i] != null) {
                        array_push($fea, array($_POST["key"][$i], $_POST["value"][$i]));
                    }
                    $key = $_POST["key"][$i];

                    //
                } else if ($_POST["key"][$i] == null && $_POST["value"][$i] != null) {
                    array_push($fea, array($f[0]));
                } //
                else if ($_POST["key"][$i] != null && $_POST["value"][$i] != null) {
                    array_push($fea, array($f[0], $f[1]));
                }
                $i++;
            }
        }
    }

    $up = $conn->prepare("UPDATE `products` SET `features`='" . serialize($fea) . "' WHERE `product_id`='" . $_SESSION["product_id"] . "'");
    $up->execute();

    $_SESSION["success"] = "Key \"" . $key . "\" updated successfully";
?>
    <script>
        window.history.back();
    </script>
<?php }




//! Add features
if (isset($_POST["add-features"])) {
    $fea = array();

    foreach ($sel as $row) {
        if ($row["features"] != null) {
            foreach (unserialize($row["features"]) as $f) {

                if (isset($f[0]) && isset($f[1])) {
                    array_push($fea, array($f[0], $f[1]));
                } else if (isset($f[0])) {
                    array_push($fea, array($f[0]));
                }
            }
        }
    }

    if ($_POST["add-key"] != null && $_POST["add-value"] != null) {
        array_push($fea, array($_POST["add-key"], $_POST["add-value"]));
    }
    //
    else if ($_POST["add-value"] != null) {
        array_push($fea, array($_POST["add-value"]));
    }

    $up = $conn->prepare("UPDATE `products` SET `features`='" . serialize($fea) . "' WHERE `product_id`='" . $_SESSION["product_id"] . "'");
    $up->execute();

    $_SESSION["success"] = "Data no. " . $_POST["add-features"] . " added successfully";
?>
    <script>
        window.history.back();
    </script>
<?php }



// ! Delete features
if (isset($_POST["delete-features"])) {
    $fea = array();

    $i = 0;
    foreach ($sel as $row) {
        if ($row["features"] != null) {

            foreach (unserialize($row["features"]) as $f) {
                if (isset($f[0]) && isset($f[1])) {
                    if (($i + 1) != $_POST["delete-features"]) {
                        array_push($fea, array($f[0], $f[1]));
                    }
                } else {
                    if (($i + 1) != $_POST["delete-features"]) {
                        array_push($fea, array($f[0]));
                    }
                }
                //
                if (($i + 1) == $_POST["delete-features"]) {
                    $key = $_POST["key"][$i];
                }
                $i++;
            }
        }
    }

    $up = $conn->prepare("UPDATE `products` SET `features`='" . serialize($fea) . "' WHERE `product_id`='" . $_SESSION["product_id"] . "'");
    $up->execute();

    $_SESSION["success"] = "Key \"" . $key . "\" deleted successfully";
?>
    <script>
        window.history.back();
    </script>
<?php }
?>