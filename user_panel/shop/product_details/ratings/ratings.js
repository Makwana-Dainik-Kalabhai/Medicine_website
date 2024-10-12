$(document).ready(function() {
    $("#write_review").click(function() {
        $("#review_form").show();
    });
    
    $(".already").click(function() {
        $("#give_ratings #error").css("display","block");
        $("#give_ratings #error").fadeOut(7000);
    });
    $("#give_ratings #form_err").fadeOut(7000);
    $("#give_ratings #success").fadeOut(10000);
});