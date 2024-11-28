$(document).ready(function () {
  if (window.history.replaceState) {
    window.history.replaceState(null, null, window.location.href);
  }

  //! All Variables
  var filter;
  var category;
  var price_range;
  var discount_range;

  //!Sort using filtering methods giving on top-right(products main page) in website
  $("#sort_products button").click(function () {
    $("#top_load").css("display", "block");
    $("#top_load").css("width", "20%");

    filter = $(this).val();
    price_range = $("#price_range input").val();
    discount_range = $("#discount_range input").val();

    $("#sort_products button").css({
      color: "#ff0000",
      backgroundColor: "#ffe6e6",
    });

    setTimeout(() => {
      $("#top_load").css("width", "40%");
    }, 200);
    $(this).css({ color: "White", backgroundColor: "#ff3333" });

    setTimeout(() => {
      $("#top_load").css("width", "80%");
      $.ajax({
        type: "POST",
        url: "http://localhost/php/medicine_website/user_panel/shop/pr_main_page/sort_products.php",
        data: {
          filter: filter,
          price_range: price_range,
          discount_range: discount_range,
        },
        success: function (data) {
          $("#top_load").css("width", "100%");
          $("#products").html(data);
        },
      });
    }, 500);

    setTimeout(() => {
      $("#top_load").css("display", "none");
    }, 700);
  });

  // ! Sort using categories given on left side(products main page) in website
  $("#categories button").click(function () {
    $("#top_load").css("display", "block");
    $("#top_load").css("width", "20%");

    category = $(this).val();
    price_range = $("#price_range input").val();
    discount_range = $("#discount_range input").val();

    setTimeout(() => {
      $("#top_load").css("width", "40%");
    }, 200);
    $("#categories button").css("background-color", "transparent");
    $(this).css("background-color", "#ffcccc");

    setTimeout(() => {
      $("#top_load").css("width", "80%");

      $.ajax({
        type: "POST",
        url: "http://localhost/php/medicine_website/user_panel/shop/pr_main_page/sort_products.php",
        data: {
          category: category,
          price_range: price_range,
          discount_range: discount_range,
        },
        success: function (data) {
          $("#products").html(data);
        },
      });
    }, 500);

    setTimeout(() => {
      $("#top_load").css("display", "none");
    }, 700);
  });

  $("input[type='range']").change(function () {
    $("#top_load").css("display", "block");
    $("#top_load").css("width", "20%");

    price_range = $("#price_range input").val();
    discount_range = $("#discount_range input").val();

    setTimeout(() => {
      $("#top_load").css("width", "40%");
    }, 200);

    setTimeout(() => {
      $("#top_load").css("width", "80%");

      $.ajax({
        type: "POST",
        url: "http://localhost/php/medicine_website/user_panel/shop/pr_main_page/sort_products.php",
        data: {
          price_range: price_range,
          discount_range: discount_range,
        },
        success: function (data) {
          $("#products").html(data);
        },
      });
    }, 500);
    setTimeout(() => {
      $("#top_load").css("display", "none");
    }, 700);
  });
});
