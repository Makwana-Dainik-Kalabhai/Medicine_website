<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All category of medicines</title>

    <?php include("C:/xampp/htdocs/php/medicine_website/links.php"); ?>
</head>

<style>
    <?php include("C:/xampp/htdocs/php/medicine_website/user_panel/header/medicines/all_medicines.css"); ?>
</style>

<script>
    $(document).ready(function() {});
</script>

<div id="all_medicines">
    <span>Find Medicines</span>
    <span>Shop by Category</span>

    <div id="abcd">
        <?php for ($i = "A"; $i <= "Z"; $i++) { ?>

            <a href="">
                <?php echo $i;
                if ($i == "Z") {
                    break;
                } ?>
            </a>
        <?php } ?>
        <a href="">ALL</a>
    </div>


    <div id="all_categories">
        <?php for ($i = "A"; $i <= "Z"; $i++) { ?>

            <a href="">
                <?php echo $i;?>

                <a href="">Alcohol Addiction (11)</a>
                <?php
                if ($i == "Z") {
                    break;
                } ?>
            </a>
        <?php } ?>
    </div>
</div>

</html>