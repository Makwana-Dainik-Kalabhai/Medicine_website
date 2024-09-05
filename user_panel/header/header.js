$(document).ready(() => {
    $("#side_nav").css("height",screen.height);

    var prevScrollPos = window.pageYOffset;

    window.onscroll = function () {
        var currentScrollPos = window.pageYOffset;

        // Scroll down 
        if (prevScrollPos < currentScrollPos) {
            $("#main_nav").addClass("header-hidden");
            $("#main_nav").removeClass("header-visible");
            $("#side_nav").css({transform: "translateY(-15%)"});
            $("#side_nav #menus").css("height","100%");
            $("#bill").css("top","80px");
        }
        // Scroll up 
        else {
            $("#main_nav").addClass("header-visible");
            $("#main_nav").removeClass("header-hidden");
            $("#side_nav").css({transform: "translateY(0)"});
            $("#side_nav #menus").css("height","460px");
            $("#bill").css("top","150px");
        }
        
        prevScrollPos = currentScrollPos;
    };

    var dis_menu = false;
    $("#menu").click(() => {
        if (!dis_menu) {
            $("#side_nav").css("left", "0");
            dis_menu = true;
        }
        else if (dis_menu) {
            $("#side_nav").css("left", "-100%");
            dis_menu = false;
        }
    });

    $("#search_input").keyup(function (e) {
        $("#searched_items #new_items").html("");

        var search_val = $("#search_input").val();

        $.ajax({
            type: "POST",
            url: "http://localhost/php/medicine_website/user_panel/header/search.php",
            data: {
                search_val:search_val
            },
            cache: false,
            success: function (data) {
                $("#searched_items #new_items").append(data);
            }
        });
    });

    $("#search_box #search_input").focus(() => {
        $("#searched_items").show();
    });
    $("#searched_items").click(() => {
        $("#searched_items").show();
    });

    // $("#search_box #search_input").blur(() => {
    // });
    // $("#searched_items").focus(() => {
    //     $("#searched_items").show();
    // });

    $("main, footer").click(() => {
        $("#side_nav").css("left", "-100%");
        dis_menu = false;
        $(".regi_form").css({ margin: "0 auto" });
        $("#searched_items").hide();
    });
});