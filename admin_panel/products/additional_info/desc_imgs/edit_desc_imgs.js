if (window.history.replaceState) {
  window.history.replaceState(null, null, window.location.href);
}
$(document).ready(function () {
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

  var last_img = Number.parseInt($(".add-desc-img").val())+1;

  $(".add-desc-img").click(function () {
    $(
      `<div class='row border-bottom py-4'>
        <div class='col-md-1'>${last_img})</div>
        <div class='col-md-4'></div>
        <div class='col-md-4'>
          Select the Image
          <input type='file' name='new-img' class='form-control mt-4' accept='image/*' required />
        </div>
        <div class='col-md-2'>
          <button class='btn btn-light add-btn' name='add'>Add</button>
        </div>
      </div>`
    ).appendTo(".desc-imgs-form");
    last_img++;
  });
});
