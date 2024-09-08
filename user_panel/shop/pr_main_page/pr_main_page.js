$(document).ready(function () {
    $("#price_range #max_price").html("&#8377;" + $("#price_range input").val());
    $("#discount_range #max_discount").html($("#discount_range input").val() + "%");

    //! All Variables
    var filter;
    var category;
    var price_range;
    var discount_range;

    //!Sort using filtering methods giving on top-right(products main page) in website
    $("#sort_products button").click(function () {
        filter = $(this).val();
        price_range = $("#price_range input").val();
        discount_range = $("#discount_range input").val();

        $("#sort_products button").css({ color: "#ff0000", backgroundColor: "#ffe6e6" });
        $(this).css({ color: "White", backgroundColor: "#ff3333" });

        $.ajax({
            type: "POST",
            url: "http://localhost/php/medicine_website/user_panel/shop/pr_main_page/sort_products.php",
            data: {
                filter: filter,
                price_range: price_range,
                discount_range: discount_range
            },
            success: function (data) {
                $("#products").html(data);
            }
        });
    });

    // ! Sort using categories given on left side(products main page) in website
    $("#categories button").click(function () {
        category = $(this).val();
        price_range = $("#price_range input").val();
        discount_range = $("#discount_range input").val();
        
        $("#categories button").css("background-color", "transparent");
        $(this).css("background-color", "#ffcccc");

        $.ajax({
            type: "POST",
            url: "http://localhost/php/medicine_website/user_panel/shop/pr_main_page/sort_products.php",
            data: {
                category: category,
                price_range: price_range,
                discount_range: discount_range
            },
            success: function (data) {
                $("#products").html(data);
            }
        });
    });

    $("input[type='range']").change(function () {
        price_range = $("#price_range input").val();
        discount_range = $("#discount_range input").val();

        $.ajax({
            type: "POST",
            url: "http://localhost/php/medicine_website/user_panel/shop/pr_main_page/sort_products.php",
            data: {
                price_range: price_range,
                discount_range: discount_range
            },
            success: function (data) {
                $("#products").html(data);
            }
        });
    });
});