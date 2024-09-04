$(document).ready(() => {
    // ! Task (add to cart)
    $("main #task").fadeOut(6000);

    // ! Click on image to change
    $("#sub_imgs #img").click(function () {
        $("#sub_imgs #img").css("border", "1.5px solid gray");
        $(this).css("border", "3.5px solid #30819c");
        $("#full").attr("src", $(this).children().attr("src"));
    });

    $("#description").show();
    $("#features").hide();
    $("#specification").hide();

    $("#advance_details button").click(function() {
        var data = $(this).val();
        $("#advance_details button").removeClass("clicked_btn");
        $(this).addClass("clicked_btn");

        $("#details").children("div").hide();
        $("#details #"+data).show();
    });
});