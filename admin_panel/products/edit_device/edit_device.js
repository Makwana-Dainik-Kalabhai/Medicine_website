if (window.history.replaceState) {
  window.history.replaceState(null, null, window.location.href);
}

$(document).ready(() => {
  $(".product-list").DataTable();

  $("input[type='checkbox']").change(function (e) {
    $(this)
      .siblings("input[type='file']")
      .attr("disabled", function (index, attr) {
        return attr ? false : true;
      });
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
