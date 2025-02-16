<?php
session_start();
include("C:/xampp/htdocs/php/medicine_website/database.php");

//! Change Description Images
if (isset($_POST["change"])) {
    if ($_FILES["desc-img"]["name"] == null) {
        $_SESSION["error"] = "Please! Select the File";

        if (isset($_SERVER['HTTP_REFERER'])) {
            header("Location: " . $_SERVER['HTTP_REFERER'] . "");;
        }
        return;
    }

    $sel = $conn->prepare("SELECT * FROM `products`");
    $sel->execute();
    $sel = $sel->fetchAll();

    foreach ($sel as $r) {
        if ($r["desc_img"] != null) {
            foreach (unserialize($r["desc_img"]) as $des) {
                if ($_FILES["desc-img"]["name"] == $des) {
                    $contain = true;
                }
            }
        }
    }
    if (isset($contain)) {
        $_SESSION["error"] = "Please! Change name of the Image, Name is already exist";
    } //
    else {
        $desc_img = array();
        $sel = $conn->prepare("SELECT * FROM `products` WHERE `product_id`='" . $_SESSION["product_id"] . "'");
        $sel->execute();
        $sel = $sel->fetchAll();

        foreach ($sel as $r) {
            if ($r["desc_img"] != null) {
                foreach (unserialize($r["desc_img"]) as $des) {
                    array_push($desc_img, $des);
                }
            }
        }

        if (str_contains($_FILES["desc-img"]["name"], "'")) {
            $_FILES["desc-img"]["name"] = explode("'", $_FILES["desc-img"]["name"]);
            $_FILES["desc-img"]["name"] = $_FILES["desc-img"]["name"][0] . $_FILES["desc-img"]["name"][1];
        }
        $desc_img[$_POST["change"] - 1] = $_FILES["desc-img"]["name"];


        $up = $conn->prepare("UPDATE `products` SET `desc_img`='" . serialize($desc_img) . "' WHERE `product_id`='" . $_SESSION["product_id"] . "'");

        if ($up->execute()) {
            move_uploaded_file($_FILES["desc-img"]["tmp_name"], "C:/xampp/htdocs/php/medicine_website/user_panel/shop/desc_imgs/" . $_FILES["desc-img"]["name"] . "");
        } //
        else {
            $_SESSION["error"] = "Please! Change name of the Image";
        }
    }
    if (isset($_SERVER['HTTP_REFERER'])) {
        header("Location: " . $_SERVER['HTTP_REFERER'] . "");;
    }
}



//! Add Description Image
if (isset($_POST["add"])) {
    if ($_FILES["new-img"]["name"] == null) {
        $_SESSION["error"] = "Please! Select the File";

        if (isset($_SERVER['HTTP_REFERER'])) {
            header("Location: " . $_SERVER['HTTP_REFERER'] . "");;
        }
        return;
    }

    $sel = $conn->prepare("SELECT * FROM `products` WHERE `product_id`='" . $_SESSION["product_id"] . "'");
    $sel->execute();
    $sel = $sel->fetchAll();

    foreach ($sel as $r) {
        if ($r["desc_img"] != null) {
            foreach (unserialize($r["desc_img"]) as $des) {
                if ($_FILES["new-img"]["name"] == $des) {
                    $contain = true;
                }
            }
        }
    }
    if (isset($contain)) {
        $_SESSION["error"] = "Please! Check that Image is already exist";
    } //
    else {
        $desc_img = array();

        foreach ($sel as $r) {
            if ($r["desc_img"] != null) {
                foreach (unserialize($r["desc_img"]) as $des) {
                    array_push($desc_img, $des);
                }
            }
        }
        if (str_contains($_FILES["new-img"]["name"], "'")) {
            $_FILES["new-img"]["name"] = explode("'", $_FILES["new-img"]["name"]);
            $_FILES["new-img"]["name"] = $_FILES["new-img"]["name"][0] . $_FILES["new-img"]["name"][1];
        }
        array_push($desc_img, $_FILES["new-img"]["name"]);

        $up = $conn->prepare("UPDATE `products` SET `desc_img`='" . serialize($desc_img) . "' WHERE `product_id`='" . $_SESSION["product_id"] . "'");

        if ($up->execute()) {
            move_uploaded_file($_FILES["new-img"]["tmp_name"], "C:/xampp/htdocs/php/medicine_website/user_panel/shop/desc_imgs/" . $_FILES["new-img"]["name"] . "");
        } //
        else {
            $_SESSION["error"] = "Please! Change name of the Image";
        }
    }
    if (isset($_SERVER['HTTP_REFERER'])) {
        header("Location: " . $_SERVER['HTTP_REFERER'] . "");;
    }
}



// ! Delete Description Image
if (isset($_POST["delete"])) {
    $i = 1;
    $desc_img = array();

    $sel = $conn->prepare("SELECT * FROM `products` WHERE `product_id`='" . $_SESSION["product_id"] . "'");
    $sel->execute();
    $sel = $sel->fetchAll();

    foreach ($sel as $r) {
        if ($r["desc_img"] != null) {
            foreach (unserialize($r["desc_img"]) as $des) {
                if ($i != $_POST["delete"]) {
                    array_push($desc_img, $des);
                }
                $i++;
            }
        }
    }

    $up = $conn->prepare("UPDATE `products` SET `desc_img`='" . serialize($desc_img) . "' WHERE `product_id`='" . $_SESSION["product_id"] . "'");
    $up->execute();

    if (isset($_SERVER['HTTP_REFERER'])) {
        header("Location: " . $_SERVER['HTTP_REFERER'] . "");;
    }
}
