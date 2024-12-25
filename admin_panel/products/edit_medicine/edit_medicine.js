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

  let category = $(".category").val();
  let cat_img;

  $('input[type="file"]').change(function (e) {
    cat_img = e.target.files[0].name;
  });

  let name = $(".name").val();
  let definition = $(".definition").val();
  let discount = $(".discount").val();
  let offer_price = $(".offer-price").val();
  let price = $(".price").val();
  let quantity = $(".quantity").val();
  let weight = $(".weight").val();
  let expiry = $(".expiry").val();
  let delivery_date = $(".delivery-date").val();

  $(".update-category").click(function () {
  });

  $(".update-product").click(function () {
  });
});
