$(document).ready(function() {
    $("#next_btn").click(function() {
        location.href = "http://localhost/php/medicine_website/index.php";
    });

    $(".edit_btn").click(function() {
        $(".edit_btn").hide();
        $("#show_profile").hide();
        $("#edit_profile").show();
    });
    $("#update_btn").click(function() {
        $(".edit_btn").show();
        $("#show_profile").show();
        $("#edit_profile").hide();
    });
});