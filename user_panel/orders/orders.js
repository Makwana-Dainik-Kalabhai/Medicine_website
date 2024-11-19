$(document).ready(function() {
    $("#filters button").click(function() {
        $("#filters button").css("color","white");
        $("#filters button").css("background-color","transparent");
        $(this).css("color","black");
        $(this).css("background-color","white");
    });
});