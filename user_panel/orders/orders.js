$(document).ready(function () {
  $("#filters button").click(function () {
    $("#filters button").css("color", "white");
    $("#filters button span").css("color", "white");
    $("#filters button").css("background-color", "transparent");
    $(this).css("color", "black");
    $(this).css("background-color", "white");
  });

  // ! Cancel the Order
  $("#orders .cancel_btn").click(function () {
    $("#order #cancel_form").css("display", "block");
    $(".brightness").css("display", "block");
  });
  $(".brightness").click(function () {
    $("#order #cancel_form").css("display", "none");
    $(".brightness").css("display", "none");
  });

  $("#filters button").click(function () {
    let btn = $(this).val();
    let time = $("#time_period").val();

    $.ajax({
      type: "POST",
      url: "filter.php",
      data: {
        filterBtn: btn,
        timePeriod: time,
      },
      success: function (data) {
        $("#all_orders").html(data);
      },
    });
  });
  $("#time_period").change(function () {
    let time = $(this).val();

    $.ajax({
      type: "POST",
      url: "filter.php",
      data: {
        timePeriod: time,
      },
      success: function (data) {
        $("#all_orders").html(data);
      },
    });
  });
});
