$(document).ready(function () {
  $("#write_review").click(function () {
    $("#review_form").show();
  });

  $(".already").click(function () {
    $("#give_ratings #error").css("display", "block");
    $("#give_ratings #error").fadeOut(7000);
  });
  $("#give_ratings #form_err").fadeOut(15000);
  $("#give_ratings #success").fadeOut(15000);


  // ! Display more reviews using more button
  var limit = 1;
  var total_data = $("#total_data").val();
  $("#show_review #more_btn").click(function () {
    $.ajax({
      type: "POST",
      url: "http://localhost/php/medicine_website/user_panel/shop/product_details/ratings/dis_more_review.php",
      data: {
        limit: limit + 2,
      },
      cache: false,
      success: function (data) {
        limit += 2;
        if (limit >= total_data) {
          $("#more_btn").hide();
        }
        $("#all_reviews").html(data);
      },
    });
  });
});
