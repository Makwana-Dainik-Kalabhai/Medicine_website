<?php
session_start();
include("C:/xampp/htdocs/php/medicine_website/database.php");

$sel = $conn->prepare("SELECT * FROM `products` WHERE `product_id`='" . $_SESSION["product_id"] . "'");
$sel->execute();
$sel = $sel->fetchAll();


//! Update specification
if (isset($_POST["update-specification"])) {
    $spe = array();

    $i = 0;
    foreach ($sel as $row) {
        if ($row["specification"] != null) {

            foreach (unserialize($row["specification"]) as $s) {
                if (($i + 1) == $_POST["update-specification"]) {
                    if ($_POST["key"][$i] == null && $_POST["value"][$i] != null) {
                        array_push($spe, array($_POST["value"][$i]));
                    }
                    if ($_POST["key"][$i] != null && $_POST["value"][$i] != null) {
                        array_push($spe, array($_POST["key"][$i], $_POST["value"][$i]));
                    }
                    $key = $_POST["key"][$i];

                    //
                } else if ($_POST["key"][$i] == null && $_POST["value"][$i] != null) {
                    array_push($spe, array($s[0]));
                } //
                else if ($_POST["key"][$i] != null && $_POST["value"][$i] != null) {
                    array_push($spe, array($s[0], $s[1]));
                }
                $i++;
            }
        }
    }

    $up = $conn->prepare("UPDATE `products` SET `specification`='" . serialize($spe) . "' WHERE `product_id`='" . $_SESSION["product_id"] . "'");
    $up->execute();

    $_SESSION["success"] = "Key \"" . $key . "\" updated successfully";
?>
    <script>
        window.history.back();
    </script>
<?php }




//! Add specification
if (isset($_POST["add-specification"])) {
    $spe = array();

    foreach ($sel as $row) {
        if ($row["specification"] != null) {
            foreach (unserialize($row["specification"]) as $s) {

                if (isset($s[0]) && isset($s[1])) {
                    array_push($spe, array($s[0], $s[1]));
                } else if (isset($s[0])) {
                    array_push($spe, array($s[0]));
                }
            }
        }
    }

    if ($_POST["add-key"] != null && $_POST["add-value"] != null) {
        array_push($spe, array($_POST["add-key"], $_POST["add-value"]));
    }
    //
    else if ($_POST["add-value"] != null) {
        array_push($spe, array($_POST["add-value"]));
    }

    $up = $conn->prepare("UPDATE `products` SET `specification`='" . serialize($spe) . "' WHERE `product_id`='" . $_SESSION["product_id"] . "'");
    $up->execute();

    $_SESSION["success"] = "Data no. " . $_POST["add-specification"] . " added successfully";
?>
    <script>
        window.history.back();
    </script>
<?php }



// ! Delete specification
if (isset($_POST["delete-specification"])) {
    $spe = array();

    $i = 0;
    foreach ($sel as $row) {
        if ($row["specification"] != null) {

            foreach (unserialize($row["specification"]) as $s) {
                if (isset($s[0]) && isset($s[1])) {
                    if (($i + 1) != $_POST["delete-specification"]) {
                        array_push($spe, array($s[0], $s[1]));
                    }
                } else {
                    if (($i + 1) != $_POST["delete-specification"]) {
                        array_push($spe, array($s[0]));
                    }
                }
                //
                if (($i + 1) == $_POST["delete-specification"]) {
                    $key = $_POST["key"][$i];
                }
                $i++;
            }
        }
    }

    $up = $conn->prepare("UPDATE `products` SET `specification`='" . serialize($spe) . "' WHERE `product_id`='" . $_SESSION["product_id"] . "'");
    $up->execute();

    $_SESSION["success"] = "Key \"" . $key . "\" deleted successfully";
?>
    <script>
        window.history.back();
    </script>
<?php }
?>