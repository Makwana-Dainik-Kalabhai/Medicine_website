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
        }
        // Scroll up 
        else {
            $("#main_nav").addClass("header-visible");
            $("#main_nav").removeClass("header-hidden");
            $("#side_nav").css({transform: "translateY(0)"});
            $("#side_nav #menus").css("height","460px");
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

    $("#search_input").keydown(function (e) {
        $("#searched_items #new_items").html("");

        var firstName = $("#search_input").val();

        $.ajax({
            type: "POST",
            url: "http://localhost/php/medicine_website/user_panel/header/search.php",
            data: {
                key: e.key,
                firstName: firstName
            },
            cache: false,
            success: function (data) {
                $("#searched_items #new_items").append(data);
            },
            error: function (xhr, status, error) {
                console.error(xhr);
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