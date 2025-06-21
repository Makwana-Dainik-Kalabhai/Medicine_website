if (window.history.replaceState) {
  window.history.replaceState(null, null, window.location.href);
}
$(document).ready(function () {
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
    $(this)
      .parent()
      .siblings("div")
      .children("button")
      .attr("disabled", false1);
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
  $("input[type='text']").keyup(function () {
    if ($(this).val().length > 0)
      $(this)
        .parent()
        .siblings("div")
        .children("button")
        .attr("disabled", false);
    else {
      $(this)
        .parent()
        .siblings("div")
        .children("button")
        .attr("disabled", true);
    }
  });

  //
  var last_img = Number.parseInt($(".add-desc-img").val()) + 1;

  $(".add-desc-img").click(function () {
    $(
      `<div class='row border-bottom py-4'>
        <div class='col-md-1'>${last_img})</div>
        <div class='col-md-4'></div>
        <div class='col-md-4'>
          Select the Image
          <input type='file' name='new-img' class='form-control mt-4' accept='image/*' />
          <p class="text-center mt-2">OR</p>
          <input type="text" name="new-img" class="form-control" placeholder="Enter HTTP URL here" required />
        </div>
        <div class='col-md-2'>
          <button class='btn btn-light add-btn' name='add'>Add</button>
        </div>
      </div>`
    ).appendTo(".desc-imgs-form");
    last_img++;
  });
});
