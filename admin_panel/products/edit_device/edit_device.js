if (window.history.replaceState) {
  window.history.replaceState(null, null, window.location.href);
}

$(document).ready(() => {
  let checked = false;
  $(".product-list").DataTable();

  $("input[type='checkbox']").change(function () {
    if (checked) {
      $("input[type='file']").attr("disabled", "true");
      checked = false;
    } else {
      checked = true;
      $("input[type='file']").removeAttr("disabled");
    }
  });

  var file = false;

  $(".new-cat").keyup(function () {
    if ($(".old-cat").val() == $(".new-cat").val()) {
      $(".update-category").attr("disabled", true);
    } else if ($(".old-cat").val() != $(".new-cat").val() && file) {
      $(".update-category").attr("disabled", false);
    }
    //
    else if ($(".old-cat").val() != $(".new-cat").val()) {
      alert("Disabled");
      $(".update-category").attr("disabled", true);
    }
  });

  $("input[type='file']").change(function (e) {
    if (e.target.files[0].name != null) {
      file = true;
      $(".update-category").attr("disabled", true);
    }
    if ($(".old-cat-img").val() == e.target.files[0].name) {
      file = false;
      $(".update-category").attr("disabled", true);
    }
    //
    if (
      $(".old-cat").val() != $(".new-cat").val() &&
      e.target.files[0].name != null
    ) {
      file = true;
      $(".update-category").attr("disabled", false);
    }
  });
});
