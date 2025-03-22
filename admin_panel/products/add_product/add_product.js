if (window.history.replaceState) {
  window.history.replaceState(null, null, window.location.href);
}

$(document).ready(() => {
  let sel_cat_check = false;
  let cat_img_check = true;

  //! Select Category-img from Select menu
  $(".sel-cat-check").change(function () {
    if (sel_cat_check) {
      $(".old-cat").attr("disabled", "true");
      $(".new-cat").removeAttr("disabled");
      $(".category-form input[type='file']").show();
      sel_cat_check = false;
    }
    //
    else {
      $(".old-cat").removeAttr("disabled");
      $(".new-cat").attr("disabled", "true");
      $(".category-form input[type='file']").hide();
      sel_cat_check = true;
    }
  });

  $(".cat-img-check").change(function () {
    if (cat_img_check) {
      $(".category-form input[type='file']").show();
      cat_img_check = false;
    }
    //
    else {
      $(".category-form input[type='file']").hide();
      cat_img_check = true;
    }
  });

  //! Add Product Images
  $(".item-imgs-form input[type='checkbox']").change(function () {
    $(this)
      .siblings("input[type='file']")
      .attr("disabled", function (index, attr) {
        return attr ? false : true;
      });
  });

  $("input[type='file']").change(function (e) {
    if ($(this).get(0).files.name !== null) {
      $(this)
        .parent()
        .siblings("div")
        .children("button")
        .removeAttr("disabled");
    }
  });

  let index = $(".add-item-img").val();

  $(".add-item-img").click(function () {
    $(
      `<div class='row border-bottom py-4'>
            <div class='col-md-1'>${index})</div>
            <div class='col-md-3'></div>
            <div class='col-md-4'>
                Select the Image
                <input type='file' name='item-img' class='form-control mt-4' accept='image/*' />
            </div>
            <div class='col-md-2'>
                <button class='btn btn-light' name='add-item-img'>Add</button>
            </div>
            <div class='col-md-2'>
                <button class='btn btn-light' disabled>Delete</button>
            </div>
        </div>`
    ).appendTo(".item-imgs-form");
    index++;
  });
});
