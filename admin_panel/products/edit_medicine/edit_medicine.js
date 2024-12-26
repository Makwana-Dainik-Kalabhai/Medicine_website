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
});
