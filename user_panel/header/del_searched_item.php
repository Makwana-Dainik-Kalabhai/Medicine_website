<?php
session_start();

include("C:/xampp/htdocs/php/medicine_website/database.php");

$delete = $conn->prepare("DELETE FROM `searched_items` WHERE email='" . $_SESSION["email"] . "' AND data='" . $_GET["data"] . "'");
$delete->execute();
?>

<script>
    window.history.back();
</script>