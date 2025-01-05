if (window.history.replaceState) {
  window.history.replaceState(null, null, window.location.href);
}

$(document).ready(() => {
  let checked = false;

  $(".select-cat").change(function () {
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

  
  $("input[type='checkbox']").change(function () {
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

  let index = 1;

  $(".add-item-img").click(function () {
    $(
      `<div class='row border-bottom py-4'>
            <div class='col-md-1'>${index})</div>
            <div class='col-md-3'></div>
            <div class='col-md-4'>
                Select the Image
                <input type='file' name='new-item-img' class='form-control mt-4' />
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
