if (window.history.replaceState) {
  window.history.replaceState(null, null, window.location.href);
}

$(document).ready(() => {
  $(".product-list").DataTable();

  $(".file-checkbox").change(function () {
    $(this)
      .siblings("input[type='file']")
      .attr("disabled", function (index, attr) {
        return attr ? false : true;
      });
    $(this).siblings("input[type='text']").attr("disabled", true);
    $(this).parent().siblings("div").children("button").attr("disabled", true);
  });
  
  $(".url-checkbox").change(function () {
    $(this)
    .siblings("input[type='text']")
    .attr("disabled", function (index, attr) {
      return attr ? false : true;
    });
    $(this).siblings("input[type='file']").attr("disabled", true);
    $(this).siblings("input[type='text']").focus();
    $(this).parent().siblings("div").children("button").attr("disabled", false1);
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
                <p class="text-center mt-2">OR</p>
                <input type="text" name="item-img" class="form-control" placeholder="Enter HTTP URL here" required />
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
