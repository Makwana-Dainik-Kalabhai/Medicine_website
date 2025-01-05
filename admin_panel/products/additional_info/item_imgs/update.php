<?php
session_start();
include("C:/xampp/htdocs/php/medicine_website/database.php");

//* Change Product Images
if (isset($_POST["change"])) {
    if ($_FILES["item-img"]["name"] == null) {
        $_SESSION["error"] = "Please! Select the File";
?>
        <script>
            window.history.back();
        </script>
    <?php
        return;
    }

    $sel = $conn->prepare("SELECT * FROM `products`");
    $sel->execute();
    $sel = $sel->fetchAll();

    foreach ($sel as $r) {
        if ($r["item_img"] != null) {
            foreach (unserialize($r["item_img"]) as $img) {
                if ($_FILES["item-img"]["name"] == $img) {
                    $contain = true;
                }
            }
        }
    }
    if (isset($contain)) {
        $_SESSION["error"] = "Please! Change name of the Image, Name is already exist";
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
        $item_img[$_POST["change"] - 1] = $_FILES["item-img"]["name"];

        $up = $conn->prepare("UPDATE `products` SET `item_img`='" . serialize($item_img) . "' WHERE `product_id`='" . $_SESSION["product_id"] . "'");

        if ($up->execute()) {
            move_uploaded_file($_FILES["item-img"]["tmp_name"], "C:/xampp/htdocs/php/medicine_website/user_panel/shop/imgs/" . $_FILES["item-img"]["name"] . "");
        } //
        else {
            $_SESSION["error"] = "Please! Change name of the Image";
        }
    }
    ?>
    <script>
        window.history.back();
    </script>
    <?php }



//! Add Product Image
if (isset($_POST["add"])) {
    if ($_FILES["new-img"]["name"] == null) {
        $_SESSION["error"] = "Please! Select the File";
    ?>
        <script>
            window.history.back();
        </script>
    <?php
        return;
    }

    $sel = $conn->prepare("SELECT * FROM `products` WHERE `product_id`='" . $_SESSION["product_id"] . "'");
    $sel->execute();
    $sel = $sel->fetchAll();

    foreach ($sel as $r) {
        if ($r["item_img"] != null) {
            foreach (unserialize($r["item_img"]) as $img) {
                if ($_FILES["new-img"]["name"] == $img) {
                    $contain = true;
                }
            }
        }
    }
    if (isset($contain)) {
        $_SESSION["error"] = "Please! Check that Image is already exist";
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
        array_push($item_img, $_FILES["new-img"]["name"]);

        $up = $conn->prepare("UPDATE `products` SET `item_img`='" . serialize($item_img) . "' WHERE `product_id`='" . $_SESSION["product_id"] . "'");

        if ($up->execute()) {
            move_uploaded_file($_FILES["new-img"]["tmp_name"], "C:/xampp/htdocs/php/medicine_website/user_panel/shop/imgs/" . $_FILES["new-img"]["name"] . "");
        } //
        else {
            $_SESSION["error"] = "Please! Change name of the Image";
        }
    }
    ?>
    <script>
        window.history.back();
    </script>
<?php }



// ! Delete Product Image
if (isset($_POST["delete"])) {
    $i = 1;
    $item_img = array();

    $sel = $conn->prepare("SELECT * FROM `products` WHERE `product_id`='" . $_SESSION["product_id"] . "'");
    $sel->execute();
    $sel = $sel->fetchAll();

    foreach ($sel as $r) {
        if ($r["item_img"] != null) {
            foreach (unserialize($r["item_img"]) as $img) {
                if ($i != $_POST["delete"]) {
                    array_push($item_img, $img);
                } //
                else if ($i == $_POST["delete"]) {
                    unlink("C:/xampp/htdocs/php/medicine_website/user_panel/shop/imgs/$img");
                }
                $i++;
            }
        }
    }

    $up = $conn->prepare("UPDATE `products` SET `item_img`='" . serialize($item_img) . "' WHERE `product_id`='" . $_SESSION["product_id"] . "'");
    $up->execute();
?>
    <script>
        window.history.back();
    </script>
<?php }