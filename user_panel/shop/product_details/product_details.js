$(document).ready(() => {
  // ! Task (add to cart)
  $("main #task").fadeOut(6000);

  //! Hover on Main Image, then Zoom it
  $("#main_imgs a").mouseenter(function () {
    $(".full-img").css("display", "block");
    $(".full-img img").attr("src", $(this).children("img").attr("src"));
  });
  $("#main_imgs a").mouseleave(function () {
    $(".full-img").css("display", "none");
  });

  // ! Click on image to change
  $("#sub_imgs #img").click(function () {
    $("#sub_imgs #img").removeClass("active-sub-img");
    $(this).addClass("active-sub-img");
    $("#full img").attr("src", $(this).children().attr("src"));
    $("#full").attr("href", $(this).children().attr("src"));
  });

  $("#advance_details button").click(function () {
    var data = $(this).val();
    $("#advance_details button").removeClass("clicked_btn");
    $(this).addClass("clicked_btn");

    $("#details").children("div").hide();
    $("#details #" + data).show();
  });
});
