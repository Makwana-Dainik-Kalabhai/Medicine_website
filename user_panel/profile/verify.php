<?php
session_start();

include("C:/xampp/htdocs/php/medicine_website/database.php");

if (isset($_POST["update"])) {

    move_uploaded_file($_FILES["profile_img"]["tmp_name"], "C:/xampp/htdocs/php/medicine_website/user_panel/profile/profile_imgs/" . $_FILES["profile_img"]["name"] . "");

    if($_FILES["profile_img"]["name"] != null) {
        $profile_img = $_FILES["profile_img"]["name"];
    }
    else {
        $sel = $conn->prepare("SELECT * FROM `user_login_data` WHERE email='".$_SESSION["email"]."'");
        $sel->execute();
        $sel = $sel->fetchAll();

        foreach($sel as $row) {
            $profile_img = $row["profile_img"];
        }
        
    }

    $user = array(
        "profile_img" => $profile_img,
        "name" => $_POST["name"],
        "gender" => $_POST["gender"],
        "age" => $_POST["age"],
        "phone" => $_POST["phone"],

        "address" => array(
            "house_no" => $_POST["house_no"],
            "street" => $_POST["street"],
            "suite" => $_POST["suite"],
            "city" => $_POST["city"],
            "state" => $_POST["state"],
            "pincode" => $_POST["pincode"]
        )
    );

    $query = "UPDATE `user_login_data` SET 
                `profile_img`='" . $user["profile_img"] . "',
                `name`='" . $user["name"] . "',
                `gender`='" . $user["gender"] . "',
                `age`='" . $user["age"] . "',
                `phone`='" . $user["phone"] . "',
                `address`='" . serialize($user["address"]) . "' WHERE `email`='" . $_SESSION["email"] . "'";


    $update = $conn->prepare($query);
    $update->execute();

    header("Refresh:0;url=http://localhost/php/medicine_website/user_panel/profile/profile.php");
}
