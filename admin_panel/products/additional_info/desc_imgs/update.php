<?php
session_start();
include("C:/xampp/htdocs/php/medicine_website/database.php");

//! Change Description Images
if (isset($_POST["change"])) {
    if (isset($_FILES["desc-img"]) && $_FILES["desc-img"]["name"] != null) {

        $sel = $conn->prepare("SELECT * FROM `products`");
        $sel->execute();
        $sel = $sel->fetchAll();

        foreach ($sel as $r) {
            if ($r["desc_img"] != null) {
                foreach (unserialize($r["desc_img"]) as $key => $des) {
                    if ($_FILES["desc-img"]["name"] == $des && $_POST["change"] != $key) {
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
            $desc_img[$_POST["change"]] = $_FILES["desc-img"]["name"];


            $up = $conn->prepare("UPDATE `products` SET `desc_img`='" . serialize($desc_img) . "' WHERE `product_id`='" . $_SESSION["product_id"] . "'");

            if ($up->execute()) {
                move_uploaded_file($_FILES["desc-img"]["tmp_name"], "C:/xampp/htdocs/php/medicine_website/user_panel/shop/desc_imgs/" . $_FILES["desc-img"]["name"] . "");
                $_SESSION["success"] = "Product Description Image updated Successfully";
            } //
            else {
                $_SESSION["error"] = "Please! Change name of the Image";
            }
        }
    }
    
    //
    else if (isset($_POST["desc-img"]) && $_POST["desc-img"] != null) {
        
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
        $desc_img[$_POST["change"]] = $_POST["desc-img"];
        
        $up = $conn->prepare("UPDATE `products` SET `desc_img`='" . serialize($desc_img) . "' WHERE `product_id`='" . $_SESSION["product_id"] . "'");
        $up->execute();
        $_SESSION["success"] = "Product Description Image updated Successfully";
    }
    //
    else {
        $_SESSION["error"] = "Please! Select the file";
    }
    if (isset($_SERVER['HTTP_REFERER'])) {
        header("Location: " . $_SERVER['HTTP_REFERER'] . "");;
    }
}







//! Add Description Image
if (isset($_POST["add"])) {
    if (isset($_FILES["new-img"]) && $_FILES["new-img"]["name"] != null) {
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

                $_SESSION["success"] = "Product Description Image added Successfully";
            } //
            else {
                $_SESSION["error"] = "Please! Change name of the Image";
            }
        }
    }

    //
    else if (isset($_POST["new-img"]) && $_POST["new-img"] != null) {

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
        array_push($desc_img, $_POST["new-img"]);


        $up = $conn->prepare("UPDATE `products` SET `desc_img`='" . serialize($desc_img) . "' WHERE `product_id`='" . $_SESSION["product_id"] . "'");
        $up->execute();

        $_SESSION["success"] = "Product Description Image added Successfully";
        //
    } else {
        $_SESSION["error"] = "Please! Select the File";
    }
    if (isset($_SERVER['HTTP_REFERER'])) {
        header("Location: " . $_SERVER['HTTP_REFERER'] . "");;
    }
}









// ! Delete Description Image
if (isset($_POST["delete"])) {
    $desc_img = array();

    $sel = $conn->prepare("SELECT * FROM `products` WHERE `product_id`='" . $_SESSION["product_id"] . "'");
    $sel->execute();
    $sel = $sel->fetchAll();

    foreach ($sel as $r) {
        if ($r["desc_img"] != null) {
            foreach (unserialize($r["desc_img"]) as $key => $des) {
                if ($key != $_POST["delete"]) {
                    array_push($desc_img, $des);
                } //
                else if ($key == $_POST["delete"]) {
                    unlink("C:/xampp/htdocs/php/medicine_website/user_panel/shop/desc_imgs/$des");
                }
            }
        }
    }

    $up = $conn->prepare("UPDATE `products` SET `desc_img`='" . serialize($desc_img) . "' WHERE `product_id`='" . $_SESSION["product_id"] . "'");
    $up->execute();

    if (isset($_SERVER['HTTP_REFERER'])) {
        header("Location: " . $_SERVER['HTTP_REFERER'] . "");;
    }
}
