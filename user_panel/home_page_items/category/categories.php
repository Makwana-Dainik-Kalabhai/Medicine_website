<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<style>
    #home_categories>a {
        width: 35%;
        padding: 0 2%;
        display: flex;
        align-items: center;
        background-color: rgba(235, 246, 249, 0.55);
        border-radius: 5px;
        font-size: 22px;
        box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;
        text-decoration: none;
    }

    #home_categories #medicines img {
        width: 16%;
    }

    #home_categories #products img {
        width: 21%;
    }

    @import url('https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100..700;1,100..700&display=swap');

    #home_categories .details {
        width: 100%;
        padding-left: 5%;
        display: flex;
        flex-direction: column;
        font-family: "Josefin Sans", sans-serif;
    }

    #home_categories .details span:first-of-type {
        color: #2a7189;
        font-size: 1em;
        font-weight: 500;
    }

    #home_categories .details span:last-of-type {
        color: green;
        font-size: 0.85em;
        margin-top: 1.5%;
    }

    #home_categories i {
        color: gray;
        font-size: 0.85em;
    }

    @media (max-width: 800px) {
        #home_categories>a {
            font-size: 21px;
            width: 40%;
        }

        #home_categories .details span:last-of-type {
            margin-top: 0;
        }
    }

    @media (max-width: 650px) {
        #home_categories>a {
            font-size: 19px;
        }
    }

    @media (max-width: 575px) {
        #home_categories>a {
            font-size: 18px;
            width: 45%;
        }
    }

    @media (max-width: 490px) {
        #home_categories>a {
            font-size: 15px;
        }
    }

    @media (max-width: 405px) {
        #home_categories>a {
            font-size: 13px;
        }
    }

    @media (max-width: 370px) {
        #home_categories>a {
            width: 80%;
            height: 50px;
            margin: 1rem 0;
        }

        #home_categories #medicines img {
            width: 17%;
            padding: 1.5%;
        }

        #home_categories #products img {
            width: 17%;
            padding: 1.5%;
        }

        #home_categories .details {
            padding-left: 10%;
        }
    }
</style>


<?php
include("C:/xampp/htdocs/php/medicine_website/database.php");

$sel = $conn->prepare("SELECT * FROM `products`");
$sel->execute();
$sel = $sel->fetchAll();
$max_pr_dis = 0;

foreach ($sel as $row) {
    if ($row["discount"] > $max_pr_dis) {
        $max_pr_dis = $row["discount"];
    }
}

$sel = $conn->prepare("SELECT * FROM `products` WHERE `status`='medicine'");
$sel->execute();
$sel = $sel->fetchAll();
$max_me_dis = 0;

foreach ($sel as $row) {
    if ($row["discount"] > $max_me_dis) {
        $max_me_dis = $row["discount"];
    }
}
$max_cl_dis = 0;
?>

<!-- //! This category file is used only for index.php -->

<a href="http://localhost/php/medicine_website/user_panel/shop/pr_main_page/pr_main_page.php?status=medicine" id="medicines">
    <img src="http://localhost/php/medicine_website/user_panel/home_page_items/category/medicines.jpg" alt="">
    <div class="details">
        <span>Order Medicines</span>
        <span>Save Upto <?php echo $max_me_dis; ?>% off</span>
    </div>
    <i class="fa-solid fa-chevron-right"></i>
</a>
<a href="http://localhost/php/medicine_website/user_panel/shop/pr_main_page/pr_main_page.php?status=device" id="products">
    <img src="http://localhost/php/medicine_website/user_panel/home_page_items/category/products.png" alt="">
    <div class="details">
        <span>Medical Devices</span>
        <span>Save Upto <?php echo $max_pr_dis; ?>% off</span>
    </div>
    <i class="fa-solid fa-chevron-right"></i>
</a>