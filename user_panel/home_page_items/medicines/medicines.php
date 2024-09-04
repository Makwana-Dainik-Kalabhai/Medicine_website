<style>
    <?php include("C:/xampp/htdocs/php/medicine_website/user_panel/home_page_items/medicines/medicines.css"); ?>
</style>

<div id="medicine_shop_category">
    <p>Shop By Category</p>

    <a href=""><img src="http://localhost/php/medicine_website/user_panel/shop/medicines/category_img/ayurvedic.png" /></a>
    <a href=""><img src="http://localhost/php/medicine_website/user_panel/shop/medicines/category_img/vitamins.jpeg" /></a>
    <a href=""><img src="http://localhost/php/medicine_website/user_panel/shop/medicines/category_img/diabetes_care.png" /></a>
    <a href=""><img src="http://localhost/php/medicine_website/user_panel/shop/medicines/category_img/weight_care.png" /></a>
    <a href=""><img src="http://localhost/php/medicine_website/user_panel/shop/medicines/category_img/cold_fever.png" /></a>
</div>

<div id="popular_picks">
    <div>
        <p>Popular Picks</p>
        <div id="picks">
            <?php for ($i = 0; $i < 5; $i++) { ?>
                <div id="box">
                    <a href="">
                        <div id="product_img">
                            <img src="http://localhost/php/medicine_website/user_panel/shop/medicines/category_img/ayurvedic.png" />

                            <?php if (!isset($_SESSION["email"])) { ?>
                                <a href="http://localhost/php/medicine_website/user_panel/form/login_form.php"><i class="fa-solid fa-heart"></i></a>
                            <?php } ?>

                            <?php if (isset($_SESSION["email"])) { ?>
                                <a href="" style="color:red;"><i class="fa-solid fa-heart"></i></a>
                            <?php } ?>
                        </div>
                        <div id="details">
                            <span id="name">asdfghjkl</span>
                            <span id="offer_price">&#8377;100</span>
                            <span id="price">&#8377;150</span>
                            <span id="save">GET 25% off</span>
                        </div>
                        <a href="" id="add_cart"><i class="fa-solid fa-cart-plus"></i> Add to cart</a>
                    </a>
                </div>
            <?php } ?>
        </div>
    </div>
</div>

<!-- <div id="order_description">
    <?php //include("C:/xampp/htdocs/php/medicine_website/user_panel/shop/medicines/medicines_cat_des.php"); ?>
</div> -->