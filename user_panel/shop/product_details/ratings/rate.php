<?php
session_start();

include("C:/xampp/htdocs/php/medicine_website/database.php");

if (isset($_GET["star"])) {
    $sel = $conn->prepare("SELECT * FROM `ratings` WHERE `email`='" . $_SESSION["email"] . "' AND `product_id`='" . $_SESSION["product_id"] . "'");
    $sel->execute();
    $sel = $sel->fetchAll();

    foreach ($sel as $row) {
        if ($row["status"] == "review" || $row["status"] == "both") {
            $contain = true;
        }
    }

    if (isset($contain)) {
        $update = $conn->prepare("UPDATE `ratings` SET `rate`='" . $_GET["star"] . "', `status`='both' WHERE `email`='" . $_SESSION["email"] . "' AND `product_id`='" . $_SESSION["product_id"] . "'");
        $update->execute();
    }
    //
    else {
        $_SESSION["success"] = "Your rating has been submitted successfully";
        $insert = $conn->prepare("INSERT INTO `ratings` VALUES('" . $_SESSION["email"] . "','" . $_SESSION["product_id"] . "','" . $_GET["star"] . "','',NOW(),'rate')");
        $insert->execute();
    }
    
    header("Refresh:0; url=http://localhost/php/medicine_website/user_panel/shop/product_details/product_details.php");
    return;
}



//* Submit review form
if (isset($_POST["submit"])) {
    
    $review = [$_POST["review_head"], $_POST["review_des"]];
    
    $sel = $conn->prepare("SELECT * FROM `ratings` WHERE `email`='" . $_SESSION["email"] . "' AND `product_id`='" . $_SESSION["product_id"] . "'");
    $sel->execute();
    $sel = $sel->fetchAll();

    foreach ($sel as $row) {
        if ($row["status"] == "review" || $row["status"] == "both") {
            $_SESSION["form_err"] = "You already reviewed this product";
            
            header("Refresh:0; url=http://localhost/php/medicine_website/user_panel/shop/product_details/product_details.php");
            return;
        }
    }
    
    foreach ($sel as $row) {
        if ($row["status"] == "rate") {
            $contain = true;
        }
        if ($row["status"] == "both") {
            $contain = true;
        }
    }
    
    if (isset($contain)) {

        $update = $conn->prepare("UPDATE `ratings` SET `review`='" . serialize($review) . "', `status`='both' WHERE `email`='" . $_SESSION["email"] . "' AND `product_id`='" . $_SESSION["product_id"] . "'");
        $update->execute();
    }
    //
    else {
        $_SESSION["success"] = "Your review has been submitted successfully";
        $insert = $conn->prepare("INSERT INTO `ratings` VALUES('" . $_SESSION["email"] . "','" . $_SESSION["product_id"] . "','','" . serialize($review) . "',NOW(),'review')");
        $insert->execute();
    }
    header("Refresh:0; url=http://localhost/php/medicine_website/user_panel/shop/product_details/product_details.php");
    return;
}
?>