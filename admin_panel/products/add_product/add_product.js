if (window.history.replaceState) {
  window.history.replaceState(null, null, window.location.href);
}

$(document).ready(() => {
  let checked = false;

  $("input[type='checkbox']").change(function () {
    if (checked) {
      $(".old-cat").attr("disabled", "true");
      $(".new-cat").removeAttr("disabled");
      checked = false;
    }
    //
    else {
      $(".old-cat").removeAttr("disabled");
      $(".new-cat").attr("disabled", "true");
      checked = true;
    }
  });
});
