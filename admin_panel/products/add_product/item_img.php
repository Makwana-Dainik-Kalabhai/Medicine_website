<?php
session_start();
include("C:/xampp/htdocs/php/medicine_website/database.php");


//* Add Product Images
if (isset($_POST["add-item-img"])) {
    if ($_FILES["new-item-img"]["name"] == null) {
        $_SESSION["pr_img_error"] = "Please! Select the File";


        if (isset($_SERVER['HTTP_REFERER'])) {
            header("Location: " . $_SERVER['HTTP_REFERER'] . "");;
        }
        return;
    }

    if (str_contains($_FILES["new-item-img"]["name"], "'")) {
        $_FILES["new-item-img"]["name"] = explode("'", $_FILES["new-item-img"]["name"]);
        $_FILES["new-item-img"]["name"] = $_FILES["new-item-img"]["name"][0] . $_FILES["new-item-img"]["name"][1];
    }


    $sel = $conn->prepare("SELECT * FROM `products` WHERE `product_id`='" . $_SESSION["product_id"] . "'");
    $sel->execute();
    $sel = $sel->fetchAll();

    foreach ($sel as $r) {
        if ($r["item_img"] != null) {
            foreach (unserialize($r["item_img"]) as $img) {
                if ($_FILES["new-item-img"]["name"] == $img) {
                    $contain = true;
                }
            }
        }
    }
    if (isset($contain)) {
        $_SESSION["pr_img_error"] = "Please! Check that Image is already exist this Product";


        if (isset($_SERVER['HTTP_REFERER'])) {
            header("Location: " . $_SERVER['HTTP_REFERER'] . "");;
        }
        return;
    } //
    else {
        $item_img = array();

        foreach ($sel as $r) {
            if ($r["item_img"] != null) {
                foreach (unserialize($r["item_img"]) as $img) {
                    array_push($item_img, $img);
                }
            }
        }
        array_push($item_img, $_FILES["new-item-img"]["name"]);

        $up = $conn->prepare("UPDATE `products` SET `item_img`='" . serialize($item_img) . "' WHERE `product_id`='" . $_SESSION["product_id"] . "'");

        if ($up->execute()) {
            move_uploaded_file($_FILES["new-item-img"]["tmp_name"], "C:/xampp/htdocs/php/medicine_website/user_panel/shop/imgs/" . $_FILES["new-item-img"]["name"] . "");

            $_SESSION["pr_img_suc"] = "Product Image Added Successfully";
        } //
        else {
            $_SESSION["pr_img_error"] = "Something went Wrong";
        }
    }


    if (isset($_SERVER['HTTP_REFERER'])) {
        header("Location: " . $_SERVER['HTTP_REFERER'] . "");;
    }
}





//* Delete Product Image
if (isset($_POST["delete-item-img"])) {
    $i = 1;
    $item_img = array();

    $sel = $conn->prepare("SELECT * FROM `products` WHERE `product_id`='" . $_SESSION["product_id"] . "'");
    $sel->execute();
    $sel = $sel->fetchAll();

    foreach ($sel as $r) {
        if ($r["item_img"] != null) {
            foreach (unserialize($r["item_img"]) as $img) {
                if ($i != $_POST["delete-item-img"]) {
                    array_push($item_img, $img);
                } //
                else if ($i == $_POST["delete-item-img"]) {
                    unlink("C:/xampp/htdocs/php/medicine_website/user_panel/shop/imgs/$img");
                }
                $i++;
            }
        }
    }

    $up = $conn->prepare("UPDATE `products` SET `item_img`='" . serialize($item_img) . "' WHERE `product_id`='" . $_SESSION["product_id"] . "'");
    $up->execute();


    if (isset($_SERVER['HTTP_REFERER'])) {
        header("Location: " . $_SERVER['HTTP_REFERER'] . "");;
    }
}



//* Update Product Images
if (isset($_POST["update-item-img"])) {
    if ($_FILES["item-img"]["name"] == null) {
        $_SESSION["pr_img_error"] = "Please! Select the File";


        if (isset($_SERVER['HTTP_REFERER'])) {
            header("Location: " . $_SERVER['HTTP_REFERER'] . "");;
        }
        return;
    }
    if (str_contains($_FILES["item-img"]["name"], "'")) {
        $_FILES["item-img"]["name"] = explode("'", $_FILES["item-img"]["name"]);
        $_FILES["item-img"]["name"] = $_FILES["item-img"]["name"][0] . $_FILES["item-img"]["name"][1];
    }

    $sel = $conn->prepare("SELECT * FROM `products`");
    $sel->execute();
    $sel = $sel->fetchAll();

    foreach ($sel as $r) {
        if ($r["item_img"] != null) {
            foreach (unserialize($r["item_img"]) as $key => $img) {
                if ($_FILES["item-img"]["name"] == $img && $_POST["update-item-img"] != $key+1) {
                    $contain = true;
                }
            }
        }
    }
    if (isset($contain)) {
        $_SESSION["pr_img_error"] = "Please! Change name of the Image, Name is already exist";
    } //
    else {
        $item_img = array();
        $sel = $conn->prepare("SELECT * FROM `products` WHERE `product_id`='" . $_SESSION["product_id"] . "'");
        $sel->execute();
        $sel = $sel->fetchAll();

        foreach ($sel as $r) {
            if ($r["item_img"] != null) {
                foreach (unserialize($r["item_img"]) as $img) {
                    array_push($item_img, $img);
                }
            }
        }
        $item_img[$_POST["update-item-img"] - 1] = $_FILES["item-img"]["name"];

        $up = $conn->prepare("UPDATE `products` SET `item_img`='" . serialize($item_img) . "' WHERE `product_id`='" . $_SESSION["product_id"] . "'");

        if ($up->execute()) {
            move_uploaded_file($_FILES["item-img"]["tmp_name"], "C:/xampp/htdocs/php/medicine_website/user_panel/shop/imgs/" . $_FILES["item-img"]["name"] . "");
            $_SESSION["pr_img_suc"] = "Product Image Deleted Successfully";
        } //
        else {
            $_SESSION["pr_img_error"] = "Please! Change name of the Image";
        }
    }


    if (isset($_SERVER['HTTP_REFERER'])) {
        header("Location: " . $_SERVER['HTTP_REFERER'] . "");;
    }
}
