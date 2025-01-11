$(document).ready(() => {
  // ! Task (add to cart)
  $("main #task").fadeOut(6000);

  // ! Click on image to change
  $("#sub_imgs #img").click(function () {
    $("#sub_imgs #img").removeClass("active-sub-img");
    $(this).addClass("active-sub-img");
    $("#full img").attr("src", $(this).children().attr("src"));
  });

  $("#advance_details button").click(function () {
    var data = $(this).val();
    $("#advance_details button").removeClass("clicked_btn");
    $(this).addClass("clicked_btn");

    $("#details").children("div").hide();
    $("#details #" + data).show();
  });
});
