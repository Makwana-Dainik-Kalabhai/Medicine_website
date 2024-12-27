<?php
session_start();

include("C:/xampp/htdocs/php/medicine_website/database.php");

//! Change Description Images
if (isset($_POST["change"])) {
    if ($_FILES["desc-img"]["name"] == null) {
        $_SESSION["error"] = "Please! Select the File";
        header("Refresh:0; url=http://localhost/php/medicine_website/admin_panel/products/additional_info/desc_imgs/edit_desc_imgs.php");

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
        $desc_img[$_POST["change"] - 1] = $_FILES["desc-img"]["name"];

        $up = $conn->prepare("UPDATE `products` SET `desc_img`='" . serialize($desc_img) . "' WHERE `product_id`='" . $_SESSION["product_id"] . "'");

        if ($up->execute()) {
            move_uploaded_file($_FILES["desc-img"]["tmp_name"], "C:/xampp/htdocs/php/medicine_website/user_panel/shop/desc_imgs/" . $_FILES["desc-img"]["name"] . "");
        } //
        else {
            $_SESSION["error"] = "Please! Change name of the Image";
        }
    }
    header("Refresh:0; url=http://localhost/php/medicine_website/admin_panel/products/additional_info/desc_imgs/edit_desc_imgs.php");
}



//! Add Description Image
if (isset($_POST["add"])) {
    if ($_FILES["new-img"]["name"] == null) {
        $_SESSION["error"] = "Please! Select the File";
        header("Refresh:0; url=http://localhost/php/medicine_website/admin_panel/products/additional_info/desc_imgs/edit_desc_imgs.php");

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
        array_push($desc_img, $_FILES["new-img"]["name"]);

        $up = $conn->prepare("UPDATE `products` SET `desc_img`='" . serialize($desc_img) . "' WHERE `product_id`='" . $_SESSION["product_id"] . "'");

        if ($up->execute()) {
            move_uploaded_file($_FILES["new-img"]["tmp_name"], "C:/xampp/htdocs/php/medicine_website/user_panel/shop/desc_imgs/" . $_FILES["new-img"]["name"] . "");
        } //
        else {
            $_SESSION["error"] = "Please! Change name of the Image";
        }
    }
    header("Refresh:0; url=http://localhost/php/medicine_website/admin_panel/products/additional_info/desc_imgs/edit_desc_imgs.php");
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
                } //
                else if ($i == $_POST["delete"]) {
                    unlink("C:/xampp/htdocs/php/medicine_website/user_panel/shop/desc_imgs/$des");
                }
                $i++;
            }
        }
    }

    $up = $conn->prepare("UPDATE `products` SET `desc_img`='" . serialize($desc_img) . "' WHERE `product_id`='" . $_SESSION["product_id"] . "'");
    $up->execute();

    header("Refresh:0; url=http://localhost/php/medicine_website/admin_panel/products/additional_info/desc_imgs/edit_desc_imgs.php");
}
