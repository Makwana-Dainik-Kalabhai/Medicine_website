$(document).ready(() => {
  $("#search_input").val("");
  $("#side_nav").css("height", screen.height);

  var prevScrollPos = window.pageYOffset;

  window.onscroll = function () {
    var currentScrollPos = window.pageYOffset;

    // Scroll down
    if (prevScrollPos < currentScrollPos) {
      $("#main_nav").addClass("header-hidden");
      $("#main_nav").removeClass("header-visible");
      $("#bill").css("top", "80px");
    }
    // Scroll up
    else {
      $("#main_nav").addClass("header-visible");
      $("#main_nav").removeClass("header-hidden");
      $("#bill").css("top", "150px");
    }

    prevScrollPos = currentScrollPos;
  };

  var dis_menu = false;
  $("#menu i").click(() => {
    if (!dis_menu) {
      $("#side_nav").css("left", "0");
      $(".brightness").css("display", "block");
      $(".carousel-indicators").css("z-index", "0");
      $("body").css("overflow", "hidden");
      dis_menu = true;
    } else if (dis_menu) {
      $("#side_nav").css("left", "-100%");
      $(".brightness").css("display", "none");
      $(".carousel-indicators").css("z-index", "1");
      $("body").css("overflow", "auto");
      dis_menu = false;
    }
  });

  $("#search_input").keyup(function (e) {
    if ($(this).val().length >= 1) {
      $("body").css("overflow", "hidden");
    } else {
      $("body").css("overflow", "auto");
    }
    
    $("#searched_items #new_items").html("");

    var search_val = $("#search_input").val();

    $.ajax({
      type: "POST",
      url: "http://localhost/php/medicine_website/user_panel/header/search.php",
      data: {
        search_val: search_val,
      },
      cache: false,
      success: function (data) {
        if (data != null) $("#searched_items").show();
        if (data.length < 1) $("#searched_items").hide();

        $("#searched_items #new_items").append(data);
      },
    });
  });

  $("#search_input").focus(function () {
    if ($(this).val().length >= 1) {
      $("#searched_items").show();
      $("body").css("overflow", "hidden");
    }
  });
  $("#searched_items").click(() => {
    $("#searched_items").show();
  });

  $(".brightness").click(() => {
    $("#side_nav").css("left", "-100%");
    $(".brightness").css("display", "none");
    $(".carousel-indicators").css("z-index", "1");
    dis_menu = false;
    $(".regi_form").css({ margin: "0 auto" });
    $("#searched_items").hide();
    $("body").css("overflow", "auto");
  });

  $("main").click(function () {
    $("#searched_items").hide();
    $("body").css("overflow", "auto");
    botpress.close();
  });
});
