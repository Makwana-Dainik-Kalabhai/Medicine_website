if (window.history.replaceState) {
  window.history.replaceState(null, null, window.location.href);
}

$(document).ready(function () {
  var last_index = $(".add-description").val();

  $(".add-description").click(function () {
    $(".description-form").append(
      `<div class="row">
            <div class="col-md-1 border p-3">
                <p>${last_index})</p>
            </div>
            <div class="col-md-3 border p-3">
                <input type="text" name='key[]' class="form-control" />
            </div>
            <div class="col-md-6 border p-3">
                <textarea class="border w-100 text-secondary py-1 px-2" name='value[]' rows="5"></textarea>
            </div>
            <div class="col-md-2 border p-3">
                <button class="btn btn-danger" name="update-description" value="${last_index}">Update</button>
            </div>
        </div>`
    );
    last_index++;
  });
});
